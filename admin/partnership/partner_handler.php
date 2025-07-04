<?php
require '../../api/Database/DatabaseConn.php';

$db = new DatabaseConn();
$conn = $db->connect();

// Handle Form Submission (Insert/Update)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'save') {
    $id = $_POST['partner_id'] ?? null;  // If editing, id will be present
    $partner_name = $_POST['partner_name'];
    $partner_email = $_POST['partner_email'];
    $partner_phone = $_POST['partner_phone'];
    $company_address = $_POST['company_address'];
    $business_type = $_POST['business_type'];
    $partnership_type = $_POST['partnership_type'];
    $contact_person = $_POST['contact_person'];
    $contact_role = $_POST['contact_role'];

    // Handle Logo Upload
    if (!empty($_FILES['company_logo']['name'])) {
        $target_dir = "../assets/images/partnership-upload/";
        $file_name = basename($_FILES['company_logo']['name']);
        $target_file = $target_dir . time() . "_" . $file_name; // Prevent duplicate names
        move_uploaded_file($_FILES['company_logo']['tmp_name'], $target_file);
    } else {
        $target_file = $_POST['existing_logo'] ?? null;
    }

    try {
        if ($id) {
            // Update Record
            $sql = "UPDATE partners SET partner_name = ?, partner_email = ?, partner_phone = ?, company_address = ?, 
                    business_type = ?, partnership_type = ?, contact_person = ?, contact_role = ?, company_logo = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$partner_name, $partner_email, $partner_phone, $company_address, $business_type, 
                            $partnership_type, $contact_person, $contact_role, $target_file, $id]);
            echo json_encode(["status" => "success", "message" => "Partner updated successfully"]);
        } else {
            // Insert Record
            $sql = "INSERT INTO partners (partner_name, partner_email, partner_phone, company_address, business_type, 
                    partnership_type, contact_person, contact_role, company_logo) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$partner_name, $partner_email, $partner_phone, $company_address, $business_type, 
                            $partnership_type, $contact_person, $contact_role, $target_file]);
            echo json_encode(["status" => "success", "message" => "Partner added successfully"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
}

// Fetch Data for Edit
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM partners WHERE id = ?");
    $stmt->execute([$id]);
    $partner = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($partner);
}

// Fetch All Partners for Table
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'fetch') {
    $limit = isset($_GET['limit']) ? max(1, intval($_GET['limit'])) : 10;
    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $offset = ($page - 1) * $limit;
    try {

        $stmt = $conn->prepare("SELECT * FROM partners LIMIT ? OFFSET ?");
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->bindValue(2, $offset, PDO::PARAM_INT);
        $stmt->execute();
        $partners = $stmt->fetchAll(PDO::FETCH_ASSOC);


        $countStmt = $conn->query("SELECT COUNT(*) AS total FROM partners");
        $totalCount = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];
        $totalPages = ($limit > 0) ? ceil($totalCount / $limit) : 1;
        

        // Encode JSON safely
        $json = json_encode(
        [
            "status" => "success",
            "data" => $partners,
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
            "data" => []]);
    }
    exit; // Ensure no extra output
    
}
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'fetchFiltered') {
    $typeFilter = isset($_GET['partnership_type']) ? trim($_GET['partnership_type']) : '';
    $limit = isset($_GET['limit']) ? max(1, (int) $_GET['limit']) : 10;
    $page = isset($_GET['page']) ? max(1, (int) $_GET['page']) : 1;
    $offset = ($page - 1) * $limit;

    $where = "WHERE 1=1";
    $params = [];

    if (!empty($typeFilter)) {
        $where .= " AND partnership_type = ?";
        $params[] = $typeFilter;
    }

    try {
        $totalSql = "SELECT COUNT(*) AS total FROM partners $where";
        $totalStmt = $conn->prepare($totalSql);
        $totalStmt->execute($params);
        $total = $totalStmt->fetch(PDO::FETCH_ASSOC)['total'];
        $totalPages = ceil($total / $limit);

        $dataSql = "SELECT * FROM partners $where ORDER BY id DESC LIMIT ? OFFSET ?";
        $dataStmt = $conn->prepare($dataSql);
        $params[] = (int)$limit;
        $params[] = (int)$offset;

        foreach ($params as $i => $param) {
            $dataStmt->bindValue($i + 1, $param, is_int($param) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }

        $dataStmt->execute();
        $rows = $dataStmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'status' => 'success',
            'data' => $rows,
            'totalPages' => $totalPages,
            'currentPage' => $page,
        ]);
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage(),
            'data' => [],
        ]);
    }
    exit;
}
// Delete Partner
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $id = $_POST['id'];

    try {
        $stmt = $conn->prepare("DELETE FROM partners WHERE id = ?");
        $stmt->execute([$id]);

        echo json_encode(["status" => "success", "message" => "Partner deleted successfully"]);
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => "Failed to delete partner"]);
    }
}


?>
