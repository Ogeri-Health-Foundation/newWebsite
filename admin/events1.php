<?php
session_start();
?>
<?php

$page_title = "Events - Admin- Ogeri Health Foundation";

$page_author = "Olayinka!";

$page_description = "";

$page_rel = '../';

$page_name = 'admin';

$customs = array(
  "stylesheets" => ["admin/assets/css/events.css"],
  "scripts" => ["admin/assets/js/events.js"]
);

$addons = array(
  "stylesheets" => ["https://some-external-url.css"],
  "scripts" => ["https://some-external-url.js"]
);

?>
<!DOCTYPE html>
<html>

<head>
  <script>
    // window.onload = function() {

    //   fetch("https://ogerihealth.org/api/v1/auth.php")
    //     .then(async response => {
    //       const data = await response.json();

    //       if (!response.ok) {
    //         if (data.message === "Unauthorized") {
    //           location.href = "../admin/login.php";
    //         }
    //         throw new Error(data.message || "Network response was not ok");
    //       }

    //       console.log("Auth Data:", data);
    //       return data;
    //     })
    //     .catch(error => {
    //       console.error("Fetch error:", error);
    //     });


    // };
  </script>

  <?php include $page_rel . 'include/head.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>
<style>
  .upload-box {
    /* border: 2px dashed #ccc; */
    padding: 20px;
    cursor: pointer;
    width: 100%;
    height: 150px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: transparent;

  }

  .upload-box img {
    max-height: 100%;
    max-width: 100%;
    object-fit: cover;

  }

  #toast-success {
    position: fixed;
    bottom: -100px;
    left: 50%;
    transform: translateX(-50%);
    background: white;
    color: #4a5568;
    z-index: 9999;
    display: flex;
    align-items: center;
    width: 300px;
    max-width: auto;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    transition: bottom 0.5s ease;
  }

  .show {
    bottom: 20px !important;
  }

  .icon {
    width: 26px;
    height: 26px;
    background: #d1fae5;
    color: #10b981;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    margin-right: 10px;
  }

  .close-btn {
    background: none;
    border: none;
    cursor: pointer;
    color: #6b7280;
    font-size: 20px;
    margin-left: 5px;
  }




  #bad-toast {
    position: fixed;
    bottom: -100px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 9999;
    background: white;
    color: #4a5568;
    display: flex;
    align-items: center;
    width: auto;
    max-width: auto;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    transition: bottom 0.5s ease;
  }

  .bad-show {
    bottom: 20px !important;
  }

  .bad-icon {
    width: 26px;
    height: 26px;
    background: rgb(250, 209, 209);
    color: rgb(185, 16, 16);
    display: flex;
    align-items: center;
    font-family: Arial, Helvetica, sans-serif;
    font-weight: 600;
    justify-content: center;
    border-radius: 50%;
    margin-right: 10px;
  }
</style>

<style>
  .image-upload-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin: 20px 0;
  }

  .image-upload-container .upload-box {
    border: 2px dashed #ccc;
    width: 200px;
    height: 200px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    position: relative;
    border-radius: 8px;
    background-color: #f9f9f9;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .upload-box:hover {
    border-color: #888;
  }

  .file-input {
    opacity: 0;
    position: absolute;
    width: 100%;
    height: 100%;
    cursor: pointer;
    z-index: 2;
  }

  .upload-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 15px;
  }

  .upload-icon {
    margin-bottom: 10px;
  }

  .upload-text {
    font-size: 14px;
    color: #666;
    text-align: center;
  }

  .upload-subtext {
    font-size: 12px;
    color: #888;
  }

  .image-preview {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: none;
    border-radius: 8px;
    overflow: hidden;
  }

  .image-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .remove-btn {
    position: absolute;
    top: 5px;
    right: 5px;
    background: rgba(255, 255, 255, 0.7);
    border: none;
    border-radius: 50%;
    width: 25px;
    height: 25px;
    z-index: 99999;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.3s ease;
  }

  .remove-btn:hover {
    background: rgba(255, 255, 255, 0.9);
  }

  /* Show the preview when an image is selected */
  .has-image .image-preview {
    display: block;
  }

  .has-image .upload-content {
    display: none;
  }
