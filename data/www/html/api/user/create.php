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
    httpResponse(400, "User creation failed");
}

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
    if ($user->usernameAvailable()) {
        httpResponse(400, "Username not available");
    } elseif ($user->emailAvailable()) {
        httpResponse(400, "Email not available");
    } else {
        httpResponse(200, "User creation succeeded");
    }
} else {
    httpResponse(400, "User creation failed");
}
