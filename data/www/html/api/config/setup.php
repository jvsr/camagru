<?php

include_once ('./database.php');

$database = new Database;
$conn = $database->getConnection();

try {
	$stmt = $conn->prepare("
		DROP TABLE IF EXISTS `users`
	");
	$stmt->execute();
} catch (PDOException $exception) {
	die("Connection error: " . $exception->getMessage());
}

try {
	$stmt = $conn->prepare("
		CREATE TABLE `users`(
			`id` INT(11) NOT NULL AUTO_INCREMENT,
			`firstname` VARCHAR(256) NOT NULL,
			`lastname` VARCHAR(256) NOT NULL,
			`email` VARCHAR(256) NOT NULL,
			`username` VARCHAR(256) NOT NULL,
			`password` VARCHAR(2048) NOT NULL,
			`type` ENUM('normal', 'admin') NOT NULL DEFAULT 'normal',
			`created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
			PRIMARY KEY(`id`)
		) ENGINE = INNODB CHARSET = utf8;
	");
	$stmt->execute();
} catch (PDOException $exception) {
	die("Connection error: " . $exception->getMessage());
}

try {
	$password_hash = password_hash('admin', PASSWORD_BCRYPT);
	$stmt = $conn->prepare("
		INSERT INTO `users`(
			`id`,
			`firstname`,
			`lastname`,
			`email`,
			`username`,
			`password`,
			`type`,
			`created`
		)
		VALUES(
			NULL,
			'Jelle',
			'Visser',
			'jvisser@student.codam.nl',
			'jvisser',
			'" . $password_hash . "',
			'admin',
			CURRENT_TIMESTAMP
		)
	");
	$stmt->execute();
} catch (PDOException $exception) {
	die("Connection error: " . $exception->getMessage());
}

$database->closeConnection();

header('Location: /');
