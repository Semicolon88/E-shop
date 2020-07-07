<?php
    spl_autoload_register(function($class){
        $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        if(strpos($url,'view') !== false){
            require_once "../".str_replace('\\','/',$class).".class.php";
        }else if(strpos($url,'Classes')){
            require_once str_replace('\\','/',$class).".class.php";
        }
    });
?>