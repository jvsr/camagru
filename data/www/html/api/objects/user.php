<?php

class User
{
    // Database properties
    private $conn;
    private $table_name = "users";

    // Object properties
    public  $id;
    public  $firstname;
    public  $lastname;
    public  $username;
    public  $email;
    public  $password;

    // Constructor
    public function __construct($database) {
        $this->conn = $database;
    }

    // Create method
    public function create() {
        return (true);
    }
}
