<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
require_once '../api/Database/DatabaseConn.php';

$db = (new DatabaseConn())->connect();

// Fetch subscribers
$stmt = $db->query("SELECT email FROM subscribers");
$emails = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Get form inputs
$subject = $_POST['subject'] ?? '';
$body = $_POST['body'] ?? '';

if (empty($subject) || empty($body)) {
    die("Subject and body are required.");
}

// Setup mail
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'mail.ogerihealth.org';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'info@ogerihealth.org';
    $mail->Password   = '0s)lArHP7LxR';  // ❗ Make sure to store this securely
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    // Sender
     $mail->setFrom('info@ogerihealth.org', 'Ogeri Health Foundation');

    // Recipients
    foreach ($emails as $email) {
        $mail->addBCC($email); // Use BCC so they don’t see each other
    }

    // Content
    $mail->isHTML(true);
    $mail->Subject = $subject;
   $mail->Body = '
    <div style="font-family: Arial, sans-serif; background-color: #f9f9f9; padding: 30px;">
        <div style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
            <div style="background-color: #24ABA0; color: #ffffff; padding: 20px; text-align: center;">
                <h2 style="margin: 0;">Ogeri Health Foundation</h2>
            </div>
            <div style="padding: 30px; color: #333333;">
                <p style="font-size: 16px; line-height: 1.6;">' . nl2br($body) . '</p>
            </div>
            <div style="background-color: #F7A234; color: #ffffff; text-align: center; padding: 15px; font-size: 14px;">
                <p style="margin: 0;">Thank you for staying connected with us!</p>
            </div>
        </div>
    </div>';

    try {
    $mail->send();
    $msg = urlencode("Newsletter sent successfully!");
    header("Location: subcribers.php?status=success&message=$msg");
    exit;
} catch (Exception $e) {
    $error = urlencode("Mailer Error: {$mail->ErrorInfo}");
    header("Location: subcribers.php?status=error&message=$error");
    exit;
}
} catch (Exception $e) {
    // Handle error
    $msg = urlencode("Mailer Error: {$mail->ErrorInfo}");
    header("Location: subcribers.php?status=error&message=$msg");
    exit;
} finally {
    $mail->clearAddresses(); // Clear addresses for next use
}
