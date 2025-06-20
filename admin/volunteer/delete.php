<?php
session_start();
require '../../api/Database/DatabaseConn.php'; // Ensure you have a proper database connection file

// Check if an ID is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['message'] = "Invalid request!";
    header("Location: volunteers.php");
    exit();
}

// Sanitize the input
$volunteerId = intval($_GET['id']); // Convert to integer to prevent SQL injection

try {
    // Establish database connection
    $db = new DatabaseConn();
    $pdo = $db->connect();

    // Prepare the DELETE query
    $sql = "DELETE FROM volunteers WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $volunteerId, PDO::PARAM_INT);

    // Execute the statement
    if ($stmt->execute()) {
        $_SESSION['message'] = "Volunteer deleted successfully!";
    } else {
        $_SESSION['message'] = "Error deleting volunteer.";
    }

    // Close connection
    $pdo = null;

} catch (PDOException $e) {
    $_SESSION['message'] = "Database error: " . $e->getMessage();
}

// Redirect back to the volunteers list
header("Location: volunteers.php");
exit();
?>
