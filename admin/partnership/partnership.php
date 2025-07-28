<?php
session_start();
?>
<?php

$page_title = "Partnership - Ogeri Health Foundation";

$page_author = "kayode";

$page_description = "";

$page_rel = '../../';

$page_name = 'partnership';

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
    .then(response => {
      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.json(); 
    })
    .then(data => {
      console.log("Auth Data:", data); 
      if (data.status === "error") {
        
        location.href = "../../admin/login.php";
      }
    })
    .catch(error => {
      console.error("Fetch error:", error);
    });
};

    </script>


    <?php $page = 'Partnership'; ?>
    <?php include $page_rel . 'admin/includes/topbar.php'; ?>

    <main class="">
    <div id="alertBox" class="alert-box" style="z-index: 100000;"></div>
        <div class="container-fluid main-container ">
            <!-- Main Content -->
            <div class="content">

                <!-- Page Content -->
                <div class="page-content ">
                    <!-- Toast Notification -->
                    <div class="toast-container" id="toastContainer">
                        <!-- Toast will be added dynamically -->
                    </div>

                    <!-- Page Header -->
                    <div class="content-header">
                        <div>
                            <h2 class="content-title">Partnership!</h2>
                            <p class="content-subtitle">List of partnerships received</p>
                        </div>
                        <button class="btn btn-add" id="addVolunteerBtn" data-bs-toggle="modal" data-bs-target="#addVolunteerModal">
                            <i class="fas fa-plus"></i> Add Partners
                        </button>
                    </div>

                    <!-- Action Buttons -->
                    <!-- <div class="action-buttons">
                        <button class="btn btn-export" id="exportBtn">
                            <i class="fas fa-file-export"></i> Export
                        </button>
                        <button class="btn btn-filter" id="filterBtn">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                    </div> -->

                    <!-- Volunteers Table -->
                    <div class="table-container">
                        <table class="table volunteers-table" id="partnersTable">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Company Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Partnership Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="partners-table-body">
                                <!-- Table content will be added dynamically -->
                            </tbody>
                        </table>
                    </div>
                    

                    <!-- Pagination -->
                    <!-- <div class="pagination"></div> -->
                </div>
            </div>
        </div>

        <!-- Filter Modal -->
        <!-- <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <form id="filterForm">
                <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Filter by Partnership Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <select class="form-select" name="partnership_type" id="partnershipTypeFilter">
                    <option value="">-- Select Type --</option>
                    <option value="Corporate">Corporate</option>
                    <option value="Individual">Individual</option>
                    <option value="NGO">NGO</option>
                   
                </select>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Apply Filter</button>
                </div>
            </form>
            </div>
        </div>
        </div> -->


        <!-- Add Volunteer Modal -->
        <div class="modal fade" id="addVolunteerModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Onboard Partners</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <form id="addPartnerForm">
                            <div class="mb-3">
                                <label class="form-label">Add a Logo</label>
                                
                                <div class="upload-container" id="logo-upload-container">
                                    <div class="upload-area" id="uploadArea">
                                    <input type="hidden" id="partner_id" name="partner_id" />
                                    <input type="hidden" id="existing_logo" name="existing_logo" />
                                        <i class="fas fa-upload"></i>
                                        <span>Upload</span>
                                    </div>
                                    <input type="file" id="logo-upload" accept="image/*" name="company_logo" hidden />
                                    <div class="upload-preview" style="display: none;">
                                        <img id="logo-preview" src="/placeholder.svg" alt="Logo Preview" />
                                    </div>
                                    <div class="upload-placeholder">
                                        <span>No image uploaded</span>
                                    </div>
                                    <button type="button" id="remove-logo-image" class="btn btn-edit">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="partnerName" class="form-label">Name of Brand/Company*</label>
                                <input type="text" class="form-control" id="partnerName" name="partner_name" placeholder="Enter Name" required>
                            </div>

                            <div class="mb-3">
                                <label for="partnerEmail" class="form-label">Company Email*</label>
                                <input type="email" class="form-control" id="partnerEmail" name="partner_email" placeholder="Enter Email Address" required>
                            </div>

                            <div class="mb-3">
                                <label for="partnerPhone" class="form-label">Company Phone Number</label>
                                <input type="text" class="form-control" id="partnerPhone" name="partner_phone" placeholder="Enter Phone Number">
                            </div>

                            
                            <div class="mb-3">
                                <label for="companyAddress" class="form-label">Company Address</label>
                                <input type="text" class="form-control" id="companyAddress" name="company_address" placeholder="Enter Address">
                            </div>

                            <div class="mb-3">
                                <label for="businessType" class="form-label">Business Type</label>
                                <select class="form-control" id="businessType" name="business_type">
                                    <option value="" disabled selected>Select Business Type</option>
                                    <option value="Technology">Technology</option>
                                    <option value="Finance">Finance</option>
                                    <option value="Healthcare">Healthcare</option>
                                    <option value="Retail">Retail</option>
                                    <option value="Education">Education</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="partnershipType" class="form-label">Partnership Type</label>
                                <select class="form-control" id="partnershipType" name="partnership_type">
                                    <option value="" disabled selected>Select Partnership Type</option>
                                    <option value="Sponsor">Sponsor</option>
                                    <option value="Collaborator">Collaborator</option>
                                    <option value="Service Provider">Service Provider</option>
                                    <option value="Investor">Investor</option>
                                </select>
                            </div>

                            

                            <div class="mb-3">
                                <label for="contactPerson" class="form-label">Point of Contact Name</label>
                                <input type="text" class="form-control" id="contactPerson" name="contact_person" placeholder="Enter Name">
                            </div>

                            <div class="mb-3">
                                <label for="contactRole" class="form-label">Point of Contact Role</label>
                                <input type="text" class="form-control" id="contactRole" name="contact_role" placeholder="Enter Role (e.g., CEO, Manager)">
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

        <div class="modal fade" id="partnerDetailsModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Partnership Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                    </div>
                    <div class="modal-body">
                        <div class="status-badge-container">
                            <span class="status-badge" id="detailsStatusBadge">Pending</span>
                        </div>
                        <div class="partner-info">
                            <div class="partner-photo">
                                <img src="../assets/images/includes/user1.svg" alt="Partner Logo" id="detailsLogo">
                            </div>
                            <div class="partner-details">
                                <div class="detail-item">
                                    <h6 class="detail-label">Company Name:</h6>
                                    <p class="detail-value" id="detailsName"></p>
                                </div>
                                <div class="detail-item">
                                    <h6 class="detail-label">Email:</h6>
                                    <p class="detail-value" id="detailsEmail"></p>
                                </div>
                                <div class="detail-item">
                                    <h6 class="detail-label">Phone:</h6>
                                    <p class="detail-value" id="detailsPhone"></p>
                                </div>
                                <div class="detail-item">
                                    <h6 class="detail-label">Address:</h6>
                                    <p class="detail-value" id="detailsAddress"></p>
                                </div>
                                <div class="detail-item">
                                    <h6 class="detail-label">Business Type:</h6>
                                    <p class="detail-value" id="detailsBusinessType"></p>
                                </div>
                                <div class="detail-item">
                                    <h6 class="detail-label">Partnership Type:</h6>
                                    <p class="detail-value" id="detailsPartnershipType"></p>
                                </div>
                                <div class="detail-item">
                                    <h6 class="detail-label">Contact Person:</h6>
                                    <p class="detail-value" id="detailsContactPerson"></p>
                                </div>
                                <div class="detail-item">
                                    <h6 class="detail-label">Contact Role:</h6>
                                    <p class="detail-value" id="detailsContactRole"></p>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="reason-section">
                            <h5>Reason for Partnering</h5>
                            <p id="detailsReason"></p>
                        </div> -->
                    </div>
                    <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-reject btn-danger" id="rejectBtn">Reject</button>
                        <button type="button" class="btn btn-approve btn-primary" id="approveBtn">Approve</button>
                    </div> -->
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

  <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/super-build/ckeditor.js"></script>
  <script>
     // Global variables
    let currentEventId = null;
    let currentEventName = null;
    let editEventEditor = null;
    let eventEditor; // Global variable to hold the editor instance


   $(document).ready(function () {
  let selectedFilter = "";

  $("#filterBtn").on("click", function () {
    $("#filterModal").modal("show");
  });

  $("#filterForm").on("submit", function (e) {
    e.preventDefault();
    selectedFilter = $("#partnershipTypeFilter").val();
    $('#partnersTable').DataTable().ajax.reload(); // Reload with new filter
    $("#filterModal").modal("hide");
  });

  $('#partnersTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
      url: 'partner_handler.php?action=fetch',
      type: 'GET',
      data: function (d) {
        // Inject filter into AJAX request
        d.partnership_type = selectedFilter;
      }
    },
    columns: [
      { data: 'serial' },
      { data: 'partner_name' },
      { data: 'partner_email' },
      { data: 'partner_phone' },
      { data: 'partnership_type' },
      {
        data: 'id',
        orderable: false,
        searchable: false,
        render: function (data, type, row, meta) {
          return `
            <div class='dropdown text-center'>
              <button class='action-button dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                <i class='fas fa-ellipsis-v'></i>
              </button>
              <ul class='dropdown-menu'>
                <li>
                  <a class='dropdown-item view-details-btn' href='#' data-bs-toggle='modal' data-bs-target='#volunteerDetailsModal' data-id='${data}'>View Details</a>
                </li>
                <li>
                  <a class='dropdown-item edit-partner' href='#' data-bs-toggle='modal' data-bs-target='#addVolunteerModal' data-id='${data}'>Edit Details</a>
                </li>
                <li>
                  <a class='dropdown-item text-danger delete-btn' href='#' data-id='${data}'>Delete Partner</a>
                </li>
              </ul>
            </div>
          `;
        }
      }
    ],
    dom: '<"row mb-3"<"col-md-4"l>>' +
      '<"row mb-3"<"col-md-6"B><"col-md-6 text-end"f>>' +
      'rt' +
      '<"row mt-3"<"col-md-5"i><"col-md-7"p>>',
    buttons: [
      { extend: 'copy', className: 'btn btn-primary btn-sm me-1' },
      { extend: 'csv', className: 'btn btn-secondary btn-sm me-1' },
      { extend: 'excel', className: 'btn btn-success btn-sm me-1' },
      { extend: 'pdf', className: 'btn btn-danger btn-sm me-1' },
      { extend: 'print', className: 'btn btn-dark btn-sm' }
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


  </script>
  
<script>
    $(document).ready(function () {
    $("#addPartnerForm").submit(function (e) {
        e.preventDefault();

        var formData = new FormData(this);
        formData.append("action", "save"); // Ensure action is included

        $.ajax({
            url: "partner_handler.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (response) {
                if (response.status === "success") {
                    showAlert(response.message, "success");
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    showAlert("Error: " + response.message, "error");
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", status, error);
                console.error("Response:", xhr.responseText);
                showAlert("An error occurred. Please check the console.", "error");
            }
        });
    });
});


    // Fetch and Prefill Data for Edit Mode
    $(document).on("click", ".edit-partner", function () {
    var partnerId = $(this).data("id");

    $.ajax({
        url: "partner_handler.php",
        type: "GET",
        data: { id: partnerId },
        dataType: "json",
        success: function (data) {
            if (data) {
                $("#partnerName").val(data.partner_name);
                $("#partnerEmail").val(data.partner_email);
                $("#partnerPhone").val(data.partner_phone);
                $("#companyAddress").val(data.company_address);
                $("#businessType").val(data.business_type);
                $("#partnershipType").val(data.partnership_type);
                $("#contactPerson").val(data.contact_person);
                $("#contactRole").val(data.contact_role);
                
                // Handle logo preview
                if (data.company_logo) {
                    $("#logo-preview").attr("src", data.company_logo).show();
                    $(".upload-placeholder").hide();
                    $(".upload-preview").show();
                     $("#existing_logo").val(data.company_logo);
                } else {
                    $("#logo-preview").attr("src", "/placeholder.svg").show();
                     $("#existing_logo").val(""); // Clear it just in case
                }

                // Remove any existing hidden input before appending
                $("input[name='partner_id']").remove();
                $("<input>").attr({
                    type: "hidden",
                    name: "partner_id",
                    value: data.id
                }).appendTo("#addPartnerForm");
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", status, error);
            console.error("Response:", xhr.responseText);
            showAlert("Error fetching partner details.", "error");
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


    
    

    // Delete partner
    $(document).on("click", ".delete-partner", function () {
        let partnerId = $(this).data("id");
        if (confirm("Are you sure you want to delete this partner?")) {
            $.ajax({
                url: "partner_handler.php",
                type: "POST",
                data: { action: "delete", id: partnerId },
                dataType: "json",
                success: function (response) {
                    if (response.status === "success") {
                        showAlert(response.message, "success");
                        fetchPartners(); // Reload table
                    } else {
                        showAlert(response.message, "error");
                    }
                },
                error: function () {
                    showAlert("An error occurred while deleting the partner.", "error");
                }
            });
        }
    });


$(document).on('click', '.view-details-btn', function () {
    let partnerId = $(this).data('id');
    $.ajax({
        url: 'partner_handler.php',
        type: 'GET',
        data: { id: partnerId },
        dataType: 'json',
        success: function (data) {
            if (data) {
                $('#detailsName').text(data.partner_name);
                $('#detailsEmail').text(data.partner_email);
                $('#detailsPhone').text(data.partner_phone);
                $('#detailsAddress').text(data.company_address);
                $('#detailsBusinessType').text(data.business_type);
                $('#detailsPartnershipType').text(data.partnership_type);
                $('#detailsContactPerson').text(data.contact_person);
                $('#detailsContactRole').text(data.contact_role);
                $('#detailsReason').text(data.reason_for_partnering || 'N/A');
                $('#detailsLogo').attr('src', data.company_logo ? data.company_logo : '../assets/images/includes/user1.svg');
                
                $('#partnerDetailsModal').modal('show');
            }
        },
        error: function () {
            alert('Failed to fetch partner details.');
        }
    });
});
$(document).ready(function () {
    let uploadArea = $("#uploadArea");
    let fileInput = $("#logo-upload");
    let previewContainer = $(".upload-preview");
    let previewImage = $("#logo-preview");
    let placeholder = $(".upload-placeholder");
    let removeButton = $("#remove-logo-image");

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

</script>
</body>

</html>