<?php
    spl_autoload_register('loadClass');

    function loadClass($class){
        $url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        if(strpos($url,'view') !== false){
            require_once "../".str_replace('\\','/',$class).".class.php";
        }else if(strpos($url,'Classes') !== false){
            require_once str_replace('\\','/',$class).".class.php";
        }else if(strpos($url,'src') !== false){
            require_once "../".str_replace('\\','/',$class).".class.php";
        }
    }
?>