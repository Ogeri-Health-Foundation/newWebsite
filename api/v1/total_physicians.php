<?php

require_once "../Controllers/totalPhyController.php";
require "../Models/TotalPhy.php";


error_reporting(E_ALL);
ini_set('display_errors', 1);

$TotalPhyController = new TotalPhyController();

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $TotalPhyController->fetchTotalPhys();
}  else {
    http_response_code(401);
    echo json_encode(["message" => "Invalid request"]);
}
?>
