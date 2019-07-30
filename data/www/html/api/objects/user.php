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

    // Check username availability
    public function usernameAvailable() {
        $stmt = $this->conn->prepare("SELECT * FROM `users` WHERE `username`=:username");
        $stmt->bindParam(':username', $this->username);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return false;
        }
        return true;
    }

    // Check email availability
    public function emailAvailable() {
        $stmt = $this->conn->prepare("SELECT * FROM `users` WHERE `email`=:email");
        $stmt->bindParam(':email', $this->email);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return false;
        }
        return true;
    }
        
    // Create method
    public function create() {
        $stmt = $this->conn->prepare(
                "INSERT INTO " . $this->table_name . "
                SET
                    `firstname` = :firstname,
                    `lastname` = :lastname,
                    `username` = :username,
                    `email` = :email,
                    `password` = :password
                ");
        $this->firstname = htmlspecialchars((strip_tags($this->firstname)));
        $this->lastname = htmlspecialchars((strip_tags($this->lastname)));
        $this->username = htmlspecialchars((strip_tags($this->username)));
        $this->email = htmlspecialchars((strip_tags($this->email)));
        $this->password = htmlspecialchars((strip_tags($this->password)));

        $stmt->bindParam(':firstname', $this->firstname);
        $stmt->bindParam(':lastname', $this->lastname);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);

        $pasword_hash = password_hash($this->password, PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $pasword_hash);

        if ($stmt->execute()) {
            return true;
        }

        return false;
        
    }
}
