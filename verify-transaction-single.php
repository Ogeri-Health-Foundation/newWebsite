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
function convertToNGN($amount, $currency) {
    if ($currency === 'NGN') return $amount;

    $url = "https://api.exchangerate.host/convert?from={$currency}&to=NGN&amount={$amount}";

    // Use cURL (safer than file_get_contents on shared hosting)
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);

    // ✅ If API call works
    if (isset($data['result']) && is_numeric($data['result'])) {
        return round($data['result'], 2);
    }

    // ⚠️ Fallback if API fails — approximate static conversion rates
    $fallbackRates = [
        'USD' => 1600,  // 1 USD ≈ ₦1600
        'EUR' => 1700,  // 1 EUR ≈ ₦1700
        'GBP' => 1950,  // 1 GBP ≈ ₦1950
        'CAD' => 1200,  // 1 CAD ≈ ₦1200
        'AUD' => 1050,  // 1 AUD ≈ ₦1050
        'ZAR' => 85,    // 1 ZAR ≈ ₦85
        'GHS' => 115,   // 1 GHS ≈ ₦115
        'KES' => 12,    // 1 KES ≈ ₦12
        'XAF' => 2.6,   // 1 XAF ≈ ₦2.6
        'XOF' => 2.6,   // 1 XOF ≈ ₦2.6
    ];

    // Use fallback if available
    if (array_key_exists($currency, $fallbackRates)) {
        return round($amount * $fallbackRates[$currency], 2);
    }

    // If currency is unknown, just return amount (to avoid breaking insert)
    return $amount;
}

if ($payment_response['status'] === "success" && $payment_response['data']['status'] === "successful") {
    $donor_name = $event['name'] ?? $payment_response['data']['customer']['name'];
    $donor_email = $event['email'] ?? $payment_response['data']['customer']['email'];
    $donation_amount = $payment_response['data']['amount'];
    $donation_currency = $payment_response['data']['currency'];
    $transaction_id = $payment_response['data']['id'];
    $donation_event_id = $event['donation_event_id'] ?? 1;
    $message = $event['message'] ?? '';

   $donation_amount_ngn = convertToNGN($donation_amount, $donation_currency);
    $original_display = $donation_currency . " " . number_format($donation_amount, 2);

    // Insert donation record
    $stmt = $dbh->prepare("INSERT INTO donation_single 
        (donation_event_id, donor_name, email, amount, currency, amount_ngn, original_display, payment_method, message) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $payment_method = "Flutterwave";

  $stmt->bind_param("issdsdsss", 
    $donation_event_id, 
    $donor_name, 
    $donor_email, 
    $donation_amount, 
    $donation_currency, 
    $donation_amount_ngn, 
    $original_display, 
    $payment_method, 
    $message
);

    if ($stmt->execute()) {
        // Update amount raised (in NGN)
        $update_stmt = $dbh->prepare("UPDATE donation_events SET amount_raised = amount_raised + ? WHERE id = ?");
        $update_stmt->bind_param("di", $donation_amount_ngn, $donation_event_id);
        $update_stmt->execute();
        $update_stmt->close();

        echo json_encode(["status" => "success", "message" => "Donation recorded successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to record donation"]);
    }

    $stmt->close();
    $dbh->close();
}

?>
