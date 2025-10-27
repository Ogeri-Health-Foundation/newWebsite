<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

require_once "../Database/DatabaseConn.php";


$data = json_decode(file_get_contents("php://input"));

if (!isset($data->blogId) || empty($data->blogId)) {
    echo json_encode(["success" => false, "message" => "Blog ID not provided."]);
    exit;
}

$blogId = htmlspecialchars(strip_tags($data->blogId));

try {
    // Create DB connection
    $database = new DatabaseConn();
    $conn = $database->connect();

    // Step 1: Fetch the image name before deletion (so we can delete it from uploads)
    $checkQuery = "SELECT image FROM blog_posts WHERE blog_id = :blog_id";
    $checkStmt = $conn->prepare($checkQuery);
    $checkStmt->bindParam(":blog_id", $blogId);
    $checkStmt->execute();

    $blog = $checkStmt->fetch(PDO::FETCH_ASSOC);

    if (!$blog) {
        echo json_encode(["success" => false, "message" => "No blog found with the provided ID."]);
        exit;
    }

    // Step 2: Delete the blog
    $deleteQuery = "DELETE FROM blog_posts WHERE blog_id = :blog_id";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bindParam(":blog_id", $blogId);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Step 3: Delete image file if it exists
        $imagePath = "../../uploads/" . $blog["image"];
        if (!empty($blog["image"]) && file_exists($imagePath)) {
            unlink($imagePath);
        }

        echo json_encode(["success" => true, "message" => "Blog deleted successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to delete blog."]);
    }

} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Database Error: " . $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => "Error: " . $e->getMessage()]);
}
?>