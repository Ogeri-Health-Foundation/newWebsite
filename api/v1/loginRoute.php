<?php 
declare(strict_types=1);


error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../../vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
USE PHPMailer\PHPMailer\Exception;

include_once '../Database/DatabaseConn.php';
include_once '../Models/Login.php';
include_once '../Controllers/login.controller.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //   $data = json_decode(file_get_contents('php://input'), true);

      $email = $_POST['email'];
      $password = $_POST['password'];
    

        $signUp = new LoginContrl($email, $password);

        $result = $signUp->signinAdmin();

        echo json_encode($result);
   
} else {
    echo json_encode([
        "message" => "Invalid request method",
        "status" => "error"
    ]);
    http_response_code(405);  
}











