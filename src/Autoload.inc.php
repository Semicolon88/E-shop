<?php
    spl_autoload_register('loadClass');

    function loadClass($class)
    {
        if(strpos($_SERVER['REQUEST_URI'],'Admin') !== false)
        {
            require_once "../../../".str_replace('\\','/',$class).".class.php";
        }else if(strpos($_SERVER['REQUEST_URI'],'Classes') !== false)
        {
            require_once str_replace('\\','/',$class).".class.php";
        }else if(strpos($_SERVER['REQUEST_URI'],'src') !== false)
        {
            require_once "../".str_replace('\\','/',$class).".class.php";
        }
    }
?>