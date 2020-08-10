<?php
    include_once "../Classes/Model/Session.class.php";
    include_once "../Classes/Model/Database.class.php";
    include_once "../Classes/Controller/Controller.class.php";
    include_once "../Classes/Controller/Payment.class.php";

        if(isset($_POST['pro_id']) && !empty($_POST['pro_id'])){
            if(isset($_FILES['file']['name']) && !empty($_FILES['file']['name']))
            {
                $dbh = new Model\Database;
                $db = $dbh->connect();

                $ctrl = new Controller($db);
                $edit_index = $_POST['file-index'];
                $pro_id = $_POST['pro_id'];
                $ctrl->setFile($_FILES['file']);
                $ctrl->update_image($pro_id,$edit_index);
            }
        }
        if(isset($_POST['del-index'])){
            $dbh = new Database;
            $db = $dbh->connect();
            $ctrl = new Controller($db);
            $edit_id = $_POST['edit_id'];
            $ctrl->delete_image($edit_id,$_POST['del-index']);
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
    
    if(isset($_GET['logout'])){
        $dbh = new Database;
        $db = $dbh->connect();
        $ctrl = new Controller($db);
        $ctrl::logOut();
    }
    if(isset($_POST['cart'])){
        //echo $_POST['cart_id']
        if($_POST['cart_id'] == 'login_first'){
            $url = $_SERVER['REQUEST_URI'];
            Session::set('cart_login','Login to create your Shopping Cart');
            if(strpos($url,'View')){
                header('Location: ../../E-shop/View/Admin/concept-master/Login/login.php');
            }
        }else{
            $dbh = new Database;
            $db = $dbh->connect();
            $ctrl = new Controller($db);
            $ctrl->add_cart($_POST['cart_id']);
        }
    }
    if(isset($_POST['Address'])){
        $obj = new Controller;
        foreach($_POST as $key => $value){
            if(empty($_POST[$key])){
                $obj->error[] =  $key." is required!";
            }
        }
        if(empty($obj->error)){
            $payType = $_POST['PAY_TYPE'];
            $cardType = new $payType;
            $buy = new Payment(intval(trim($_POST['AMOUNT'],'$')));
            $buy->buyNow($cardType);
        }else{
            echo $obj->display_errors();
        }
    }
    if(isset($_POST['pay'])){
        $dbh = new Database;
        $db = $dbh->connect();
        $ctrl = new Controller($db);
        $ctrl->checkout();
    }
?>