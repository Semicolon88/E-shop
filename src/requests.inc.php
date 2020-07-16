<?php
    //include_once "Autoload.inc.php";
    //use Classes\Controller\Controller as Controller;
    if(isset($_POST['submit']))
    {
        $obj = new Controller;
        $productName = $_POST['product_name'];
        $price = $_POST['price'];
        $listPrice = $_POST['list_price'];
        $cat = $_POST['category'];
        $port = $_POST['portfolio'];
        $brand = $_POST['brand'];
        $details = $_POST['details'];
        $sizes = $_POST['sizes'];


        $fields = [
            'product_name'=>$productName,
            'price'=>$price,
            'list_price'=>$listPrice,
            'category'=>$cat,
            'portfolio'=>$port,
            'brand'=>$brand,
            'description'=>$details,
            'sizes'=>$sizes
        ];
        foreach ($fields as $key => $value) 
        {
            if(isset($_POST[$key]) && empty($_POST[$key]))
            {
                $obj->error[] = "All feilds are required";
            break;
            }
        }
        if(empty($_FILES['photo']['name'][0])){
            $obj->error[] = "upload image";
        }else{
            $obj->setFile($_FILES);
            $obj->upload_image();
        }
        if(!empty($obj->error))
        {
            echo $obj->display_errors();
        }else{
            $obj->setData($fields);
            $obj->add();
        }
    }
    if(isset($_GET['edit']))
    {
        $edit_id = $_GET['edit'];
        $edit_data = new Controller;
        $data = $edit_data->select_this($edit_id);
        $img = explode(',',$data['photo']);

        if(isset($_POST['edit']))
        {
            $productName = $_POST['product_name'];
            $price = $_POST['price'];
            $listPrice = $_POST['list_price'];
            $cat = $_POST['category'];
            $port = $_POST['portfolio'];
            $brand = $_POST['brand'];
            $details = $_POST['details'];
            $sizes = $_POST['sizes'];
            $fields = [
                'product_name'=>$productName,
                'price'=>$price,
                'list_price'=>$listPrice,
                'category'=>$cat,
                'portfolio'=>$port,
                'brand'=>$brand,
                'description'=>$details,
                'sizes'=>$sizes
            ];
            foreach ($fields as $key => $value) 
            {
                if(isset($_POST[$key]) && empty($_POST[$key]))
                {
                    $edit_data->error[] = "All feilds are required";
                break;
                }
            }
            if(!empty($edit_data->error))
            {
                //header('Location: ../View/Admin/concept-master/Post.php?edit='.$edit_id);
                echo $edit_data->display_errors();
            }else
            {
                $edit_data->setData($fields);
                $edit_data->update($edit_id);
            }
        }           
    }
    if(isset($_GET['delete']))
    {
        $delete_id = $_GET['delete'];
        $obj = new Controller;
        $obj->delete_this($delete_id);
    }
    if(isset($_POST['data']))
    {
        $count = $_POST['data'];
        $i = 0;
        $response = "";
        while($i < $count)
        {
            $response .= "<tr>";
            $response .= "<td><input class='form-control' id='size$i' type='text'></td>";
            $response .= "<td><input class='form-control' id='qty$i' type='number' min=0></td>";
            $response .= "</tr>";
            $i++;
        }
        echo $response;
    }
    if(isset($_POST['signup']))
    {
        $email = $_POST['email'];
        $pword = $_POST['pword'];
        $rPword = $_POST['r-pword'];
        $obj = new Controller;
        if($pword != $rPword)
        {
            $obj->error[] = "Password does not match";
        }
        $fields = [
            'email'=>$email,
            'pword'=>password_hash($pword,PASSWORD_DEFAULT)
        ];
        if(!empty($obj->error))
        {
            echo $obj->display_errors();
        }else
        {
            $obj->setData($fields);
            $obj->addUser();
        }
    }
    if(isset($_POST['login']))
    {
        $email = $_POST['email'];
        $pword = $_POST['pword'];
        $obj = new Controller;
        $obj->setData(['email'=>$email,'pword'=>$pword]);
        $obj->login();

    }
    /*if(isset($_SESSION['error_flash'])){
        echo "<div class='bg-info mx-auto col-6>".Session::get('error_flash')."</div>";
    }*/
?>