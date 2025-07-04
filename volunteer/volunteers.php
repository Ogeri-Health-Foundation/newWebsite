<?php
    session_start();
?>
<?php

    $page_title = "XYZ Page - Voluteers - Ogeri Health Foundation";

    $page_author = "Mobolaji";

    $page_description = "";

    $page_rel = '../';

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

    <?php include $page_rel.'include/head.php'; ?>

</head>

<body>
    <div class="dashboard-container">

        <!-- Main Content -->
        <main class="main-content">
            <!-- Content Area -->
            <div class="content">
                <div class="content-header">
                    <div class="title-container">
                        <h2>Volunteers!</h2>
                        <p class="subtitle">List of Volunteers received</p>
                    </div>
                    <button class="btn btn-primary add-volunteer-btn">
                        Add Volunteers <span>+</span>
                    </button>
                </div>

                <div class="table-actions">
                    <div></div>
                    <div class="table-actions-right">
                        <button class="btn btn-primary export-btn">
                            <i class="fas fa-download"></i> Export
                        </button>
                        <button class="btn btn-outline filter-btn">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                    </div>
                </div>

                <!-- Volunteers Table -->
                <div class="table-container">
                    <table class="volunteers-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Profession</th>
                                <th>Field</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="volunteers-table-body">
                            <!-- Volunteer rows will be inserted here by JavaScript -->
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="pagination">
                    <button class="pagination-btn prev-btn" disabled>
                        <i class="fas fa-chevron-left"></i> Previous
                    </button>
                    <div class="pagination-numbers">
                        <button class="pagination-number active">1</button>
                        <button class="pagination-number">2</button>
                        <button class="pagination-number">3</button>
                        <span>...</span>
                        <button class="pagination-number">67</button>
                        <button class="pagination-number">68</button>
                    </div>
                    <button class="pagination-btn next-btn">
                        Next <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </main>
    </div>

    <!-- Add Volunteer Modal -->
    <div class="modal" id="add-volunteer-modal">
        <div class="modal-content">
            <h2>Onboard Volunteers</h2>
            <form id="add-volunteer-form">
                <div class="form-group">
                    <label>Profile Picture</label>
                    <div class="upload-container" id="profile-upload-container">
                        <div class="upload-placeholder">
                            <i class="fas fa-upload"></i>
                            <span>Upload</span>
                        </div>
                        <div class="upload-preview" style="display: none;">
                            <img id="profile-preview" src="" alt="Profile Preview">
                            <button type="button" class="remove-image" id="remove-profile-image">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <input type="file" id="profile-upload" accept="image/*" hidden>
                    </div>
                </div>
                <div class="form-group">
                    <label for="volunteer-name">Name<span class="required">*</span></label>
                    <input type="text" id="volunteer-name" placeholder="Enter Name" required>
                </div>
                <div class="form-group">
                    <label for="volunteer-email">Email<span class="required">*</span></label>
                    <input type="email" id="volunteer-email" placeholder="Enter Email Address" required>
                </div>
                <div class="form-group">
                    <label for="volunteer-role">Role</label>
                    <div class="select-container">
                        <select id="volunteer-role" required>
                            <option value="" disabled selected>Select Volunteers role</option>
                            <option value="Patient Clinic">Patient Clinic</option>
                            <option value="Fundraising">Fundraising</option>
                            <option value="Administration">Administration</option>
                            <option value="Marketing">Marketing</option>
                        </select>
                        <!-- <i class="fas fa-chevron-down select-icon"></i> -->
                    </div>
                </div>
                <div class="form-actions">
                    <!-- <button type="button" class="btn btn-outline cancel-btn">Cancel</button> -->
                    <button type="submit" class="btn btn-primary">Onboard</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Volunteer Details Modal -->
    <div class="modal" id="volunteer-details-modal">
        <div class="modal-content details-modal-content">
            <div class="details-header">
                <h2>Volunteers Details</h2>
                <div id="volunteer-status-badge" class="status-badge"></div>
            </div>
            <div class="volunteer-details">
                <div class="volunteer-profile">
                    <img id="volunteer-image" src="" alt="Volunteer Profile">
                    <div class="volunteer-info">
                        <div class="info-item">
                            <span class="info-label">Name:</span>
                            <span id="detail-name" class="info-value"></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Location:</span>
                            <span id="detail-location" class="info-value"></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Gender:</span>
                            <span id="detail-gender" class="info-value"></span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Age:</span>
                            <span id="detail-age" class="info-value"></span>
                        </div>
                    </div>
                </div>
                <div class="volunteer-professional-info">
                    <div class="info-item">
                        <span class="info-label">Profession:</span>
                        <span id="detail-profession" class="info-value"></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Volunteer field:</span>
                        <span id="detail-field" class="info-value"></span>
                    </div>
                </div>
                <div class="certification-section">
                    <h3>Certification</h3>
                    <div class="certification-container">
                        <img id="certification-image" src="" alt="Certification">
                        <button class="btn btn-dark download-btn">
                            <i class="fas fa-download"></i> Download
                        </button>
                    </div>
                </div>
                <div class="reason-section">
                    <h3>Reason for Vountering</h3>
                    <p id="detail-reason"></p>
                </div>
                <div class="details-actions">
                    <button class="btn btn-danger reject-btn" id="reject-volunteer-btn">Reject</button>
                    <button class="btn btn-primary approve-btn" id="approve-volunteer-btn">Approve</button>
                    <button class="btn btn-outline close-details-btn">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal" id="delete-modal">
        <div class="modal-content delete-modal-content">
            <div class="delete-header">
                <div class="delete-icon">
                    <i class="fas fa-trash"></i>
                </div>
                <h2 id="delete-volunteer-name">Delete Anwara Callistus</h2>
            </div>
            <p class="delete-message">Are you sure you want to delete this Volunteer? If Yes, Confirm</p>
            <div class="delete-actions">
                <button class="btn btn-outline cancel-delete-btn">Cancel</button>
                <button class="btn btn-danger confirm-delete-btn">Yes, Delete</button>
            </div>
        </div>
    </div>

    <!-- Action Menu -->
    <div class="action-menu" id="action-menu">
        <button class="action-item view-details-btn">
            <i class="fas fa-eye"></i> View details
        </button>
        <button class="action-item delete-volunteer-btn">
            <i class="fas fa-trash"></i> Delete Volunteer
        </button>
    </div>

    <!-- Toast Notification -->
    <div class="toast" id="toast">
        <div class="toast-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="toast-message" id="toast-message"></div>
        <button class="toast-close">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <script src="../volunteer/assets/js/volunteers.js"></script>
</body>

</html>