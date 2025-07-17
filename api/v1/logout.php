<?php
require_once "../Database/DatabaseConn.php";

class Logout extends DatabaseConn {

    private $encryption_key = 'Kj6vNw!rJ3QpZ&4X8aBz$1TcLm9YgF@S2dVhGxR5HnUoIwP'; 
    private $cipher = 'AES-128-CBC'; 

    public function logout() {
        if (!isset($_COOKIE['_variable_']) || !isset($_COOKIE['usid_id'])) {
            $this->clearCookies();
            http_response_code(200);
            echo json_encode(["message" => "Logged out"]);
            exit;
        }

        $uniqueID = $this->decryptCookieValue($_COOKIE['_variable_']);
        $sessionID = $this->decryptCookieValue($_COOKIE['usid_id']);

        try {
            // Remove session from DB
            $stmt = $this->connect()->prepare("
                DELETE FROM admin_sessions 
                WHERE unique_id = :unique_id AND session_1 = :session_id
            ");
            $stmt->bindParam(':unique_id', $uniqueID);
            $stmt->bindParam(':session_id', $sessionID);
            $stmt->execute();

        } catch (Exception $e) {
            error_log("Logout error: " . $e->getMessage());
        }

        $this->clearCookies();
        http_response_code(200);
        echo json_encode(["message" => "Logged out successfully"]);
        exit;
    }

    private function decryptCookieValue($encrypted_value) {
        try {
            list($encrypted_data, $iv) = explode('::', base64_decode($encrypted_value), 2);
            return openssl_decrypt($encrypted_data, $this->cipher, $this->encryption_key, 0, $iv);
        } catch (Exception $e) {
            return false;
        }
    }

    private function clearCookies() {
        $cookies = ['_variable_', 'usid_id', 'auth_token_', 'session_key_', 'user_auth_', 'secure_tag_', 'access_data_'];

        foreach ($cookies as $cookie) {
            setcookie($cookie, '', time() - 3600, "/", "", true, true);
            unset($_COOKIE[$cookie]);
        }
    }
}

$logout = new Logout();
$logout->logout();
