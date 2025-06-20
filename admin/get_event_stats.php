<?php
// $connectX = true;
// require '../include/connectionx.php';
require '../api/Database/DatabaseConn.php';

$db = new DatabaseConn();
$conn = $db->connect();


$filter = $_GET['filter'] ?? 'this_month';

$start_date = '';
$end_date = $end_date = date('Y-m-t');

switch ($filter) {
    case 'last_month':
        $start_date = date('Y-m-01', strtotime('first day of last month'));
        $end_date = date('Y-m-t', strtotime('last day of last month'));
        break;
    case 'last_3_months':
        $start_date = date('Y-m-d', strtotime('-3 months'));
        break;
    case 'this_month':
    default:
        $start_date = date('Y-m-01');
        break;
}

// Total events
$stmt = $conn->prepare("SELECT COUNT(*) as total FROM events WHERE date BETWEEN ? AND ?");
$stmt->execute([$start_date, $end_date]);
$total = $stmt->fetchColumn();

// Upcoming events
$stmt = $conn->prepare("SELECT COUNT(*) FROM events WHERE status = 'upcoming' AND date BETWEEN ? AND ?");
$stmt->execute([$start_date, $end_date]);
$upcoming = $stmt->fetchColumn();

// Completed events
$stmt = $conn->prepare("SELECT COUNT(*) FROM events WHERE status = 'completed' AND date BETWEEN ? AND ?");
$stmt->execute([$start_date, $end_date]);
$completed = $stmt->fetchColumn();

$response = [
    'total' => $total,
    'upcoming' => $upcoming,
    'completed' => $completed
];

echo json_encode($response);
