<?php
    class Db{
        private $host = 'localhost';
        private $user = 'root';
        private $pass = '';
        private $dbname = 'area_sale';
        private $pdo;
        function __construct(){
            $this->connect();
        }
        function connect(){
            $this->pdo = new PDO('mysql:host='.$this->host.';dbname='.$this->dbname.';charset=utf8', $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        }
    }
?>
