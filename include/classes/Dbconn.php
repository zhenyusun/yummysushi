<?php
    class Dbconn{
        public function connect(){
            $dbConnString = "mysql:host=".DB_SERVER."; dbname=".DB_DATABASE;
            $pdoObj = new PDO($dbConnString, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
            return $pdoObj;
        }
    }
?>
