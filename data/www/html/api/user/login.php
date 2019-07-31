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

function createJwtToken($user) {
    $jwtHeader = json_encode(array(
        "typ" => "JWT",
        "alg" => "HS256"
        )
    );
    $jwtHeaderEncoded = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($jwtHeader));

    $jwtPayload = json_encode(array(
        "id" => $user->id,
        "firstname" => $user->firstname,
        "lastname" => $user->lastname,
        "email" => $user->email,
        "username" => $user->username
        )
    );
    $jwtPayloadEncoded = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($jwtPayload));

    $data = $jwtHeaderEncoded . "." . $jwtPayloadEncoded;
    $jwtSignature = hash_hmac("sha256", $data, "c4m4ragululu#1!wow", true);
    $jwtSignatureEncoded = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($jwtSignature));

    $jwtToken = $jwtHeaderEncoded . "." . $jwtPayloadEncoded . "." . $jwtSignatureEncoded;

    setcookie("jwt", $jwtToken, time() + 60*60*24, '/');
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
    $user->usernameExists() &&
    !empty($user->password) &&
    !empty($data->password) &&
    password_verify($data->password, $user->password)
) {
    createJwtToken($user);
    httpResponse(200, "User login succesful");
} else {
    httpResponse(401, "User login failed");
}

