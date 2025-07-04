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
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'praiseonojs@gmail.com';
            $mail->Password   = 'ktle eksd aybh fgsw';  // ❗ Make sure to store this securely
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;
            $mail->setFrom('praiseonojs@gmail.com', 'Ogeri Health Foundation');
            $mail->addAddress($volunteer['email'], $volunteer['name']);

            // Compose message
            if ($status === "Approved") {
                $mail->Subject = "Volunteer Application Accepted";
                $mail->Body = "Dear {$volunteer['name']},\n\nYour application has been approved! Please contact +234XXXXXXXXX to proceed with the next steps.\n\nBest regards,\nOgeri Health Foundation";
            } else {
                $mail->Subject = "Volunteer Application Status";
                $mail->Body = "Dear {$volunteer['name']},\n\nWe regret to inform you that your application has been declined at this time. Please feel free to try again in the future.\n\nBest wishes,\nOgeri Health Foundation";
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

    // If updating volunteer details
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $name = $_POST['name'];
    $email = $_POST['email'];
    $home_address = $_POST['home_address'];
    $role = $_POST['role'];
    $gender = $_POST['gender'];
    $profession = $_POST['profession'];
    $status= "Pending";
    
    $profile_picture = NULL;

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $upload_dir = "../assets/images/volunteer-img-uploads/"; // The correct upload path

        if (!!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        $file_name = basename($_FILES["profile_picture"]["name"]);
        $target_file = $upload_dir . $file_name;
    
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
            // Remove '../' before saving in the database
            $profile_picture =  $file_name;
        }
    }

    try {
        // $db = new DatabaseConn();
        // $pdo = $db->connect();
        
        if ($id) {
            $stmt = $pdo->prepare("UPDATE volunteers SET name = ?, email = ?, home_address = ?, role = ?, gender = ?, profession = ?, profile_picture = COALESCE(?, profile_picture) WHERE id = ?");
            $stmt->execute([$name, $email, $home_address, $role, $gender, $profession, $profile_picture, $id]);
            echo json_encode(["success" => true, "message" => "Volunteer updated successfully"]);
        } else {

            $RandId = bin2hex(random_bytes(10));

            $stmt = $pdo->prepare("INSERT INTO volunteers (volunteer_id, name, email, home_address, role, gender, profession, profile_picture, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$RandId, $name, $email, $home_address, $role, $gender, $profession, $profile_picture, $status]);
            echo json_encode(["success" => true, "message" => "Volunteer onboarded successfully"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "message" => "Error: " . $e->getMessage()]);
    }
}
?>