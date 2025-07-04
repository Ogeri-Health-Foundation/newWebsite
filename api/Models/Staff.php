<?php

require_once "../Database/DatabaseConn.php";

class Staff extends DatabaseConn {

    public function createPost($data) {
        try {
           
           if ($data['category'] === 'doctor') {

            $DoctorAvailable = "0";
            $image = isset($data['image']) && !empty($data['image']) ? $data['image'] : NULL;

            $stmt = $this->connect()->prepare("

            INSERT INTO doctors (doctor_name, area_of_specialization, status, is_available, image) 
            VALUES (:doctor_name, :area_of_specialization, :status, :is_available, :image)
        ");


        $stmt->bindParam(':doctor_name', $data['name']);
        $stmt->bindParam(':area_of_specialization', $data['specialization']);
        $stmt->bindParam(':status', $data['category']);
        $stmt->bindParam(':is_available', $DoctorAvailable);
        $stmt->bindParam(':image', $image);

        if ($stmt->execute()) {
            return [
                "success" => true,
                "message" => "Health-worker created successfully.",
                // "blog_id" => $Id
            ];
        } else {
            return [
                "success" => false,
                "message" => "Failed to create Health-worker."
            ];
        }

           } 
           
           
           
           
           
           
           if ($data['category'] === 'nurse'){
            $NurseAvailable = "0";
            $image = isset($data['image']) && !empty($data['image']) ? $data['image'] : NULL;

            $stmt = $this->connect()->prepare("

            INSERT INTO nurses (nurse_name, area_of_specialization, status, is_available, image) 
            VALUES (:nurse_name, :area_of_specialization, :status, :is_available, :image)
        ");


        $stmt->bindParam(':nurse_name', $data['name']);
        $stmt->bindParam(':area_of_specialization', $data['specialization']);
        $stmt->bindParam(':status', $data['category']);
        $stmt->bindParam(':is_available', $NurseAvailable);
        $stmt->bindParam(':image', $image);

        if ($stmt->execute()) {
            return [
                "success" => true,
                "message" => "Health-worker created successfully.",
                // "blog_id" => $Id
            ];
        } else {
            return [
                "success" => false,
                "message" => "Failed to create Health-worker."
            ];
        }
           }





           if ($data['category'] === 'physiologist'){
            $PhyAvailable = "0";
            $image = isset($data['image']) && !empty($data['image']) ? $data['image'] : NULL;

            $stmt = $this->connect()->prepare("

            INSERT INTO physiologist (physiologist_name, area_of_specialization, status, is_available, image) 
            VALUES (:physiologist_name, :area_of_specialization, :status, :is_available, :image)
        ");


        $stmt->bindParam(':physiologist_name', $data['name']);
        $stmt->bindParam(':area_of_specialization', $data['specialization']);
        $stmt->bindParam(':status', $data['category']);
        $stmt->bindParam(':is_available', $PhyAvailable);
        $stmt->bindParam(':image', $image);

        if ($stmt->execute()) {
            return [
                "success" => true,
                "message" => "Health-worker created successfully.",
                // "blog_id" => $Id
            ];
        } else {
            return [
                "success" => false,
                "message" => "Failed to create Health-worker."
            ];
        }
           } else {
            return [
                "success" => false,
                "message" => "Must be a doctor, nurse or physiologist"
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
