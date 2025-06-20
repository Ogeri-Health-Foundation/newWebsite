<?php
declare(strict_types=1);
require_once "../../vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
USE PHPMailer\PHPMailer\Exception;
class LoginContrl extends Login 
{
    private $email;
    private $password;


    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function signinAdmin()
{
    if (!$this->checkInputs()) {
        http_response_code(400);
        return ["message" => "Please fill in all fields."];
    }

    // if (!$this->invalidMatch()) {
    //     http_response_code(400);
    //     return ["message" => "Invalid Password format."];
    // }

    if (!$this->invalidEmail()) {
        http_response_code(400);
        return ["message" => "Invalid Email format."];
    }

 
    $response = $this->loginAdmin($this->email, $this->password);

    if (is_array($response) && isset($response['message'])) {
       
        http_response_code(200);
        return $response;
     } 
     else {
     
        http_response_code(400);
        return ["message" => "Invalid email or password",
                "status" => 400];
    }
}

    private function checkInputs() {
        return !(empty($this->email) || empty($this->password));
    }

    // private function invalidMatch() {
    //     return preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%#*?&])[A-Za-z\d@$!%#*?&]{8,}$/", $this->password);
    // }

    private function invalidEmail() {
        return filter_var($this->email, FILTER_VALIDATE_EMAIL);
    }

}