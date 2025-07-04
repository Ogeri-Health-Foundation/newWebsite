<?php
require_once "../Database/DatabaseConn.php";

class AvailableNrModel extends DatabaseConn {
    
    public function AvailableNrModel() {
        $stmt = $this->connect()->prepare("
            SELECT COUNT(*) AS count 
            FROM nurses WHERE is_available = 1
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
}

