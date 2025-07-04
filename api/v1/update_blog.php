<?php


error_reporting(E_ALL);
ini_set('display_errors', 1);
// declare(strict_types=1);
// header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once "../Middleware/GlobalAuth.php";

include_once "../Models/UpdateDraft.php";

if ($_SERVER["REQUEST_METHOD"] === "PUT") {

    $authenticate = new Auth();
    $authenticate->authenticate();


    $data = json_decode(file_get_contents("php://input"), true);

    if($data['type'] === 'draft'){
        
    
    $blog_id = $data['blogId'];
    $draft = "draft";
    $UpdateToDraft = new UpdateBlog( $blog_id, $draft);
    $result = $UpdateToDraft->updateToDraft();

    echo json_encode($result);

    } else if($data['type'] === 'publish'){
        $blog_id = $data['blogId'];
        $published = "published";
        $UpdateToPublish = new UpdateBlog( $blog_id, $published);
        $result = $UpdateToPublish->updateToPublish();

        echo json_encode($result);

        }  else {
            http_response_code(401);
            echo json_encode(["message" => "Invalid request type"]);
        }
} else {
    http_response_code(401);
    echo json_encode(["message" => "Invalid request method"]);
}
?>
