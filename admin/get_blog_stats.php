<?php
header('Content-Type: application/json');

// Use the existing connection setup
$connectX = true;
require '../include/connectionx.php'; // update this path

$data = array_fill(1, 12, 0); // Jan to Dec, default 0 posts

$sql = "SELECT MONTH(created_at) as month, COUNT(*) as count 
        FROM blog_posts 
        WHERE status = 'published' 
        GROUP BY MONTH(created_at)";

$result = $dbh->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $month = (int)$row['month']; // 1 to 12
        $count = (int)$row['count'];
        $data[$month] = $count;
    }
}

echo json_encode(array_values($data)); // Ensure it's a plain array
?>
