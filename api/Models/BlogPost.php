<?php

require_once "../Database/DatabaseConn.php";

class Blog extends DatabaseConn {

    // public function createPost($data) {
    //     try {

    //         $Id = bin2hex(random_bytes(6)); 
    //         $status = "published";


    //         $image = isset($data['image']) && !empty($data['image']) ? $data['image'] : NULL;

    //         $stmt = $this->connect()->prepare("
    //             INSERT INTO blog_posts (blog_id, blog_title, blog_description, category, body, image, status) 
    //             VALUES (:blog_id, :blog_title, :blog_description, :category, :body, :image, :status)
    //         ");


    //         $stmt->bindParam(':blog_id', $Id);
    //         $stmt->bindParam(':blog_title', $data['title']);
    //         $stmt->bindParam(':blog_description', $data['description']);
    //         $stmt->bindParam(':category', $data['category']);
    //         $stmt->bindParam(':body', $data['body']);
    //         $stmt->bindParam(':image', $image);
    //         $stmt->bindParam(':status', $status);


    //         if ($stmt->execute()) {
    //             return [
    //                 "success" => true,
    //                 "message" => "Post created successfully.",
    //                 "blog_id" => $Id
    //             ];
    //         } else {
    //             return [
    //                 "success" => false,
    //                 "message" => "Failed to create post."
    //             ];
    //         }

    //     } catch (PDOException $e) {
    //         error_log("Database error: " . $e->getMessage());
    //         return [
    //             "success" => false,
    //             "message" => "Database error occurred"
    //         ];
    //     }
    // }

    public function createPost($data)
    {
        try {
            $conn = $this->connect();
            if (!$conn) {
                throw new Exception("Database connection failed");
            }

            $Id = bin2hex(random_bytes(6));
            $status = "published";
            $image = isset($data['image']) && !empty($data['image']) ? $data['image'] : NULL;

            $stmt = $conn->prepare("
            INSERT INTO blog_posts 
            (blog_id, blog_title, blog_description, category, body, image, status) 
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
                    "message" => "Post created successfully.",
                    "blog_id" => $Id
                ];
            } else {
                $errorInfo = $stmt->errorInfo();
                throw new Exception("SQL Error: " . $errorInfo[2]);
            }
        } catch (PDOException $e) {
            error_log("PDO Error: " . $e->getMessage());
            return [
                "success" => false,
                "message" => "Database error: " . $e->getMessage()
            ];
        } catch (Exception $e) {
            error_log("General Error: " . $e->getMessage());
            return [
                "success" => false,
                "message" => $e->getMessage()
            ];
        }
    }


    public function fetchValues($blogId){
        $stmt = $this->connect()->prepare("SELECT blog_title, blog_description, image, status, category, created_at, body FROM blog_posts WHERE blog_id = :blog_id");
        $stmt->bindParam(":blog_id", $blogId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


   
}
?>
