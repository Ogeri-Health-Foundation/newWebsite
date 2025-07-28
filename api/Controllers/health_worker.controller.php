<?php

class HealthWorkerController {
    private $HealthWorkerModel;

    public function __construct() {
        $this->HealthWorkerModel = new HealthWorkerModel();
    }

    public function fetchHealthWorkers() {
        $AvailableHealthWorker = $this->HealthWorkerModel->HealthWorkerModel();
        header("Content-Type: application/json");
        echo file_get_contents("../v1/health_workers.php");
        echo json_encode($AvailableHealthWorker);
    

   
        if ($AvailableHealthWorker) {
            return true;
        } else {
            return false;
        }
    }
}
?>
