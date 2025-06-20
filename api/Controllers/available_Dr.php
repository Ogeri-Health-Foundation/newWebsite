<?php

class AvailableDoctorController {
    private $AvailableDrModel;

    public function __construct() {
        $this->AvailableDrModel = new AvailableDrModel();
    }

    public function fetchAvailableDoctors() {
        $AvailableDr = $this->AvailableDrModel->AvailableDrModel();
        header("Content-Type: application/json");
        echo json_encode($AvailableDr[0]);
    

   
        if ($AvailableDr) {
            return true;
        } else {
            return false;
        }
    }
}
?>
