<?php


require_once "../../vendor/autoload.php";
require_once "../Models/TotalBlogs.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $AllBlogController = new TotalBlogs();
 $result = $AllBlogController->getTotalBlogs();

    echo json_encode($result);
} else {
    http_response_code(401);
    echo json_encode(["message" => "Invalid request"]);
}
