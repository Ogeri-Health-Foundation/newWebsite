<?php
 // Assuming this is a flag to include the connection file
 $connectX=true;
require_once 'include/connectionx.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $home_address = trim($_POST['home_address']);
    $profession = isset($_POST['profession']) ? trim($_POST['profession']) : null;
    $gender = $_POST['gender'];
    $role = $_POST['role'];
    $staus = "Pending";

    $upload_dir = "admin/assets/images/volunteer-img-uploads/";
    $profile_picture = null;

    // Handle profile picture upload
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['profile_picture']['tmp_name'];
        $file_name = basename($_FILES['profile_picture']['name']);
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($file_ext, $allowed_exts)) {
            $new_filename = uniqid("vol_") . '.' . $file_ext;
            $destination = $upload_dir . $new_filename;

            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true); // create folder if not exists
            }

            if (move_uploaded_file($file_tmp, $destination)) {
                $profile_picture = $new_filename;
            } else {
                echo json_encode(["success" => false, "message" => "Failed to upload profile picture."]);
                exit;
            }
        } else {
            echo json_encode(["success" => false, "message" => "Invalid image format."]);
            exit;
        }
    }

    // Insert into database
    $stmt = $dbh->prepare("INSERT INTO volunteers (name, email, phone, home_address, role, gender, profession, profile_picture, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    try {
        $stmt->bind_param("sssssssss", $name, $email, $phone, $home_address, $role, $gender, $profession, $profile_picture, $staus);
        $stmt->execute();
        echo json_encode(["success" => true, "message" => "Your volunteer request has been submitted successfully."]);
    } catch (mysqli_sql_exception $e) {
        echo json_encode(["success" => false, "message" => "Database error: " . $e->getMessage()]);
    }

    exit;
}
?>
