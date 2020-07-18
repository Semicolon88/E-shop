<?php
    include_once "../Classes/Model/Session.class.php";
    include_once "../Classes/Model/Database.class.php";
    include_once "../Classes/Controller/Controller.class.php";
    if(isset($_GET['logout'])){
        $obj = new Controller;
        $obj::logOut();
    }
?>