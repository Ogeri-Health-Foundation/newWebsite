<?php
// require_once __DIR__ . '/../app/routes/PostRoute.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "../Models/BlogPost.php";
require_once "../Middleware/PostWare.php";
require_once "../Middleware/GlobalAuth.php";
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // $authenticate = new Auth();
    // $authenticate->authenticate();

$route = new PostRoute();
$route->store();

}
else if ($_SERVER['REQUEST_METHOD'] === 'GET') {

$route = new PostRoute();
$route->fetchBlogbyId();

}


else{
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}