<?php

class DbConnection {
    private $connection;
    private $servername;
    private $username;
    private $password;
    private $dbname;

    public function __construct($servername, $dbname, $username, $password) {
        $this->servername = $servername;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
    }

    public function connect() {
        try {
            $connection = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }

        return $connection;
    }
}