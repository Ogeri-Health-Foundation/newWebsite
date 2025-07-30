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
            // If no event_id provided, this might be a request for existing data
            echo json_encode([
                'success' => false,
                'message' => 'Event ID is required'
            ]);
            exit;
        }

        $eventId = $_POST['event_id'];

        // Fetch event details from events table
        $eventQuery = "SELECT 
                        event_id,
                        total_attendees,
                        bp_screened,
                        high_bp_detected,
                        repeat_attendees,
                        counselled,
                        medications_dispensed,
                        referrals,
                        average_age,
                        gender_male,
                        gender_female,
                        villages_served
                      FROM events 
                      WHERE event_id = :event_id";

        $stmt = $dbh->prepare($eventQuery);
        $stmt->execute(['event_id' => $eventId]);
        $eventDetails = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$eventDetails) {
            echo json_encode([
                'success' => false,
                'message' => 'Event not found'
            ]);
            exit;
        }

        // Fetch event images from event_galleries table
        $imagesQuery = "SELECT img_path 
                       FROM event_galleries 
                       WHERE event_id = :event_id 
                       ORDER BY event_gallery_id";

        $stmt = $dbh->prepare($imagesQuery);
        $stmt->execute(['event_id' => $eventId]);
        $images = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // Prepare the response data
        $eventDetails['images'] = $images;

        // Convert numeric fields to integers (in case they're stored as strings)
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

        foreach ($numericFields as $field) {
            $eventDetails[$field] = isset($eventDetails[$field]) ? (int)$eventDetails[$field] : 0;
        }

        echo json_encode([
            'success' => true,
            'message' => 'Event details retrieved successfully',
            'event_details' => $eventDetails
        ]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Database error: ' . $e->getMessage()
        ]);
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
        'message' => 'Invalid request method. Only POST is allowed.'
    ]);
}
