<?php

require_once "../Middleware/GlobalAuth.php";

$authenticate = new Auth();
$authenticate->authenticate();

error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once "../Controllers/add_images.controller.php";

header("Content-Type: application/json");





if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $route = new addImageRoute();
    $result = $route->addImagesbyId();
    echo json_encode($result);
    
    }else {
        http_response_code(401);
        echo json_encode(["message" => "Invalid request"]);
    }
