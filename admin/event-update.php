<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Database configuration
if (ob_get_length()) ob_clean();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../api/Database/DatabaseConn.php';

$db = new DatabaseConn();
$pdo = $db->connect();
try {
    // Create PDO connection
    if (!$pdo) {
        throw new Exception('Database connection failed');
    }
    
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Only POST method allowed');
    }
    
    // Validate required fields
    if (!isset($_POST['event_id']) || empty($_POST['event_id'])) {
        throw new Exception('Event ID is required');
    }
    
    $event_id = intval($_POST['event_id']);
    
    // Create uploads directory if it doesn't exist
    $upload_dir = '../uploads/events/';
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    
    // Handle image uploads
    $uploaded_images = array();
    $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
    $max_file_size = 5 * 1024 * 1024; // 5MB
    
    for ($i = 1; $i <= 6; $i++) {
        $file_key = "event_image$i";
        
        if (isset($_FILES[$file_key]) && $_FILES[$file_key]['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES[$file_key];
            
            // Validate file size
            if ($file['size'] > $max_file_size) {
                throw new Exception("Image $i is too large. Maximum size is 5MB");
            }
            
            // Validate file type
            $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if (!in_array($file_extension, $allowed_types)) {
                throw new Exception("Image $i has invalid file type. Only JPG, JPEG, PNG, and GIF are allowed");
            }
            
            // Generate unique filename
            $new_filename = 'event_' . $event_id . '_' . $i . '_' . time() . '.' . $file_extension;
            $destination = $upload_dir . $new_filename;
            
            // Move uploaded file
            if (move_uploaded_file($file['tmp_name'], $destination)) {
                $uploaded_images[$file_key] = $new_filename;
            } else {
                throw new Exception("Failed to upload image $i");
            }
        }
    }
    
    // Prepare event data
    $event_data = array(
        'total_attendees' => isset($_POST['total_attendees']) ? intval($_POST['total_attendees']) : null,
        'bp_screened' => isset($_POST['bp_screened']) ? intval($_POST['bp_screened']) : null,
        'high_bp_detected' => isset($_POST['high_bp_detected']) ? intval($_POST['high_bp_detected']) : null,
        'repeat_attendees' => isset($_POST['repeat_attendees']) ? intval($_POST['repeat_attendees']) : null,
        'counselled' => isset($_POST['counselled']) ? intval($_POST['counselled']) : null,
        'medications_dispensed' => isset($_POST['medications_dispensed']) ? intval($_POST['medications_dispensed']) : null,
        'referrals' => isset($_POST['referrals']) ? intval($_POST['referrals']) : null,
        'average_age' => isset($_POST['average_age']) ? intval($_POST['average_age']) : null,
        'gender_male' => isset($_POST['gender_male']) ? intval($_POST['gender_male']) : null,
        'gender_female' => isset($_POST['gender_female']) ? intval($_POST['gender_female']) : null,
        'villages_served' => isset($_POST['villages_served']) ? intval($_POST['villages_served']) : null
    );
    
    // Start transaction
    $pdo->beginTransaction();
    
    // Check if event exists first
    $check_sql = "SELECT id FROM events WHERE id = :event_id";
    $check_stmt = $pdo->prepare($check_sql);
    $check_stmt->execute(['event_id' => $event_id]);
    
    if (!$check_stmt->fetch()) {
        throw new Exception('Event not found');
    }
    
    // Update event details
    $update_sql = "UPDATE events SET 
                   total_attendees = :total_attendees,
                   bp_screened = :bp_screened,
                   high_bp_detected = :high_bp_detected,
                   repeat_attendees = :repeat_attendees,
                   counselled = :counselled,
                   medications_dispensed = :medications_dispensed,
                   referrals = :referrals,
                   average_age = :average_age,
                   gender_male = :gender_male,
                   gender_female = :gender_female,
                   villages_served = :villages_served,
                   status = 'completed',
                   updated_at = NOW()
                   WHERE id = :event_id";
    
    $stmt = $pdo->prepare($update_sql);
    $event_data['event_id'] = $event_id;
    $stmt->execute($event_data);
    
    // Insert uploaded images into event_images table
    if (!empty($uploaded_images)) {
        $image_sql = "INSERT INTO event_images (event_id, image_filename, image_order, uploaded_at) VALUES (?, ?, ?, NOW())";
        $image_stmt = $pdo->prepare($image_sql);
        
        $order = 1;
        foreach ($uploaded_images as $key => $filename) {
            $image_stmt->execute([$event_id, $filename, $order]);
            $order++;
        }
    }
    
    // Commit transaction
    $pdo->commit();
    
    $response = array(
        'success' => true,
        'message' => 'Event updated successfully',
        'event_id' => $event_id,
        'uploaded_images' => count($uploaded_images),
        'data' => array(
            'images' => $uploaded_images,
            'event_data' => $event_data
        )
    );
    
} catch (Exception $e) {
    // Rollback transaction if it was started
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollback();
    }
    
    // Clean up uploaded files if there was an error
    if (isset($uploaded_images)) {
        foreach ($uploaded_images as $filename) {
            if (file_exists($upload_dir . $filename)) {
                unlink($upload_dir . $filename);
            }
        }
    }
    
    $response = array(
        'success' => false,
        'message' => $e->getMessage(),
        'error_code' => $e->getCode()
    );
    
    http_response_code(400);
}

echo json_encode($response);
?>