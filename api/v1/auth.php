<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once "../Middleware/GlobalAuth.php";

$auth = new Auth();
$isAuthenticated = $auth->authenticate();

if ($isAuthenticated) {
    // http_response_code(200);
    echo json_encode(["status" => "success", "message" => "Authenticated"]);
} else {
    // http_response_code(401);
    echo json_encode(["status" => "error", "message" => "Not Authenticated"]);
}
