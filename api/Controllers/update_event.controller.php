<?php


// class updateEventController
// {
//     public function updateEventById()
//     {
//         $blogId = $_POST['edit_id'];
//         $title = $_POST['volunteer-title'];
//         $location = $_POST['volunteer-location'];
//         $time = $_POST['volunteer-time'];
//         $date = $_POST['volunteer-date'];
//         $description = $_POST['volunteer-description'];
//         $body = $_POST['volunteer-body'];
//         $status = $_POST['volunteer-status'];


//         $targetDir = __DIR__ . '/../../uploads/';
//         $imageName = basename($_FILES["volunteer_image"]["name"]);
//         $targetFilePath = $targetDir . $imageName;
//         $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
//         $allowedTypes = ["jpg", "jpeg", "png", "gif"];

//         if (!in_array($imageFileType, $allowedTypes)) {
//             http_response_code(401);
//             echo json_encode(["success" => false, "message" => "Only JPG, JPEG, PNG, and GIF files are allowed."]);
//             exit;
//         }

//         if (move_uploaded_file($_FILES["volunteer_image"]["tmp_name"], $targetFilePath)) {
//             $postModel = new UpdateEvents();

//             $result = $postModel->updateEvent([
//                 'id' => $blogId,
//                 'title' => $title,
//                 'location' => $location,
//                 'time' => $time,
//                 'date' => $date,
//                 'description' => $description,
//                 'body' => $body,
//                 'status' => $status,
//                 'image' => $imageName
//             ]);

//             if ($result['success']) {
//                 http_response_code(201);
//                 echo json_encode(["success" => true, "message" => $result['message']]);
//             } else {
//                 echo json_encode(400);
//                 echo json_encode(["success" => false, "message" => $result['message']]);
//             }
//         }
//     }
// }



class updateEventController
{
    public function updateEventById()
    {
        $blogId = $_POST['edit_id'];
        $title = $_POST['volunteer-title'];
        $location = $_POST['volunteer-location'];
        $time = $_POST['volunteer-time'];
        $date = $_POST['volunteer-date'];
        $description = $_POST['volunteer-description'];
        $body = $_POST['volunteer-body'];
        $status = $_POST['volunteer-status'];

        $postModel = new UpdateEvents();
        
        // Check if a new image was uploaded
        if (!empty($_FILES["volunteer_image"]["name"])) {
            $targetDir = __DIR__ . '/../../uploads/';
            $imageName = basename($_FILES["volunteer_image"]["name"]);
            $targetFilePath = $targetDir . $imageName;
            $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
            $allowedTypes = ["jpg", "jpeg", "png", "gif"];

            if (!in_array($imageFileType, $allowedTypes)) {
                http_response_code(401);
                echo json_encode(["success" => false, "message" => "Only JPG, JPEG, PNG, and GIF files are allowed."]);
                exit;
            }

            if (move_uploaded_file($_FILES["volunteer_image"]["tmp_name"], $targetFilePath)) {
                $result = $postModel->updateEvent([
                    'id' => $blogId,
                    'title' => $title,
                    'location' => $location,
                    'time' => $time,
                    'date' => $date,
                    'description' => $description,
                    'body' => $body,
                    'status' => $status,
                    'image' => $imageName
                ]);
            } else {
                http_response_code(500);
                echo json_encode(["success" => false, "message" => "Failed to upload image"]);
                exit;
            }
        } else {
            // No new image uploaded, update without changing the image
            $result = $postModel->updateEvent([
                'id' => $blogId,
                'title' => $title,
                'location' => $location,
                'time' => $time,
                'date' => $date,
                'description' => $description,
                'body' => $body,
                'status' => $status,
                'image' => null // This tells the model to keep the existing image
            ]);
        }

        if ($result['success']) {
            http_response_code(200);
            echo json_encode(["success" => true, "message" => $result['message']]);
        } else {
            http_response_code(400);
            echo json_encode(["success" => false, "message" => $result['message']]);
        }
    }
}