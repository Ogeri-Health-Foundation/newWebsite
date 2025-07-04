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

        <?php $page = 'Blog'; ?>
        <?php include $page_rel . 'admin/includes/topbar.php'; ?>
        <main>
            <div id="alertBox" class="alert-box"></div>
            <section class="container">
                <div class="content-header">
                    <div>
                        <h2 class="content-title">Volunteering Opportunities!</h2>
                        <p class="content-subtitle">Opportunities to volunteer</p>
                    </div>
                    
                    <button class="btn btn-add" id="addVolunteerBtn" data-bs-toggle="modal" data-bs-target="#addVolunteerModal">
                        <i class="fas fa-plus"></i> Add Oppurtunities
                    </button>
                  
                    
                </div>
                
            </section>

            <section class="container">
                <!-- Opportuity Table -->
                <div class="table-container">
                    <table class="table" id="opportunityTable">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Title</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="pagination"></div>


            </section>


            <section class="container">
                 <!-- Add opportunity Modal -->
                    <div class="modal fade" id="addVolunteerModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Opportunity</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                                </div>
                                <div class="modal-body">
                                    <form id="volunteerForm" enctype="multipart/form-data">
                                        <input type="hidden" id="volunteerId" name="id">
                                        <div class="mb-3">
                                            <label class="form-label">Add an image</label>
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
                                            <label for="volunteerName" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="volunteerName" placeholder="Enter Title"
                                            name="name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="startDate" class="form-label">Start Date</label>
                                            <input type="date" class="form-control" id="startDate"
                                                 name="start_date" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="endDate" class="form-label">End Date</label>
                                            <input type="date" class="form-control" id="endDate"
                                                placeholder="Enter Home Address" name="end_date" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="Description" class="form-label">Description</label>
                                            <textarea class="form-control text-area"  name="description" row="10"></textarea>
                                        </div>
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-cancel btn-outline" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-onboard btn-primary" id="onboardBtn">Add Opportuity</button>
                                        </div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                    </div>
            </section>

            <section class="container">
                <!-- Volunteer Details Modal -->
                <div class="modal fade" id="volunteerDetailsModal" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Opportunity Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="opportunityId">
                                <div class="status-badge-container">
                                    <span class="status-badge" id="detailsStatusBadge"></span>
                                </div>
                            
                                <div class="volunteer-info">
                                    <div class="volunteer-photo" id="opportunityimg">
                                        <img src="../assets/images/includes/user1.svg" alt="Volunteer" id="detailsImage">
                                    </div>
                                    <div class="volunteer-details">
                                        <div class="detail-item">
                                            <h6 class="detail-label">Title:</h6>
                                            <p class="detail-value" id="oppotunityTitle"></p>
                                        </div>
                                        <div class="detail-item">
                                            <h6 class="detail-label">Start Date:</h6>
                                            <p class="detail-value" id="start-date"></p>
                                        </div>
                                        <div class="detail-item">
                                            <h6 class="detail-label">End Date:</h6>
                                            <p class="detail-value" id="end-date"></p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="reason-section">
                                    <h5>Opportunity Description</h5>
                                    <p id="description">I just love the initiative</p>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-approve btn-primary" id="publishBtn">Publish</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


        </main>




        <?php include $page_rel . 'admin/includes/sidebar.php'; ?>

        <script>
             $(document).ready(function () {
            $("#publishBtn").click(function () {
                updateOppStatus("published");
            });

    

    function updateOppStatus(status) {
        let volunteerId = $("#opportunityId").val(); // Get the volunteer ID

        if (!volunteerId) {
            alert("Volunteer ID is missing!");
            return;
        }

        $.ajax({
            url: "opportunity-backend.php",
            type: "POST",
            data: {
                id: volunteerId,
                status: status
            },
            success: function (response) {
                let data = JSON.parse(response);
                if (data.success) {
                    showAlert("Status updated to: " + status, "success");
                    $("#detailsStatusBadge").text(status); // Update UI
                    $("#volunteerDetailsModal").modal("hide"); // Close modal
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
    let uploadArea = $("#uploadArea");
    let fileInput = $("#profile-upload");
    let previewContainer = $(".upload-preview");
    let previewImage = $("#profile-preview");
    let placeholder = $(".upload-placeholder");
    let removeButton = $("#remove-profile-image");

    
    // Click on upload area to trigger file input
    uploadArea.click(function () {
        fileInput.click();
    });

    // Handle file selection
    fileInput.change(function (event) {
        let file = event.target.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function (e) {
                previewImage.attr("src", e.target.result);
                previewContainer.show();
                placeholder.hide();
                removeButton.show();
            };
            reader.readAsDataURL(file);
        }
    });

    // Remove selected image
    removeButton.click(function () {
        fileInput.val(""); // Clear file input
        previewImage.attr("src", "/placeholder.svg"); // Reset preview image
        previewContainer.hide();
        placeholder.show();
        removeButton.hide();
    });

    // Hide remove button initially
    removeButton.hide();
});

$(document).ready(function () {
    let currentPage = 1;
    let limit = 10; // Adjust items per page
    function loadOpportunities(page = 1) {
    $.ajax({
        url: `opportunity-backend.php?action=fetch&page=${page}&limit=${limit}`,
        type: "GET",
        success: function (data) {
            let response;
            try {
                response = JSON.parse(data);
            } catch (e) {
                console.error("JSON Parse Error:", e);
                return;
            }

            if (response.status === "error") {
                console.error("Error from server:", response.message);
                return;
            }

            if (!response.opportunities || response.opportunities.length === 0) {
                $("#opportunityTable tbody").html("<tr><td colspan='5'>No opportunities found.</td></tr>");
                return;
            }

            let html = "";
            response.opportunities.forEach((opportunity, index) => {
                html += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${opportunity.title}</td>
                        <td>${opportunity.start_date}</td>
                        <td>${opportunity.end_date}</td>
                        <td class="${opportunity.status === 'pending' ? 'status-pending' : 
                                    opportunity.status === 'published' ? 'status-approved' : ''}" 
                            style='text-transform: uppercase;'>
                            ${opportunity.status}
                        </td>
                        <td class='text-center' style='text-align: center;'>
                            <div class='dropdown'>
                                <button class='action-button dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                    <i class='fas fa-ellipsis-v'></i>
                                </button>
                                <ul class='dropdown-menu'>
                                    <li>
                                        <a class='dropdown-item view-details-btn' href='#' 
                                        data-bs-toggle='modal' data-bs-target='#volunteerDetailsModal'
                                        data-id='${opportunity.id}'>
                                        View Details
                                        </a>
                                    </li>
                                    <li>
                                        <a class='dropdown-item edit-btn' href='#' 
                                        data-bs-toggle='modal' data-bs-target='#addVolunteerModal'
                                        data-id='${opportunity.id}'>
                                        Edit Details
                                        </a>
                                    </li>
                                    <li>
                                        <a class='dropdown-item text-danger delete-btn' href='#' 
                                        data-id='${opportunity.id}'>
                                        Delete Volunteer
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>`;
            });

            $("#opportunityTable tbody").html(html);
            updatePagination(response.totalPages, response.currentPage);
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
        }
    });
}

    function updatePagination(totalPages, currentPage) {
        let paginationHtml = `
            <button class="btn btn-prev" ${currentPage === 1 ? 'disabled' : ''} id="prevPageBtn">
                <i class="fas fa-chevron-left"></i> Previous
            </button>`;

        for (let i = 1; i <= totalPages; i++) {
            paginationHtml += `<button class="btn btn-page ${i === currentPage ? 'active' : ''}" data-page="${i}">${i}</button>`;
        }

        paginationHtml += `
            <button class="btn btn-next" ${currentPage === totalPages ? 'disabled' : ''} id="nextPageBtn">
                Next <i class="fas fa-chevron-right"></i>
            </button>`;

        $(".pagination").html(paginationHtml);
    }

    $(document).on("click", ".btn-page", function () {
        currentPage = $(this).data("page");
        loadOpportunities(currentPage);
    });

    $(document).on("click", "#prevPageBtn", function () {
        if (currentPage > 1) {
            loadOpportunities(--currentPage);
        }
    });

    $(document).on("click", "#nextPageBtn", function () {
        loadOpportunities(++currentPage);
    });

    loadOpportunities();
 // Load opportunities on page load

    // View Details
    $(document).on("click", ".view-details-btn", function () {
        let id = $(this).data("id");

        $.ajax({
            url: `opportunity-backend.php?action=get&id=${id}`,
            type: "GET",
            success: function (data) {
                let opportunity = JSON.parse(data);
                $("#opportunityId").val(opportunity.id);
                $("#oppotunityTitle").text(opportunity.title);
                $("#start-date").text(opportunity.start_date);
                $("#end-date").text(opportunity.end_date);
                $("#description").text(opportunity.description);

                if (opportunity.image) {
                    $("#detailsImage").attr("src", "../assets/images/volunteer-opp-img/" + opportunity.image);
                } else {
                    $("#detailsImage").attr("src", "../assets/images/includes/user1.svg"); // Default Image
                }

                $("#volunteerDetailsModal").modal("show");
            }
        });
    });

    // Add/Edit Opportunity
     // **Edit Mode: Fetch and Populate Form**
     function editOpportunity(id) {
        let uploadArea = $("#uploadArea");
        let fileInput = $("#profile-upload");
        let previewContainer = $(".upload-preview");
        let previewImage = $("#profile-preview");
        let placeholder = $(".upload-placeholder");
        let removeButton = $("#remove-profile-image");
        $.ajax({
            url: "opportunity-backend.php?action=get&id=" + id,
            type: "GET",
            dataType: "json",
            success: function (data) {
                console.log("Editing Opportunity:", data);
                if (!data || !data.id) {
                console.error("Error: Opportunity data is undefined or missing ID.");
                return;
    }

                $("#volunteerId").val(data.id);
                $("#volunteerName").val(data.title);
                $("#startDate").val(data.start_date);
                $("#endDate").val(data.end_date);
                $("textarea[name='description']").val(data.description);

                if (data.image) {
                    previewImage.attr("src", "../assets/images/volunteer-opp-img/" + data.image);
                    previewContainer.show();
                    placeholder.hide();
                    removeButton.show();
                } else {
                    previewImage.attr("src", "/placeholder.svg");
                    previewContainer.hide();
                    placeholder.show();
                    removeButton.hide();
                }
            },
            error: function (xhr) {
                console.error("Error fetching opportunity:", xhr.responseText);
            }
        });
    }


    // **Handle Add/Edit Submission**
    $("#volunteerForm").submit(function (e) {
        e.preventDefault();
        let formData = new FormData(this);
        $.ajax({
            url: "opportunity-backend.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (response) {
                const message = response.message || (response.success ? "Operation successful." : "Something went wrong.");
                showAlert(message, response.success ? "success" : "error");

                if (response.success) {
                    setTimeout(() => location.reload(), 2000);
                }else {
                    showAlert("Error: " + response.message, "error");
                }
            },
            error: function (xhr) {
                showAlert("Submission failed: " + xhr.responseText, "error");
            }
        });
    });

    // **Trigger Edit Mode**
    $(document).on("click", ".edit-btn", function () {
        let id = $(this).data("id");
        editOpportunity(id);
    });

    // Delete Opportunity
    $(document).on('click', '.delete-btn', function () {
        let id = $(this).data('id');
        if (confirm("Are you sure?")) {
            $.ajax({
                url: `opportunity-backend.php?action=delete&id=${id}`,
                type: "GET", // Changed from DELETE to GET
                success: function () {
                    showAlert("Deleted");
                    loadOpportunities();
                }
            });
        }
    });
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


    </body>

</html>