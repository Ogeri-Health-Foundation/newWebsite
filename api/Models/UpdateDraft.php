<?php

include_once "../Database/DatabaseConn.php";

class UpdateBlog extends DatabaseConn {

    private $id;
    private $status;

    public function __construct($id, $status){
        $this->id = $id;
        $this->status = $status;
    }

    public function updateToDraft(){
        return $this->updateStatus();
    }

    public function updateToPublish(){
        return $this->updateStatus();
    }

    private function updateStatus() {
        try {
            $stmt = $this->connect()->prepare("UPDATE blog_posts SET status = :status WHERE blog_id = :blog_id");
            $stmt->bindParam(":status", $this->status);
            $stmt->bindParam(":blog_id", $this->id);

            if ($stmt->execute()) {
                return [
                    "success" => true,
                    "message" => "Blog updated to {$this->status} ."
                ];
            } else {
                return [
                    "success" => false,
                    "message" => "Failed to update blog {$this->status}."
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
