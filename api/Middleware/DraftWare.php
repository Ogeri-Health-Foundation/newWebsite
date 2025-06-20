<?php
require_once "../Models/BlogPost.php";
require_once "../Controllers/blog.controller.php";
header("Content-Type: application/json");

class DraftRoute {
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(["success" => false, "message" => "Invalid request method."]);
            exit;
        }

        $controller = new DraftController();
        $errors = $controller->validateForm($_POST);

        if (!empty($errors)) {
            echo json_encode(["success" => false, "message" => implode(" ", $errors)]);
            exit;
        }

        $title = $_POST['Title'];
        $description = $_POST['Description'];
        $category = $_POST['Category'];
        $body = $_POST['Body'];

        // Handle Image Upload
        $targetDir = __DIR__ . '/../../uploads/';
        $imageName = basename($_FILES["cover_image"]["name"]);
        $targetFilePath = $targetDir . $imageName;
        $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        $allowedTypes = ["jpg", "jpeg", "png", "gif"];

        if (!in_array($imageFileType, $allowedTypes)) {
            echo json_encode(["success" => false, "message" => "Only JPG, JPEG, PNG, and GIF files are allowed."]);
            exit;
        }

        if (move_uploaded_file($_FILES["cover_image"]["tmp_name"], $targetFilePath)) {
            $postModel = new Draft();
      // In PostRoute.php
$result = $postModel->createDraft([
    'title' => $title,
    'description' => $description,
    'category' => $category,
    'body' => $body,
    'image' => $imageName
]);

if ($result['success']) {
    $blog_id = $result['blog_id']; 
    $eventImages = [];
    for ($i = 1; $i <= 3; $i++) {
        $inputName = "event_image" . $i;

        if (!empty($_FILES[$inputName]["name"])) {
            $eventImageName = basename($_FILES[$inputName]["name"]);
            $eventImagePath = $targetDir . $eventImageName;
            $eventImageType = strtolower(pathinfo($eventImagePath, PATHINFO_EXTENSION));

            if (!in_array($eventImageType, $allowedTypes)) {
                echo json_encode(["success" => false, "message" => "Invalid file type for event images."]);
                exit;
            }

            if (move_uploaded_file($_FILES[$inputName]["tmp_name"], $eventImagePath)) {
                $eventImages[] = $eventImageName;
                $this->storeBlogImage($blog_id, $eventImageName);
            } else {
                echo json_encode(["success" => false, "message" => "Failed to upload $eventImageName."]);
                exit;
            }
        }
    }

    echo json_encode(["success" => true, "message" => "Event drafted successfully!"]);
} else {
    echo json_encode(["success" => false, "message" => "Failed to draft event."]);
}
}
}



private function storeBlogImage($blog_id, $imageName) {
    $db = new DatabaseConn();
    $conn = $db->connect();

    try {
        $blog_gallery_id = uniqid("gallery_"); 
        $stmt = $conn->prepare("
            INSERT INTO blog_images (blog_image_id, blog_id, img_path) 
            VALUES (:image_id, :blog_id, :img_path)
        ");

        $stmt->bindParam(':image_id', $blog_gallery_id);
        $stmt->bindParam(':blog_id', $blog_id);
        $stmt->bindParam(':img_path', $imageName);

        $stmt->execute();
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => "Error storing event image: " . $e->getMessage()]);
        exit;
    }
}
}

  
?>

