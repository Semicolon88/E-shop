<?php
    include_once "Autoload.inc.php";
    //include_once "../Classes/Model/Database.class.php";
    //include_once "../Classes/Controller/Controller.class.php";
    use Classes\Controller as Ctrl;
   /* if($_POST){
        $obj = new Ctrl\Controller;
        $obj->setter($_POST,$_FILES);
        $exec = $obj->add();
        if($exec){
            header('Location: data-tables.php');
        }
    }*/
    /*if($_POST){
        print_r($_POST);
        $obj = new Ctrl\Controller;
        $obj->setter($_POST);
        $obj->update(14);
        /*if($exec){
            header('Location: data-tables.php');
        }
    }*/

    if(isset($_POST['submit'])){
        $obj = new Ctrl\Controller;
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
        $obj->setter($fields,$_FILES);
        $obj->add();
        /*if($exec){
            header('Location: ../View/Admin/Concept_master/pages/data-tables.php');
        }*/
    }
    if(isset($_GET['edit'])){
        $edit_id = $_GET['edit'];
        $edit_data = new Ctrl\Controller;
        $data = $edit_data->select_this($edit_id);
        $img = explode(',',$data['photo']);
        if($_POST){
            print_r($_POST);
            print_r($_FILES);
        }
        //print_r($img);
        /*if($_POST){
            $productName = $_POST['product_name'];
            $price = $_POST['price'];
            $listPrice = $_POST['list_price'];
            $cat = $_POST['category'];
            $port = $_POST['portfolio'];
            $brand = $_POST['brand'];
            $details = $_POST['details'];
    
            $fields = [
                'product_name'=>$productName,
                'price'=>$price,
                'list_price'=>$listPrice,
                'category'=>$cat,
                'portfolio'=>$port,
                'brand'=>$brand,
                'description'=>$details,
            ];
            $edit_data->set($fields);
            $exec = $edit_data->update($edit_id);
        }  */            
    }
    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $obj = new Ctrl\Controller;
        $obj->delete_this($delete_id);
    }
    if(isset($_POST['data'])){
        $count = $_POST['data'];
        $i = 0;
        $response = "";
        while($i < $count){
            $response .= "<tr>";
            $response .= "<td><input class='form-control' id='size$i' type='text'></td>";
            $response .= "<td><input class='form-control' id='qty$i' type='number' min=0></td>";
            $response .= "</tr>";
            $i++;
        }
        echo $response;
    }
?>