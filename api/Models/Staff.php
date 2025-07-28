<?php

require_once "../Database/DatabaseConn.php";

class Staff extends DatabaseConn {

    public function createPost($data) {
    try {
        $image = isset($data['image']) && !empty($data['image']) ? $data['image'] : NULL;
        $staffId = uniqid('staff_', true);
        $isAvailable = "0";

        if ($data['category'] === 'doctor') {
            $stmt = $this->connect()->prepare("
                INSERT INTO doctors (doctor_id, doctor_name, area_of_specialization, status, is_available, image) 
                VALUES (:id, :name, :specialization, :status, :available, :image)
            ");
        } else if ($data['category'] === 'nurse') {
            $stmt = $this->connect()->prepare("
                INSERT INTO nurses (nurse_id, nurse_name, area_of_specialization, status, is_available, image) 
                VALUES (:id, :name, :specialization, :status, :available, :image)
            ");
        } else if ($data['category'] === 'physiologist') {
            $stmt = $this->connect()->prepare("
                INSERT INTO physiologist (physiologist_id, physiologist_name, area_of_specialization, status, is_available, image) 
                VALUES (:id, :name, :specialization, :status, :available, :image)
            ");
        } else {
            // Default case: insert into doctors table
            $stmt = $this->connect()->prepare("
                INSERT INTO doctors (doctor_id, doctor_name, area_of_specialization, status, is_available, image) 
                VALUES (:id, :name, :specialization, :status, :available, :image)
            ");
        }

        // Bind common parameters
        $stmt->bindParam(':id', $staffId);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':specialization', $data['specialization']);
        $stmt->bindParam(':status', $data['category']);
        $stmt->bindParam(':available', $isAvailable);
        $stmt->bindParam(':image', $image);

        if ($stmt->execute()) {
            return [
                "success" => true,
                "message" => "Health-worker created successfully.",
            ];
        } else {
            return [
                "success" => false,
                "message" => "Failed to create Health-worker."
            ];
        }
    } catch (Exception $e) {
        if ($e->getCode() == 23000) {
            return [
                "success" => false,
                "message" => "The Health-worker ID '{$data['staff-id']}' is already in use."
            ];
        }
        return [
            "success" => false,
            "message" => "Error: " . $e->getMessage()
        ];
    }
}
}
?>
