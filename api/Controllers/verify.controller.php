<?php

declare(strict_types=1);

class verifyingUserContrl extends verifyingUser {

    private $code;

    public function __construct(string $code) {
        $this->code = $code;
    }

    public function verifyingUser() {
        try {
            if (!$this->checkCodeValid($this->code)) {
                echo json_encode(["message" => "Code is Invalid or Expired."]);
                http_response_code(400);
                exit;
            }

            $this->verifiedUser($this->code);
            echo json_encode(["message" => "Code validated successfully."]);
            http_response_code(200);
        } catch (Exception $e) {
            echo json_encode(["message" => $e->getMessage()]);
            http_response_code(500);
        }
    }

    protected function checkCodeValid($code) {
        return parent::checkCode($code);
    }
}
?>