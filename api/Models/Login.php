<?php
declare(strict_types=1);
require_once "../Traits/MailGrid.php";

class Login extends DatabaseConn {
    private $encryption_key = 'Kj6vNw!rJ3QpZ&4X8aBz$1TcLm9YgF@S2dVhGxR5HnUoIwP'; 
    private $cipher = 'AES-128-CBC'; 

    use sendMail;

  public function loginAdmin(string $email, string $password)
{
    try {
        $stmt = $this->connect()->prepare("SELECT unique_id, password FROM admins WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() === 0) {
            return ["message" => "Invalid email or password", "status" => 400];
        }

        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        // If plain passwords (for now)
        if ($password !== $admin['password']) {
            return ["message" => "Invalid email or password", "status" => 400];
        }

        $uniqueId = $admin['unique_id'];
        $currentBrowserAgent = $_SERVER["HTTP_USER_AGENT"] ?? "";

        // ✅ Check if this device/browser already has an active session
        $sessionStmt = $this->connect()->prepare("
            SELECT id FROM admin_sessions 
            WHERE unique_id = :uid AND browser_agent = :agent
        ");
        $sessionStmt->bindParam(':uid', $uniqueId);
        $sessionStmt->bindParam(':agent', $currentBrowserAgent);
        $sessionStmt->execute();

        if ($sessionStmt->rowCount() === 0) {
            // New device/browser → create new session
            $sessionID = bin2hex(random_bytes(32));
            $insert = $this->connect()->prepare("
                INSERT INTO admin_sessions (unique_id, session_1, browser_agent, ip_address, created_at)
                VALUES (:uid, :sid, :agent, :ip, NOW())
            ");
            $ip = $_SERVER['REMOTE_ADDR'] ?? '';
            $insert->bindParam(':uid', $uniqueId);
            $insert->bindParam(':sid', $sessionID);
            $insert->bindParam(':agent', $currentBrowserAgent);
            $insert->bindParam(':ip', $ip);
            $insert->execute();
        } else {
            // Existing trusted device
            $session = $sessionStmt->fetch(PDO::FETCH_ASSOC);
            $sessionID = $session['id']; // use existing session
        }

        // ✅ Set encrypted cookies for authentication
        $this->setEncryptedCookie('_variable_', $uniqueId);
        $this->setEncryptedCookie('usid_id', (string)$sessionID);

        // Optional extra cookies (security padding)
        $this->setAdditionalCookies();

        return [
            "message" => "Login successful",
            "status" => 200
        ];
    } catch (Exception $e) {
        return ["message" => "Server error: " . $e->getMessage(), "status" => 500];
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
                    
                   echo json_encode([
                        "status" => "success",
                        "message" => "Otp Sent: Please check your email to re-login"
                    ]);
                    http_response_code(200);
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

    // ✅ Replace the old checkDeviceAuth() with this:
    public function checkDeviceAuth(string $email): bool {
        try {
            $userStmt = $this->connect()->prepare("SELECT unique_id FROM admins WHERE email = :email");
            $userStmt->bindParam(':email', $email);
            $userStmt->execute();

            if ($userStmt->rowCount() === 0) return false;

            $userData = $userStmt->fetch(PDO::FETCH_ASSOC);
            $uniqueId = $userData['unique_id'];

            $currentBrowserAgent = $_SERVER["HTTP_USER_AGENT"] ?? "";

            $sessionStmt = $this->connect()->prepare("
                SELECT id FROM admin_sessions
                WHERE unique_id = :uid AND browser_agent = :agent
            ");
            $sessionStmt->bindParam(':uid', $uniqueId);
            $sessionStmt->bindParam(':agent', $currentBrowserAgent);
            $sessionStmt->execute();

            return $sessionStmt->rowCount() > 0;
        } catch (Exception $e) {
            error_log("Device check error: " . $e->getMessage());
            return false;
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
