<?php
require_once "../Middleware/GlobalAuth.php";
require_once "../Controllers/no_limit_doc.controller.php";
require_once "../Models/NoLimitDoc.php";


error_reporting(E_ALL);
ini_set('display_errors', 1);

$doctorController = new NoLimitDoctorController();

if ($_SERVER["REQUEST_METHOD"] === "GET") {
        $doctorController->fetchNoLImitDoctors();
} elseif ($_SERVER["REQUEST_METHOD"] === "POST") {

    $authenticate = new Auth();
    $authenticate->authenticate();

    $data = json_decode(file_get_contents("php://input"), true);
    if ($data["role"] === "nurse"){

        $doctorController->updateNurseAvailability();
    }elseif ($data["role"] === "doctor"){
        $doctorController->updateAvailability();
    }
        
} else {
    http_response_code(404);
    echo json_encode(["message" => "Invalid request"]);
}
?>
