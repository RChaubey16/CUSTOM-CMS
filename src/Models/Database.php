<?php

namespace Cms\Models;

require "dbconfig.php";
class Database
{
    public $conn;
    public $result;
    public $sql;

    public function __construct()
    {
        require 'dbconfig.php';

        $this->conn = mysqli_connect($database['host'], $database['user'], $database['password'], $database['dbName']);
        if (!$this->conn) {
            echo "<h1>Datbase connection failed</h1>";
        }
    }
    
    public function fetchUserDetails()
    {
        $query = $this->conn->prepare("SELECT * FROM users");
        $query->execute();
        $ans = $query->get_result();
        return $ans;
    }

    public function insertUserDetails($name, $phone){
        $query = $this->conn->prepare("INSERT INTO users(name, phone) VALUES('$name', '$phone')");
        $query->execute();
        $ans = $query->get_result();
        return $ans;
    }

    // query for inserting block 
    public function insertBlockDetails($title, $desc) {
        $query = $this->conn->prepare("INSERT INTO customBlock(block_title, block_desc) VALUES('$title', '$desc')");
        $query->execute();
        $result = $query->get_result();
        return $result;
    }
    
    // query for displaying block 
    public function displayBlock() {
        $query = $this->conn->prepare("SELECT * FROM customBlock");
        $query->execute();
        $result = $query->get_result();
        return $result;
    }

}
