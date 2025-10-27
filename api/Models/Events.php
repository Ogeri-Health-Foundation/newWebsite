<?php

require_once "../Database/DatabaseConn.php";

class Event extends DatabaseConn {

    // public function createPost($data) {
    //     try {
           
    //         $Id = bin2hex(random_bytes(6));
    //         // $status = "published";

            
    //         $image = isset($data['image']) && !empty($data['image']) ? $data['image'] : NULL;

    //         $stmt = $this->connect()->prepare("
    //             INSERT INTO events (event_id, title, banner_image, location, time, date, description, body, status) 
    //             VALUES (:event_id, :title, :banner_image, :location, :time, :date, :description, :body, :status)
    //         ");

            
    //         $stmt->bindParam(':event_id', $Id);
    //         $stmt->bindParam(':title', $data['title']);
    //         $stmt->bindParam(':banner_image', $data['image']);
    //         $stmt->bindParam(':location', $data['location']);
    //         $stmt->bindParam(':time', $data['time']);
    //         $stmt->bindParam(':date', $data['date']);
    //         $stmt->bindParam(':description', $data['description']);
    //         $stmt->bindParam(':body', $data['body']);
    //         $stmt->bindParam(':status', $data['status']);

    //       if ($stmt->execute()) {
    //             echo json_encode(["success" => true, "message" => "Event created successfully."]);
    //         } else {
    //             $errorInfo = $stmt->errorInfo();
    //             echo json_encode(["success" => false, "message" => "SQL Error: " . $errorInfo[2]]);
    //         }
    //         exit;

    //     } catch (Exception $e) {
    //         return [
    //             "success" => false,
    //             "message" => "Error: " . $e->getMessage()
    //         ];
    //     }
    // }
public function createPost($data) {
    try {
        $Id = bin2hex(random_bytes(6));
        $image = isset($data['image']) && !empty($data['image']) ? $data['image'] : NULL;

        $stmt = $this->connect()->prepare("
            INSERT INTO events (event_id, title, banner_image, location, time, date, description, body, status) 
            VALUES (:event_id, :title, :banner_image, :location, :time, :date, :description, :body, :status)
        ");

        // 🧠 Use $image variable, not $data['image']
        $stmt->bindParam(':event_id', $Id);
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':banner_image', $image);
        $stmt->bindParam(':location', $data['location']);
        $stmt->bindParam(':time', $data['time']);
        $stmt->bindParam(':date', $data['date']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':body', $data['body']);
        $stmt->bindParam(':status', $data['status']);

        $executed = $stmt->execute();
        if ($executed) {
            return [
                "success" => true,
                "message" => "Event created successfully",
                "event_id" => $Id
            ];
        } else {
            $errorInfo = $stmt->errorInfo();
            $errorMessage = $errorInfo[2] ?? 'Unknown database error.';

            // 🎨 Friendly messages for users
            if (stripos($errorMessage, 'max_allowed_packet') !== false) {
                $friendlyMessage = "Your event content is too large for the server to process. Please remove or resize large embedded images.";
            } else {
                $friendlyMessage = "Something went wrong while saving your event. Please try again later.";
            }

            return [
                "success" => false,
                "message" => $friendlyMessage
            ];
        }

    } catch (Exception $e) {
        $friendlyMessage = "A server error occurred while saving your event. Please try again.";
        if (stripos($e->getMessage(), 'max_allowed_packet') !== false) {
            $friendlyMessage = "Your event content is too large. Please remove or resize large images before submitting.";
        }

        return [
            "success" => false,
            "message" => $friendlyMessage
        ];
    }
}



    public function fetchEventModel(){
        $stmt = $this->connect()->prepare("SELECT id, event_id, title, date, time, banner_image, location, body, description, status FROM events");
        // $stmt->bindParam(1, $limit, PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
}
?>
