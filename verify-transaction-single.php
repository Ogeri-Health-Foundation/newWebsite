<?php
$connectX = true;
include 'include/connectionx.php';
header("Content-Type: application/json");

$flutterwave_secret_key = "FLWSECK_TEST-6e7064db369a9300ea34a5a494c1431c-X";

// Read the response from Flutterwave
$input = @file_get_contents("php://input");
$event = json_decode($input, true);

if (!isset($event['transaction_id'])) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Transaction ID missing"]);
    exit();
}

// Get transaction ID
$transaction_id = $event['transaction_id'];

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
    // Extract donor and payment details
    $donor_name = $payment_response['data']['customer']['name'] ?? 'Unknown';
    $donor_email = $payment_response['data']['customer']['email'] ?? 'Unknown';
    $donation_amount = $payment_response['data']['amount'];
    $donation_currency = $payment_response['data']['currency'];
    $transaction_id = $payment_response['data']['id'];
    $donation_event_id = $event['donation_event_id'] ?? 1; // Change to dynamically get event ID
    $message = $event['message'] ?? '';

    // Insert donation details into `donation-single` table
    $stmt = $dbh->prepare("INSERT INTO donation_single (donation_event_id, donor_name, email, amount, currency, payment_method, message) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $payment_method = "Flutterwave"; // Hardcoded for now

    $stmt->bind_param("issdsss", $donation_event_id, $donor_name, $donor_email, $donation_amount, $donation_currency, $payment_method, $message);

    if ($stmt->execute()) {
        // Update the `amount_raised` column in `donation_events` table
        $update_stmt = $dbh->prepare("UPDATE donation_events SET amount_raised = amount_raised + ? WHERE id = ?");
        $update_stmt->bind_param("di", $donation_amount, $donation_event_id);
        $update_stmt->execute();
        $update_stmt->close();

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
