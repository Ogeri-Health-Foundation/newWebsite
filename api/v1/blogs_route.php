<?php



require_once "../Controllers/fetchBlogs.controller.php";
require_once "../Models/Blogs.php";


error_reporting(E_ALL);
ini_set('display_errors', 1);

$BlogController = new FecthBlogController();

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $BlogController->fetchBlogs();
}  else {
    http_response_code(401);
    echo json_encode(["message" => "Invalid request"]);
}
?>
