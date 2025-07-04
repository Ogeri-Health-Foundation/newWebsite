<?php

require_once "../Middleware/GlobalAuth.php";
require_once "../Models/Doctor.php";


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $authenticate = new Auth();
    $authenticate->authenticate();

    $data = json_decode(file_get_contents("php://input"), true);

    if(isset( $data['staff_Id'])){

        $staff_id =  $data['staff_Id'];

        $deleteStaff = new DoctorModel();
      $result = $deleteStaff->deleteStaffById($staff_id);

      echo json_encode($result);


    }else {
        echo json_encode(['message' => 'No Id provided' , 'success' => false]);
        exit();
    }

} else{
    echo json_encode(['message' => 'Invalid request method', 'success'=> false]);
}