<?php
declare(strict_types=1);
require_once "../Traits/MailGrid.php";

class Login extends DatabaseConn {
    private $encryption_key = 'Kj6vNw!rJ3QpZ&4X8aBz$1TcLm9YgF@S2dVhGxR5HnUoIwP'; 
    private $cipher = 'AES-128-CBC'; 

    use sendMail;

    public function loginAdmin(string $email, string $password) {
        try {
            $stmt = $this->connect()->prepare("
            SELECT password FROM admins WHERE email = :email
        
        ");

        $stmt->bindParam(':email', $email);

        if (!$stmt->execute()) {
            throw new Exception("Error checking user.");
        }

        if ($stmt->rowCount() > 0) {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($password !== $result['password']) {
                return false;
            }
        }
            $DbQuery = $this->checkDeviceAuth($email);
            if ($DbQuery) {
                $stmt = $this->connect()->prepare(" SELECT admin_s.unique_id, admin_s.session_1, 
                           a.password, admin_s.browser_agent, admin_s.ip_address
                    FROM admins a
                    JOIN admin_sessions admin_s ON a.unique_id = admin_s.unique_id
                    WHERE a.email = :email
                    
                ");

                $stmt->bindParam(':email', $email);

                if (!$stmt->execute()) {
                    throw new Exception("Error checking user.");
                }

                if ($stmt->rowCount() > 0) {
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);

                    if ($password !== $result['password']) {
                        return[
                "message" =>"nooo"
            ]; 
                    }

                    $sessionId = bin2hex(random_bytes(60));
                    $encryptedUniqueId = $result['unique_id'];

                    $this->setEncryptedCookie('usid_id', $sessionId);
                    $this->setEncryptedCookie('_variable_', $encryptedUniqueId);
                    $this->setAdditionalCookies();
                    $currentBrowserAgent = $_SERVER["HTTP_USER_AGENT"] ?? "";
                    $currentIpAddress = $_SERVER['REMOTE_ADDR'] ?? "";
            
                    $updateStmt = $this->connect()->prepare("
                        UPDATE admin_sessions 
                        SET session_1 = :session_1 
                        WHERE browser_agent = :browser_agent 
                        AND ip_address = :ip_address
            ");

            $updateStmt->bindParam(':session_1', $sessionId);
            $updateStmt->bindParam(':browser_agent',   $currentBrowserAgent);
            $updateStmt->bindParam(':ip_address',  $currentIpAddress);

                    if ($updateStmt->execute()) {
                        return [
                            "message" => "Signed In Successfully", true
                        ];
                    }

                } else {
                    return  [
                        "message" => "Unable to sign in",
                    ];
                }
            }else {
                $this->InvokeAuth($email);
               
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return[
                "message" =>"nooo"
            ];
        }
    }





























    

    public function InvokeAuth(string $email){
        $stmt = $this->connect()->prepare("
                    SELECT email, unique_id FROM admins WHERE email = :email
                ");
            
                $stmt->bindParam(':email', $email);
                $stmt->execute(); 
            
                if ($stmt->rowCount() > 0) { 
                $result = $stmt->fetch(PDO::FETCH_ASSOC); 
                
                    $otp_link_code = bin2hex(random_bytes(50));
                
                    $stmt = $this->connect()->prepare("UPDATE admins SET otp_link_token = :otp_link_code WHERE email = :email");
                    $stmt->bindParam(":otp_link_code", $otp_link_code);
                    $stmt->bindParam(":email", $email);
                    $stmt->execute();
                
                    $this->sendMail($email, $otp_link_code);

                    $encryptedUniqueId = $result['unique_id'];
                    $this->setEncryptedCookie('_variable_', $encryptedUniqueId);
                    http_response_code(200);
                    echo json_encode([
                        "message" => "Otp Sent: Please Check your email to re-login",
                        "status" => 200
                    ]);
                    exit;
                } else {
                    
                    http_response_code(400);
                    echo json_encode([
                        "message" => "Invalid email or password",
                        "status" => 400
                    ]);
                    exit;
                }
                
    }

    public function checkDeviceAuth(string $email) {
        try {
            $currentBrowserAgent = $_SERVER["HTTP_USER_AGENT"] ?? "";
            $currentIpAddress = $_SERVER['REMOTE_ADDR'] ?? "";
    
           
            $userStmt = $this->connect()->prepare("
                SELECT unique_id FROM admins WHERE email = :email
            ");
            $userStmt->bindParam(':email', $email);
            $userStmt->execute();
            
            if ($userStmt->rowCount() == 0) {
                return false;
            }
            
            $userData = $userStmt->fetch(PDO::FETCH_ASSOC);
            $uniqueId = $userData['unique_id'];
            
           
            $sessionStmt = $this->connect()->prepare("
                SELECT browser_agent, ip_address
                FROM admin_sessions
                WHERE unique_id = :unique_id
            ");
            $sessionStmt->bindParam(':unique_id', $uniqueId);
            $sessionStmt->execute();
            
            if ($sessionStmt->rowCount() == 0) {
                return false;
            }
            
           
            while ($session = $sessionStmt->fetch(PDO::FETCH_ASSOC)) {
                if ($currentBrowserAgent === $session["browser_agent"] && 
                    $currentIpAddress === $session["ip_address"]) {
                    return true; 
                }
                // return false;
            }
            
            return false;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return[
                "message" =>"nooo"
            ];
        }
    }

    private function encryptCookieValue($value) {
        $iv_length = openssl_cipher_iv_length($this->cipher);
        $iv = openssl_random_pseudo_bytes($iv_length);
        $encrypted_value = openssl_encrypt($value, $this->cipher, $this->encryption_key, 0, $iv);
        return base64_encode($encrypted_value . '::' . $iv);
    }

    private function decryptCookieValue($encrypted_value) {
        list($encrypted_data, $iv) = explode('::', base64_decode($encrypted_value), 2);
        return openssl_decrypt($encrypted_data, $this->cipher, $this->encryption_key, 0, $iv);
    }

    protected function setEncryptedCookie(string $name, string $value) {
        $encrypted_value = $this->encryptCookieValue($value);
        setcookie($name, $encrypted_value, [
            'expires' => time() + (24 * 60 * 60),
            'path' => '/',
            'secure' => true,
            'httponly' => true
        ]);
    }

    protected function setAdditionalCookies() {
        $cookieNames = ['auth_token_', 'session_key_', 'user_auth_', 'secure_tag_', 'access_data_'];

        foreach ($cookieNames as $name) {
            $cookieValue = bin2hex(random_bytes(32)); 
            $encryptedValue = $this->encryptCookieValue($cookieValue);

            setcookie($name, $encryptedValue, [
                'expires' => time() + (24 * 60 * 60),
                'path' => '/',
                'secure' => true,
                'httponly' => true
            ]);
        }
    }
}
