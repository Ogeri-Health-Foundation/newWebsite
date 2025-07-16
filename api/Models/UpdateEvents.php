<?php


require_once "../Database/DatabaseConn.php";

class UpdateEvents extends DatabaseConn {
    // public function updateEvent($Updatedata){
    //     $new_time = date("H:i:s", strtotime($Updatedata['time'])); // Converts to 14:30:00
    //     $formatted_date = date("Y-m-d", strtotime($Updatedata['date']));
    //     try{
    //     $image = isset($Updatedata['image']) && !empty($Updatedata['image']) ? $Updatedata['image'] : NULL;

    //     $stmt = $this->connect()->prepare("
    //     UPDATE events SET title = :title, banner_image = :image, location = :location, time = :time, date = :date, description = :description, body = :body, status = :status WHERE id = :id
    //     ");

    //         $stmt->bindParam(':id', $Updatedata['id']);
    //         $stmt->bindParam(':location', $Updatedata['location']);
    //         $stmt->bindParam(':title', $Updatedata['title']);
    //         $stmt->bindParam(':description', $Updatedata['description']);
    //         $stmt->bindParam(':time', $new_time);
    //         $stmt->bindParam(':date',  $formatted_date);
    //         $stmt->bindParam(':status', $Updatedata['status']);
    //         $stmt->bindParam(':body', $Updatedata['body']);
    //         $stmt->bindParam(':image', $image);

    //         if ($stmt->execute()) {
    //             return [
    //                 "success" => true,
    //                 "message" => "Event updated successfully."
    //             ];
    //         } else {
    //             return [
    //                 "success" => false,
    //                 "message" => "Failed to update event."
    //             ];
    //         }

    //     } catch (Exception $e) {
    //         return [
    //             "success" => false,
    //             "message" => "Error: " . $e->getMessage()
    //         ];
    //     }
    // }



    public function updateEvent($Updatedata)
    {
        $new_time = date("H:i:s", strtotime($Updatedata['time']));
        $formatted_date = date("Y-m-d", strtotime($Updatedata['date']));

        try {
            $query = "
                UPDATE events SET 
                    title = :title, 
                    location = :location, 
                    time = :time, 
                    date = :date, 
                    description = :description, 
                    body = :body, 
                    status = :status
            ";

            // Add image update only if a new image is uploaded
            if (!empty($Updatedata['image'])) {
                $query .= ", banner_image = :image";
            }

            $query .= " WHERE id = :id";

            $stmt = $this->connect()->prepare($query);

            $stmt->bindParam(':id', $Updatedata['id']);
            $stmt->bindParam(':location', $Updatedata['location']);
            $stmt->bindParam(':title', $Updatedata['title']);
            $stmt->bindParam(':description', $Updatedata['description']);
            $stmt->bindParam(':time', $new_time);
            $stmt->bindParam(':date',  $formatted_date);
            $stmt->bindParam(':status', $Updatedata['status']);
            $stmt->bindParam(':body', $Updatedata['body']);

            // Bind image only if it's present
            if (!empty($Updatedata['image'])) {
                $stmt->bindParam(':image', $Updatedata['image']);
            }

            if ($stmt->execute()) {
                return [
                    "success" => true,
                    "message" => "Event updated successfully."
                ];
            } else {
                return [
                    "success" => false,
                    "message" => "Failed to update event."
                ];
            }
        } catch (Exception $e) {
            return [
                "success" => false,
                "message" => "Error: " . $e->getMessage()
            ];
        }
    }
}