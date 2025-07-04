<?php
require_once "../Database/DatabaseConn.php";

class BlogsModel extends DatabaseConn {
    
       public function getBlogs($limit) {
        $stmt = $this->connect()->prepare("SELECT blog_id, blog_id, blog_title, category, published_at, created_at, status FROM blog_posts ORDER BY created_at DESC LIMIT ?");
        $stmt->bindParam(1, $limit, PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

}
