<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../vendor/autoload.php'; // Adjust this path as needed

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize form inputs
    $toEmail = filter_var($_POST['toEmail'], FILTER_SANITIZE_EMAIL);
    $toName = htmlspecialchars($_POST['contactName']);
    $replyMessage = nl2br(htmlspecialchars($_POST['replyMessage']));

    $mail = new PHPMailer(true);

    try {
        // SMTP Server configuration for Gmail
       $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'praiseonojs@gmail.com';
            $mail->Password   = 'ktle eksd aybh fgsw';  // 
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

        // Sender & recipient
        $mail->setFrom('praiseonojs@gmail.com', 'Ogeri Health Foundation');
        $mail->addAddress($toEmail, $toName);

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Reply to your message';
        $mail->Body    = "
            <p>Dear {$toName},</p>
            <p>{$replyMessage}</p>
            <p>Best regards,<br>Ogeri Health Foundation</p>
        ";

        $mail->send();
        echo "<script>
                window.onload = function() {
                    showAlert('Reply sent successfully!', 'success');
                    setTimeout(function() {
                        window.history.back();
                    }, 4000);
                };
            </script>";
    } catch (Exception $e) {
        echo "<script>
                window.onload = function() {
                    showAlert('Mail Error: " . addslashes($mail->ErrorInfo) . "', 'error');
                    setTimeout(function() {
                        window.history.back();
                    }, 4000);
                };
            </script>";
    }
}
