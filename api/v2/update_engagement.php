<?php
header("Content-Type: application/json");
require_once "../Controllers/engage.controller.php";
require_once "../Models/Engagement.php";


$engagementObj = new Engagement();
$response = $engagementObj->fetchEngagement();

echo json_encode($response);
?>
