<?php
require_once "../Database/DatabaseConn.php";
class AllBlogs extends DatabaseConn {
    
    public function getAllBlogs($page = 1, $perPage = 5) {
        $offset = ($page - 1) * $perPage;
        $pdo = $this->connect();
    
        // Get blogs with pagination (LIMIT Fix)
        $stmt = $pdo->prepare("SELECT * FROM blog_posts ORDER BY created_at DESC LIMIT :offset, :perPage");
        $stmt->bindValue(":offset", (int) $offset, PDO::PARAM_INT);
        $stmt->bindValue(":perPage", (int) $perPage, PDO::PARAM_INT);
        
        try {
            $stmt->execute();
        } catch (PDOException $e) {
            die(json_encode(["error" => "Query Failed: " . $e->getMessage()]));
        }
        
        $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Get total blog count
        $totalStmt = $pdo->prepare("SELECT COUNT(*) as total FROM blog_posts");
        $totalStmt->execute();
        $totalBlogs = $totalStmt->fetch(PDO::FETCH_ASSOC)['total'];
    
        return [
            "data" => $blogs,
            "current_page" => $page,
            "last_page" => ceil($totalBlogs / $perPage)
        ];
    }
    
}
?>
