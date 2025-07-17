<?php
$connectX = true;
include 'include/connectionx.php';
header("Content-Type: application/json");


// Check connection
if ($dbh->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Database connection failed']));
}

$blog_id = $dbh->real_escape_string($_GET['blog_id']);

// Fetch comments
$result = $dbh->query("SELECT * FROM comments WHERE blog_id = '$blog_id' ORDER BY created_at DESC");

$comments = [];
while ($row = $result->fetch_assoc()) {
    $comments[] = $row;
}

echo json_encode([
    'status' => 'success',
    'comments' => $comments
]);

$dbh->close();
