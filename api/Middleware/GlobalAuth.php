<?php

require_once "../Database/DatabaseConn.php";

class Auth extends DatabaseConn {

    private $encryption_key = 'Kj6vNw!rJ3QpZ&4X8aBz$1TcLm9YgF@S2dVhGxR5HnUoIwP'; 
    private $cipher = 'AES-128-CBC'; 

    public function authenticate() {
        // Ensure both cookies exist
        if (empty($_COOKIE['_variable_']) || empty($_COOKIE['usid_id'])) {
            $this->clearCookies();
            http_response_code(401);
            echo json_encode(["message" => "Missing authentication cookies"]);
            exit;
        }

        // Decrypt cookie values
        $uniqueID = $this->decryptCookieValue($_COOKIE['_variable_']);
        $sessionID = $this->decryptCookieValue($_COOKIE['usid_id']);

        if (!$uniqueID || !$sessionID) {
            $this->clearCookies();
            http_response_code(401);
            echo json_encode(["message" => "Invalid session cookies"]);
            exit;
        }

        try {
            $stmt = $this->connect()->prepare("
                SELECT * FROM admin_sessions 
                WHERE unique_id = :unique_id AND session_1 = :session_id
            ");
            $stmt->bindParam(':unique_id', $uniqueID);
            $stmt->bindParam(':session_id', $sessionID);
            $stmt->execute();
            $session = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$session) {
                $this->clearCookies();
                http_response_code(401);
                echo json_encode(["message" => "Session not found"]);
                exit;
            }

            // Get user agent for device recognition
            $currentBrowserAgent = $_SERVER["HTTP_USER_AGENT"] ?? "";

            // ✅ Instead of forcing exact IP match, only check same browser/device
            if ($currentBrowserAgent !== $session['browser_agent']) {
                // Device or browser changed → force re-login
                $this->clearCookies();
                http_response_code(401);
                echo json_encode(["message" => "New device detected, please re-login"]);
                exit;
            }

            // ✅ Optional: update last_seen to track activity
            $update = $this->connect()->prepare("
                UPDATE admin_sessions SET last_seen = NOW() WHERE unique_id = :uid
            ");
            $update->bindParam(':uid', $uniqueID);
            $update->execute();

            return true;

        } catch (Exception $e) {
            error_log("Auth error: " . $e->getMessage());
            http_response_code(500);
            echo json_encode(["message" => "Server error during authentication"]);
            exit;
        }
    }

    private function decryptCookieValue($encrypted_value) {
        try {
            list($encrypted_data, $iv) = explode('::', base64_decode($encrypted_value), 2);
            return openssl_decrypt($encrypted_data, $this->cipher, $this->encryption_key, 0, $iv);
        } catch (Exception $e) {
            error_log("Decryption failed: " . $e->getMessage());
            return false;
        }
    }

    private function clearCookies() {
        setcookie("_variable_", "", time() - 3600, "/"); 
        setcookie("usid_id", "", time() - 3600, "/");
        unset($_COOKIE["_variable_"]);
        unset($_COOKIE["usid_id"]);
    }
}
