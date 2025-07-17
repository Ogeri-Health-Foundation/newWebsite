<?php
$connectX = true;
include 'include/connectionx.php';
header("Content-Type: application/json");


// Check connection
if ($dbh->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Database connection failed']));
}

// Get POST data
$name = $dbh->real_escape_string($_POST['name']);
$email = $dbh->real_escape_string($_POST['email']);
$website = isset($_POST['website']) ? $dbh->real_escape_string($_POST['website']) : null;
$message = $dbh->real_escape_string($_POST['message']);
$blog_id = $dbh->real_escape_string($_POST['blog_id']);

// Insert comment
$stmt = $dbh->prepare("INSERT INTO comments (name, email, website, message, blog_id) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $email, $website, $message, $blog_id);

if ($stmt->execute()) {
    $comment_id = $stmt->insert_id;
    // Get the newly created comment
    $result = $dbh->query("SELECT * FROM comments WHERE id = $comment_id");
    $comment = $result->fetch_assoc();
    
    echo json_encode([
        'status' => 'success',
        'comment' => $comment
    ]);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Failed to save comment'
    ]);
}

$stmt->close();
$dbh->close();
