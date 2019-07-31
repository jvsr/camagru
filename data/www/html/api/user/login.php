<?php
header("Access-Control-Allow-Origin: http://localhost/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once ('../config/database.php');
include_once ('../objects/user.php');

function httpResponse($code, $message) {
    http_response_code($code);
    echo json_encode(array("message" => $message));
}

// Initialize database object
$database = new Database();
$conn = $database->getConnection();

// Initialize user object
$user = new User($conn);

// Get posted data
$data = json_decode(file_get_contents("php://input"));

if (empty($data)) {
    httpResponse(400, "Empty user data");
}

// Set object property values
$user->username = $data->username;

if (
    !empty($user->username) && 
    !empty($data->password) && 
    $user->usernameExists() &&
    password_needs_rehash($data->password())
) {
    $token = array(
        "data" => array (
            "id" => $user->id,
            "firstname" => $user->firstname,
            "lastname" => $user->lastname,
            "email" => $user->email,
            "username" => $user->username
        )
    );
    httpResponse(200, "User login succesful");
} else {
    httpResponse(401, "User login failed");
}

