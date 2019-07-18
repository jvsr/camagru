<?php

class Database
{
	// Initializing database variables
	private $host = "mysql";
	private $port = "3306";
	private $DB_NAME = "camagru_db";
	private $DB_USER = "root";
	private $DB_PASSWORD = "camagruadmin";
	public $conn;
	
	// Create and returns a database connection
	public function getConnection() {
		$this->conn = null;
		$DB_DSN = "mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->DB_NAME;
		try {
			$this->conn = new PDO($DB_DSN, $this->DB_USER, $this->DB_PASSWORD);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->conn->exec("SET NAMES utf8");
		} catch(PDOException $exception) {
			die("Connection error: " . $exception->getMessage());
		}
		return $this->conn;
	}

	// Close database connection
	public function closeConnection() {
		$this->conn = null;
	}
}
