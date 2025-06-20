<?php

require_once "../Models/getMessageModel.php";

if($_SERVER["REQUEST_METHOD"] === "GET"){


    $getMessage = new getMessageModel();
   $result = $getMessage->getMessage();

    echo json_encode($result);

}else{
    echo json_encode([
        "message" => "Invalid request method",
        "success" => false 
    ]);
}