</style>



<!-- JavaScript for image preview functionality -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Set up event listeners for all file inputs
    for (let i = 1; i <= 4; i++) {
      const fileInput = document.getElementById('imageUpload' + i);
      fileInput.addEventListener('change', function(e) {
        displayUploadedImagee(e.target, i);
      });

      // Setup drag and drop
      const uploadBox = fileInput.parentElement;
      uploadBox.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.style.borderColor = '#888';
      });

      uploadBox.addEventListener('dragleave', function(e) {
        e.preventDefault();
        this.style.borderColor = '#ccc';
      });

      uploadBox.addEventListener('drop', function(e) {
        e.preventDefault();
        this.style.borderColor = '#ccc';
        const files = e.dataTransfer.files;
        if (files.length) {
          fileInput.files = files;
          displayUploadedImage(fileInput, i);
        }
      });
    }
  });

  function displayUploadedImagee(input, boxNum) {
    const preview = document.getElementById('imagePreview' + boxNum);
    const uploadBox = input.parentElement;

    if (input.files && input.files[0]) {
      const reader = new FileReader();

      reader.onload = function(e) {
        const previewImg = preview.querySelector('img');
        previewImg.src = e.target.result;
        uploadBox.classList.add('has-image');
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  function removeUploadedImagee(boxNum) {
    const fileInput = document.getElementById('imageUpload' + boxNum);
    const preview = document.getElementById('imagePreview' + boxNum);
    const uploadBox = fileInput.parentElement;

    fileInput.value = '';
    preview.querySelector('img').src = '';
    uploadBox.classList.remove('has-image');

    event.stopPropagation();
  }
</script>







































<script>
  document.addEventListener('DOMContentLoaded', function() {

    for (let i = 1; i <= 6; i++) {
      const fileInput = document.getElementById('imageUpload_' + i);
      fileInput.addEventListener('change', function(e) {
        displayUploadedImage(e.target, i);
      });

      // Setup drag and drop
      const uploadBox = fileInput.parentElement;
      uploadBox.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.style.borderColor = '#888';
      });

      uploadBox.addEventListener('dragleave', function(e) {
        e.preventDefault();
        this.style.borderColor = '#ccc';
      });

      uploadBox.addEventListener('drop', function(e) {
        e.preventDefault();
        this.style.borderColor = '#ccc';
        const files = e.dataTransfer.files;
        if (files.length) {
          fileInput.files = files;
          displayUploadedImage(fileInput, i);
        }
      });
    }
  });

  // New function name to avoid conflicts
  function displayUploadedImage(input, boxNum) {
    const preview = document.getElementById('imagePreview_' + boxNum);
    const uploadBox = input.parentElement;

    if (input.files && input.files[0]) {
      const reader = new FileReader();

      reader.onload = function(e) {
        const previewImg = preview.querySelector('img');
        previewImg.src = e.target.result;
        uploadBox.classList.add('has-image');
      }

      reader.readAsDataURL(input.files[0]);
    }
  }

  function removeUploadedImage(boxNum) {
    const fileInput = document.getElementById('imageUpload_' + boxNum);
    const preview = document.getElementById('imagePreview_' + boxNum);
    const uploadBox = fileInput.parentElement;

    fileInput.value = '';
    preview.querySelector('img').src = '';
    uploadBox.classList.remove('has-image');

    event.stopPropagation();
  }
</script>

<body>

  <?php include $page_rel . 'admin/includes/topbar.php'; ?>

  <main>

    <div id="toast-success">
      <div class="icon">✔</div>
      <div id="toast-message">login success</div>
      <button class="close-btn" onclick="hideToast()">&times;</button>
    </div>

    <div id="bad-toast">
      <div class="bad-icon"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="13" height="13">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg></div>
      <div id="bad-toast-message">login not successful</div>
      <button class="close-btn" onclick="hideToast()">&times;</button>
    </div>



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
              <h2 class="content-title">Events!</h2>
              <p class="content-subtitle">List of Events</p>
            </div>
            <button class="btn btn-add" id="addVolunteerBtn">
              <i class="fas fa-plus"></i> Add Events
            </button>
          </div>

          <!-- Action Buttons -->
          <div class="action-buttons">
            <button class="btn btn-export" id="exportBtn">
              <i class="fas fa-file-export"></i> Export
            </button>
            <button class="btn btn-filter" id="filterBtn">
              <i class="fas fa-filter"></i> Filter
            </button>
          </div>

          <!-- Volunteers Table -->
          <div class="table-container position-relative table-responsive">
            <table class="volunteers-table" id="volunteersTable">
              <thead>
                <tr>
                  <th class='text-nowrap text-center'>S/N</th>
                  <th class='text-nowrap text-center'>Title</th>
                  <th class='text-nowrap text-center'>Date</th>
                  <th class='text-nowrap text-center'>Time</th>
                  <th class="text-nowrap text-center">Description</th>
                  <th class="text-nowrap text-center">Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="volunteers-table-body">
                <!-- Table content will be added dynamically -->
              </tbody>
            </table>
          </div>

          <!-- Pagination -->
          <div class="pagination">
            <button class="btn btn-prev" id="prevPageBtn">
              <i class="fas fa-chevron-left"></i> Previous
            </button>
            <div class="page-numbers d-flex gap-2">
              <button class="btn btn-page active">1</button>
              <button class="btn btn-page">2</button>
              <button class="btn btn-page">3</button>
              <span>...</span>
              <button class="btn btn-page">67</button>
              <button class="btn btn-page">68</button>
            </div>
            <button class="btn btn-next" id="nextPageBtn">
              Next <i class="fas fa-chevron-right"></i>
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Add Volunteer Modal -->
    <div class="modal fade" id="addVolunteerModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" style="display:flex; justify-content:center;">
        <div class="modal-content" style="background-color: #fff;">
          <div class="modal-header">
            <h5 class="modal-title">Onboard Events</h5>
            <svg xmlns="http://www.w3.org/2000/svg" class="btn-close" data-bs-dismiss="modal" aria-label="Close" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="13" height="13">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </div>
          <div class="modal-body">
            <form method="POST" id="addVolunteerForm" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="volunteerTitle" class="form-label">Title*</label>
                <input type="text" name="Title" class="form-control" id="volunteerTitle" placeholder="Enter Title"
                  required>
              </div>
              <div class="mb-3">
                <label class="form-label">Event Banner</label>
                <div class="upload-container">
                  <div class="upload-box text-center" id="uploadArea" onclick="document.getElementById('cover_image').click();">
                    <input type="file" id="cover_image" name="cover_image" accept="image/*" hidden onchange="previewImage(event)">
                    <img id="preview" src="<?php echo isset($post['image']) ? 'uploads/' . $post['image'] : 'assets/images/upload-placeholder.svg'; ?>" alt="Upload Image">

                  </div>
                  <button type="button" class="btn btn-edit">
                    <i class="fas fa-pencil-alt"></i>
                  </button>
                </div>
              </div>

              <div class="mb-3">
                <label for="volunteerLocation" class="form-label">Location*</label>
                <input type="text" name="volunteerLocation" class="form-control" id="volunteerLocation" placeholder="Enter Location"
                  required>
              </div>
              <div class="mb-3">
                <label for="volunteerTime" class="form-label">Time*</label>
                <input type="time" name="volunteerTime" class="form-control" id="volunteerTime"
                  required>
              </div>
              <div class="mb-3">
                <label for="volunteerDate" class="form-label">Date*</label>
                <input type="date" name="volunteerDate" class="form-control" id="volunteerDate"
                  required>
              </div>
              <div class="mb-3">
                <label for="volunteerDescription" class="form-label">Description*</label>
                <input type="text" name="volunteerDescription" class="form-control" id="volunteerDescription" placeholder="Enter Description"
                  required>
              </div>



              <div class="image-upload-container">
                <!-- Upload Box 1 -->
                <div class="upload-box">
                  <input type="file" name="event_image1" id="imageUpload1" accept="image/*" class="file-input">
                  <div class="upload-content">
                    <div class="upload-icon">
                      <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#888" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="17 8 12 3 7 8"></polyline>
                        <line x1="12" y1="3" x2="12" y2="15"></line>
                      </svg>
                    </div>
                    <div class="upload-text">
                      Upload Image 1<br><span class="upload-subtext">Click or drag & drop</span>
                    </div>
                  </div>
                  <div class="image-preview" id="imagePreview1">
                    <img src="" alt="Preview">
                    <button type="button" class="remove-btn" onclick="removeUploadedImagee(1)">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ff4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                      </svg>
                    </button>
                  </div>
                </div>

                <!-- Upload Box 2 -->
                <div class="upload-box">
                  <input type="file" name="event_image2" id="imageUpload2" accept="image/*" class="file-input">
                  <div class="upload-content">
                    <div class="upload-icon">
                      <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#888" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="17 8 12 3 7 8"></polyline>
                        <line x1="12" y1="3" x2="12" y2="15"></line>
                      </svg>
                    </div>
                    <div class="upload-text">
                      Upload Image 2<br><span class="upload-subtext">Click or drag & drop</span>
                    </div>
                  </div>
                  <div class="image-preview" id="imagePreview2">
                    <img src="" alt="Preview">
                    <button type="button" class="remove-btn" onclick="removeUploadedImagee(2)">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ff4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                      </svg>
                    </button>
                  </div>
                </div>

                <!-- Upload Box 3 -->
                <div class="upload-box">
                  <input type="file" name="event_image3" id="imageUpload3" accept="image/*" class="file-input">
                  <div class="upload-content">
                    <div class="upload-icon">
                      <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#888" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="17 8 12 3 7 8"></polyline>
                        <line x1="12" y1="3" x2="12" y2="15"></line>
                      </svg>
                    </div>
                    <div class="upload-text">
                      Upload Image 3<br><span class="upload-subtext">Click or drag & drop</span>
                    </div>
                  </div>
                  <div class="image-preview" id="imagePreview3">
                    <img src="" alt="Preview">
                    <button type="button" class="remove-btn" onclick="removeUploadedImagee(3)">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ff4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                      </svg>
                    </button>
                  </div>
                </div>

                <!-- Upload Box 4 -->
                <div class="upload-box">
                  <input type="file" name="event_image4" id="imageUpload4" accept="image/*" class="file-input">
                  <div class="upload-content">
                    <div class="upload-icon">
                      <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#888" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="17 8 12 3 7 8"></polyline>
                        <line x1="12" y1="3" x2="12" y2="15"></line>
                      </svg>
                    </div>
                    <div class="upload-text">
                      Upload Image 4<br><span class="upload-subtext">Click or drag & drop</span>
                    </div>
                  </div>
                  <div class="image-preview" id="imagePreview4">
                    <img src="" alt="Preview">
                    <button type="button" class="remove-btn" onclick="removeUploadedImagee(4)">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ff4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                      </svg>
                    </button>
                  </div>
                </div>
              </div>

              <label for="volunteerBody" class="form-label">Body*</label>
              <textarea class="form-control text-areaa" id="volunteerBody" name="volunteerBody" row="10">

                           </textarea>
              <div class="mb-3" style="margin-top: 10px;">
                <label for="volunteerStatus" class="form-label">Status*</label>
                <select class="form-select" name="volunteerStatus" id="volunteerStatus">
                  <option value="" selected>Select Event Status</option>
                  <option value="completed">Completed</option>
                  <option value="upcoming">Upcoming</option>

                </select>
              </div>




            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-cancel btn-outline" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-onboard btn-primary" id="onboardBtn">Onboard</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Volunteer Details Modal -->
    <div class="modal fade" id="volunteerDetailsModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" style="display:flex; justify-content:center;">
        <div class="modal-content" style='background-color: #fff;'>
          <div class="modal-header">
            <h5 class="modal-title">Event Details</h5>
            <svg xmlns="http://www.w3.org/2000/svg" class="btn-close" data-bs-dismiss="modal" aria-label="Close" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="13" height="13">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </div>
          <div class="modal-body">
            <div class="status-badge-container">
              <span class="status-badge" id="detailsStatusBadge">Pending</span>
            </div>
            <div class="volunteer-info">
              <div class="volunteer-photo">
                <img src="../assets/images/includes/user1.svg" id="detailsImage">
              </div>
              <div class="volunteer-details">
                <div class="detail-item">
                  <h6 class="detail-label">Event title:</h6>
                  <p class="detail-value" id="detailsTitle"></p>
                </div>
                <div class="detail-item">
                  <h6 class="detail-label">Date:</h6>
                  <p class="detail-value" id="detailsDate"></p>
                </div>
                <div class="detail-item">
                  <h6 class="detail-label">Time:</h6>
                  <p class="detail-value" id="detailsTime"></p>
                </div>
                <div class="detail-item">
                  <h6 class="detail-label">Location:</h6>
                  <p class="detail-value" id="detailsLocation"></p>
                </div>
                <div class="detail-item">
                  <h6 class="detail-label">Description:</h6>
                  <p class="detail-value" id="detailsDescription"></p>
                </div>

              </div>
            </div>

            <!-- <div class="detail-item">
                            <h5>Reason for Vountering</h5>
                            
                                <p id="detailsComment"></p>
                            
                        </div> -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-reject btn-danger" id="rejectBtn">Reject</button>
            <button type="button" class="btn btn-approve btn-primary" id="approveBtn">Approve</button>
          </div>
        </div>
      </div>
    </div>







    <!-- updating event  -->

    <div class="modal fade" id="volunteerUpdateModal" tabindex="-1" aria-labelledby="volunteerUpdateModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- Centered & large width -->
        <div class="modal-content">
          <form id="image-form" method="POST" enctype="multipart/form-data" action="update_event.php">
            <input type="hidden" name="event_id" id="event_id">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="volunteerUpdateModalLabel">Update Event</h5>
                <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body add-border-blue" style="max-height: 70vh; overflow-y: auto; padding: 20px;"></div>
              <label for="">Upload Images From the events that just conclude</label>
              <div class="image-upload-container">
                <!-- Upload Box 1 -->
                <div class="upload-box">
                  <input type="file" name="event_image1" id="imageUpload_1" accept="image/*" class="file-input">
                  <div class="upload-content">
                    <div class="upload-icon">
                      <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#888" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="17 8 12 3 7 8"></polyline>
                        <line x1="12" y1="3" x2="12" y2="15"></line>
                      </svg>
                    </div>
                    <div class="upload-text">
                      Upload Image 1<br><span class="upload-subtext">Click or drag & drop</span>
                    </div>
                  </div>
                  <div class="image-preview" id="imagePreview_1">
                    <img src="" alt="Preview">
                    <button type="button" class="remove-btn" onclick="removeUploadedImage(1)">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ff4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                      </svg>
                    </button>
                  </div>
                </div>

                <!-- Upload Box 2 -->
                <div class="upload-box">
                  <input type="file" name="event_image2" id="imageUpload_2" accept="image/*" class="file-input">
                  <div class="upload-content">
                    <div class="upload-icon">
                      <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#888" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="17 8 12 3 7 8"></polyline>
                        <line x1="12" y1="3" x2="12" y2="15"></line>
                      </svg>
                    </div>
                    <div class="upload-text">
                      Upload Image 2<br><span class="upload-subtext">Click or drag & drop</span>
                    </div>
                  </div>
                  <div class="image-preview" id="imagePreview_2">
                    <img src="" alt="Preview">
                    <button type="button" class="remove-btn" onclick="removeUploadedImage(2)">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ff4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                      </svg>
                    </button>
                  </div>
                </div>

                <!-- Upload Box 3 -->
                <div class="upload-box">
                  <input type="file" name="event_image3" id="imageUpload_3" accept="image/*" class="file-input">
                  <div class="upload-content">
                    <div class="upload-icon">
                      <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#888" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="17 8 12 3 7 8"></polyline>
                        <line x1="12" y1="3" x2="12" y2="15"></line>
                      </svg>
                    </div>
                    <div class="upload-text">
                      Upload Image 3<br><span class="upload-subtext">Click or drag & drop</span>
                    </div>
                  </div>
                  <div class="image-preview" id="imagePreview_3">
                    <img src="" alt="Preview">
                    <button type="button" class="remove-btn" onclick="removeUploadedImage(3)">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ff4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                      </svg>
                    </button>
                  </div>
                </div>

                <!-- Upload Box 4 -->
                <div class="upload-box">
                  <input type="file" name="event_image4" id="imageUpload_4" accept="image/*" class="file-input">
                  <div class="upload-content">
                    <div class="upload-icon">
                      <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#888" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="17 8 12 3 7 8"></polyline>
                        <line x1="12" y1="3" x2="12" y2="15"></line>
                      </svg>
                    </div>
                    <div class="upload-text">
                      Upload Image 4<br><span class="upload-subtext">Click or drag & drop</span>
                    </div>
                  </div>
                  <div class="image-preview" id="imagePreview_4">
                    <img src="" alt="Preview">
                    <button type="button" class="remove-btn" onclick="removeUploadedImage(4)">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ff4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                      </svg>
                    </button>
                  </div>
                </div>


                <div class="upload-box">
                  <input type="file" name="event_image5" id="imageUpload_5" accept="image/*" class="file-input">
                  <div class="upload-content">
                    <div class="upload-icon">
                      <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#888" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="17 8 12 3 7 8"></polyline>
                        <line x1="12" y1="3" x2="12" y2="15"></line>
                      </svg>
                    </div>
                    <div class="upload-text">
                      Upload Image 5<br><span class="upload-subtext">Click or drag & drop</span>
                    </div>
                  </div>
                  <div class="image-preview" id="imagePreview_5">
                    <img src="" alt="Preview">
                    <button type="button" class="remove-btn" onclick="removeUploadedImage(5)">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ff4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                      </svg>
                    </button>
                  </div>
                </div>





                <div class="upload-box">
                  <input type="file" name="event_image6" id="imageUpload_6" accept="image/*" class="file-input">
                  <div class="upload-content">
                    <div class="upload-icon">
                      <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#888" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="17 8 12 3 7 8"></polyline>
                        <line x1="12" y1="3" x2="12" y2="15"></line>
                      </svg>
                    </div>
                    <div class="upload-text">
                      Upload Image 6<br><span class="upload-subtext">Click or drag & drop</span>
                    </div>
                  </div>
                  <div class="image-preview" id="imagePreview_6">
                    <img src="" alt="Preview">
                    <button type="button" class="remove-btn" onclick="removeUploadedImage(6)">
                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#ff4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                      </svg>
                    </button>
                  </div>

                </div>
              </div>
              <div class="mt-4">
                <h2>More Details of the event</h2>
                <div class="container">
                  <div class="row mb-3">
                    <div class="col-md-6">
                      <label for="totalAttendees" class="form-label">Total number of attendees at community outreaches</label>
                      <input type="number" class="form-control" id="totalAttendees" name="total_attendees">
                    </div>
                    <div class="col-md-6">
                      <label for="bpScreened" class="form-label">Number of people screened for blood pressure</label>
                      <input type="number" class="form-control" id="bpScreened" name="bp_screened">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-6">
                      <label for="highBpDetected" class="form-label">Number of people with high blood pressure detected</label>
                      <input type="number" class="form-control" id="highBpDetected" name="high_bp_detected">
                    </div>
                    <div class="col-md-6">
                      <label for="repeatAttendees" class="form-label">Number of repeat attendees / follow-up visits</label>
                      <input type="number" class="form-control" id="repeatAttendees" name="repeat_attendees">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-6">
                      <label for="counselled" class="form-label">Number of people counselled on lifestyle changes</label>
                      <input type="number" class="form-control" id="counselled" name="counselled">
                    </div>
                    <div class="col-md-6">
                      <label for="medicationsDispensed" class="form-label">Number of medications dispensed</label>
                      <input type="number" class="form-control" id="medicationsDispensed" name="medications_dispensed">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-6">
                      <label for="referrals" class="form-label">Number of referrals made to health centres/hospitals</label>
                      <input type="number" class="form-control" id="referrals" name="referrals">
                    </div>
                    <div class="col-md-6">
                      <label for="avgAge" class="form-label">Average age of attendees (optional)</label>
                      <input type="number" class="form-control" id="avgAge" name="average_age">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-6">
                      <label for="genderMale" class="form-label">Number of Male attendees</label>
                      <input type="number" class="form-control" id="genderMale" name="gender_male">
                    </div>
                    <div class="col-md-6">
                      <label for="genderFemale" class="form-label">Number of Female attendees</label>
                      <input type="number" class="form-control" id="genderFemale" name="gender_female">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <div class="col-md-6">
                      <label for="villagesServed" class="form-label">Number of villages/communities served</label>
                      <input type="number" class="form-control" id="villagesServed" name="villages_served">
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <div class="form-actions">
            <button type="submit" class="btn btn-primary">Upload</button>
          </div>
        </div>

      </div>
      </form>
    </div>
    </div>
    </div>










    <!-- edit  event -->
    <div class="modal" id="add-volunteer-modal">
      <div class="modal-content">
        <h2>Onboard Volunteers</h2>
        <form id="add-volunteer-form" method="POST" enctype="multipart/form-data">


          <div class="form-group">
            <label for="volunteer-title">Title<span class="reqd">*</span></label>
            <input type="text" id="volunteer-title" name="volunteer-title" placeholder="Enter Title" required>
          </div>

          <div class="form-group">
            <label>Event banner</label>
            <div class="upload-container" id="profile-upload-container">
              <div class="upload-placeholder">
                <i class="fas fa-upload"></i>
                <span>Upload</span>
              </div>
              <div class="upload-preview">
                <img id="profile-preview" src="" alt="Profile Preview">
                <button type="button" class="remove-image" id="remove-profile-image">
                  <svg xmlns="http://www.w3.org/2000/svg" class="btn-close" data-bs-dismiss="modal" aria-label="Close" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="13" height="13">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                </button>
              </div>
              <input type="file" id="profile-upload" name="volunteer_image" accept="image/*" hidden>
            </div>
          </div>
          <div class="form-group">
            <label for="volunteer-location">Location<span class="required">*</span></label>
            <input type="text" id="volunteer-location" name="volunteer-location" placeholder="Enter Location" required>
          </div>
          <div class="form-group">
            <label for="volunteer-time">Time<span class="required">*</span></label>
            <input type="time" id="volunteer-time" name="volunteer-time" required>
          </div>
          <div class="form-group">
            <label for="volunteer-date">Date<span class="required">*</span></label>
            <input type="date" id="volunteer-date" name="volunteer-date" required>
          </div>
          <div class="form-group">
            <label for="volunteer-description">Description<span class="required">*</span></label>
            <input type="text" id="volunteer-description" name="volunteer-description" placeholder="Enter Description" required>
          </div>

          <div class="form-group">
            <label for="volunteer-body" class="form-label">Body*</label>
            <textarea class="form-control text-areaa" id="volunteer-body" name="volunteer-body" row="10"></textarea>
          </div>
          <div class="form-group">
            <label for="volunteer-status">Status</label>
            <div class="select-container">
              <select id="volunteer-status" name="volunteer-status" required>
                <option value="" selected>Select Volunteers Status</option>
                <option value="completed">Completed</option>
                <option value="upcoming">Upcoming</option>
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










    <!-- Delete Confirmation Modal -->
    <div class="modal" id="deleteModal">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body text-center">
            <div class="delete-icon" id="cancelIcon">
              <i class="fas fa-trash-alt"></i>
            </div>
            <h5 id="deleteVolunteerName"></h5>
            <p>Are you sure you want to delete this Event? If Yes, Confirm</p>
            <div class="delete-actions">
              <button type="button" class="btn btn-delete" id="confirmDeleteBtn">Yes, Delete</button>
              <button type="button" class="btn btn-cancel" id="cancelBtn" data-bs-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </div>

  </main>



  <?php include $page_rel . 'admin/includes/sidebar.php'; ?>



  <script>
    function previewImage(event) {
      const reader = new FileReader();
      reader.onload = function() {
        document.getElementById('preview').src = reader.result;
      };
      reader.readAsDataURL(event.target.files[0]);
    }


    document.getElementById("onboardBtn").addEventListener("click", function() {
      const form = document.getElementById("addVolunteerForm");

      form.onsubmit = (e) => {
        e.preventDefault();
      };
      let formData = new FormData(form);
      let isValid = true;


      for (let [key, value] of formData.entries()) {
        if (typeof value === "string") {
          let trimmedValue = value.trim();
          formData.set(key, trimmedValue);

          if (trimmedValue === "") {
            isValid = false;

            const BadToast = document.getElementById('bad-toast');
            const BadToastMesaage = document.getElementById('bad-toast-message');
            BadToast.classList.add('show');
            BadToastMesaage.textContent = `${key} cannot be empty or only spaces.`;
            setTimeout(hideBadToast, 5000);

            function hideBadToast() {
              const BadToast = document.getElementById('bad-toast');
              BadToast.classList.remove('show');
            }
            return;
          }
        }
      }

      if (!isValid) return;

      fetch(`../api/v1/add_events.php`, {
      // fetch(`${location.origin}/api/v1/add_events.php`, {
          method: "POST",
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          if (data.success === true) {
            const toast = document.getElementById('toast-success');
            const toastMesaage = document.getElementById('toast-message');
            toast.classList.add('show');
            toastMesaage.textContent = data.message;
            setTimeout(hideToast, 5000);
            form.reset();
            document.getElementById('preview').src = "assets/images/upload-placeholder.svg";

            function hideToast() {
              const toast = document.getElementById('toast-success');
              toast.classList.remove('show');
            }

          } else {
            const BadToast = document.getElementById('bad-toast');
            const BadToastMesaage = document.getElementById('bad-toast-message');
            BadToast.classList.add('show');
            BadToastMesaage.textContent = data.message || `Error ${xhr.status}: ${xhr.statusText}`;;
            setTimeout(hideBadToast, 5000);

            function hideBadToast() {
              const BadToast = document.getElementById('bad-toast');
              BadToast.classList.remove('show');
            }
          }

        })
        .catch(error => {
          console.error("Error:", error);
          // alert("An error occurred.");
        });
    });
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      setupActionMenu();
      handleUpdateFormSubmission();
    });
  </script>
</body>

</html>