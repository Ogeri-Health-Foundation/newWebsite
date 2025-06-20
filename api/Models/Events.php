<?php

require_once "../Database/DatabaseConn.php";

class Event extends DatabaseConn {

    public function createPost($data) {
        try {
           
            $Id = bin2hex(random_bytes(6));
            // $status = "published";

            
            $image = isset($data['image']) && !empty($data['image']) ? $data['image'] : NULL;

            $stmt = $this->connect()->prepare("
                INSERT INTO events (event_id, title, banner_image, location, time, date, description, body, status) 
                VALUES (:event_id, :title, :banner_image, :location, :time, :date, :description, :body, :status)
            ");

            
            $stmt->bindParam(':event_id', $Id);
            $stmt->bindParam(':title', $data['title']);
            $stmt->bindParam(':banner_image', $data['image']);
            $stmt->bindParam(':location', $data['location']);
            $stmt->bindParam(':time', $data['time']);
            $stmt->bindParam(':date', $data['date']);
            $stmt->bindParam(':description', $data['description']);
            $stmt->bindParam(':body', $data['body']);
            $stmt->bindParam(':status', $data['status']);

           
            if ($stmt->execute()) {
                return [
                    "success" => true,
                    "message" => "Event created successfully.",
                    "event_id" => $Id
                ];
            } else {
                return [
                    "success" => false,
                    "message" => "Failed to create event."
                ];
            }

        } catch (Exception $e) {
            return [
                "success" => false,
                "message" => "Error: " . $e->getMessage()
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
