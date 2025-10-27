<?php
declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once "../../vendor/autoload.php";
include_once '../Database/DatabaseConn.php';
include_once '../Models/Verify.php';
include_once '../Controllers/verify.controller.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $code = $_GET['code'] ?? null;

        if (empty($code)) {
            throw new Exception("Missing or empty code parameter.");
        }

        $verifying = new verifyingUserContrl($code);
        $result = $verifying->verifyingUser();

       if ($result['status'] === 200) {
    $baseUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http")
        . "://" . $_SERVER['HTTP_HOST']
        . str_replace('/api/v1', '', rtrim(dirname($_SERVER['PHP_SELF']), '/'));

    header("Location: $baseUrl/admin/index.php");
    exit;

        } else {
            echo json_encode($result);
        }

    } catch (Exception $e) {
        http_response_code(400);
        echo json_encode(["message" => $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(["message" => "Invalid request method."]);
}
