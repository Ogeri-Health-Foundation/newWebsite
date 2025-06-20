<?php


class updatePostRouteController  {
    public function updateBlogbyId(){
        $blogId = $_POST['blogId'];
        $title = $_POST['Title'];
        $description = $_POST['Description'];
        $category = $_POST['Category'];
        $body = $_POST['Body'];


        $targetDir = __DIR__ . '/../../uploads/';
        $imageName = basename($_FILES["cover_image"]["name"]);
        $targetFilePath = $targetDir . $imageName;
        $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        $allowedTypes = ["jpg", "jpeg", "png", "gif"];

        if (!in_array($imageFileType, $allowedTypes)) {
            http_response_code(401);
            echo json_encode(["success" => false, "message" => "Only JPG, JPEG, PNG, and GIF files are allowed."]);
            exit;
        }

        if (move_uploaded_file($_FILES["cover_image"]["tmp_name"], $targetFilePath)) {
            $postModel = new UpdateBlogPost();
      
$result = $postModel->updatePost([
    'id'=> $blogId,
    'title' => $title,
    'description' => $description,
    'category' => $category,
    'body' => $body,
    'image' => $imageName
]);

if ($result['success']) {
    http_response_code(201);
    echo json_encode(["success" => true, "message" => $result['message']]);
} else {
    echo json_encode(400);
    echo json_encode(["success" => false, "message" => $result['message']]);
}
        }

        

    }

}