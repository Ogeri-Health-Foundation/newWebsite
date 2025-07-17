<?php
session_start();
?>
<?php

$page_title = "Volunteer - Ogeri Health Foundation";

$page_author = "Mobolaji";

$page_description = "";

$page_rel = '../../';

$page_name = 'volunteer';
 
$customs = array(
    "stylesheets" => ["volunteer/assets/css/volunteers.css"],
    "scripts" => ["volunteer/assets/js/volunteers.js"]
);

// $addons = array(
//             "stylesheets" => ["https://some-external-url.css"],
//             "scripts" => ["https://some-external-url.js"]
//            );

?>
<!DOCTYPE html>
<html>

<head>

    <?php include $page_rel . 'admin/includes/admin-head.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>


<script>


  

window.onload = function () {

  fetch("../../api/v1/auth.php")
  .then(async response => {
    const data = await response.json(); 

    if (!response.ok) {
      if (data.message === "Unauthorized") {
        location.href = "../admin/login.php";
      }
      throw new Error(data.message || "Network response was not ok");
    }

    console.log("Auth Data:", data);
    return data;
  })
  .catch(error => {
    console.error("Fetch error:", error);
  });


};

      

    </script>

    <?php $page = 'Blog'; ?>
    <?php include $page_rel . 'admin/includes/topbar.php'; ?>

    <main class="main-content ">
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert-box alert-success">
                <?= $_SESSION['message']; ?>
            </div>
            <?php unset($_SESSION['message']); // Clear the message after displaying ?>
        <?php endif; ?>
        <div id="alertBox" class="alert-box"></div>

        <div class="container-fluid main-container">
            <!-- Main Content -->
            <div class="content">

                <!-- Page Content -->
                <div class="page-content">
                    <!-- Toast Notification -->
                    <div class="toast-container" id="toastContainer">
                        <!-- Toast will be added dynamically -->
                    </div>

                    <!-- Page Header -->
                    <div class="content-header">
                        <div>
                            <h2 class="content-title">Volunteers!</h2>
                            <p class="content-subtitle">List of Volunteers received</p>
                        </div>
                        <div class="d-flex flex-sm-wrap align-items-center gap-3 add-btns">
                            <button class="btn btn-add mb-3 " id="addVolunteerBtn" data-bs-toggle="modal" data-bs-target="#addVolunteerModal">
                                <i class="fas fa-plus"></i> Add Volunteers
                            </button>
                            <a href="volunteer-opps.php" class="btn btn-add mb-3">
                                <i class="fas fa-plus"></i> Add Volunteer Opportunities
                            </a>
                        </div>

                    </div>

                    <!-- Action Buttons -->
                    <div class="action-buttons">
                        <!-- Desktop Buttons -->
                        <div class="desktop-buttons">
                            <button class="btn btn-export" id="exportBtn">
                                <i class="fas fa-file-export"></i> Export
                            </button>
                            <button class="btn btn-filter" id="filterBtn">
                                <i class="fas fa-filter"></i> Filter
                            </button>
                        </div>

                        <!-- Mobile Dropdown -->
                        <div class="mobile-dropdown dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="actionDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-bars"></i> Actions
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="actionDropdown">
                                <li><a class="dropdown-item" href="#" id="exportBtnMobile"><i class="fas fa-file-export"></i> Export</a></li>
                                <li><a class="dropdown-item" href="#" id="filterBtnMobile"><i class="fas fa-filter"></i> Filter</a></li>
                            </ul>
                        </div>
                    </div>

                    <div id="filterForm" style="display: none; margin-bottom: 20px;">
                        <form method="GET" action="">
                            <input type="text" name="name" placeholder="Filter by Name" />
                            <select name="gender">
                                <option value="">All Genders</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <select name="status">
                                <option value="">All Status</option>
                                <option value="Pending">Pending</option>
                                <option value="Approved">Approved</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                            <button type="submit">Apply Filter</button>
                        </form>
                    </div>
                    <!-- Volunteers Table -->
                    <div class="table-container">
                        <table class="volunteers-table" id="">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Profession</th>
                                    <th>Volunteer Field</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="">
                                <?php
                                require '../../api/Database/DatabaseConn.php'; // Ensure this file contains the database connection

                                try {
                                    $db = new DatabaseConn();
                                    $pdo = $db->connect();
                                
                                    // Pagination setup
                                    $limit = 10; // Number of records per page
                                    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                    $offset = ($page - 1) * $limit;
                                
                                    // Get filters
                                    $nameFilter = isset($_GET['name']) ? $_GET['name'] : '';
                                    $genderFilter = isset($_GET['gender']) ? $_GET['gender'] : '';
                                    $statusFilter = isset($_GET['status']) ? $_GET['status'] : '';
                                
                                    // Build SQL with optional filters
                                    $baseSql = " FROM volunteers WHERE 1";
                                    $params = [];
                                
                                    if ($nameFilter) {
                                        $baseSql .= " AND name LIKE :name";
                                        $params[':name'] = "%$nameFilter%";
                                    }
                                    if ($genderFilter) {
                                        $baseSql .= " AND gender = :gender";
                                        $params[':gender'] = $genderFilter;
                                    }
                                    if ($statusFilter) {
                                        $baseSql .= " AND status = :status";
                                        $params[':status'] = $statusFilter;
                                    }
                                
                                    // Get total count of filtered results
                                    $countSql = "SELECT COUNT(*) as total" . $baseSql;
                                    $countStmt = $pdo->prepare($countSql);
                                    foreach ($params as $key => $value) {
                                        $countStmt->bindValue($key, $value);
                                    }
                                    $countStmt->execute();
                                    $totalRows = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];
                                    $totalPages = ceil($totalRows / $limit);
                                
                                    // Fetch filtered & paginated data
                                    $dataSql = "SELECT *" . $baseSql . " LIMIT :limit OFFSET :offset";
                                    $dataStmt = $pdo->prepare($dataSql);
                                    foreach ($params as $key => $value) {
                                        $dataStmt->bindValue($key, $value);
                                    }
                                    $dataStmt->bindValue(':limit', $limit, PDO::PARAM_INT);
                                    $dataStmt->bindValue(':offset', $offset, PDO::PARAM_INT);
                                    $dataStmt->execute();
                                
                                
                                    $sn = $offset;
                                    while ($row = $dataStmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo "<tr>
                                        <td>" . ++$sn . "</td>
                                        <td>{$row['name']}</td>
                                        <td>{$row['gender']}</td>
                                        <td>{$row['profession']}</td>
                                        <td>{$row['role']}</td>
                                        <td class='" . 
                                            ($row['status'] === 'Pending' ? 'status-pending' : 
                                            ($row['status'] === 'Approved' ? 'status-approved' : 
                                            ($row['status'] === 'Rejected' ? 'status-rejected' : ''))) . 
                                        "'>" . htmlspecialchars($row['status']) . "</td>
                                
                                        <td class='text-center' style='text-align: center;'>
                                            <div class='dropdown'>
                                                <button class='action-button dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                                    <i class='fas fa-ellipsis-v'></i>
                                                </button>
                                                <ul class='dropdown-menu'>
                                                    <li>
                                                        <a class='dropdown-item view-btn' href='#' 
                                                        data-bs-toggle='modal' data-bs-target='#volunteerDetailsModal'
                                                        data-id='{$row['id']}'>
                                                        View Details
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class='dropdown-item edit-btn' href='#' 
                                                        data-bs-toggle='modal' data-bs-target='#addVolunteerModal'
                                                        data-id='{$row['id']}'>
                                                        Edit Details
                                                        </a>
                                                    </li>
                                                    <li><a class='dropdown-item text-danger' href='delete.php?id={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this volunteer?\")'>Delete Volunteer</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>";
                                    }
                                } catch (PDOException $e) {
                                    echo "<tr><td colspan='7'>Error fetching data: " . $e->getMessage() . "</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                                        <div class="pagination">
                        <?php if ($page > 1): ?>
                            <a href="?page=<?php echo $page - 1; ?>" class="btn btn-prev">
                                <i class="fas fa-chevron-left"></i> Previous
                            </a>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <a href="?page=<?php echo $i; ?>" class="btn btn-page <?php echo ($i == $page) ? 'active' : ''; ?>">
                                <?php echo $i; ?>
                            </a>
                        <?php endfor; ?>

                        <?php if ($page < $totalPages): ?>
                            <a href="?page=<?php echo $page + 1; ?>" class="btn btn-next">
                                Next <i class="fas fa-chevron-right"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Volunteer Modal -->
        <div class="modal fade" id="addVolunteerModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Onboard Volunteers</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <form id="volunteerForm" enctype="multipart/form-data">
                            <input type="hidden" id="volunteerId" name="id">
                            <div class="mb-3">
                                <label class="form-label">Profile Picture</label>
                                <div class="upload-container" id="profile-upload-container">
                                    <!-- Upload Area -->
                                    <div class="upload-area" id="uploadArea">
                                        <i class="fas fa-upload"></i>
                                        <span>Upload</span>
                                    </div>

                                    <!-- Hidden File Input -->
                                    <input type="file" id="profile-upload" accept="image/*" name="profile_picture" hidden />

                                    <!-- Profile Preview -->
                                    <div class="upload-preview" style="display: none;">
                                        <img id="profile-preview" src="/placeholder.svg" alt="Profile Preview" />
                                    </div>

                                    <!-- Placeholder (Visible when no image is uploaded) -->
                                    <div class="upload-placeholder">
                                        <span></span>
                                    </div>

                                    <!-- Remove Image Button -->
                                    <button type="button" id="remove-profile-image" class="btn btn-edit" style="display: none !important;">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="volunteerName" class="form-label">Name*</label>
                                <input type="text" class="form-control" id="volunteerName" placeholder="Enter Name"
                                  name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="volunteerEmail" class="form-label">Email*</label>
                                <input type="email" class="form-control" id="volunteerEmail"
                                    placeholder="Enter Email Address" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="volunteerEmail" class="form-label">Home Address*</label>
                                <input type="text" class="form-control" id="homeAddress"
                                    placeholder="Enter Home Address" name="home_address" required>
                            </div>
                            <div class="mb-3">
                                <label for="volunteerRole" class="form-label">Role</label>
                                <select class="form-select" id="volunteerRole" name="role">
                                    <option value="" selected>Select Volunteers role</option>
                                    <option value="Patient Clinic">Patient Clinic</option>
                                    <option value="Fundraising">Fundraising</option>
                                    <option value="Administration">Administration</option>
                                    <option value="Marketing">Marketing</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="volunteerGender" class="form-label">Gender</label>
                                <select class="form-select" id="volunteerGender" name="gender">
                                    <option value="" selected>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="volunteerProfession" class="form-label">Profession</label>
                                <input type="text" class="form-control" id="volunteerProfession"
                                    placeholder="Enter Profession" name="profession">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-cancel btn-outline" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-onboard btn-primary" id="onboardBtn">Onboard</button>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>

        <!-- Volunteer Details Modal -->
        <div class="modal fade" id="volunteerDetailsModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Volunteers Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="volunteerId">
                        <div class="status-badge-container">
                            <span class="status-badge" id="detailsStatusBadge"></span>
                        </div>
                        <div class="volunteer-info">
                            <div class="volunteer-photo" id="volunteerimg">
                                <img src="../assets/images/includes/user1.svg" alt="Volunteer" id="detailsImage" style="width: 100%; height: 170px;">
                            </div>
                            <div class="volunteer-details">
                                <div class="detail-item">
                                    <h6 class="detail-label">Name:</h6>
                                    <p class="detail-value" id="detailsName"></p>
                                </div>
                                <div class="detail-item">
                                    <h6 class="detail-label">Location:</h6>
                                    <p class="detail-value" id="detailsLocation"></p>
                                </div>
                                <div class="detail-item">
                                    <h6 class="detail-label">Gender:</h6>
                                    <p class="detail-value" id="detailsGender"></p>
                                </div>
                               
                            </div>
                        </div>
                        <div class="professional-info">
                            <div class="detail-item">
                                <h6 class="detail-label">Profession:</h6>
                                <p class="detail-value" id="detailsProfession"></p>
                            </div>
                            <div class="detail-item">
                                <h6 class="detail-label">Volunteer field:</h6>
                                <p class="detail-value" id="detailsField"></p>
                            </div>
                        </div>
                        <!-- <div class="certification-section">
                            <h5>Certification</h5>
                            <div class="certification-container">
                                <img src="https://hebbkx1anhila5yf.public.blob.vercel-storage.com/ohf-volunteersdetails-Z7bC23Wo2KkfBGEEsUb5Yqo2Y4EnAu.png"
                                    alt="Certification" class="certification-image">
                                <button class="btn btn-download btn-dark mt-3">
                                    <i class="fas fa-download"></i> Download
                                </button>
                            </div>
                        </div> -->
                        <div class="reason-section">
                            <h5>Reason for Vountering</h5>
                            <p id="detailsReason">I just love the intiative</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-reject btn-danger" id="rejectBtn">Reject</button>
                        <button type="button" class="btn btn-approve btn-primary" id="approveBtn">Approve</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <div class="delete-icon">
                            <i class="fas fa-trash-alt"></i>
                        </div>
                        <h5 id="deleteVolunteerName">Delete Anwara Callistus</h5>
                        <p>Are you sure you want to delete this Volunteer? If Yes, Confirm</p>
                        <div class="delete-actions">
                            <button type="button" class="btn btn-delete" id="confirmDeleteBtn">Yes, Delete</button>
                            <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>



    <?php include $page_rel . 'admin/includes/sidebar.php'; ?>
    <script>
      $(document).ready(function () {
    $("#approveBtn").click(function () {
        showConfirmModal("approve");
    });

    $("#rejectBtn").click(function () {
        showConfirmModal("reject");
    });

    function showConfirmModal(action) {
        const confirmation = confirm(`Are you sure you want to ${action} this volunteer?`);
        if (confirmation) {
            updateVolunteerStatus(action === "approve" ? "Approved" : "Rejected");
        }
    }

    function updateVolunteerStatus(status) {
        let volunteerId = $("#volunteerId").val();

        if (!volunteerId) {
            showAlert("Volunteer ID is missing!", "error");
            return;
        }

        $.ajax({
            url: "volunteer_backend.php",
            type: "POST",
            data: {
                id: volunteerId,
                status: status
            },
            success: function (response) {
                let data = JSON.parse(response);
                if (data.success) {
                    showAlert("Status updated to: " + status, "success");
                    $("#detailsStatusBadge").text(status);
                    $("#volunteerDetailsModal").modal("hide");
                } else {
                    showAlert("Error: " + data.message, "error");
                }
            },
            error: function () {
                showAlert("Failed to update status.", "error");
            }
        });
    }
});

    $(document).ready(function () {
        // Function to handle file input
        function handleFileUpload() {
            $("#profile-upload").click();
        }

        $("#profile-upload").change(function (event) {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $("#profile-preview").attr("src", e.target.result).show();
                    $(".upload-placeholder").hide();
                    $(".upload-preview").show();
                    $("#remove-profile-image").show(); // Show trash icon
                };
                reader.readAsDataURL(file);
            }
        });

        // Function to remove selected image
        $("#remove-profile-image").click(function () {
            $("#profile-preview").attr("src", "/placeholder.svg").hide();
            $(".upload-placeholder").show();
            $(".upload-preview").hide();
            $("#profile-upload").val(""); // Reset file input
            $("#remove-profile-image").hide(); // Hide trash icon again
        });

        // Handle "Edit" button click
        $(".edit-btn").click(function () {
            let id = $(this).data("id");

            $.ajax({
                url: "volunteer_backend.php",
                type: "GET",
                data: { id: id },
                success: function (response) {
                    let data = JSON.parse(response);
                    
                    // Populate form fields
                    $("#volunteerId").val(data.id);
                    $("#volunteerName").val(data.name);
                    $("#volunteerEmail").val(data.email);
                    $("#homeAddress").val(data.home_address);
                    $("#volunteerRole").val(data.role);
                    $("#volunteerGender").val(data.gender);
                    $("#volunteerProfession").val(data.profession);

                    // Set image preview
                    if (data.profile_picture) {
    let profilePicture = data.profile_picture;
    let primaryPath = "volunteer-img-uploads/" + profilePicture;
    let fallbackPath = "../../admin/assets/images/volunteer-img-uploads/" + profilePicture;
   

                    fetch(primaryPath, { method: 'HEAD' })
                        .then(response => {
                            let finalPath = response.ok ? primaryPath : fallbackPath;
                            $("#profile-preview").attr("src", finalPath).show();
                            $(".upload-placeholder").hide();
                            $(".upload-preview").show();
                        })
                        .catch(() => {
                            $("#profile-preview").attr("src", fallbackPath).show();
                            $(".upload-placeholder").hide();
                            $(".upload-preview").show();
                        });
                } else {
                    $("#profile-preview").attr("src", "/placeholder.svg").hide();
                    $(".upload-placeholder").show();
                    $(".upload-preview").hide();
                }

                    // Change modal title & button text
                    $(".modal-title").text("View Volunteer");
                    $("#onboardBtn").text("Update Details");
                },
                error: function () {
                    alert("Error fetching data.");
                }
            });
        });

        $(".view-btn").click(function () {
            let id = $(this).data("id");

            $.ajax({
                url: "volunteer_backend.php",
                type: "GET",
                data: { id: id },
                success: function (response) {
                    let data = JSON.parse(response);
                    $("#volunteerId").val(data.id);
                    // Populate form fields
                    $("#detailsName").text(data.name);
                    $("#volunteerEmail").text(data.email);
                    $("#detailsLocation").text(data.home_address);
                    $("#detailsField").text(data.role);
                    $("#detailsReason").text(data.motivation);

                    $("#detailsGender").text(data.gender);
                    $("#detailsProfession").text(data.profession);
                    let statusBadge = $("#detailsStatusBadge");
                    statusBadge.text(data.status);
                    
                    // Remove previous status classes
                    statusBadge.removeClass("status-pending status-approved status-rejected");

                    // Add the appropriate class based on status
                    if (data.status === "Pending") {
                        statusBadge.addClass("status-pending");
                    } else if (data.status === "Approved") {
                        statusBadge.addClass("status-approved");
                    } else if (data.status === "Rejected") {
                        statusBadge.addClass("status-rejected");
                    }


                    // Set image preview
                    if (data.profile_picture) {
    let primaryPath = "https://ogerihealth.org/assets/images/volunteer_uploads/profiles/" + data.profile_picture;
    let fallbackPath = "../../admin/assets/images/volunteer-img-uploads/" + data.profile_picture;

    let img = new Image();
    img.onload = function () {
        // If primary image loads successfully
        $("#detailsImage").attr("src", primaryPath).show();
    };
    img.onerror = function () {
        // If primary image fails, use fallback
        $("#detailsImage").attr("src", fallbackPath).show();
    };
    img.src = primaryPath;

    $(".upload-placeholder").hide();
    $(".volunteer-photo").show();
}
 else {
                        $("#profile-preview").attr("src", "/placeholder.svg").hide();
                        $(".upload-placeholder").show();
                        $(".upload-preview").hide();
                    }

                    // Change modal title & button text
                    $(".modal-title").text("Edit Volunteer");
                    $("#onboardBtn").text("Update Details");
                },
                error: function () {
                    showAlert("Error fetching data.", "error");
                }
            });
        });

        // Handle form submission
        $("#volunteerForm").submit(function (e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                url: "volunteer_backend.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function (response) {
                    showAlert(response.message, response.success ? "success" : "error");
                    if (response.success) {
                        setTimeout(() => location.reload(), 2000);
                    }
                },
                error: function (xhr) {
                    showAlert("Something went wrong: " + xhr.responseText, "error");
                }
            });
        });

        // Attach event listener to the upload area
        $("#uploadArea").click(handleFileUpload);
    });

    function showAlert(message, type = "success") {
    let alertBox = $("#alertBox");
    
    // Create alert element
    let alertDiv = $("<div>").addClass("alert").addClass(type === "success" ? "alert-success" : "alert-error");
    let closeButton = $("<span>").addClass("alert-close").html("&times;").click(function () {
        $(this).parent().fadeOut(300, function () {
            $(this).remove();
        });
    });

    alertDiv.html(message).append(closeButton);
    alertBox.append(alertDiv);
    alertBox.fadeIn();

    // Auto-remove after 4 seconds
    setTimeout(function () {
        alertDiv.fadeOut(300, function () {
            $(this).remove();
        });
    }, 4000);
}
</script>

<script>
document.getElementById("exportBtn").addEventListener("click", function () {
    const table = document.querySelector(".volunteers-table");
    let csvContent = "";
    
    for (const row of table.rows) {
        const rowData = Array.from(row.cells).map(cell => `"${cell.innerText.replace(/"/g, '""')}"`);
        csvContent += rowData.join(",") + "\n";
    }

    const blob = new Blob([csvContent], { type: "text/csv;charset=utf-8;" });
    const url = URL.createObjectURL(blob);

    const a = document.createElement("a");
    a.href = url;
    a.download = "volunteers_export.csv";
    a.click();
});
</script>
<script>
document.getElementById("filterBtn").addEventListener("click", function () {
    const filterForm = document.getElementById("filterForm");
    filterForm.style.display = filterForm.style.display === "none" ? "block" : "none";
});
</script>
<script>
    document.getElementById('exportBtnMobile').addEventListener('click', function (e) {
        e.preventDefault();
        document.getElementById('exportBtn').click();
    });

    document.getElementById('filterBtnMobile').addEventListener('click', function (e) {
        e.preventDefault();
        document.getElementById('filterBtn').click();
    });
</script>


</body>

</html>