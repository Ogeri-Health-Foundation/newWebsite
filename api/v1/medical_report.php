<?php

// declare(strict_types=1);

require_once "../Controllers/medical_report.controller.php";
require_once "../Models/MedicalModel.php";


error_reporting(E_ALL);
ini_set('display_errors', 1);



if($_SERVER['REQUEST_METHOD'] === 'POST'){ 

    $medicalRep = new MedicalReportController();
    $result = $medicalRep->functionMedical();

    echo json_encode($result);
}else{
    http_response_code(401);
    echo json_encode([
        'message'=> 'Invalid request method',
        'success'=> false
    ]);
}