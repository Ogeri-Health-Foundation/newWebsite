<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

// Prevent output buffering issues
if (ob_get_length()) ob_clean();
error_reporting(E_ALL);
ini_set('display_errors', 1);
require '../api/Database/DatabaseConn.php';

$db = new DatabaseConn();
$conn = $db->connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $category = trim($_POST['category']);
    $goal_amount = trim($_POST['amount_goal']);
    $short_description = trim($_POST['short_desc']);
    $full_description = trim($_POST['body']);
    $event_id = isset($_POST['event_id']) ? $_POST['event_id'] : null;
    $status = 'ongoing';

    $response = ['status' => 'error', 'message' => '']; // Default response

// Check if required fields are provided
if (empty($_POST['title']) || empty($_POST['category']) || empty($_POST['amount_goal']) || empty($_POST['short_desc']) || empty($_POST['body'])) {
    $response['message'] = 'All fields are required!';
    echo json_encode($response);
    exit;
}

// Assign variables

$upload_dir = 'assets/images/donation/';
$image_path = isset($_POST['existing_image']) ? $_POST['existing_image'] : null;

// Image upload handling
if (!empty($_FILES['banner_image']['name'])) {
    $image_name = time() . "_" . basename($_FILES['banner_image']['name']); // Unique filename
    $target_path = $upload_dir . $image_name;
    $imageFileType = strtolower(pathinfo($target_path, PATHINFO_EXTENSION));

    // Validate image format
    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        $response['message'] = 'Invalid image format! Only JPG, JPEG, PNG, and GIF are allowed.';
        echo json_encode($response);
        exit;
    }

    // Validate file size
    if ($_FILES['banner_image']['size'] > 2000000) {
        $response['message'] = 'File size must be less than 2MB!';
        echo json_encode($response);
        exit;
    }

    // Move uploaded file
    if (move_uploaded_file($_FILES['banner_image']['tmp_name'], $target_path)) {
        $image_path = $target_path;
    } else {
        $response['message'] = 'Error uploading image!';
        echo json_encode($response);
        exit;
    }
}

$response['status'] = 'success';


// echo json_encode($response);

try {
    if ($event_id) {
        $query = "UPDATE donation_events SET title=?, category=?, goal_amount=?, short_description=?, full_description=?, status=?";
        $params = [$title, $category, $goal_amount, $short_description, $full_description, $status];
        
        if ($image_path) {
            $query .= ", banner_image=?";
            $params[] = $image_path;
        }
        
        $query .= " WHERE id=?";
        $params[] = $event_id;
        
        $stmt = $conn->prepare($query);
        $stmt->execute($params);
        
        echo json_encode(["status" => "success", "message" => "Donation updated successfully"]);
    } else {
        $stmt = $conn->prepare("INSERT INTO donation_events (title, category, goal_amount, short_description, full_description, banner_image, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $category, $goal_amount, $short_description, $full_description, $image_path, $status]);
        
        echo json_encode(["status" => "success", "message" => "Donation added successfully"]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

exit;

}

// Fetch All Opportunities

if (isset($_GET['action']) && $_GET['action'] === 'fetch') {

    $limit = isset($_GET['limit']) ? max(1, intval($_GET['limit'])) : 10;
    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $offset = ($page - 1) * $limit;
    try {

        $stmt = $conn->prepare("SELECT * FROM donation_events LIMIT ? OFFSET ?");
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->bindValue(2, $offset, PDO::PARAM_INT);
        $stmt->execute();
        $donations = $stmt->fetchAll(PDO::FETCH_ASSOC);


        $countStmt = $conn->query("SELECT COUNT(*) AS total FROM donation_events");
        $totalCount = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];
        $totalPages = ($limit > 0) ? ceil($totalCount / $limit) : 1;
        

        // Encode JSON safely
        $json = json_encode(
        [
            "status" => "success",
            "donations" => $donations,
            "totalPages" => $totalPages,
            "currentPage" => $page]);
        if ($json === false) {
            echo json_encode(["error" => "JSON encoding error", "details" => json_last_error_msg()]);
        } else {
            echo $json;
        }
    } catch (PDOException $e) {
        echo json_encode(["status" => "error",
            "message" => $e->getMessage(),
            "donations" => []]);
    }
    exit; // Ensure no extra output
}


// Fetch Single Opportunity (For Edit Mode)
if (isset($_GET['action']) && $_GET['action'] === 'get' && isset($_GET['id'])) {
    try {
        $donationId = $_GET['id'];

        // Fetch the donation event details
        $stmt = $conn->prepare("SELECT * FROM donation_events WHERE id = ?");
        $stmt->execute([$donationId]);
        $donation = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$donation) {
            echo json_encode(["status" => "error", "message" => "Donation event not found."]);
            exit;
        }

        // Fetch the donors for this donation event
        $stmtDonors = $conn->prepare("SELECT donor_name, amount, currency FROM donation_single WHERE donation_event_id = ? ORDER BY donation_date DESC");
        $stmtDonors->execute([$donationId]);
        $donors = $stmtDonors->fetchAll(PDO::FETCH_ASSOC);

        // Include donors in the response
        $donation['donors'] = $donors;

        echo json_encode($donation);
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
    exit;
}


// Delete Opportunity
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    try {
        $stmt = $conn->prepare("DELETE FROM donation_events WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        echo json_encode(["status" => "success"]);
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
    exit;
}
?>
