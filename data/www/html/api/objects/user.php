<?php

class User
{
    // Database properties
    private $conn;
    private $tableName = "users";

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

    // Check if user exists in database
    public function usernameExists() {
        $stmt = $this->conn->prepare(
            "SELECT `id`, `firstname`, `lastname`, `email`, `password` FROM " . $this->tableName . "
            WHERE username = :username
            LIMIT 0,1
        ");
        $this->username = htmlspecialchars(strip_tags($this->username));
        $stmt->bindParam(':username', $this->username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            $this->id = $row['firstname'];
            $this->id = $row['lastname'];
            $this->id = $row['email'];
            $this->id = $row['password'];
            return true;
        } else {
            return false;
        }
    }

    // Check username availability
    public function usernameAvailable() {
        $stmt = $this->conn->prepare(
            "SELECT * FROM " . $this->tableName . "
            WHERE `username`=:username
        ");
        $stmt->bindParam(':username', $this->username);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return false;
        } else {
            return true;
        }
    }
    // Check email availability
    public function emailAvailable() {
        $stmt = $this->conn->prepare(
            "SELECT * FROM " . $this->tableName . "
            WHERE `email`=:email
        ");
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
            "INSERT INTO " . $this->tableName . "
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
