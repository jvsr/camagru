<?php
header("Access-Control-Allow-Origin: http://localhost/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

function httpResponse($code, $message) {
    http_response_code($code);
    echo json_encode(array("message" => $message));
}

if (array_key_exists('jwt', $_COOKIE)) {
    $jwt = $_COOKIE['jwt'];
} else {
    httpResponse(401, "Invalid token");
    return ;
}

if ($jwt) {
    $explodedJwt = explode('.', $jwt);
    if (count($explodedJwt) != 3) {
        httpResponse(401, "Invalid Token");
        return ;
    } else {
        $jwtHeaderEncoded = $explodedJwt[0];
        $jwtPayloadEncoded = $explodedJwt[1];
        $jwtSignatureEncoded = $explodedJwt[2];
    }
    echo json_encode(array(
        "Header" => $jwtHeaderEncoded,
        "Payload" => $jwtPayloadEncoded,
        "Signature" => $jwtSignatureEncoded
    ));
    $jwtHeader = base64_decode($jwtHeaderEncoded);
    $jwtPayload = base64_decode($jwtPayloadEncoded);
    echo print_r(array(
        "Header" => $jwtHeader,
        "Payload" => $jwtPayload
    ));
    
    $data = $jwtHeaderEncoded . "." . $jwtPayloadEncoded;
    $newJwtSignature = hash_hmac("sha256", $data, "c4m4ragululu#1!wow", true);
    $newJwtSignatureEncoded = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($newJwtSignature));

    if ($newJwtSignatureEncoded === $jwtSignatureEncoded) {
        http_response_code(200);
        echo $jwtPayload;
        return ;
    } else {
        httpResponse(401, "Invalid token");
    }
} else {
    httpResponse(401, "Invalid token");
}