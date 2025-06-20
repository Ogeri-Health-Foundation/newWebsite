<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// require_once "../Models/BlogPost.php";
// require_once "../Middleware/PostWare.php";
require_once "../Middleware/GlobalAuth.php";
require_once "../Controllers/update_post.controller.php";
require_once "../Models/UpdateBlogPost.php";
header("Content-Type: application/json");





if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $authenticate = new Auth();
    $authenticate->authenticate();


    $route = new updatePostRouteController();
    $route->updateBlogbyId();
    
    }
