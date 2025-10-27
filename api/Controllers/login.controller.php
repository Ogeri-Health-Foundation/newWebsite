<?php
declare(strict_types=1);
require_once "../../vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
USE PHPMailer\PHPMailer\Exception;
// class LoginContrl extends Login 
// {
//     private $email;
//     private $password;


//     public function __construct(string $email, string $password)
//     {
//         $this->email = $email;
//         $this->password = $password;
//     }

//     public function signinAdmin()
// {
//     if (!$this->checkInputs()) {
//         http_response_code(400);
//         return ["message" => "Please fill in all fields."];
//     }

//     // if (!$this->invalidMatch()) {
//     //     http_response_code(400);
//     //     return ["message" => "Invalid Password format."];
//     // }

//     if (!$this->invalidEmail()) {
//         http_response_code(400);
//         return ["message" => "Invalid Email format."];
//     }

 
//     $response = $this->loginAdmin($this->email, $this->password);

//     if (is_array($response) && isset($response['message'])) {
       
//         http_response_code(200);
//         return $response;
//      } 
//      else {
     
//         http_response_code(400);
//         return ["message" => "Invalid email or password",
//                 "status" => 400];
//     }
// }

//     private function checkInputs() {
//         return !(empty($this->email) || empty($this->password));
//     }

//     // private function invalidMatch() {
//     //     return preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%#*?&])[A-Za-z\d@$!%#*?&]{8,}$/", $this->password);
//     // }

//     private function invalidEmail() {
//         return filter_var($this->email, FILTER_VALIDATE_EMAIL);
//     }

// }

class LoginContrl extends Login
{
    private $email;
    private $password;

    public function __construct(string $email, string $password)
    {
        $this->email = trim($email);
        $this->password = trim($password);
    }

    public function signinAdmin()
    {
        // 1️⃣ Validate inputs
        if (empty($this->email) || empty($this->password)) {
            return ["message" => "Please fill in all fields.", "status" => 400];
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return ["message" => "Invalid email format.", "status" => 400];
        }

        // 2️⃣ Check if this device/browser has been used before
        $isTrustedDevice = $this->checkDeviceAuth($this->email);

        if (!$isTrustedDevice) {
            // 🚨 New device detected — trigger OTP flow via your existing model method
            // This method already updates DB, sends the email, and echoes a response,
            // but we’ll return its result for consistency with your AJAX frontend.
            ob_start();
            $this->InvokeAuth($this->email);
            $output = ob_get_clean();
            return json_decode($output, true);
        }

        // 3️⃣ Trusted device → perform normal login
        $loginResult = $this->loginAdmin($this->email, $this->password);

        // Ensure consistent return structure
        if (!is_array($loginResult)) {
            return ["message" => "Unexpected response from login model", "status" => 500];
        }

        return $loginResult;
    }
}