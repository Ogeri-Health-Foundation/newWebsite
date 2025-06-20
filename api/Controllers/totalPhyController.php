<?php

class TotalPhyController {
    private $TotalPhyModel;

    public function __construct() {
        $this->TotalPhyModel = new TotalPhyModel();
    }

    public function fetchTotalPhys() {
        $TotalPhy = $this->TotalPhyModel->TotalPhyModel();
        header("Content-Type: application/json");
        echo json_encode($TotalPhy[0]);
    

   
        if ($TotalPhy) {
            return true;
        } else {
            return false;
        }
    }
}
?>
