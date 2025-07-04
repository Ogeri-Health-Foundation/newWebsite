<?php

class DoctorController {
    private $doctorModel;

    public function __construct() {
        $this->doctorModel = new DoctorModel();
    }

    public function fetchDoctors() {
        $doctors = $this->doctorModel->getDoctors();
        header("Content-Type: application/json");
        echo json_encode($doctors);
    }

    public function updateAvailability() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['id']) || !isset($data['availability'])) {
            http_response_code(400);
            echo json_encode(["message" => "Invalid input"]);
            return;
        }

        $success = $this->doctorModel->updateAvailability($data['id'], $data['availability']);

        if ($success) {
            echo json_encode(["message" => "Availability updated successfully"]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Failed to update availability"]);
        }
    }


    public function updateNurseAvailability() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['id']) || !isset($data['availability']) || !isset($data['role'])) {
            http_response_code(400);
            echo json_encode(["message" => "Invalid input"]);
            return;
        }

        $success = $this->doctorModel->updateNurseAvailability($data['id'], $data['availability'], $data['role']);

        if ($success) {
            echo json_encode(["message" => "Availability updated successfully"]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Failed to update availability"]);
        }
    }










    public function updatePhysiologistAvailability() {
        $data = json_decode(file_get_contents("php://input"), true);

        if (!isset($data['id']) || !isset($data['availability']) || !isset($data['role'])) {
            http_response_code(400);
            echo json_encode(["message" => "Invalid input"]);
            return;
        }

        $success = $this->doctorModel->updatePhysiologistAvailability($data['id'], $data['availability'], $data['role']);

        if ($success) {
            echo json_encode(["message" => "Availability updated successfully"]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Failed to update availability"]);
        }
    }
}

