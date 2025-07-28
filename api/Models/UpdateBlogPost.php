<?php


require_once "../Database/DatabaseConn.php";

// class UpdateBlogPost extends DatabaseConn {
//     public function updatePost($Updatedata){

//         try{
//         $image = isset($Updatedata['image']) && !empty($Updatedata['image']) ? $Updatedata['image'] : NULL;

//         $stmt = $this->connect()->prepare("
//         UPDATE blog_posts SET blog_title = :blog_title, blog_description = :blog_description, category = :category, body = :body, image = :image WHERE blog_id = :blog_id
//         ");

//             $stmt->bindParam(':blog_id', $Updatedata['id']);
//             $stmt->bindParam(':blog_title', $Updatedata['title']);
//             $stmt->bindParam(':blog_description', $Updatedata['description']);
//             $stmt->bindParam(':category', $Updatedata['category']);
//             $stmt->bindParam(':body', $Updatedata['body']);
//             $stmt->bindParam(':image', $image);

//             if ($stmt->execute()) {
//                 return [
//                     "success" => true,
//                     "message" => "Post updated successfully."
//                 ];
//             } else {
//                 return [
//                     "success" => false,
//                     "message" => "Failed to update post."
//                 ];
//             }

//         } catch (Exception $e) {
//             return [
//                 "success" => false,
//                 "message" => "Error: " . $e->getMessage()
//             ];
//         }
//     }
// }

class UpdateBlogPost extends DatabaseConn
{
    public function updatePost($Updatedata)
    {
        try {
            // Fetch existing post to get current image
            $stmt = $this->connect()->prepare("SELECT image FROM blog_posts WHERE blog_id = :blog_id");
            $stmt->bindParam(':blog_id', $Updatedata['id']);
            $stmt->execute();
            $existingPost = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$existingPost) {
                return [
                    "success" => false,
                    "message" => "Post not found."
                ];
            }

            // Use new image if provided, otherwise keep the old one
            $image = !empty($Updatedata['image']) ? $Updatedata['image'] : $existingPost['image'];

            $stmt = $this->connect()->prepare("
                UPDATE blog_posts 
                SET blog_title = :blog_title, 
                    blog_description = :blog_description, 
                    category = :category, 
                    body = :body, 
                    image = :image 
                WHERE blog_id = :blog_id
            ");

            $stmt->bindParam(':blog_id', $Updatedata['id']);
            $stmt->bindParam(':blog_title', $Updatedata['title']);
            $stmt->bindParam(':blog_description', $Updatedata['description']);
            $stmt->bindParam(':category', $Updatedata['category']);
            $stmt->bindParam(':body', $Updatedata['body']);
            $stmt->bindParam(':image', $image);

            if ($stmt->execute()) {
                return [
                    "success" => true,
                    "message" => "Post updated successfully."
                ];
            } else {
                return [
                    "success" => false,
                    "message" => "Failed to update post."
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
