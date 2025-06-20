<?php


require_once "../Database/DatabaseConn.php";


class DeleteEvent extends DatabaseConn{
    public function deleted($edit_id){

        $stmt = $this->connect()->prepare("DELETE FROM events WHERE event_id = :event_id");
        $stmt->bindParam(':event_id',$edit_id);
        if ($stmt->execute()){
            return [
                "message" => "Deleted event successfully",
                "success" => true
            ];
        } else {
            return [
                "message" => "Failed to delete event",
                "success" => false
            ];
        }
    }
}