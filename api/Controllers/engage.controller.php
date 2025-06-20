<?php
header("Content-Type: application/json");
require_once "../Models/Engagement.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $engagement = isset($_POST['engagement']) ? intval($_POST['engagement']) : 1;

    $engagementObj = new Engagement();
    $response = $engagementObj->updateEngagement($engagement);

    echo json_encode($response);
}
?>
