<?php 

require_once "../Database/DatabaseConn.php";

class Auth extends DatabaseConn {

    private $encryption_key = 'Kj6vNw!rJ3QpZ&4X8aBz$1TcLm9YgF@S2dVhGxR5HnUoIwP'; 
    private $cipher = 'AES-128-CBC'; 

    public function authenticate() {
        if (!isset($_COOKIE['_variable_']) || !isset($_COOKIE['usid_id'])) {
            error_log("Cookies are missing.");
            $this->clearCookies(); 
            http_response_code(401);
            echo json_encode(["message" => "Unauthorized"]);
            exit; // 💥 added here
        }
    
        $encrypted_id = $_COOKIE['_variable_'];
        $encrypted_session = $_COOKIE['usid_id'];
        $uniqueID = $this->decryptCookieValue($encrypted_id);
        $sessionID = $this->decryptCookieValue($encrypted_session);
    
        if (!$uniqueID || !$sessionID) {
            error_log("Decryption failed or values are missing.");
            $this->clearCookies(); 
            http_response_code(401);
            echo json_encode(["message" => "Unauthorized"]);
            exit; // 💥 added here
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
                error_log("Invalid session, redirecting.");
                $this->clearCookies();
                http_response_code(401);
                echo json_encode(["message" => "Unauthorized"]);
                exit; // ✅ added here instead of redirect if this is API
            }
    
            $currentBrowserAgent = $_SERVER["HTTP_USER_AGENT"] ?? "";
            $currentIpAddress = $_SERVER['REMOTE_ADDR'] ?? "";
    
            if ($currentBrowserAgent !== $session['browser_agent'] || $currentIpAddress !== $session['ip_address']) {
                error_log("Session mismatch: browser or IP address changed.");
                $this->clearCookies();
                http_response_code(401);
                echo json_encode(["message" => "Unauthorized"]);
                exit; // ✅
            }
    
            return true;
    
        } catch (Exception $e) {
            error_log("Database query error: " . $e->getMessage());
            http_response_code(500);
            echo json_encode(["message" => "Server error"]);
            exit; // ✅
        }
    }
    

    private function decryptCookieValue($encrypted_value) {
        try {
            list($encrypted_data, $iv) = explode('::', base64_decode($encrypted_value), 2);
            return openssl_decrypt($encrypted_data, $this->cipher, $this->encryption_key, 0, $iv);
        } catch (Exception $e) {
            error_log("Decryption error: " . $e->getMessage());
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
