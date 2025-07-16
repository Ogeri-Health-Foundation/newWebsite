<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "../Middleware/GlobalAuth.php";
require_once "../Controllers/update_event.controller.php";
require_once "../Models/UpdateEvents.php";

header("Content-Type: application/json");

$db = new DatabaseConn();
$dbh = $db->connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Validate event ID
        if (!isset($_POST['event_id']) || empty($_POST['event_id'])) {
            throw new Exception("Event ID is required");
        }

        $eventId = $_POST['event_id'];

        // Process the numeric fields
        $numericFields = [
            'total_attendees',
            'bp_screened',
            'high_bp_detected',
            'repeat_attendees',
            'counselled',
            'medications_dispensed',
            'referrals',
            'average_age',
            'gender_male',
            'gender_female',
            'villages_served'
        ];

        $data = ['event_id' => $eventId];

        foreach ($numericFields as $field) {
            $data[$field] = isset($_POST[$field]) ? (int)$_POST[$field] : 0;
        }

        // Begin database transaction
        $dbh->beginTransaction();

        try {
            // 1. Update event statistics in the events table
            $statsQuery = "UPDATE events 
                         SET total_attendees = :total_attendees,
                             bp_screened = :bp_screened,
                             high_bp_detected = :high_bp_detected,
                             repeat_attendees = :repeat_attendees,
                             counselled = :counselled,
                             medications_dispensed = :medications_dispensed,
                             referrals = :referrals,
                             average_age = :average_age,
                             gender_male = :gender_male,
                             gender_female = :gender_female,
                             villages_served = :villages_served
                         WHERE event_id = :event_id";

            $stmt = $dbh->prepare($statsQuery);
            $stmt->execute($data);

            // 2. Process and store uploaded images in event_galleries table
            $hasNewUploads = false;

            // First check if any new images were uploaded
            for ($i = 1; $i <= 6; $i++) {
                $fieldName = "event_image$i";
                if (isset($_FILES[$fieldName]) && $_FILES[$fieldName]['error'] === UPLOAD_ERR_OK) {
                    $hasNewUploads = true;
                    break;
                }
            }

            if ($hasNewUploads) {
                // Only delete existing images if new ones are being uploaded
                $deleteQuery = "DELETE FROM event_galleries WHERE event_id = :event_id";
                $stmt = $dbh->prepare($deleteQuery);
                $stmt->execute(['event_id' => $eventId]);

                // Optional: Delete the physical files
                $selectQuery = "SELECT img_path FROM event_galleries WHERE event_id = :event_id";
                $stmt = $dbh->prepare($selectQuery);
                $stmt->execute(['event_id' => $eventId]);
                $oldImages = $stmt->fetchAll(PDO::FETCH_COLUMN);

                foreach ($oldImages as $oldImage) {
                    $filePath = "../../uploads/events/" . $oldImage;
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }

                // Process new uploads
                for ($i = 1; $i <= 6; $i++) {
                    $fieldName = "event_image$i";

                    if (isset($_FILES[$fieldName]) && $_FILES[$fieldName]['error'] === UPLOAD_ERR_OK) {
                        // Validate file type
                        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                        $fileType = mime_content_type($_FILES[$fieldName]['tmp_name']);
                        if (!in_array($fileType, $allowedTypes)) {
                            throw new Exception("Invalid file type for {$fieldName}. Only JPG, PNG, and GIF are allowed.");
                        }

                        // Validate file size (max 5MB)
                        $maxSize = 5 * 1024 * 1024; // 5MB
                        if ($_FILES[$fieldName]['size'] > $maxSize) {
                            throw new Exception("File {$fieldName} is too large. Maximum size is 5MB.");
                        }

                        $uploadDir = "../../uploads/events/";
                        if (!is_dir($uploadDir)) {
                            if (!mkdir($uploadDir, 0755, true)) {
                                throw new Exception("Failed to create upload directory");
                            }
                        }

                        $fileName = uniqid() . '_' . basename($_FILES[$fieldName]['name']);
                        $targetPath = $uploadDir . $fileName;

                        if (move_uploaded_file($_FILES[$fieldName]['tmp_name'], $targetPath)) {
                            $galleryId = 'gallery_' . bin2hex(random_bytes(6)); // 6 bytes = 12 hex chars
                            $galleryId = substr($galleryId, 0, 20); // Ensure length is 20 chars (gallery_ + 12)

                            // Insert image into event_galleries table
                            $galleryQuery = "INSERT INTO event_galleries 
                                (event_gallery_id, event_id, img_path) 
                                VALUES 
                                (:gallery_id, :event_id, :img_path)";

                            $stmt = $dbh->prepare($galleryQuery);
                            $stmt->execute([
                                'gallery_id' => $galleryId,
                                'event_id' => $eventId,
                                'img_path' => $fileName
                            ]);
                        } else {
                            throw new Exception("Failed to move uploaded file {$fieldName}");
                        }
                    }
                }
            }
            // If no new uploads, the existing images remain unchanged

            // Commit transaction
            $dbh->commit();

            echo json_encode([
                'success' => true,
                'message' => 'Event details updated successfully'
            ]);
        } catch (PDOException $e) {
            $dbh->rollBack();
            throw new Exception("Database error: " . $e->getMessage());
        }
    } catch (Exception $e) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
    }
} else {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method'
    ]);
}
