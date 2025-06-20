<?php
require_once "../Database/DatabaseConn.php";

class HealthWorkerModel extends DatabaseConn {
    
    public function HealthWorkerModel() {
        $stmt = $this->connect()->prepare("
                        SELECT doctor_name,
            area_of_specialization,
            status,
            is_available,
            image FROM doctors
                        UNION ALL
                        SELECT nurse_name,
            area_of_specialization,
            status,
            is_available,
            image FROM nurses
                        UNION ALL
                        SELECT physiologist_name,
            area_of_specialization,
            status,
            is_available,
            image FROM physiologist
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
}

