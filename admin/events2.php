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
    // "scripts" => [""]
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
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
                        <button type="button" class="btn btn-add" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                            <i class="fas fa-plus"></i> Add Events
                        </button>
                    </div>


                    <!-- Volunteers Table -->
                    <div class="table-container position-relative">
                        <div class="table-responsive">
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

                    </div>


                </div>
            </div>
        </div>


        <!-- Add Event Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg"> <!-- modal-lg for wider modal -->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Onboard Events</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
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


                            <label for="volunteerBody" class="form-label">Body*</label>
                            <textarea class="form-control text-areaa" id="volunteerBody" name="volunteerBody" row="10"></textarea>
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
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="onboardBtn">Onboard</button>
                    </div>
                </div>
            </div>
        </div>



        <!-- Volunteer Details Modal -->
        <div class="modal fade" id="volunteerDetailsModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
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
                        <textarea class="form-control text-areaa" id="volunteer-body" name="volunteer-body" row="10">

                           </textarea>
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


        // Global variable to store events data
        let eventsData = [];

        // Function to fetch events from API
        async function fetchEvents() {
            try {
                const response = await fetch("../api/v1/add_events.php");
                const data = await response.json();

                if (!Array.isArray(data)) {
                    console.error("Invalid data format", data);
                    return;
                }

                if (Array.isArray(data)) {
                    eventsData = data;
                    populateEventsTable(eventsData);
                    initializeDataTable();
                } else {
                    console.error("Invalid data format", data);
                    showToast("Error fetching events data", false);
                }
            } catch (error) {
                console.error("Error fetching events:", error);
                showToast("Network error while fetching events", false);
            }
        }

        // Function to populate the table with events data
        function populateEventsTable(events) {
            const tableBody = document.getElementById('volunteers-table-body');
            tableBody.innerHTML = ''; // Clear existing content

            events.forEach((event, index) => {
                const row = document.createElement('tr');

                // Format date if needed
                const eventDate = event.date ? new Date(event.date).toLocaleDateString() : 'N/A';



                row.innerHTML = `
            <td class='text-center'>${index + 1}</td>
            <td class='text-center'>${event.title || 'N/A'}</td>
            <td class='text-center'>${eventDate}</td>
            <td class='text-center'>${formatTime(event.time) || 'N/A'}</td>
            <td class='text-center'>${event.description ? event.description.substring(0, 50) + (event.description.length > 50 ? '...' : '') : 'N/A'}</td>
            <td class='text-center'>
              ${event.status} 
            </td>
            <td class='text-center'>
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Actions
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item view-event" href="#" data-id="${event.id}">
                                <i class="fas fa-eye me-2"></i>View
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item edit-event" href="#" data-id="${event.id}">
                                <i class="fas fa-edit me-2"></i>Edit
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item update-event" href="#" data-id="${event.id}">
                                <i class="fas fa-upload me-2"></i>Update
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item delete-event" href="#" data-id="${event.id}">
                                <i class="fas fa-trash me-2"></i>Delete
                            </a>
                        </li>
                    </ul>
                </div>
            </td>
        `;

                tableBody.appendChild(row);
            });

            // Add event listeners to the action buttons
            addEventListeners();
        }

        // Function to add event listeners to action buttons
        function addEventListeners() {
            // View event
            document.querySelectorAll('.view-event').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const eventId = this.getAttribute('data-id');
                    viewEventDetails(eventId);
                });
            });

            // Edit event
            document.querySelectorAll('.edit-event').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const eventId = this.getAttribute('data-id');
                    editEvent(eventId);
                });
            });

            // Update event (for adding images/data)
            document.querySelectorAll('.update-event').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const eventId = this.getAttribute('data-id');
                    updateEvent(eventId);
                });
            });

            // Delete event
            document.querySelectorAll('.delete-event').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const eventId = this.getAttribute('data-id');
                    confirmDeleteEvent(eventId);
                });
            });
        }

        function formatTime(timeString) {
            if (!timeString || timeString === "00:00:00.000000") return "N/A";

            // Extract HH:mm from timeString (e.g., "09:00:00.000000" → "09:00")
            return timeString.split(".")[0].slice(0, 5);
        }

        // Function to view event details
        function viewEventDetails(eventId) {
            const event = eventsData.find(e => e.id == eventId);
            if (!event) {
                showToast("Event not found", false);
                return;
            }

            // Populate the details modal
            document.getElementById('detailsTitle').textContent = event.title || 'N/A';
            document.getElementById('detailsDate').textContent = event.date ? new Date(event.date).toLocaleDateString() : 'N/A';
            document.getElementById('detailsTime').textContent = event.time || 'N/A';
            document.getElementById('detailsLocation').textContent = event.location || 'N/A';
            document.getElementById('detailsDescription').textContent = event.description || 'N/A';

            // Set image if available
            const detailsImage = document.getElementById('detailsImage');
            if (event.cover_image) {
                detailsImage.src = `../uploads/events/${event.cover_image}`;
            } else {
                detailsImage.src = '../assets/images/includes/user1.svg';
            }

            // Set status badge
            const statusBadge = document.getElementById('detailsStatusBadge');
            statusBadge.textContent = event.status || 'N/A';
            statusBadge.className = 'status-badge ' + (event.status === 'completed' ? 'completed' : 'upcoming');

            // Show the modal
            const modal = new bootstrap.Modal(document.getElementById('volunteerDetailsModal'));
            modal.show();
        }

        // Function to edit an event
        function editEvent(eventId) {
            const event = eventsData.find(e => e.id == eventId);
            if (!event) {
                showToast("Event not found", false);
                return;
            }

            // Populate the edit form
            document.getElementById('volunteer-title').value = event.title || '';
            document.getElementById('volunteer-location').value = event.location || '';
            document.getElementById('volunteer-time').value = event.time || '';
            document.getElementById('volunteer-date').value = event.date || '';
            document.getElementById('volunteer-description').value = event.description || '';
            document.getElementById('volunteer-body').value = event.body || '';
            document.getElementById('volunteer-status').value = event.status || '';

            // Set image preview if available
            const profilePreview = document.getElementById('profile-preview');
            if (event.cover_image) {
                profilePreview.src = `../uploads/events/${event.cover_image}`;
                profilePreview.style.display = 'block';
                document.querySelector('.upload-placeholder').style.display = 'none';
            }

            // Store the event ID in the form for submission
            const form = document.getElementById('add-volunteer-form');
            form.setAttribute('data-event-id', eventId);

            // Show the edit modal
            document.getElementById('add-volunteer-modal').style.display = 'block';
        }

        // Function to update an event (add images/data)
        function updateEvent(eventId) {
            // Set the event ID in the update form
            document.getElementById('event_id').value = eventId;

            // Show the update modal
            const modal = new bootstrap.Modal(document.getElementById('volunteerUpdateModal'));
            modal.show();
        }

        // Function to confirm event deletion
        function confirmDeleteEvent(eventId) {
            const event = eventsData.find(e => e.id == eventId);
            if (!event) {
                showToast("Event not found", false);
                return;
            }

            // Set the event name in the delete confirmation modal
            document.getElementById('deleteVolunteerName').textContent = `Delete "${event.title}"?`;

            // Store the event ID for the delete action
            document.getElementById('confirmDeleteBtn').setAttribute('data-id', eventId);

            // Show the delete confirmation modal
            const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
            modal.show();
        }

        // Function to handle actual deletion
        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            const eventId = this.getAttribute('data-id');
            deleteEvent(eventId);
        });

        // Function to delete an event
        async function deleteEvent(eventId) {
            try {
                const response = await fetch(`../api/v1/delete_event.php?id=${eventId}`, {
                    method: 'DELETE'
                });

                const data = await response.json();

                if (data.success) {
                    showToast("Event deleted successfully", true);
                    // Refresh the events list
                    fetchEvents();
                } else {
                    showToast(data.message || "Failed to delete event", false);
                }
            } catch (error) {
                console.error("Error deleting event:", error);
                showToast("Network error while deleting event", false);
            }

            // Close the delete modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
            modal.hide();
        }

        // Helper function to show toast messages
        function showToast(message, isSuccess) {
            if (isSuccess) {
                const toast = document.getElementById('toast-success');
                const toastMessage = document.getElementById('toast-message');
                toastMessage.textContent = message;
                toast.classList.add('show');
                setTimeout(() => toast.classList.remove('show'), 5000);
            } else {
                const badToast = document.getElementById('bad-toast');
                const badToastMessage = document.getElementById('bad-toast-message');
                badToastMessage.textContent = message;
                badToast.classList.add('show');
                setTimeout(() => badToast.classList.remove('show'), 5000);
            }
        }

        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Fetch and display events
            fetchEvents();

            // Add event listener for the onboard button
            document.getElementById("onboardBtn").addEventListener("click", function() {
                const form = document.getElementById("addVolunteerForm");
                form.onsubmit = (e) => e.preventDefault();

                let formData = new FormData(form);
                let isValid = true;

                // Validate form data
                for (let [key, value] of formData.entries()) {
                    if (typeof value === "string") {
                        let trimmedValue = value.trim();
                        formData.set(key, trimmedValue);

                        if (trimmedValue === "") {
                            isValid = false;
                            showToast(`${key} cannot be empty or only spaces.`, false);
                            return;
                        }
                    }
                }

                if (!isValid) return;

                // Submit the form
                fetch(`../api/v1/add_events.php`, {
                        method: "POST",
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showToast(data.message, true);
                            form.reset();
                            document.getElementById('preview').src = "assets/images/upload-placeholder.svg";
                            // Refresh the events list
                            fetchEvents();
                            // Close the modal
                            const modal = bootstrap.Modal.getInstance(document.getElementById('exampleModal'));
                            modal.hide();
                        } else {
                            showToast(data.message || "Failed to add event", false);
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        showToast("Network error while adding event", false);
                    });
            });
        });
    </script>





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
        /* Properly align 'Show entries' label and select */
        .dataTables_length {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            margin-bottom: 1rem;
        }

        .dataTables_length label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin: 0;
            font-weight: 500;
        }

        .dataTables_length select {
            width: auto;
            padding: 1rem 2.5rem !important;
            border-radius: 5px;
            border: 1px solid orange;
            background-color: #fff;
            font-size: 0.9rem;
        }

        @media (max-width: 576px) {
            .dataTables_wrapper .dataTables_filter {
                margin-top: 20px;
            }
        }
    </style>



    <script>
        $(document).ready(function() {
            $('#volunteersTable').DataTable({
                dom: '<"row mb-3"<"col-md-4"l>>' + // Show entries
                    '<"row mb-3"<"col-md-6"B><"col-md-6 text-end"f>>' + // Buttons and Search filter
                    'rt' +
                    '<"row mt-3"<"col-md-5"i><"col-md-7"p>>', // Info and Pagination
                buttons: [{
                        extend: 'copy',
                        className: 'btn btn-primary btn-sm me-1'
                    },
                    {
                        extend: 'csv',
                        className: 'btn btn-secondary btn-sm me-1'
                    },
                    {
                        extend: 'excel',
                        className: 'btn btn-success btn-sm me-1'
                    },
                    {
                        extend: 'pdf',
                        className: 'btn btn-danger btn-sm me-1'
                    },
                    {
                        extend: 'print',
                        className: 'btn btn-dark btn-sm'
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
    </script>
</body>

</html>