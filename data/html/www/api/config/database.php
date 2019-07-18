<?php

class Database
{
	// Initializing database variables
	private $host = "127.0.0.1";
	private $db_name = "camagru_db";
	private $username = "jvisser";
	private $password = "camagruadmin";
	public $conn;
	
	// Create and returns a database connection
	public function getConnection(){
		$this->conn = null;
		$dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name;
		try {
			$this->conn = new PDO($dsn, $this->username, $this->password);
			$this->conn->exec("set names utf8");
		} catch(PDOException $exception) {
			echo "Connection error: " . $exception->getMessage();
			die();
		}
		return $this->conn;
	}

	// Close database connection
	public function closeConnection(){
		$this->conn = null;
	}
}
