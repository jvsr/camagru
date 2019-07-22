<?php
header("Access-Control-Allow-Origin: http://localhost/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once ('../config/database.php');
include_once ('../objects/user.php');

// Initialize database object
$database = new Database();
$conn = $database->getConnection();

// Initialize user object
$user = new User($conn);

// Get posted data
$data = json_decode(file_get_contents("php://input"));

// Set object property values
$user->firstname = $data->firstname;
$user->lastname = $data->lastname;
$user->username = $data->username;
$user->email = $data->email;
$user->password = $data->password;

// Create user
if (
    // If all data is filled in
    !empty($user->firstname) &&
    !empty($user->lastname) &&
    !empty($user->username) &&
    !empty($user->email) &&
    !empty($user->password) &&
    // And user creation succeeds
    $user->create()
) {
    // Set response code
    http_response_code(200);

    // Return message: User succesfully created
    echo json_encode(array("message" => "User succesfully created."));
} else {
    // Set response code
    http_response_code(400);

    // Return message: User creation failed
    echo json_encode(array("message" => "User creation failed."));
}
