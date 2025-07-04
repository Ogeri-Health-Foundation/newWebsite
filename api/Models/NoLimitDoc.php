<?php
require_once "../Database/DatabaseConn.php";

class DoctorModel extends DatabaseConn {
    
       public function getNoLimitDoctors() {
       
        $stmt = $this->connect()->prepare("
        (SELECT doctor_id AS id, 'doctor' AS role, doctor_name AS name, area_of_specialization, status, is_available FROM doctors)
        UNION
        (SELECT nurse_id AS id, 'nurse' AS role, nurse_name AS name, area_of_specialization, status, is_available FROM nurses)
        UNION
        (SELECT physiologist_id AS id, 'physiologist' AS role, physiologist_name AS name, area_of_specialization, status, is_available FROM physiologist)

    ");
   
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
    public function updateAvailability($id, $availability) {
        $stmt = $this->connect()->prepare("UPDATE doctors SET is_available = :is_available WHERE doctor_id = :id");
        return $stmt->execute([
            ':is_available' => $availability,
            ':id' => $id
        ]);
    }

    public function updateNurseAvailability($id, $availability, $role) {
        $stmt = $this->connect()->prepare("UPDATE nurses SET is_available = :is_available WHERE nurse_id = :id");
        return $stmt->execute([
            ':is_available' => $availability,
            ':id' => $id,

        ]);
    }
}
?>
