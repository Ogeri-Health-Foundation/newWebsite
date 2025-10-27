<?php
declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../../vendor/autoload.php";
include_once '../Database/DatabaseConn.php';
include_once '../Models/Login.php';
include_once '../Controllers/login.controller.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $login = new LoginContrl($email, $password);
    $result = $login->signinAdmin();
    echo json_encode($result);
} else {
    http_response_code(405);
    echo json_encode(["message" => "Invalid request method"]);
}
