<?php
$connectX = true;                           
include 'include/connectionx.php';
header("Content-Type: application/json");

$flutterwave_secret_key = "FLWSECK_TEST-6e7064db369a9300ea34a5a494c1431c-X"; 

// Read the response from Flutterwave
$input = @file_get_contents("php://input");
$event = json_decode($input, true);

// Debugging: Log request body to check what is being received
// file_put_contents("debug.log", print_r($event, true), FILE_APPEND);
$message = $event['message'] ?? ''; 

if (!isset($event['transaction_id'])) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Transaction ID missing"]);
    exit();
}

// Get transaction ID
$transaction_id = $event['transaction_id'];


if (!$transaction_id) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Invalid transaction ID"]);
    exit();
}

// Verify transaction using Flutterwave API
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.flutterwave.com/v3/transactions/" . $transaction_id . "/verify");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer " . $flutterwave_secret_key,
    "Content-Type: application/json"
]);

$response = curl_exec($ch);
curl_close($ch);

$payment_response = json_decode($response, true);

if (!isset($payment_response['data'])) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Invalid payment response"]);
    exit();
}

if ($payment_response['status'] === "success" && $payment_response['data']['status'] === "successful") {
    // Extract donor details
    $donor_name = $payment_response['data']['customer']['name'] ?? 'Unknown';
    $donor_email = $payment_response['data']['customer']['email'] ?? 'Unknown';
    $donation_amount = $payment_response['data']['amount'];
    $donation_currency = $payment_response['data']['currency'];
    $transaction_id = $payment_response['data']['id']; 
    // $message = $payment_response['data']['message'];
   

    // Prepare the INSERT statement with corrected column names
    $stmt = $dbh->prepare("INSERT INTO donations (donor_name, donor_email, amount, currency, message, transaction_id, payment_status) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $payment_status = "successful"; // Since payment was verified successfully
    $stmt->bind_param("ssdssss", $donor_name, $donor_email, $donation_amount, $donation_currency, $message, $transaction_id, $payment_status);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Donation recorded successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to record donation"]);
    }

    $stmt->close();
    $dbh->close();
} else {
    echo json_encode(["status" => "error", "message" => "Payment verification failed"]);
}

?>
