<?php
    //include_once "header.inc.php";
    include_once "Autoload.inc.php";
    use Classes\Controller\Controller as Ctrl;
    if(isset($_POST['submit']))
    {
        $obj = new Ctrl;
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
            //print_r($_FILES);
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
        $edit_data = new Ctrl;
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
                $exec = $edit_data->update($edit_id);
                //echo "whats wrong?";
            }
        }           
    }
    if(isset($_GET['delete']))
    {
        $delete_id = $_GET['delete'];
        $obj = new Ctrl;
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
?>