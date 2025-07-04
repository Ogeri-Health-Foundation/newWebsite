<?php



require_once "../Controllers/available_Dr.php";
require "../Models/AvailableDr.php";



error_reporting(E_ALL);
ini_set('display_errors', 1);

$AvailableDoctorController = new AvailableDoctorController();

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $AvailableDoctorController->fetchAvailableDoctors();
}  else {
    http_response_code(401);
    echo json_encode(["message" => "Invalid request"]);
}
?>
