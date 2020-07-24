<?php
    interface InsertFace
    {
        public function add();
        public function upload_image();
        public function validate(); 
    }

    class Controller extends Database implements InsertFace
    {
        public $data;
        public $files;
        public $fileNames = "";
        public $error = [];
        public $success = [];

        public function setData($data)
        {
            $this->data = $data;
        }
        public function setFile($file)
        {
            $this->files = $file;
        }

        public function add_brand()
        {
            $brand = $this->data['brand'];
            $select_brand = "SELECT * FROM brands WHERE brand='$brand'";
            $prep_brand_query = $this->DBHandler->query($select_brand);
            $brand_prop = $prep_brand_query->fetch();
            if($prep_brand_query->rowCount() == 0)
            {
                $sql = "INSERT INTO brands (brand) VALUE (:brand)";
                $stmt = $this->DBHandler->prepare($sql);
                $stmt->bindValue(':brand',$this->data['brand']);
                $exec = $stmt->execute();
                $select_brand = "SELECT * FROM brands WHERE brand='$brand'";
                $prep_brand_query = $this->DBHandler->query($select_brand);
                $brand_prop = $prep_brand_query->fetch();
            }
            $this->data['brand'] = $brand_prop['id'];
        }

        public function add_category()
        {
            $query_cat = "SELECT * FROM categories WHERE category = :category AND parent = 0";
            $prep_cat_query = $this->DBHandler->prepare($query_cat);
            $prep_cat_query->bindValue(':category',$this->data['category']);
            $prep_cat_query->execute();
            $parent = $prep_cat_query->fetch();
            if($prep_cat_query->rowCount() == 0)
            {
                $sql = "INSERT INTO categories (category) VALUE (:category)";
                $prep_cat_query = $this->DBHandler->prepare($sql);
                $prep_cat_query->bindValue(':category',$this->data['category']);
                $exec = $prep_cat_query->execute();
                $query_cat = "SELECT * FROM categories WHERE category = :category AND parent = 0";
                $prep_cat_query = $this->DBHandler->prepare($query_cat);
                $prep_cat_query->bindValue(':category',$this->data['category']);
                $prep_cat_query->execute();
                $parent = $prep_cat_query->fetch();
            }
            $this->data['category'] = $parent['id'];
            //////////Insert portfolio
            $query_child = "SELECT * FROM categories WHERE category = ? AND parent = ?";
            $prep_child_query = $this->DBHandler->prepare($query_child);
            $prep_child_query->execute([$this->data['portfolio'],$parent['id']]);
            $child = $prep_child_query->fetch();
            if($prep_child_query->rowCount() == 0)
            {
                $sql = "INSERT INTO categories (category,parent) VALUES (?,?)";
                $stmt = $this->DBHandler->prepare($sql);
                $exec = $stmt->execute([$this->data['portfolio'],$parent['id']]);
                $query_cat = "SELECT * FROM categories WHERE category = ? AND parent = ?";
                $prep_child_query = $this->DBHandler->prepare($query_cat);
                $prep_child_query->execute([$this->data['portfolio'],$parent['id']]);
                $child = $prep_child_query->fetch();
            }
            $this->data['portfolio'] = $child['id'];
        }
        public function upload_image()
        {
            $name = $this->files['photo']['name'];
            $size = $this->files['photo']['size'];
            $tmp_name = $this->files['photo']['tmp_name'];
            $type = $this->files['photo']['type'];
            $formats = ['jpg','jpeg','png'];
            $db_path = [];
            for($i = 0;$i < count($name);$i++)
            {
                $ext = explode('/',$type[$i]);
                $actExt = end($ext);
                if(!in_array($actExt,$formats))
                {
                    $this->error[] = "Image format not allowed";
                break;
                }
                if($size[$i] > 101010101)
                {
                    $this->error[] = "File too large";
                break;
                }
                if(empty($this->error))
                {
                    $file_name = sha1(microtime()).'.'.$actExt;
                    $dir = $_SERVER['DOCUMENT_ROOT'].'/E-shop/View/Admin/Uploads/'.$file_name;
                    $db_path[] = '/E-shop/View/Admin/Uploads/'.$file_name;
                    move_uploaded_file($tmp_name[$i],$dir);
                }
            }
            $this->fileNames .= implode(',',$db_path);
        }
        public function validate()
        {
            $this->add_brand();
            $this->add_category();
        }
        public function add()
        {
            $this->validate();
            $this->data['photo'] = $this->fileNames;
                $query_keys = implode(',',array_keys($this->data));
                $query_values = implode(', :',array_keys($this->data));
                $query = "INSERT INTO products($query_keys) VALUES(:".$query_values.")";
                $prep_stmt = $this->DBHandler->prepare($query);
                foreach($this->data as $key => $value)
                {
                    $prep_stmt->bindValue(":".$key,$value);
                }
                $exec = $prep_stmt->execute();
                if($exec)
                {
                    header('Location: pages/data-tables.php');
                }
        }
        public function selectAll()
        {
            $select_query = "SELECT * FROM products WHERE deleted=0";
            $stmt = $this->DBHandler->query($select_query);
            if($stmt->rowCount() > 0)
            {
                while($row = $stmt->fetch())
                {
                    $data[] = $row;
                }
                return $data;
            }
        }
        public function select_this($id)
        {
            $query = "SELECT * FROM products WHERE id=:id";
            $prep_stmt = $this->DBHandler->prepare($query);
            $prep_stmt->bindValue(':id',$id);
            $prep_stmt->execute();
            $result = $prep_stmt->fetch();
            $get_cat = "SELECT * FROM categories WHERE id = ? AND parent = 0";
            $prep = $this->DBHandler->prepare($get_cat);
            $prep->execute([$result['category']]);
            $cat_res = $prep->fetch();
            $result['category'] = $cat_res['category'];
            ////////
            $get_port = "SELECT * FROM categories WHERE id =:id AND parent =:parent ";
            $prep_port = $this->DBHandler->prepare($get_port);
            $prep_port->bindValue(':id',$result['portfolio']);
            $prep_port->bindValue(':parent',$cat_res['id']);
            $prep_port->execute();
            $port_res = $prep_port->fetch();
            $result['portfolio'] = $port_res['category'];
            //////////
            $get_brand = "SELECT * FROM brands WHERE id =?";
            $prep_brand = $this->DBHandler->prepare($get_brand);
            $prep_brand->execute([$result['brand']]);
            $brand_res = $prep_brand->fetch();
            $result['brand'] = $brand_res['brand'];
            return $result;
        }  
        public function update($id)
        {
            $this->validate();
            $st = "";
            foreach ($this->data  as $key => $value) 
            {
                $st .= "$key = :".$key.", ";
            }
            $sql = "";
            $sql.= "UPDATE products SET ".rtrim($st,', ');
            $sql.= " WHERE id = ".$id;
            $stmt = $this->DBHandler->prepare($sql);
            foreach ($this->data as $key => $value) 
            {
                # code...
                $stmt->bindValue(":".$key,$value);
            }
            $exec = $stmt->execute();
            if($exec)
            {
                header('Location: pages/data-tables.php');
            }
        }
        public function delete_this($id)
        {
            $sequel = "UPDATE products SET deleted = 1 WHERE id=?";
            $stmt = $this->DBHandler->prepare($sequel);
            $exec = $stmt->execute([$id]);
            if($exec)
            {
                header('Location: pages/data-tables.php');
            }
        }
        public function display_errors()
        {
            $display = "<ul class='bg-info text-center m-b-18'>";
            foreach ($this->error as $key) 
            {
                # code...
                $display .= "<li class='text-danger'>".$key."</li>";
            }
            $display .= "</ul>";
            return $display;
        }
        public function addUser()
        {
            $keys = implode(',',array_keys($this->data));
            $values = implode(', :',array_keys($this->data));
            $sequel = "SELECT * FROM users WHERE email = ?";
            $stmt = $this->DBHandler->prepare($sequel);
            $stmt->execute([$this->data['email']]);
            if($stmt->rowCount() > 0)
            {
                $this->error[] = "User with this email already exist!";
            }

            if(!empty($this->error))
            {
                echo $this->display_errors();
            }else
            {
                $sequel = "INSERT INTO users ($keys) VALUES (:".$values.")";
                $stmt = $this->DBHandler->prepare($sequel);
                foreach ($this->data as $key => $value)
                {
                    # code...
                    $stmt->bindValue(":".$key,$value);
                }
                $exec = $stmt->execute();
                if($exec)
                {
                    header('Location: ../../../index.php');
                }
            }
        }
        public function login()
        {
            $sequel = "SELECT * FROM users WHERE email = ?";
            $stmt = $this->DBHandler->prepare($sequel);
            $stmt->execute([$this->data['email']]);
            $result = $stmt->fetch();
            if($stmt->rowCount() == 0)
            {
                $this->error[] = "User not found";
            }
            if(!empty($this->error))
            {
                echo $this->display_errors();    
            }else
            {
                if(!password_verify($this->data['pword'],$result['pword']))
                {
                    $this->error[] = "Password does not match our record.Try again";
                }
                if(!empty($this->error))
                {
                    echo $this->display_errors();
                }else
                {
                    Session::start();
                    Session::set('user_id',$result);
                    //header('Location: '.$url);
                    if(Session::get('user_id')['permission'] == 1){
                        header('Location: ../pages/data-tables.php');
                    }else{
                        header('Location: ../../../index.php');
                    }
                }
            }
        }
        static public function is_logged_in()
        {
            if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
            {
                return true;
            }
            return false;
        }
        public static function login_error_redirect($url)
        {
            Session::set('error_flash','You have no permission to this page');
            if(isset($_SESSION['user_id']))
            {
                unset($_SESSION['error_flash']);
            }
            header('Location: '.$url);
        }
        public static function logOut()
        {
            if(isset($_SESSION))
            {
                Session::destroy();
            }
            header("Location: ../View/index.php");
        }
        public function add_cart($id){
            $cart_data = $this->select_this($id);
            $key = [];
            $value = [];
            $field = ['product_name','list_price','sizes','photo'];
            for($i = 0;$i < count($field);$i++){
                if(in_array($field[$i],array_keys($cart_data))){
                    $index = $field[$i];
                    $key[] =  $field[$i];
                    $value[] = $cart_data[$index];
                }
            }
            $keys = implode(',',$key);
            $values = implode(', :',$key);

            $sequel = "INSERT INTO cart($keys) VALUES(:".$values.")";
            $stmt = $this->DBHandler->prepare($sequel);
            for($i = 0;$i < count($key);$i++){
                $stmt->bindValue(':'.$key[$i],$value[$i]);
            }
            $exec = $stmt->execute();
            if($exec){
                header('Location: ../View/index.php');
            }
        }
        public function cart(){
            $sequel = "SELECT * FROM cart WHERE active = 1";
            $result = $this->DBHandler->query($sequel);
            return $result;
        }
    }

?>