<?php
header('Content-Type: application/json');
require 'api/Database/DatabaseConn.php';
require 'vendor/autoload.php'; // If using PHPMailer via Composer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "Invalid email address."]);
        exit;
    }

    try {
        $db = new DatabaseConn();
        $pdo = $db->connect();
// Check if already subscribed
        $stmt = $pdo->prepare("SELECT id FROM subscribers WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(["status" => "error", "message" => "Email already subscribed."]);
        } else {
        $stmt = $pdo->prepare("INSERT INTO subscribers (email) VALUES (:email)");
        $stmt->execute([':email' => $email]);

         $mail = new PHPMailer(true);

        // Email notification to admin
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'praiseonojs@gmail.com';
            $mail->Password   = 'ktle eksd aybh fgsw';  // 
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;
          

        // Sender & recipient
        $mail->setFrom('praiseonojs@gmail.com', 'Ogeri Health Foundation');
        $mail->addAddress('info@ogerihealth.org'); // Admin's email
        $mail->Subject = 'New Newsletter Subscriber';
        $mail->Body = "You have a new newsletter subscriber:\n\nEmail: $email";

        $mail->send();

        echo json_encode(["status" => "success", "message" => "Thanks for subscribing!"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Database error: " . $e->getMessage()]);
    
     }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request"]);
}


?>

