<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
$connectX = true;
require_once 'include/connectionx.php';

header('Content-Type: application/json');

$response = [
    "status" => "error",
    "message" => "Something went wrong. Please try again.",
];

if (!isset($dbh)) {
    http_response_code(500);
    $response['message'] = "Database connection not established.";
    echo json_encode($response);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $name = str_replace(["\r", "\n"], [" ", " "], $name);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = trim($_POST["subject"]);
    // $number = trim($_POST["number"]);
    $message = trim($_POST["message"]);

    if (empty($name) || empty($message)  || empty($subject) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        $response['message'] = "Please complete the form correctly.";
        echo json_encode($response);
        exit;
    }

    $stmt = $dbh->prepare("INSERT INTO contact_messages (name, email,  company, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'praiseonojs@gmail.com';
            $mail->Password   = 'ktle eksd aybh fgsw';  // ❗ Make sure to store this securely
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('praiseonojs@gmail.com', 'OHF Website');
            $mail->addAddress('info@ogerihealth.org', 'Admin');

            $mail->isHTML(true);
            $mail->Subject = "New Contact Message from $name";
            $mail->Body    = "
                <h2>New Contact Form Submission</h2>
                <p><strong>Name:</strong> $name</p>
                <p><strong>Email:</strong> $email</p>
               
                <p><strong>Company:</strong> $subject</p>
                <p><strong>Message:</strong><br>$message</p>
            ";
            $mail->AltBody = "Name: $name\nEmail: $email\nCompany: $subject\nMessage:\n$message";

            $mail->send();
            http_response_code(200);
            $response['status'] = "success";
            $response['message'] = "Your message has been sent successfully.";
        } catch (Exception $e) {
            http_response_code(500);
            $response['message'] = "Saved to database, but email failed to send: {$mail->ErrorInfo}";
        }
    } else {
        http_response_code(500);
        $response['message'] = "Failed to save your message.";
    }

    $stmt->close();
    $dbh->close();
}

echo json_encode($response);
