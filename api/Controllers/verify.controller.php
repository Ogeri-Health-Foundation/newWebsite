<?php
declare(strict_types=1);

class verifyingUserContrl extends verifyingUser
{
    private string $code;

    public function __construct(string $code)
    {
        $this->code = trim($code);
    }

    public function verifyingUser(): array
    {
        try {
            $codeStatus = $this->checkCodeStatus($this->code);

            if ($codeStatus === 'not_found') {
                return [
                    "message" => "Code is invalid or has expired.",
                    "status" => 400
                ];
            }

            if ($codeStatus === 'used') {
                return [
                    "message" => "This verification link has already been used. Please log in again.",
                    "status" => 400
                ];
            }

            // ✅ Code is valid — verify and clear it
            $this->verifiedUser($this->code);

            return [
                "message" => "Verification successful! Redirecting...",
                "status" => 200
            ];

        } catch (Exception $e) {
            return [
                "message" => "Server error: " . $e->getMessage(),
                "status" => 500
            ];
        }
    }

    /**
     * Determine if the code is valid, used, or invalid.
     */
    protected function checkCodeStatus(string $code): string
    {
        // ✅ 1. Check if this code exists in database (still valid)
        $stmt = $this->connect()->prepare("SELECT COUNT(*) FROM admins WHERE otp_link_token = :code");
        $stmt->execute([':code' => $code]);
        $exists = $stmt->fetchColumn();

        if ($exists > 0) {
            return 'valid';
        }

        // ⚠️ 2. Check if any user has otp_link_token NULL (used/cleared)
        $stmt = $this->connect()->prepare("SELECT COUNT(*) FROM admins WHERE otp_link_token IS NULL");
        $stmt->execute();
        $used = $stmt->fetchColumn();

        if ($used > 0) {
            return 'used';
        }

        // ❌ 3. Otherwise, code doesn’t exist
        return 'not_found';
    }
}
