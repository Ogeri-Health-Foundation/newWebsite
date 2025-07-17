<?php
require_once '../Database/DatabaseConn.php'; // Ensure this file is in the correct directory



try {
    $db = new DatabaseConn();
    $conn = $db->connect();

    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 5; // Default to 5 donors
    $id = isset($_GET['id']) ? (int)$_GET['id'] : ''; // Default to 1 or whatever default event ID you want

    $query = "SELECT donor_name, amount, currency FROM donation_single WHERE donation_event_id = :id ORDER BY donation_date DESC LIMIT :limit";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //     echo '<div class="recent-post">
        //             <div class="media-img">
        //                 <a href="#"><img src="assets/img/donate/avatar.jpg" alt="Donor Image"></a>
        //             </div>
        //             <div class="media-body">
        //                 <h4 class="post-title"><a class="text-inherit" href="#">' . htmlspecialchars($row['donor_name']) . '</a></h4>
        //                 <div class="recent-post-meta">
        //                     <a href="#">' . htmlspecialchars($row['currency']) . ' ' . number_format($row['amount'], 2) . '</a>
        //                 </div>
        //             </div>
        //           </div>';
        // }
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="donor d-flex align-items-center gap-3 my-4">
                    <div class="donor-image">
                        <img src= "assets/img/donate/avatar.jpg" alt="" class="img-fluid total-img rounded-circle" style="object-fit: cover;">
                    </div>

                    <div class="donor-content">
                        <h6 class="mb-0 text-dark">' . htmlspecialchars($row['donor_name']) . '</h6>
                        <p class="mb-0">' . htmlspecialchars($row['currency']) . ' ' . number_format($row['amount'], 2) . '</p>
                    </div>
                </div>';
        }
    } else {
        echo '<p class="no-donors-message" style="text-align:center; color:#999; font-size:16px;">No donations yet. Be the first to donate!</p>';
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
