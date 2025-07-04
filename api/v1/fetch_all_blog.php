<?php

require_once "../../vendor/autoload.php";
require_once "../Controllers/all_blog.controller.php";
require_once "../Models/AllBlogs.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $AllBlogController = new AllBlogController();
    $AllBlogController->getBlogs();
} else {
    http_response_code(401);
    echo json_encode(["message" => "Invalid request"]);
}
?>
