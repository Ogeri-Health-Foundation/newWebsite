<?php
require '../../api/Database/DatabaseConn.php';

$db = new DatabaseConn();
$conn = $db->connect();

// Handle Form Submission (Add/Edit)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['id']) && isset($_POST['status'])) {
        $id = $_POST['id'];
        $status = $_POST['status'];

        try {
            $stmt = $conn->prepare("UPDATE volunteer_opportunities SET status = ? WHERE id = ?");
            $stmt->execute([$status, $id]);

            echo json_encode(["success" => true, "message" => "Status updated successfully"]);
        } catch (PDOException $e) {
            echo json_encode(["success" => false, "message" => "Error: " . $e->getMessage()]);
        }
        exit;
    }
    $id = $_POST['id'] ?? null;
    $title = $_POST['name'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $description = $_POST['description'];
    $image = $_FILES['profile_picture']['name'] ?? null;

    try {
        if ($id) {
            // Fetch existing image if no new one is uploaded
            $stmt = $conn->prepare("SELECT image FROM volunteer_opportunities WHERE id = ?");
            $stmt->execute([$id]);
            $existing = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$image) {
                $image = $existing['image']; // Retain existing image
            } else {
                move_uploaded_file($_FILES['profile_picture']['tmp_name'], "../assets/images/volunteer-opp-img/$image");
            }

            // Update existing record
            $stmt = $conn->prepare("UPDATE volunteer_opportunities SET title=?, start_date=?, end_date=?, description=?, image=? WHERE id=?");
            $stmt->execute([$title, $start_date, $end_date, $description, $image, $id]);
            echo json_encode([
                "success" => true,
                "message" => "Opportunity updated successfully"
            ]);
        } else {
            // Insert new record
            if ($image) {
                move_uploaded_file($_FILES['profile_picture']['tmp_name'], "../assets/images/volunteer-opp-img/$image");
            }
            $stmt = $conn->prepare("INSERT INTO volunteer_opportunities (title, start_date, end_date, description, image) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$title, $start_date, $end_date, $description, $image]);
        }

        echo json_encode([
            "success" => true,
            "message" => "Opportunity created successfully"
        ]);
    } catch (PDOException $e) {
        echo json_encode([
            "success" => false,
            "message" => $e->getMessage()
        ]);
    }
    exit;
} 

// Fetch All Opportunities
if (isset($_GET['action']) && $_GET['action'] === 'fetch') {
    $limit = isset($_GET['limit']) ? max(1, intval($_GET['limit'])) : 10;
    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $offset = ($page - 1) * $limit;
    try {
        $stmt = $conn->prepare("SELECT * FROM volunteer_opportunities LIMIT ? OFFSET ?");
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->bindValue(2, $offset, PDO::PARAM_INT);
        $stmt->execute();
        $opportunities = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Get total count for pagination
        $countStmt = $conn->query("SELECT COUNT(*) AS total FROM volunteer_opportunities");
        $totalCount = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];
        $totalPages = ($limit > 0) ? ceil($totalCount / $limit) : 1;
    
        echo json_encode([
            "status" => "success",
            "opportunities" => $opportunities,
            "totalPages" => $totalPages,
            "currentPage" => $page
        ]);
    } catch (PDOException $e) {
        echo json_encode([
            "status" => "error",
            "message" => $e->getMessage(),
            "opportunities" => []
        ]);
    }
    exit;
    
}

// Fetch Single Opportunity (For Edit Mode)
if (isset($_GET['action']) && $_GET['action'] === 'get' && isset($_GET['id'])) {
    try {
        $stmt = $conn->prepare("SELECT * FROM volunteer_opportunities WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        $opportunity = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($opportunity);
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
    exit;
}

// Delete Opportunity
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    try {
        $stmt = $conn->prepare("DELETE FROM volunteer_opportunities WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        echo json_encode(["status" => "success"]);
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
    exit;
}
?>
