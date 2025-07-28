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
        <div id="alertBox" class="alert-box" style="z-index: 10000;"></div>

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
                    <!-- <div class="action-buttons">
                       
                        <div class="desktop-buttons">
                            <button class="btn btn-export" id="exportBtn">
                                <i class="fas fa-file-export"></i> Export
                            </button>
                            <button class="btn btn-filter" id="filterBtn">
                                <i class="fas fa-filter"></i> Filter
                            </button>
                        </div>

                       
                        <div class="mobile-dropdown dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="actionDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-bars"></i> Actions
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="actionDropdown">
                                <li><a class="dropdown-item" href="#" id="exportBtnMobile"><i class="fas fa-file-export"></i> Export</a></li>
                                <li><a class="dropdown-item" href="#" id="filterBtnMobile"><i class="fas fa-filter"></i> Filter</a></li>
                            </ul>
                        </div> -->
                    <!-- </div> -->

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
                        <table class="volunteers-table" id="volunteerTable">
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
                                        <!-- <div class="pagination">
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
                    </div> -->
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
                                <label for="telephone" class="form-label">Phone Number</label>
                                <input
                                type="tel"
                                class="form-control"
                                id="phone"
                                name="phone"
                                placeholder="+234802542365"
                                />
                            </div>
                            <div class="mb-3">
                                <label for="Home Address" class="form-label">Home Address*</label>
                                <input type="text" class="form-control" id="homeAddress"
                                    placeholder="Enter Home Address" name="home_address" required>
                            </div>
                            <div class="mb-3">
                                <label for="volunteerRole" class="form-label">Role</label>
                                <select class="form-select" id="volunteerRole" name="role">
                                    <option value="" disabled selected>Select volunteer role</option>
                                    <option value="Patient Clinic">Patient Clinic</option>
                                    <option value="Fundraising">Fundraising</option>
                                    <option value="Administration">Administration</option>
                                    <option value="Marketing">Marketing</option>
                                    <option value="Events">Events</option>
                                    <option value="Community Outreach">Community Outreach</option>
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
                           <div class="form-group full-width mb-3">
                                <label class="form-label">Resume/CV</label>
                                <div class="file-upload bg-white" id="resume-upload">
                                    <input type="file" name="resume" id="resume" accept=".pdf,.doc,.docx">
                                    <div class="file-upload-icon">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                    <p class="file-upload-text">Upload your resume<br>PDF, DOC or DOCX (max. 5MB)</p>
                                </div>

                                <div class="resume-icon mt-2 resume-placeholder" style="display:none;">
                                    <i class="fas fa-file-pdf"></i>
                                    <p class="resume-file-name" id="resume-file-name"></p>
                                    <a href="#" id="resume-preview" class="btn btn-sm btn-outline-primary mt-1" target="_blank">View Resume</a>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="bio" class="form-label">Short Bio</label>
                                <textarea
                                class="form-control"
                                id="bio"
                                name="bio"
                                rows="10"
                                placeholder="Tell us about the volunteer"
                                ></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="volunteerProfession" class="form-label">Profession</label>
                                <input type="text" class="form-control" id="volunteerProfession"
                                    placeholder="Enter Profession" name="profession">
                            </div>
                            <div class="social-link-container mb-3">
                                <div class="row">
                                    <div class="input-group mb-3 col-12">
                                        <span class="input-group-text" id="basic-addon1"
                                        ><img
                                            src="../../assets/img/volunteer/icons/facebook-icon-form.png"
                                            class="img-"
                                            alt=""
                                        /></span>
                                        <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Username"
                                        aria-label="Username"
                                        aria-describedby="basic-addon1"
                                        id="facebookUsername"
                                        name="facebook"
                                        />
                                    </div>
                                    <div class="input-group mb-3 col-12">
                                        <span class="input-group-text" id="basic-addon2"
                                        ><img
                                            src="../../assets/img/volunteer/icons/linkedin-icon-form.png"
                                            alt=""
                                        /></span>
                                        <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Username"
                                        aria-label="Username"
                                        aria-describedby="basic-addon2"
                                        id="linkedUsername"
                                        name="linkedin"
                                        />
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="input-group mb-3 col-12">
                                        <span class="input-group-text" id="basic-addon3"
                                        ><img src="../../assets/img/volunteer/icons/x-icon-form.png" alt="x icon"
                                        /></span>
                                        <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Username"
                                        aria-label="Username"
                                        aria-describedby="basic-addon3"
                                        id="xUsername"
                                        name="twitter"
                                        />
                                    </div>
                                    <div class="input-group mb-3 col-12">
                                        <span class="input-group-text" id="basic-addon4"
                                        ><img
                                            src="../../assets/img/volunteer/icons/instagram-icon-form.png"
                                            alt="instagram icon"
                                        /></span>
                                        <input
                                        type="text"
                                        class="form-control"
                                        placeholder="Username"
                                        aria-label="Username"
                                        aria-describedby="basic-addon4"
                                        id="instagramUsername"
                                        name="instagram"
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group full-width mb-3">
                                <label for="skills" class="form-label">Skills (press Enter to add)</label>
                                <div class="skills-container" id="skills-container">
                                <input type="text" id="skills-input" class="skill-input" placeholder="Add skills...">
                                </div>
                                <input type="hidden" name="skills" id="skills-hidden">
                            </div>
                            <div class="mb-3">
                                <label for="reason" class="form-label"
                                >Why Do You Want To Volunteer</label
                                >
                                <textarea
                                class="form-control"
                                id="motivation"
                                name="motivation"
                                rows="10"
                                placeholder="Share you motivation for volunteering with us."
                                ></textarea>
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
                        <!-- Contact Info -->
                        <div class="additional-info">
                            <div class="detail-item">
                                <h6 class="detail-label">Email:</h6>
                                <p class="detail-value" id="detailsEmail"></p>
                            </div>
                            <div class="detail-item">
                                <h6 class="detail-label">Phone:</h6>
                                <p class="detail-value" id="detailsPhone"></p>
                            </div>
                        </div>

                        <!-- Bio -->
                        <div class="bio-section mt-3">
                            <h5>Bio</h5>
                            <p id="detailsBio"></p>
                        </div>

                      <div class="skills-section mt-3">
                            <h5>Skills</h5>
                            <div id="detailsSkills" class="d-flex flex-wrap gap-2" style="min-height: 2rem;"></div>
                        </div>

                        <!-- Social Media -->
                        <div class="social-section mt-3">
                            <h5>Social Media</h5>
                            <ul class="list-unstyled">
                                <li><strong>Facebook:</strong> <span id="detailsFacebook"></span></li>
                                <li><strong>LinkedIn:</strong> <span id="detailsLinkedin"></span></li>
                                <li><strong>X:</strong> <span id="detailsTwitter"></span></li>
                                <li><strong>Instagram:</strong> <span id="detailsInstagram"></span></li>
                            </ul>
                        </div>

                        <!-- Resume -->
                        <div class="resume-section mt-3">
                            <h5>Resume</h5>
                            <a href="#" id="resumeDownloadLink" target="_blank" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-file-download"></i> Download Resume
                            </a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-reject btn-danger" id="rejectBtn">
                            <span class="btn-text">Reject</span>
                            <span class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></span>
                        </button>
                        <button type="button" class="btn btn-approve btn-primary" id="approveBtn">
                            <span class="btn-text">Approve</span>
                            <span class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></span>
                        </button>
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
    <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
  <script src="https://cdn.datatables.net/buttons/2.1.3/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.1.3/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.1.3/js/buttons.print.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <!-- jsPDF -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

  <!-- Buttons JS -->
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
  <style>
      div.dataTables_wrapper div.dataTables_length select {
        padding: 5px 35px;
      }
    </style>
  
    <script>
        $(document).ready(function() {
      // Call it on page load
     

      $('#volunteerTable').DataTable({
        dom: '<"row mb-3"<"col-md-4"l>>' + // Show entries
          '<"row mb-3"<"col-md-6"B><"col-md-6 text-end"f>>' + // Buttons and Search filter
          'rt' +
          '<"row mt-3"<"col-md-5"i><"col-md-7"p>>', // Info and Pagination
        buttons: [{
            extend: 'copy',
            className: 'btn btn-primary btn-sm me-1 mb-2 '
          },
          {
            extend: 'csv',
            className: 'btn btn-secondary btn-sm me-1 mb-2'
          },
          {
            extend: 'excel',
            className: 'btn btn-success btn-sm me-1 mb-2'
          },
          {
            extend: 'pdf',
            className: 'btn btn-danger btn-sm me-1 mb-2'
          },
          {
            extend: 'print',
            className: 'btn btn-dark btn-sm mb-2'
          }
        ],
        language: {
          paginate: {
            next: 'Next',
            previous: 'Prev'
          },
          search: 'Search Filter',
          lengthMenu: 'Show _MENU_ entries',
          info: 'Showing _START_ to _END_ of _TOTAL_ entries'
        }
      });
    });

      $(document).ready(function () {
    $("#approveBtn").click(function () {
        showConfirmModal("approve");
    });

    $("#rejectBtn").click(function () {
        showConfirmModal("reject");
    });


    
    
   $(document).ready(function () {
  // Declare necessary variables
  const skills = [];
  const skillsContainer = document.getElementById('skills-container');
  const skillsInput = document.getElementById('skills-input');
  const skillsHidden = document.getElementById('skills-hidden');
  skillsInput.addEventListener('keydown', function (e) {
if (e.key === 'Enter') {
    e.preventDefault(); // prevent form submission or other default behavior
    const newSkill = skillsInput.value.trim();
    if (newSkill && !skills.includes(newSkill)) {
    addSkill(newSkill);
    updateHiddenField();
    skillsInput.value = '';
    }
}
});

  function addSkill(skill) {
    skills.push(skill);

    const skillTag = document.createElement('div');
    skillTag.className = 'skill-tag';
    skillTag.innerHTML = `${skill} <span class="remove-skill">&times;</span>`;

    skillTag.querySelector('.remove-skill').addEventListener('click', function () {
      skillsContainer.removeChild(skillTag);
      const index = skills.indexOf(skill);
      if (index > -1) {
        skills.splice(index, 1);
        updateHiddenField();
      }
    });

    skillsContainer.insertBefore(skillTag, skillsInput);
  }

  function updateHiddenField() {
    skillsHidden.value = JSON.stringify(skills);
  }

  function clearPreviewAndSkills() {
    const skillTags = document.querySelectorAll('.skill-tag');
    skillTags.forEach(tag => {
      skillsContainer.removeChild(tag);
    });

    skills.length = 0;
    updateHiddenField();
  }

  // Expose functions globally so they're accessible in success handlers or inline scripts
  window.clearPreviewAndSkills = clearPreviewAndSkills;
  window.addSkill = addSkill;
  window.skills = skills; // Now globally accessible
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
            // Detect the clicked button
            const btn = status === "Approved" ? $("#approveBtn") : $("#rejectBtn");
            const spinner = btn.find(".spinner-border");
            const btnText = btn.find(".btn-text");
            btn.prop("disabled", true);
            spinner.removeClass("d-none");
            btnText.text("Processing...");

            $.ajax({
                url: "volunteer_backend.php",
                type: "POST",
                data: {
                    id: volunteerId,
                    status: status
                },
                success: function (response) {
                    let data = JSON.parse(response);
                      btn.prop("disabled", false);
                        spinner.addClass("d-none");
                        btnText.text(status === "Approved" ? "Approve" : "Reject");
                    if (data.success) {
                        showAlert(data.message, "success");  // Show the message from PHP (e.g., "Status updated and email sent")
                        $("#detailsStatusBadge").text(status);
                        $('#volunteerDetailsModal').modal('hide');

                        // In case the backdrop remains, remove it manually
                        $('.modal-backdrop').remove();
                        $('body').removeClass('modal-open');
                        $('body').css('padding-right', '');
                    } else {
                        showAlert("Error: " + data.message, "error"); // Show specific mail or DB error
                    }
                },      
                error: function () {
                    btn.prop("disabled", false);
            spinner.addClass("d-none");
            btnText.text(status === "Approved" ? "Approve" : "Reject");
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

        $(".edit-btn").click(function () {
            let id = $(this).data("id");

            $.ajax({
                url: "volunteer_backend.php",
                type: "GET",
                data: { id: id },
                success: function (response) {
                    let data = JSON.parse(response);

                    // Basic Fields
                    $("#volunteerId").val(data.id);
                    $("#volunteerName").val(data.name);
                    $("#volunteerEmail").val(data.email);
                    $("#homeAddress").val(data.home_address);
                    $("#volunteerRole").val(data.role);
                    $("#volunteerGender").val(data.gender);
                    $("#volunteerProfession").val(data.profession);
                    $("#phone").val(data.phone);
                    $("#bio").val(data.bio);
                    $("#motivation").val(data.motivation);

                    // Social Links
                    $("#facebookUsername").val(data.facebook);
                    $("#linkedUsername").val(data.linkedin);
                    $("#xUsername").val(data.twitter);
                    $("#instagramUsername").val(data.instagram);

                    // Resume Preview
                    if (data.resume) {
                        
                         let resumePath = "../../volunteer_upload/resumes/" + data.resume;

                        $("#resume-preview")
                            .attr("href", resumePath)
                            .text("View Resume")
                            .show();

                        $("#resume-file-name")
                            .text(data.resume);

                        $(".resume-placeholder").show();
                    } else {
                        $("#resume-preview").hide();
                        $(".resume-placeholder").hide();
                    }

                    // Profile Picture
                    if (data.profile_picture) {
                        // let profilePicture = data.profile_picture;
                         let primaryPath = "../../volunteer_upload/profiles/" + data.profile_picture;
                        let fallbackPath = "../../admin/assets/images/volunteer-img-uploads/" + data.profile_picture;

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
                        
                       if (data.skills) {
                        let skillList = [];

                        try {
                            // If already an array (e.g. ["JavaScript", "PHP"])
                            if (Array.isArray(data.skills)) {
                            skillList = data.skills;
                            }
                            // If it's a JSON string: '["JavaScript", "PHP"]'
                            else if (typeof data.skills === 'string') {
                            skillList = JSON.parse(data.skills);
                            }
                            // If it's a comma-separated string: 'JavaScript, PHP'
                            else {
                            skillList = data.skills.split(',').map(s => s.trim());
                            }
                        } catch (err) {
                            console.error("Skill parse failed:", err);
                        }

                        // Clear any previous tags
                        clearPreviewAndSkills();

                        // Load each skill into the tag system
                        skillList.forEach(skill => {
                            if (!skills.includes(skill)) {
                            addSkill(skill);
                            // Don't call updateHiddenField here because it's called inside addSkill
                            }
                        });
                        }

                    // Change modal title & button
                    $(".modal-title").text("View Volunteer");
                    $("#onboardBtn").text("Update Details");
                },
                error: function () {
                    alert("Error fetching volunteer data.");
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

                    // Basic Details
                    $("#volunteerId").val(data.id);
                    $("#detailsName").text(data.name);
                    $("#detailsLocation").text(data.home_address);
                    $("#detailsField").text(data.role);
                    $("#detailsReason").text(data.motivation);
                    $("#detailsGender").text(data.gender);
                    $("#detailsProfession").text(data.profession);

                    // Additional Info
                    $("#detailsEmail").text(data.email);
                    $("#detailsPhone").text(data.phone || "-");
                    $("#detailsBio").text(data.bio || "-");

                    // Skills (render as comma-separated or tags)
                    
                  try {
                    let skills = [];
                    console.log("Raw data.skills:", data.skills);
                    console.log("Type of data.skills:", typeof data.skills);
                    
                    if (Array.isArray(data.skills)) {
                        skills = data.skills;
                        console.log("Used as array");
                    } else if (typeof data.skills === 'string') {
                        try {
                            skills = JSON.parse(data.skills);
                            console.log("Parsed as JSON:", skills);
                        } catch {
                            skills = data.skills.split(',').map(s => s.trim());
                            console.log("Split as CSV:", skills);
                        }
                    }
                    
                    console.log("Final skills array:", skills);
                    
                const skillTags = (skills || [])
                    .filter(skill => skill && skill.trim())
                    .map(skill => `<span style="background: #6c757d; color: white; padding: 4px 8px; margin: 2px; border-radius: 4px; display: inline-block;">${skill.trim()}</span>`)
                    .join("");
                    
                    console.log("Generated HTML:", skillTags);
                    $("#detailsSkills").html(skillTags || "<span class='text-muted'>-</span>");
                } catch (err) {
                    console.error("Skill display error:", err);
                    $("#detailsSkills").html("<span class='text-muted'>-</span>");
                }

                    // Social Links
                    $("#detailsFacebook").text(data.facebook || "-");
                    $("#detailsLinkedin").text(data.linkedin || "-");
                    $("#detailsTwitter").text(data.twitter || "-");
                    $("#detailsInstagram").text(data.instagram || "-");

                    // Resume Link
                   if (data.resume) {
                        let primaryResumePath = "../../volunteer_upload/resumes/" + data.resume;
                        $("#resumeDownloadLink").attr("href", primaryResumePath).show();
                    } else {
                        $("#resumeDownloadLink").hide();
                    }               

                    // Status Badge
                    let statusBadge = $("#detailsStatusBadge");
                    statusBadge.text(data.status);
                    statusBadge.removeClass("status-pending status-approved status-rejected");

                    if (data.status === "Pending") {
                        statusBadge.addClass("status-pending");
                    } else if (data.status === "Approved") {
                        statusBadge.addClass("status-approved");
                    } else if (data.status === "Rejected") {
                        statusBadge.addClass("status-rejected");
                    }

                    // Profile Picture
                    if (data.profile_picture) {
                        let primaryPath = "../../volunteer_upload/profiles/" + data.profile_picture;
                        let fallbackPath = "../../admin/assets/images/volunteer-img-uploads/" + data.profile_picture;

                        let img = new Image();
                        img.onload = function () {
                            $("#detailsImage").attr("src", primaryPath).show();
                        };
                        img.onerror = function () {
                            $("#detailsImage").attr("src", fallbackPath).show();
                        };
                        img.src = primaryPath;

                        $(".upload-placeholder").hide();
                        $(".volunteer-photo").show();
                    } else {
                        $("#detailsImage").attr("src", "/placeholder.svg").hide();
                        $(".upload-placeholder").show();
                        $(".upload-preview").hide();
                    }

                    // Modal title
                    $(".modal-title").text("Volunteer Details");
                    $("#volunteerDetailsModal").modal("show");
                },
                error: function () {
                    showAlert("Error fetching data.", "error");
                }
            });
        });

        // Handle form submission
        $("#volunteerForm").submit(function (e) {
            e.preventDefault();

            // Collect form data
            let formData = new FormData(this);

            // Manually append skills if needed
            const skills = $("#skills-hidden").val();
            formData.append("skills", skills);

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
                        clearPreviewAndSkills();
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

<!-- <script>
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
</script> -->


</body>

</html>