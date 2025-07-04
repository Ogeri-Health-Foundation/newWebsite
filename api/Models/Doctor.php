<?php
require_once "../Database/DatabaseConn.php";

class DoctorModel extends DatabaseConn {
    
       public function getDoctors() {
        $first_limit = 2;
        $second_limit = 2;
        $third_limit = 1;
        $stmt = $this->connect()->prepare("
        (SELECT doctor_id AS id, 'doctor' AS role, doctor_name AS name, status, is_available FROM doctors LIMIT ?)
        UNION
        (SELECT nurse_id AS id, 'nurse' AS role, nurse_name AS name, status, is_available FROM nurses LIMIT ?)
        UNION
        (SELECT physiologist_id AS id, 'physiologist' AS role, physiologist_name AS name, status, is_available FROM physiologist LIMIT ?)
    ");
    $stmt->bindParam(1,  $first_limit, PDO::PARAM_INT);
    $stmt->bindParam(2, $second_limit, PDO::PARAM_INT);
    $stmt->bindParam(3, $third_limit, PDO::PARAM_INT);
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

    public function updatePhysiologistAvailability($id, $availability, $role) {
        $stmt = $this->connect()->prepare("UPDATE physiologist SET is_available = :is_available WHERE physiologist_id = :id");
        return $stmt->execute([
            ':is_available' => $availability,
            ':id' => $id,

        ]);
    }
    public function deleteStaffById($staff_id) {
        $tables = [
            ['table' => 'doctors', 'column' => 'doctor_id'],
            ['table' => 'nurses', 'column' => 'nurse_id'],
            ['table' => 'physiologist', 'column' => 'physiologist_id']
        ];
    
        foreach ($tables as $table) {
            $stmt = $this->connect()->prepare("
                DELETE FROM {$table['table']} WHERE {$table['column']} = :staff_id
            ");
            $stmt->bindParam(':staff_id', $staff_id, PDO::PARAM_INT);
    
            if ($stmt->execute() && $stmt->rowCount() > 0) {
                return [
                    "message" => "Deleted successfully from {$table['table']}",
                    "success" => true
                ];
            }
        }
    
        return [
            "message" => "No matching record found to delete",
            "success" => false
        ];
    }
    
}
?>
