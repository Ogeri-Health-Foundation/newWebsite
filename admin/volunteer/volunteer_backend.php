<?php
require '../../api/Database/DatabaseConn.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php'; // Adjust the path as needed


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $db = new DatabaseConn();
    $pdo = $db->connect();
    $stmt = $pdo->prepare("SELECT * FROM volunteers WHERE id = ?");
    $stmt->execute([$id]);
    $volunteer = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($volunteer);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $db = new DatabaseConn();
    $pdo = $db->connect(); 

    // Status update block remains unchanged...
    // If updating status only
    if (isset($_POST['id']) && isset($_POST['status'])) {
        $id = $_POST['id'];
        $status = $_POST['status'];

        try {
            $stmt = $pdo->prepare("SELECT email, name FROM volunteers WHERE id = ?");
            $stmt->execute([$id]);
            $volunteer = $stmt->fetch();
            if (!$volunteer) {
                echo json_encode(["success" => false, "message" => "Volunteer not found"]);
                exit;
            }

            $stmt = $pdo->prepare("UPDATE volunteers SET status = ? WHERE id = ?");
            $stmt->execute([$status, $id]);

            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host       = 'mail.ogerihealth.org';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'info@ogerihealth.org';
            $mail->Password   = '0s)lArHP7LxR';  // ❗ Make sure to store this securely
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            $mail->setFrom('info@ogerihealth.org', 'Ogeri Health Foundation');
            
            $mail->addAddress($volunteer['email'], $volunteer['name']);

            // Compose message
           if ($status === "Approved") {
            $mail->Subject = "Volunteer Application Accepted";

            $mail->isHTML(true);
            $mail->Body = "
            <div style='font-family: Arial, sans-serif; padding: 20px; color: #333; background-color: #f9f9f9;'>
                <div style='max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 10px; padding: 30px; box-shadow: 0 0 10px rgba(0,0,0,0.05);'>
                    <h2 style='color: #34a853;'>Congratulations, {$volunteer['name']}!</h2>
                    <p>Your volunteer application has been <strong>approved</strong> by Ogeri Health Foundation.</p>
                    <p>We're excited to have you on board! Please contact us at <a href='tel:+234XXXXXXXXX' style='color: #1a73e8;'>+234XXXXXXXXX</a> to proceed with the next steps.</p>
                    <p>We look forward to working with you and making a great impact together.</p>
                    <br>
                    <p style='font-style: italic; color: #666;'>Best regards,</p>
                    <p><strong>Ogeri Health Foundation</strong></p>
                </div>
            </div>
            ";
        } else {
            $mail->Subject = "Volunteer Application Status";

            $mail->isHTML(true);
            $mail->Body = "
            <div style='font-family: Arial, sans-serif; padding: 20px; color: #333; background-color: #f9f9f9;'>
                <div style='max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 10px; padding: 30px; box-shadow: 0 0 10px rgba(0,0,0,0.05);'>
                    <h2 style='color: #ea4335;'>Hello, {$volunteer['name']}</h2>
                    <p>Thank you for taking the time to apply as a volunteer with <strong>Ogeri Health Foundation</strong>.</p>
                    <p>After careful consideration, we regret to inform you that your application has not been approved at this time.</p>
                    <p>We appreciate your interest and encourage you to apply again in the future.</p>
                    <br>
                    <p style='font-style: italic; color: #666;'>Best wishes,</p>
                    <p><strong>Ogeri Health Foundation</strong></p>
                </div>
            </div>
            ";
        }

            $mail->send();

            echo json_encode(["success" => true, "message" => "Status updated and email sent"]);
        } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => "Mailer Error: " . $mail->ErrorInfo]);
        } catch (PDOException $e) {
            echo json_encode(["success" => false, "message" => "DB Error: " . $e->getMessage()]);
        }
        exit;
    }

    // Onboard or update volunteer
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'] ?? null;
    $home_address = $_POST['home_address'];
    $role = $_POST['role'];
    $gender = $_POST['gender'];
    $profession = $_POST['profession'] ?? null;
    $bio = $_POST['bio'] ?? null;
    $facebook = $_POST['facebook'] ?? null;
    $linkedin = $_POST['linkedin'] ?? null;
    $twitter = $_POST['twitter'] ?? null;
    $instagram = $_POST['instagram'] ?? null;
    $skills = $_POST['skills'] ?? null;
    $motivation = $_POST['motivation'] ?? null;

    $status = "Pending";
    $profile_picture = null;
    $resume = null;

    // === Profile Picture Upload ===
   if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
    $allowed_image_types = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
    $max_image_size = 2 * 1024 * 1024; // 2MB

    if (!in_array($_FILES['profile_picture']['type'], $allowed_image_types)) {
        echo json_encode(["success" => false, "message" => "Only JPG, PNG, and GIF images are allowed."]);
        exit;
    }

    if ($_FILES['profile_picture']['size'] > $max_image_size) {
        echo json_encode(["success" => false, "message" => "Profile picture must not exceed 2MB."]);
        exit;
    }

    $upload_dir = "../../volunteer_upload/profiles/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $file_name = uniqid() . "_" . basename($_FILES["profile_picture"]["name"]);
    $target_file = $upload_dir . $file_name;

    if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
        $profile_picture = $file_name;
    }
}
    // === Resume Upload ===
    if (isset($_FILES['resume']) && $_FILES['resume']['error'] == 0) {
    $allowed_resume_types = [
        'application/pdf',
        'application/msword',
        'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
    ];
    $max_resume_size = 5 * 1024 * 1024; // 5MB

    if (!in_array($_FILES['resume']['type'], $allowed_resume_types)) {
        echo json_encode(["success" => false, "message" => "Only PDF, DOC, and DOCX resumes are allowed."]);
        exit;
    }

    if ($_FILES['resume']['size'] > $max_resume_size) {
        echo json_encode(["success" => false, "message" => "Resume must not exceed 5MB."]);
        exit;
    }

    $upload_dir = "../../volunteer_upload/resumes/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $file_name = uniqid() . "_" . basename($_FILES["resume"]["name"]);
    $target_file = $upload_dir . $file_name;

    if (move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file)) {
        $resume = $file_name;
    }
}
    try {
        if ($id) {
            $stmt = $pdo->prepare("UPDATE volunteers SET 
                name = ?, email = ?, phone = ?, home_address = ?, role = ?, gender = ?, profession = ?, 
                bio = ?, facebook = ?, linkedin = ?, twitter = ?, instagram = ?, skills = ?, motivation = ?, 
                profile_picture = COALESCE(?, profile_picture), 
                resume = COALESCE(?, resume) 
                WHERE id = ?");

            $stmt->execute([
                $name, $email, $phone, $home_address, $role, $gender, $profession,
                $bio, $facebook, $linkedin, $twitter, $instagram, $skills, $motivation,
                $profile_picture, $resume, $id
            ]);

            echo json_encode(["success" => true, "message" => "Volunteer updated successfully"]);

        } else {
            
            $stmt = $pdo->prepare("INSERT INTO volunteers (
                 name, email, phone, home_address, role, gender, profession,
                bio, facebook, linkedin, twitter, instagram, skills, motivation, 
                profile_picture, resume, status
            ) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->execute([
                 $name, $email, $phone, $home_address, $role, $gender, $profession,
                $bio, $facebook, $linkedin, $twitter, $instagram, $skills, $motivation,
                $profile_picture, $resume, $status
            ]);

            echo json_encode(["success" => true, "message" => "Volunteer onboarded successfully"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "message" => "Error: " . $e->getMessage()]);
    }
}


?>