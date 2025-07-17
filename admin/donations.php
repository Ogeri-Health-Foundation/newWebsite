<?php
session_start();
?>
<?php

$page_title = "Donations - Ogeri Health Foundation";

$page_author = "Okibe";

$page_description = "";

$page_rel = '../';

$page_name = 'donations';

$customs = array(
    "stylesheets" => ["volunteer/assets/css/volunteers.css"],
    "scripts" => ["assets/js/donations.js"]
);

// $addons = array(
//             "stylesheets" => ["https://some-external-url.css"],
//             "scripts" => ["https://some-external-url.js"]
//            );

?>

<!DOCTYPE html>
<html lang="en">
  <head>
  <?php include $page_rel . 'admin/includes/admin-head.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>

  <script>


  

window.onload = function () {

  fetch("../api/v1/auth.php")
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
    <!-- header section -->
    <?php $page = 'Blog'; ?>
    <?php include $page_rel . 'admin/includes/topbar.php'; ?>

    <main>
      <div id="alertBox" class="alert-box"></div>
        <section
          class="container d-flex justify-content-between align-items-center"
        >
          <div class="">
            <h2 class="fw-bolder">Donations</h2>
            <p class="fw-bold text-secondary">List of donations</p>
          </div>
          <div>
            <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addDonationModal"">
              <i class="fas fa-plus""></i> Add donations
            </button>
          </div>
        </section>
        <!-- filter export section -->
        <section class="container pt-5 d-flex justify-content-end">
          <button class="btn don-export-btn">
            <i class="bs bi-file-earmark-fill"></i>
            Export
          </button>
          <button class="btn ms-3"><i class="bs bi-funnel-fill"></i> Filter</button>
        </section>
        <!-- table section -->
        <section class="container">
                <!-- Opportuity Table -->
                <div class="table-container">
                    <table class="table volunteers-table" id="donationTable">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Title</th>
                                <th>category</th>
                                <th>Amount to be Raised</th>
                                <th>Raised Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                
            </section>

            <section>

            </section>
        <!-- navigation section -->
        <section class="container d-flex justify-content-center pt-5">
        <div class="pagination"></div>
        </section>

        <section class="container">
          <div class="modal fade" id="addDonationModal" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title">Add Donation Event</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                      </div>
                      <div class="modal-body">
                          <form id="donationForm" enctype="multipart/form-data">
                            
                              <input type="hidden" id="event_id" name="event_id"> <!-- For edit functionality -->
                              <input type="hidden" id="existing_image" name="existing_image"> <!-- For keeping the old image -->

                              <!-- Image Upload -->
                              <div class="mb-3">
                                  <label class="form-label">Add a Banner Image</label>
                                  <div class="upload-container" id="banner-upload-container">
                                      <div class="upload-area" id="uploadArea">
                                          <i class="fas fa-upload"></i>
                                          <span>Upload</span>
                                      </div>
                                      <input type="file" id="banner-upload" accept="image/*" name="banner_image" hidden />
                                      <div class="upload-preview" style="display: none;">
                                          <img id="banner-preview" src="/placeholder.svg" alt="Banner Preview" />
                                      </div>
                                      <div class="upload-placeholder">
                                          <span>No image uploaded</span>
                                      </div>
                                      <button type="button" id="remove-banner-image" class="btn btn-edit">
                                        <i class="fa-solid fa-trash"></i>
                                      </button>
                                  </div>
                              </div>

                              <!-- Title -->
                              <div class="mb-3">
                                  <label for="donationTitle" class="form-label">Title</label>
                                  <input type="text" class="form-control" id="donationTitle" placeholder="Enter Title" name="title" required>
                              </div>

                              <!-- Category -->
                              <div class="mb-3">
                                  <label for="donationCategory" class="form-label">Category</label>
                                  <input type="text" class="form-control" id="donationCategory" placeholder="Enter Category" name="category" required>
                              </div>

                              <!-- Goal Amount -->
                              <div class="mb-3">
                                  <label for="goalAmount" class="form-label">Goal Amount</label>
                                  <input type="number" class="form-control" id="goalAmount" placeholder="Enter Goal Amount" name="amount_goal" required>
                              </div>

                              <!-- Short Description -->
                              <div class="mb-3">
                                  <label for="shortDesc" class="form-label">Short Description</label>
                                  <textarea class="form-control text-area" name="short_desc" id="shortDesc" rows="3"></textarea>
                              </div>

                              <!-- Full Description -->
                              <div class="mb-3">
                                  <label for="body" class="form-label">Full Description</label>
                                  <textarea class="form-control text-area" name="body" id="body" rows="6"></textarea>
                              </div>

                              <div class="modal-footer">
                                  <button type="button" class="btn btn-cancel btn-outline" data-bs-dismiss="modal">Cancel</button>
                                  <button type="submit" class="btn btn-onboard btn-primary" id="onboardBtn">Add Donation Event</button>
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </section>

      <section class="container">
          <!-- Donation Details Modal -->
          <div class="modal fade" id="donationDetailsModal" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h5 class="modal-title">Donation Details</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                      </div>
                      <div class="modal-body">
                          <input type="hidden" id="donationId">
                          <div class="status-badge-container">
                              <span class="status-badge" id="detailsStatusBadges"></span>
                          </div>
                          
                          <div class="donation-info">
                              <div class="donation-photo" id="donationImg">
                                  <img src="../assets/images/includes/donation.svg" alt="Donation Image" id="detailsImages">
                              </div>
                              <div class="donation-details mt-5">
                                  <div class="detail-item">
                                      <h6 class="detail-label">Title:</h6>
                                      <p class="detail-value" id="donationTitles"></p>
                                  </div>
                                  <div class="detail-item">
                                      <h6 class="detail-label">Category:</h6>
                                      <p class="detail-value" id="donationCategorys"></p>
                                  </div>
                                  <div class="detail-item">
                                      <h6 class="detail-label">Description</h6>
                                      <p class="detail-value" id="short"></p>
                                  </div>
                                  <div class="detail-item">
                                      <h6 class="detail-label">Goal Amount:</h6>
                                      <p class="detail-value" id="goalAmounts"></p>
                                  </div>
                              </div>
                          </div>
                          
                          <div class="reason-section">
                              <h5>Body</h5>
                              <p id="descriptions"></p>
                          </div>
                      </div>
                      <hr>
                      <div class="" style="text-align: left;">
                          <div id="donorsList"></div>
                      </div>
                  </div>
              </div>
          </div>
      </section>


    </main>


    <?php include $page_rel . 'admin/includes/sidebar.php'; ?>

    <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   
    <script>
      $(document).ready(function () {
        let uploadArea = $("#uploadArea");
        let fileInput = $("#banner-upload");
        let previewContainer = $(".upload-preview");
        let previewImage = $("#banner-preview");
        let placeholder = $(".upload-placeholder");
        let removeButton = $("#remove-banner-image");   


    
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
    $("#donationForm").submit(function (e) {
        e.preventDefault(); // Prevent form from reloading page

        let formData = new FormData(this); // Collect form data, including files

        $.ajax({
            url: "donation-backend.php", // Single backend script
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json", 
            success: function (response) {
                showAlert(response.message, response.success ? "success" : "error");
                    if (response.success) {
                        setTimeout(() => location.reload(), 2000);
                    } else {
                    showAlert("Error: " + response.message, "error");
                }
            },
            error: function (xhr, status, error) {
              console.error("AJAX Error:", status, error);
              showAlert("Error fetching donation details: " + error, "error");
          }
        });
    });
  });

    // Populate form when editing
   
    function editDonation(id) {
    let uploadArea = $("#uploadArea");
    let fileInput = $("#banner-upload");
    let previewContainer = $(".upload-preview");
    let previewImage = $("#banner-preview");
    let placeholder = $(".upload-placeholder");
    let removeButton = $("#remove-banner-image");

    $.ajax({
        url: "donation-backend.php?action=get&id=" + id,
        type: "GET",
        dataType: "json",
        success: function (data) {
            console.log("Editing Donation Event:", data);
            if (!data || !data.id) {
                console.error("Error: Donation data is undefined or missing ID.");
                return;
            }

            // Populate Form Fields
            $("#event_id").val(data.id);
            $("#donationTitle").val(data.title);
            $("#donationCategory").val(data.category);
            $("#goalAmount").val(data.goal_amount);
            $("#existing_image").val(data.banner_image);
            $("textarea[name='short_desc']").val(data.short_description);
            $("textarea[name='body']").val(data.full_description);

            // Handle Image Display
            if (data.banner_image) {
                previewImage.attr("src", data.banner_image);
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
            console.error("Error fetching donation event:", xhr.responseText);
        }
    });
}

// Event Listener for Edit Button Click
$(document).on("click", ".edit-btn", function () {
    let id = $(this).data("id");
    editDonation(id);
});

    $(document).ready(function () {
        let currentPage = 1;
        let limit = 10; // Adjust items per page
    function loadDonations(page = 1) {
        $.ajax({
            url: `donation-backend.php?action=fetch&page=${page}&limit=${limit}`,
            type: "GET",
            dataType: "json", // Ensures response is parsed automatically
            success: function (data) {
                let donations = data.donations;
                console.log("Parsed Donations:", donations);

                if (!Array.isArray(donations)) {
                    console.error("Unexpected response format:", donations);
                    return;
                }
                if (data.status === "error") {
                console.error("Error from server:", data.message);
                return;
            }
            if (!data.donations || data.donations.length === 0) {
                $("#donationTable tbody").html("<tr><td colspan='5'>No Donations found.</td></tr>");
                return;
            }

                let html = "";
                donations.forEach((donation, index) => {
                    html += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${donation.title}</td>
                            <td>${donation.category}</td>
                            <td>${Number(donation.goal_amount).toLocaleString()}</td>
                            <td>${Number(donation.amount_raised).toLocaleString()}</td>
                          
                            <td class="${
                                donation.status === 'ongoing' ? 'status-pending' :
                                donation.status === 'completed' ? 'status-approved' :
                                ''
                            }" style='text-transform: uppercase;'>${donation.status}</td>

                            <td class='text-center'>
                                <div class='dropdown'>
                                    <button class='action-button dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                        <i class='fas fa-ellipsis-v'></i>
                                    </button>
                                    <ul class='dropdown-menu'>
                                        <li>
                                            <a class='dropdown-item view-details-btn' href='#' 
                                            data-bs-toggle='modal' data-bs-target='#donationDetailsModal'
                                            data-id='${donation.id}'>
                                            View Details
                                            </a>
                                        </li>
                                        <li>
                                            <a class='dropdown-item edit-btn' href='#' 
                                            data-bs-toggle='modal' data-bs-target='#addDonationModal'
                                            data-id='${donation.id}'>
                                            Edit Details
                                            </a>
                                        </li>
                                        <li>
                                            <a class='dropdown-item text-danger delete-btn' href='#' 
                                            data-id='${donation.id}'>
                                            Delete Donation
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>`;
                });

                $("#donationTable tbody").html(html);
                updatePagination(data.totalPages, data.currentPage);
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", status, error, "\nResponse:", xhr.responseText);
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
        loadDonations(currentPage);
    });

    $(document).on("click", "#prevPageBtn", function () {
        if (currentPage > 1) {
            loadDonations(--currentPage);
        }
    });

    $(document).on("click", "#nextPageBtn", function () {
        loadDonations(++currentPage);
    });


    // Load donations when page is ready
    loadDonations();
});

    // Handle View Details Click
   $(document).on("click", ".view-details-btn", function () {
    let donationId = $(this).data("id");
    console.log("Selected Donation ID:", donationId);

    $.ajax({
        url: "donation-backend.php?action=get&id=" + donationId,
        type: "GET",
        dataType: "json", 
        success: function (donation) {
            console.log("Donation Details:", donation);

            // Set event details
            $("#donationId").val(donation.id);
            $("#donationTitles").text(donation.title);
            $("#donationCategorys").text(donation.category);
            $("#goalAmounts").text(Number(donation.goal_amount).toLocaleString());
            $("#descriptions").text(donation.full_description);
            $("#short").text(donation.short_description);

            let imageUrl = donation.banner_image ? donation.banner_image : "../assets/images/includes/donation.svg";
            $("#detailsImages").attr("src", imageUrl);

            let statusClass = donation.status === "ongoing" ? "status-pending" : 
                              donation.status === "completed" ? "status-approved" : "";
            $("#detailsStatusBadges").removeClass().addClass("status-badge " + statusClass).text(donation.status);

           // Handle Donors List
            let donorsList = $("#donorsList"); // Ensure you have a div or ul with this ID in the modal
            donorsList.empty(); // Clear existing list

            if (donation.donors.length > 0) {
                let count = 1; // Initialize counter before looping

                let donorItems = `<div class="recent-post">
                    <h3 class="widget_title">Donors</h3>`;

                donation.donors.forEach(function (donor) {
                    donorItems += `
                        <div class="media-body d-flex align-items-center" style="font-size: 18px;">
                            <p style="margin-right: 8px; font-weight: bold;">${count}.</p> <!-- Numbering -->
                            <p class="post-title" style="font-weight: bold;">${donor.donor_name} :</p>
                            <div class="recent-post-meta">
                                <p style="margin-left: 5px;">${donor.currency} ${Number(donor.amount).toLocaleString()}</p>
                            </div>
                        </div>`;
                    count++; // Increment counter
                });

                donorItems += `</div>`; // Close the donor list div
                donorsList.append(donorItems); // Append to modal
            } else {
                donorsList.append(`<p style="font-size: 18px; font-weight: bold;">No donors yet.</p>`);
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", status, error);
            console.error("Response:", xhr.responseText);
        }
    });
});




    // Delete Opportunity
    $(document).on('click', '.delete-btn', function () {
        let id = $(this).data('id');
        if (confirm("Are you sure?")) {
            $.ajax({
                url: `donation-backend.php?action=delete&id=${id}`,
                type: "GET", // Changed from DELETE to GET
                success: function () {
                    showAlert("Deleted");
                    loadOpportunities();
                }
            });
        }
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
<!-- view details modal -->

