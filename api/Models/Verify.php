<?php
// Name of file: verifying.classes.php

class verifyingUser extends DatabaseConn {

    private $encryption_key = 'Kj6vNw!rJ3QpZ&4X8aBz$1TcLm9YgF@S2dVhGxR5HnUoIwP'; 
    private $cipher = 'AES-128-CBC'; 

    public function verifiedUser($code) {
        try {
            if (!isset($_COOKIE['_variable_'])) {
                throw new Exception("Cookie is not set.");
            }

            $encrypted_value = $_COOKIE['_variable_'];
            $uniqueID = $this->decryptCookieValue($encrypted_value);

            $stmt = $this->connect()->prepare("UPDATE admins SET otp_link_token = NULL WHERE unique_id = :unique_id");
            $stmt->bindParam(":unique_id", $uniqueID);
            $stmt->execute();

            $this->tickUser($uniqueID);
            return true;
        } catch (Exception $e) {
            error_log($e->getMessage());
            throw new Exception("Error during user verification.");
        }
    }

    protected function decryptCookieValue($encrypted_value) {
        try {
            list($encrypted_data, $iv) = explode('::', base64_decode($encrypted_value), 2);
            $decrypted = openssl_decrypt($encrypted_data, $this->cipher, $this->encryption_key, 0, $iv);

            if ($decrypted === false) {
                throw new Exception("Decryption failed.");
            }

            return $decrypted;
        } catch (Exception $e) {
            error_log($e->getMessage());
            throw new Exception("Error decrypting cookie value.");
        }
    }

    public function checkCode(string $code) {
        try {
            $stmt = $this->connect()->prepare("SELECT otp_link_token FROM admins WHERE otp_link_token = :code");
            $stmt->bindParam(':code', $code);
            $stmt->execute();
    
            return $stmt->rowCount() > 0;
        } catch (Exception $e) {
            error_log($e->getMessage());
            throw new Exception("Error checking code.");
        }
    }

    protected function tickUser($uniqueID) {
        try {
            $sessionId = bin2hex(random_bytes(60));
            $browserAgent = $_SERVER["HTTP_USER_AGENT"] ?? 'unknown';
            $ipAddress = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
            $userId = rand(time(), 10000000);
            $verificationStatus = true;

            $updateStmt = $this->connect()->prepare("
                INSERT INTO admin_sessions (user_id, unique_id, browser_agent, ip_address, verification_status, session_1)
                VALUES (:user_id, :unique_id, :browser_agent, :ip_address, :verification_status, :session_id)
                
            ");

            $updateStmt->bindParam(':session_id', $sessionId);
            $updateStmt->bindParam(':user_id', $userId);
            $updateStmt->bindParam(':browser_agent', $browserAgent);
            $updateStmt->bindParam(':ip_address', $ipAddress);
            $updateStmt->bindParam(':verification_status', $verificationStatus);
            $updateStmt->bindParam(':unique_id', $uniqueID); 
            $updateStmt->execute();

            $this->setEncryptedCookie($sessionId);
            $this->setAdditionalCookies();

            return true;
        } catch (Exception $e) {
            error_log($e->getMessage());
            throw new Exception("Error during user session management.");
        }
    }

    private function encryptCookieValue($value) {
        $iv_length = openssl_cipher_iv_length($this->cipher);
        $iv = openssl_random_pseudo_bytes($iv_length);

        $encrypted_value = openssl_encrypt($value, $this->cipher, $this->encryption_key, 0, $iv);

        if ($encrypted_value === false) {
            throw new Exception("Encryption failed.");
        }

        return base64_encode($encrypted_value . '::' . $iv);
    }

    protected function setEncryptedCookie($sessionId) {
        try {
            $encrypted_value = $this->encryptCookieValue($sessionId);

            setcookie('usid_id', $encrypted_value, [
                'expires' => time() + (24 * 60 * 60), 
                'path' => '/',
                'domain' => '',
                'secure' => true,
                'httponly' => true,
                'samesite' => 'None'
            ]);
            
        } catch (Exception $e) {
            error_log($e->getMessage());
            throw new Exception("Error setting encrypted cookie.");
        }
    }

    protected function setAdditionalCookies() {
        try {
            $cookieNames = [
                'auth_token_',
                'session_key_',
                'user_auth_',
                'secure_tag_',
                'access_data_'
            ];

            foreach ($cookieNames as $name) {
                $cookieValue = bin2hex(random_bytes(32));
                $encryptedValue = $this->encryptCookieValue($cookieValue);

                setcookie($name, $encryptedValue, [
                    'expires' => time() + (24 * 60 * 60),
                    'path' => '/',
                    'domain' => '',
                    'secure' => true,
                    'httponly' => true,
                    'samesite' => 'None'
                ]);
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            throw new Exception("Error setting additional cookies.");
        }
    }
}
?>