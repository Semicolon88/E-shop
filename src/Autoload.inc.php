<?php
    //declare(strict_type = 1);
    spl_autoload_register('loadClass');

    function loadClass($class)
    {
        $url = $_SERVER['REQUEST_URI'];
        if(strpos($url,'Admin') !== false)
        {
            if(strpos($url,'concept-master') !== false)
            {
                if(strpos($url,'pages')){
                    require_once "../../../../".str_replace('\\','/',$class).".class.php";
                }else{
                    require_once "../../../".str_replace('\\','/',$class).".class.php";
                }
            }else
            {if(strpos($url,'Login') !== false){
                require_once "../../../".str_replace('\\','/',$class).".class.php";
            }
        }
        }else if(strpos($url,'Classes') !== false)
        {
            require_once str_replace('\\','/',$class).".class.php";
        }else if(strpos($url,'src') !== false)
        {
            require_once "../".str_replace('\\','/',$class).".class.php";
        }elseif (strpos($url,'Controller') !== false) {
            # code...
            require_once str_replace('\\','/',$class).".class.php";
        }elseif (strpos($url,'View') !== false){
            require_once "../".str_replace('\\','/',$class).".class.php";
        }
    }
?>