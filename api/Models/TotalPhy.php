<?php
require_once "../Database/DatabaseConn.php";

class TotalPhyModel extends DatabaseConn {
    
    public function TotalPhyModel() {
        $stmt = $this->connect()->prepare("
            SELECT 
            (SELECT COUNT(*) FROM doctors) AS doctor_count,
            (SELECT COUNT(*) FROM nurses) AS nurse_count,
            (SELECT COUNT(*) FROM physiologist) AS physiologists_count
    
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
}

