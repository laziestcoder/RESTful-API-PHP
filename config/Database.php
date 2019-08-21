<?php

//Database.php


class Database {

    //DB Params

    private $host = 'localhost';
    private $db_name = 'restfulapiphp';
    private $username = 'root';
    private $password = '';
    private $connection;


    //DB Connect

    public function connect(){
        $this->connection = null;

        try{
            $this->connection = new PDO('mysql:host='.$this->host.';dbname='.$this->db_name,$this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $error){
            echo 'Connection Error: '.$error->getMessage();
        }
        return $this->connection;
    }
}

?>