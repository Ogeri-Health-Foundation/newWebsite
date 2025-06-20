<?php
require_once "../Database/DatabaseConn.php";

class AvailableDrModel extends DatabaseConn {
    
    public function AvailableDrModel() {
        $stmt = $this->connect()->prepare("
        SELECT 
            (SELECT COUNT(*) FROM doctors WHERE is_available = 1) AS doctor_count,
            (SELECT COUNT(*) FROM nurses WHERE is_available = 1) AS nurse_count,
            (SELECT COUNT(*) FROM physiologist WHERE is_available = 1) AS physiologists_count
    ");
    
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
}

