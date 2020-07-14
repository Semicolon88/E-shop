<?php
    //declare(strict_type = 1);
    spl_autoload_register('loadClass');

    function loadClass($class)
    {
        if(strpos($_SERVER['REQUEST_URI'],'Admin') !== false)
        {
            if(strpos($_SERVER['REQUEST_URI'],'pages') !== false)
            {
                require_once "../../../../".str_replace('\\','/',$class).".class.php";
            }else
            {
                require_once "../../../".str_replace('\\','/',$class).".class.php";
            }
        }else if(strpos($_SERVER['REQUEST_URI'],'Classes') !== false)
        {
            require_once str_replace('\\','/',$class).".class.php";
        }else if(strpos($_SERVER['REQUEST_URI'],'src') !== false)
        {
            require_once "../".str_replace('\\','/',$class).".class.php";
        }
    }
?>