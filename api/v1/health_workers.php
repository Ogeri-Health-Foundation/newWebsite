<?php

require_once "../Controllers/health_worker.controller.php";
require_once "../Models/HealthWorker.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

$HealthWorkerController = new HealthWorkerController();

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $HealthWorkerController->fetchHealthWorkers();
}  else {
    http_response_code(401);
    echo json_encode(["message" => "Invalid request"]);
}

