<?php
header("Access-Control-Allow-Origin: http://localhost/login.php/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once ('api/config/database.php');
include_once ('api/objects/user.php');

$database = new Database();
$conn = $database->getConnection();

$user = new User();
