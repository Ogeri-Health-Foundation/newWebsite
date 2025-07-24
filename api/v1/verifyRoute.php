<?php


// error_reporting(E_ALL);
// ini_set('display_errors', 1);

include_once '../Database/DatabaseConn.php';
include_once '../Models/Verify.php';
include_once '../Controllers/verify.controller.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        if (!isset($_GET["code"]) || empty($_GET["code"])) {
            throw new Exception("Missing or empty code parameter.");
        }

        $code = $_GET["code"];

        $verifying = new verifyingUserContrl($code);
        $verifying->verifyingUser();
        header("Location: https://web.ogerihealth.org/admin/index.php");
        // header("Location:../../admin/resources.php");
    } catch (Exception $e) {
        echo json_encode(["message" => $e->getMessage()]);
        http_response_code(400);
    }
} else {
    echo json_encode(["message" => "Invalid request method."]);
    http_response_code(405);
}
?>