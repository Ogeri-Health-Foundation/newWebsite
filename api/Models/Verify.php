<?php
class verifyingUser extends DatabaseConn
{
    private string $encryption_key = 'Kj6vNw!rJ3QpZ&4X8aBz$1TcLm9YgF@S2dVhGxR5HnUoIwP'; 
    private string $cipher = 'AES-128-CBC';

   public function verifiedUser(string $code): bool
        {
            $stmt = $this->connect()->prepare("
                SELECT unique_id FROM admins WHERE otp_link_token = :code
            ");
            $stmt->execute([':code' => $code]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$row) {
                throw new Exception("Invalid verification code.");
            }

            $uniqueID = $row['unique_id'];

            // Clear OTP token
            $clear = $this->connect()->prepare("
                UPDATE admins 
                SET otp_link_token = NULL 
                WHERE unique_id = :unique_id
            ");
            $clear->execute([':unique_id' => $uniqueID]);

            // Mark device as trusted
            $this->registerTrustedDevice($uniqueID);
            return true;
        }

    private function registerTrustedDevice(string $uniqueID): void
    {
        $sessionId = bin2hex(random_bytes(60));
        $browserAgent = $_SERVER["HTTP_USER_AGENT"] ?? 'unknown';
        $ipAddress = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        $verificationStatus = 1;
        $userId = random_int(100000, 999999);

        $stmt = $this->connect()->prepare("
            INSERT INTO admin_sessions 
            (user_id, unique_id, browser_agent, ip_address, verification_status, session_1)
            VALUES 
            (:user_id, :unique_id, :browser_agent, :ip_address, :verification_status, :session_id)
        ");
        $stmt->execute([
            ':user_id' => $userId,
            ':unique_id' => $uniqueID,
            ':browser_agent' => $browserAgent,
            ':ip_address' => $ipAddress,
            ':verification_status' => $verificationStatus,
            ':session_id' => $sessionId
        ]);

        $this->setEncryptedCookie('usid_id', $sessionId);
        $this->setAdditionalCookies();
    }

    private function decryptCookieValue(string $encrypted_value): string
    {
        list($encrypted_data, $iv) = explode('::', base64_decode($encrypted_value), 2);
        $decrypted = openssl_decrypt($encrypted_data, $this->cipher, $this->encryption_key, 0, $iv);
        if ($decrypted === false) {
            throw new Exception("Failed to decrypt cookie value.");
        }
        return $decrypted;
    }

    private function encryptCookieValue(string $value): string
    {
        $iv_length = openssl_cipher_iv_length($this->cipher);
        $iv = openssl_random_pseudo_bytes($iv_length);
        $encrypted_value = openssl_encrypt($value, $this->cipher, $this->encryption_key, 0, $iv);

        if ($encrypted_value === false) {
            throw new Exception("Encryption failed.");
        }

        return base64_encode($encrypted_value . '::' . $iv);
    }

    protected function setEncryptedCookie(string $name, string $value): void
    {
        $encrypted_value = $this->encryptCookieValue($value);
        setcookie($name, $encrypted_value, [
            'expires' => time() + (24 * 60 * 60),
            'path' => '/',
            'secure' => true,
            'httponly' => true,
            'samesite' => 'None'
        ]);
    }

    protected function setAdditionalCookies(): void
    {
        $extraCookies = ['auth_token_', 'session_key_', 'user_auth_', 'secure_tag_', 'access_data_'];
        foreach ($extraCookies as $cookie) {
            $randomVal = bin2hex(random_bytes(32));
            $this->setEncryptedCookie($cookie, $randomVal);
        }
    }

    public function checkCode(string $code): bool
    {
        $stmt = $this->connect()->prepare("SELECT otp_link_token FROM admins WHERE otp_link_token = :code");
        $stmt->bindParam(':code', $code);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }
}
