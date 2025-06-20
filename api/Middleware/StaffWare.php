<?php
require_once "../Models/Staff.php";
require_once "../Controllers/staff.controller.php";

class AddStaffWare {
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(["success" => false, "message" => "Invalid request method."]);
            exit;
        }

        $controller = new StaffController();
        $errors = $controller->validateForm($_POST);

        if (!empty($errors)) {
            echo json_encode(["success" => false, "message" => implode(" ", $errors)]);
            exit;
        }

        $Specilization = $_POST['Specialization'];
        $Name = $_POST['Name'];
        $category = $_POST['Category'];
       

        // Handle Image Upload
        $targetDir = __DIR__ . '/../../Staff_images/';
        $imageName = basename($_FILES["cover_image"]["name"]);
        $targetFilePath = $targetDir . $imageName;
        $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        $allowedTypes = ["jpg", "jpeg", "png", "gif"];

        if (!in_array($imageFileType, $allowedTypes)) {
            echo json_encode(["success" => false, "message" => "Only JPG, JPEG, PNG, and GIF files are allowed."]);
            exit;
        }

        if (move_uploaded_file($_FILES["cover_image"]["tmp_name"], $targetFilePath)) {
            $postModel = new Staff();
      // In PostRoute.php
$result = $postModel->createPost([
    'specialization' =>  $Specilization,
    'name' => $Name,
    'category' => $category,
    'image' => $imageName
]);

if ($result['success']) {
    echo json_encode(["success" => true, "message" => $result['message']]);
} else {
    echo json_encode(["success" => false, "message" => $result['message']]);
}
        }
    }
}
?>
