<?php

require_once "../Middleware/GlobalAuth.php";

require_once "../Controllers/doctor.controller.php";
require_once "../Models/Doctor.php";


error_reporting(E_ALL);
ini_set('display_errors', 1);

$doctorController = new DoctorController();

if ($_SERVER["REQUEST_METHOD"] === "GET") {
        $doctorController->fetchDoctors();
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {

    $authenticate = new Auth();
    $authenticate->authenticate();

    $data = json_decode(file_get_contents("php://input"), true);
    if ($data["role"] === "nurse"){

        $doctorController->updateNurseAvailability();
    }elseif ($data["role"] === "doctor"){
        $doctorController->updateAvailability();
    } elseif ($data["role"] === "physiologist"){
        $doctorController->updatePhysiologistAvailability();
    }
        
} else {
    http_response_code(404);
    echo json_encode(["message" => "Invalid request"]);
}
?>
