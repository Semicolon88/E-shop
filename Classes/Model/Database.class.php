<?php
    include_once "config.php";

    class Database
    {
        private $host = HOST;
        private $user = USER;
        private $pwd = KEY;
        private $db = DB;

        protected $DBHandler;

        public function connect()
        {
            $this->DBHandler = null;
            $dsn = "mysql:host=".$this->host.";dbname=".$this->db;
            try{
                $this->DBHandler = new PDO($dsn,$this->user,$this->pwd);
                $this->DBHandler->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
                $this->DBHandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                die("Database connection failed : ".$e->getMessage());
            }
            return $this->DBHandler;
        }
    }
    Session::start();
?> 