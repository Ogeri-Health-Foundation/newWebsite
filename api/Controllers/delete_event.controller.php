<?php


class deleteEvents {

    public function deleteEvents(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $data = json_decode(file_get_contents("php://input"), true);
            // Check if JSON decoding was successful
            if (json_last_error() !== JSON_ERROR_NONE) {
                // Fallback to regular POST data if JSON parsing fails
                $data = $_POST;
            }

            $edit_id = $data['eventId'];

            $deleteEvent = new DeleteEvent();
            $Result = $deleteEvent->deleted($edit_id);
            echo json_encode($Result);

        }else {
            echo json_encode([
                "message" => "Invalid Request",
                "success"=> false
            ]);
        }
    }
}