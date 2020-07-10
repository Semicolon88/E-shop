<?php
    namespace Classes\Controller;

    use Classes\Model\Database as DB;

    interface InsertFace
    {
        public function add();
        public function upload_image();
        public function validate(); 
    }

    class Controller extends DB implements Insertface
    {
        public $data;
        public $files;
        public $error = [];
        public $success = [];

        public function setter($data,$file)
        {
            $this->data = $data;
            $this->files = $file;
        }

        public function set($data)
        {
            $this->data = $data;
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
            $portfolio = $this->data['portfolio'];
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

            $query_child = "SELECT * FROM categories WHERE category = ? AND parent = ?";
            $prep_child_query = $this->DBHandler->prepare($query_child);
            $prep_child_query->execute([$this->data['portfolio'],$parent['id']]);
            $child = $prep_child_query->fetch();
            if($prep_child_query->rowCount() == 0)
            {
                $sql = "INSERT INTO categories (category,parent) VALUES (?,?)";
                $stmt = $this->DBHandler->prepare($sql);
                $exec = $stmt->execute([$portfolio,$parent['id']]);
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
            $tmp_name = $this->files['photo']['tmp_name'];
            $type = $this->files['photo']['type'];
            $db_path = [];
            for($i = 0;$i < count($name);$i++)
            {
                $ext = explode('/',$type[$i]);
                $actExt = end($ext);
                $file_name = sha1(microtime()).'.'.$actExt;
                $dir = $_SERVER['DOCUMENT_ROOT'].'/E-shop/View/Admin/Uploads/'.$file_name;
                $db_path[] = '/E-shop/View/Admin/Uploads/'.$file_name;
                move_uploaded_file($tmp_name[$i],$dir);
            }
            $this->data['photo'] = implode(',',$db_path);
        }
        public function validate()
        {
            $this->add_brand();
            $this->add_category();
        }
        public function add()
        {
            $this->validate();
            $this->upload_image();
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
    }

?>