<?php

require_once "../Database/DatabaseConn.php";

class Draft extends DatabaseConn {

    public function createDraft($data) {
        try {
           
            $Id = bin2hex(random_bytes(6));
            $status = "draft";

            
            $image = isset($data['image']) && !empty($data['image']) ? $data['image'] : NULL;

            $stmt = $this->connect()->prepare("
                INSERT INTO blog_posts (blog_id, blog_title, blog_description, category, body, image, status) 
                VALUES (:blog_id, :blog_title, :blog_description, :category, :body, :image, :status)
            ");

            
            $stmt->bindParam(':blog_id', $Id);
            $stmt->bindParam(':blog_title', $data['title']);
            $stmt->bindParam(':blog_description', $data['description']);
            $stmt->bindParam(':category', $data['category']);
            $stmt->bindParam(':body', $data['body']);
            $stmt->bindParam(':image', $image);
            $stmt->bindParam(':status', $status);

           
            if ($stmt->execute()) {
                return [
                    "success" => true,
                    "message" => "Post drafted successfully.",
                    "blog_id" => $Id
                ];
            } else {
                return [
                    "success" => false,
                    "message" => "Failed to draft post."
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
?>
