<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

header('Content-Type: application/json');

$response = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $toEmail = filter_var($_POST['toEmail'], FILTER_SANITIZE_EMAIL);
    $toName = htmlspecialchars($_POST['contactName']);
    $replyMessage = nl2br(htmlspecialchars($_POST['replyMessage']));

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'mail.ogerihealth.org';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'info@ogerihealth.org';
        $mail->Password   = '0s)lArHP7LxR';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $mail->setFrom('info@ogerihealth.org', 'Ogeri Health Foundation');
        $mail->addAddress($toEmail, $toName);

        $mail->isHTML(true);
        $mail->Subject = 'Reply to your message';
        $mail->Body    = "
            <p>Dear {$toName},</p>
            <p>{$replyMessage}</p>
            <p>Best regards,<br>Ogeri Health Foundation</p>
        ";

        $mail->send();

        $response = [
            'status' => 'success',
            'message' => 'Reply sent successfully!'
        ];

    } catch (Exception $e) {
        $response = [
            'status' => 'error',
            'message' => 'Mail Error: ' . $mail->ErrorInfo
        ];
    }

    echo json_encode($response);
}
