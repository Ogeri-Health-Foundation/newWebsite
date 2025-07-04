<?php



require_once "../Controllers/available_Nr.php";
require "../Models/AvailableNr.php";


error_reporting(E_ALL);
ini_set('display_errors', 1);

$AvailableNurseController = new AvailableNurseController();

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $AvailableNurseController->fetchAvailableNurses();
}  else {
    http_response_code(401);
    echo json_encode(["message" => "Invalid request"]);
}
?>
