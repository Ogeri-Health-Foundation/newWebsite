<?php
$connectX = true;
include 'include/connectionx.php';
header("Content-Type: application/json");

$flutterwave_secret_key = "FLWSECK_TEST-127b655c5746169b7d8f89d9610bcde1-X";

// Read incoming JSON from frontend
$input = file_get_contents("php://input");
$event = json_decode($input, true);

if (!isset($event['transaction_id'])) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Transaction ID missing"]);
    exit();
}

$transaction_id = $event['transaction_id'];

// Verify transaction with Flutterwave API
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.flutterwave.com/v3/transactions/" . $transaction_id . "/verify");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $flutterwave_secret_key",
    "Content-Type: application/json"
]);
$response = curl_exec($ch);
curl_close($ch);

$payment_response = json_decode($response, true);

// Validate response
if (!isset($payment_response['data'])) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Invalid payment response"]);
    exit();
}

if (
    $payment_response['status'] === "success" &&
    $payment_response['data']['status'] === "successful"
) {
    // Extract details
    $donor_name = $event['name'] ?? $payment_response['data']['customer']['name'] ?? '';
    $donor_email = $event['email'] ?? $payment_response['data']['customer']['email'] ?? '';
    $donation_amount = $payment_response['data']['amount'];
    $donation_currency = $payment_response['data']['currency'];
    $transaction_id = $payment_response['data']['id'];
    $message = $event['message'] ?? '';

    // Currency conversion helper
    function convertToNGN($amount, $currency)
    {
        if ($currency === 'NGN') return $amount;

        $url = "https://api.exchangerate.host/convert?from={$currency}&to=NGN&amount={$amount}";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        if (isset($data['result']) && is_numeric($data['result'])) {
            return round($data['result'], 2);
        }

        $fallbackRates = [
            'USD' => 1600, 'EUR' => 1700, 'GBP' => 1950,
            'CAD' => 1200, 'AUD' => 1050, 'ZAR' => 85,
            'GHS' => 115, 'KES' => 12, 'XAF' => 2.6, 'XOF' => 2.6,
        ];

        return isset($fallbackRates[$currency])
            ? round($amount * $fallbackRates[$currency], 2)
            : $amount;
    }

    $donation_amount_ngn = convertToNGN($donation_amount, $donation_currency);
    $original_display = $donation_currency . " " . number_format($donation_amount, 2);
    $payment_status = "successful";

    // ✅ Insert donation record into DB (MySQLi)
    $stmt = $dbh->prepare("
        INSERT INTO donations 
        (donor_name, donor_email, amount, currency, amount_ngn, original_display, message, transaction_id, payment_status)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    if (!$stmt) {
        echo json_encode(["status" => "error", "message" => "Database error: " . $dbh->error]);
        exit();
    }

    $stmt->bind_param(
        "ssdsdssss",
        $donor_name,
        $donor_email,
        $donation_amount,
        $donation_currency,
        $donation_amount_ngn,
        $original_display,
        $message,
        $transaction_id,
        $payment_status
    );

    if ($stmt->execute()) {
        echo json_encode([
            "status" => "success",
            "message" => "Donation recorded successfully"
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Database error: " . $stmt->error
        ]);
    }

    $stmt->close();
    exit();
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Payment verification failed"
    ]);
    exit();
}
?>
