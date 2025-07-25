<?php
require_once '../Database/DatabaseConn.php';
header('Content-Type: application/json');

$db = new DatabaseConn();
$conn = $db->connect();

$startDate = $_GET['start_date'] ?? null;
$endDate = $_GET['end_date'] ?? null;
$eventIds = isset($_GET['event_ids']) ? $_GET['event_ids'] : [];

$conditions = ["status = 'completed'"];
$params = [];

// Add date range filter
if ($startDate && $endDate) {
    $conditions[] = "date BETWEEN :start_date AND :end_date";
    $params[':start_date'] = $startDate;
    $params[':end_date'] = $endDate;
}

// Add event_ids filter
if (!empty($eventIds) && is_array($eventIds)) {
    $placeholders = implode(',', array_fill(0, count($eventIds), '?'));
    $conditions[] = "event_id IN ($placeholders)";
    $params = array_merge($params, $eventIds);
}

$whereSQL = implode(" AND ", $conditions);

try {
    $query = "
        SELECT
            COALESCE(SUM(total_attendees), 0) AS total_attendees,
            COALESCE(SUM(bp_screened), 0) AS bp_screened,
            COALESCE(SUM(high_bp_detected), 0) AS high_bp_detected,
            COALESCE(SUM(repeat_attendees), 0) AS repeat_attendees,
            COALESCE(SUM(counselled), 0) AS counselled,
            COALESCE(SUM(medications_dispensed), 0) AS medications_dispensed,
            COALESCE(SUM(referrals), 0) AS referrals,
            COALESCE(AVG(average_age), 0) AS average_age,
            COALESCE(SUM(gender_male), 0) AS gender_male,
            COALESCE(SUM(gender_female), 0) AS gender_female,
            COALESCE(SUM(villages_served), 0) AS villages_served
        FROM events
        WHERE $whereSQL
    ";

    $stmt = $conn->prepare($query);
    $stmt->execute(array_values($params));

    $stats = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode([
        'success' => true,
        'data' => $stats
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}