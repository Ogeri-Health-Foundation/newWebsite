<?php
require_once "../Database/DatabaseConn.php";

class TotalBlogs extends DatabaseConn {
    
    public function getTotalBlogs() {
        $stmt = $this->connect()->prepare("
           SELECT COUNT(*) AS total FROM blog_posts
        ");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }
}
?>
