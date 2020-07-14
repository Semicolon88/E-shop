<?php
    namespace Classes\Controller;

    class Session
    {
        private static $_sessionStarted = false;

        public static function start()
        {
            if(self::$_sessionStarted == false)
            {
                session_start();
                self::$_sessionStarted = true;
            }
        }
        public static function set($sess,$sessValue)
        {
            $_SESSION[$sess] = $sessValue;
        }
        public static function get($sess)
        {
            if(isset($_SESSION[$sess]))
            {
                return $_SESSION[$sess];
            }    
        }
    }
?>