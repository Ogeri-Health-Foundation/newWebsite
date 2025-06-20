<?php

class AvailableNurseController {
    private $AvailableNrModel;

    public function __construct() {
        $this->AvailableNrModel = new AvailableNrModel();
    }

    public function fetchAvailableNurses() {
        $AvailableNr = $this->AvailableNrModel->AvailableNrModel();
        header("Content-Type: application/json");
        echo json_encode($AvailableNr[0]);
    

   
        if ($AvailableNr) {
            return true;
        } else {
            return false;
        }
    }
}
?>
