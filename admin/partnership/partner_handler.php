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
    $draw = isset($_GET['draw']) ? intval($_GET['draw']) : 1;
    $start = isset($_GET['start']) ? intval($_GET['start']) : 0;
    $length = isset($_GET['length']) ? intval($_GET['length']) : 10;
    $search = isset($_GET['search']['value']) ? trim($_GET['search']['value']) : '';
    $typeFilter = isset($_GET['partnership_type']) ? trim($_GET['partnership_type']) : '';

    $where = "WHERE 1=1";
    $params = [];

    // Search filtering
    if (!empty($search)) {
        $where .= " AND (partner_name LIKE ? OR partner_email LIKE ? OR partner_phone LIKE ?)";
        $searchTerm = "%$search%";
        $params = array_merge($params, [$searchTerm, $searchTerm, $searchTerm]);
    }

    // Type filtering
    if (!empty($typeFilter)) {
        $where .= " AND partnership_type = ?";
        $params[] = $typeFilter;
    }

    try {
        // Get total records (no filtering)
        $totalStmt = $conn->query("SELECT COUNT(*) AS total FROM partners");
        $recordsTotal = $totalStmt->fetch(PDO::FETCH_ASSOC)['total'];

        // Get total filtered
        $countSql = "SELECT COUNT(*) AS filtered FROM partners $where";
        $countStmt = $conn->prepare($countSql);
        $countStmt->execute($params);
        $recordsFiltered = $countStmt->fetch(PDO::FETCH_ASSOC)['filtered'];

        // Fetch filtered records
        $dataSql = "SELECT * FROM partners $where ORDER BY id DESC LIMIT ? OFFSET ?";
        $params[] = (int)$length;
        $params[] = (int)$start;

        $dataStmt = $conn->prepare($dataSql);
        foreach ($params as $i => $param) {
            $dataStmt->bindValue($i + 1, $param, is_int($param) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
        $dataStmt->execute();
        $partners = $dataStmt->fetchAll(PDO::FETCH_ASSOC);

        // Add serial numbers
        foreach ($partners as $index => &$partner) {
            $partner['serial'] = $start + $index + 1;
        }

        echo json_encode([
            "draw" => $draw,
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => $partners
        ]);
    } catch (PDOException $e) {
        echo json_encode([
            "draw" => $draw,
            "recordsTotal" => 0,
            "recordsFiltered" => 0,
            "data" => [],
            "error" => $e->getMessage()
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
