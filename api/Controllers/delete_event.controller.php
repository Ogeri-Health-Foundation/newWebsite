<?php


class deleteEvents {

    public function deleteEvents(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $data = json_decode(file_get_contents("php://input"), true);


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