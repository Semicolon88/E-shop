<?php
    spl_autoload_register(function($class){
        $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        if(strpos($url,'Classes') !== false){
            if(strpos($url,'Model') !== false){
                var_dump($class);
                require_once "../Controller/".$class.".class.php";
            }elseif(strpos($url,'Controller') !== false){
                var_dump($class);
                require_once "../Model/".$class.".class.php";
            }
        }elseif (strpos($url,'View') !== false) {
            # code...
            if(strpos($url,'pages')){
                var_dump($class);
                require_once "../../../../Classes/Controller/".$class.".class.php";
            }
        }
    })
?>