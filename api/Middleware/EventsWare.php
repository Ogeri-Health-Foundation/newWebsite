<?php
require_once "../Controllers/events.controller.php";

class EventRoute {
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           
            $controller = new EventController();
            $errors = $controller->validateForm($_POST);

            if (!empty($errors)) {
                echo json_encode(["success" => false, "message" => implode(" ", $errors)]);
                exit;
            }

            $title = $_POST['Title'];
            $volunteerLocation = $_POST['volunteerLocation'];
            $volunteerTime = $_POST['volunteerTime'];
            $volunteerDate = $_POST['volunteerDate'];
            $volunteerDescription = $_POST['volunteerDescription'];
            $volunteerBody = $_POST['volunteerBody'];
            $volunteerStatus = $_POST['volunteerStatus'];

            // Define upload directory
            $targetDir = __DIR__ . '/../../uploads/';
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true); 
            }

            $imageName = NULL;
            if (!empty($_FILES["cover_image"]["name"])) {
                $imageName = basename($_FILES["cover_image"]["name"]);
                $targetFilePath = $targetDir . $imageName;
                $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
                $allowedTypes = ["jpg", "jpeg", "png"];

                if (!in_array($imageFileType, $allowedTypes)) {
                    echo json_encode(["success" => false, "message" => "Invalid file type for cover image."]);
                    exit;
                }

                if (!move_uploaded_file($_FILES["cover_image"]["tmp_name"], $targetFilePath)) {
                    echo json_encode(["success" => false, "message" => "Failed to upload cover image."]);
                    exit;
                }
            }

            $postModel = new Event();
            $result = $postModel->createPost([
                'title' => $title,
                'location' => $volunteerLocation,
                'time' => $volunteerTime,
                'date' => $volunteerDate,
                'description' => $volunteerDescription,
                'body' => $volunteerBody,
                'status'=> $volunteerStatus,
                'image' => $imageName
            ]);

            if ($result['success']) {
                $event_id = $result['event_id']; 

                $eventImages = [];
                for ($i = 1; $i <= 6; $i++) {
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
                            $this->storeEventImage($event_id, $eventImageName);
                        } else {
                            echo json_encode(["success" => false, "message" => "Failed to upload $eventImageName."]);
                            exit;
                        }
                    }
                }

                echo json_encode(["success" => true, "message" => "Event created successfully!"]);
            } else {
                echo json_encode(["success" => false, "message" => "Failed to create event."]);
            }
        }
    }

    private function storeEventImage($event_id, $imageName) {
        $db = new DatabaseConn();
        $conn = $db->connect();

        try {
            $event_gallery_id = uniqid("gallery_"); 
            $stmt = $conn->prepare("
                INSERT INTO event_galleries (event_gallery_id, event_id, img_path) 
                VALUES (:gallery_id, :event_id, :img_path)
            ");

            $stmt->bindParam(':gallery_id', $event_gallery_id);
            $stmt->bindParam(':event_id', $event_id);
            $stmt->bindParam(':img_path', $imageName);

            $stmt->execute();
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => "Error storing event image: " . $e->getMessage()]);
            exit;
        }
    }

    public function FetchEvents() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $fetchEvent = new Event();
            $result = $fetchEvent->fetchEventModel();
            echo json_encode($result);
        }
    }
}
?>
