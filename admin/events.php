<?php
session_start();

require '../api/Database/DatabaseConn.php';

// Create an instance of DatabaseConn and establish connection
$db = new DatabaseConn();
$dbh = $db->connect();

$stmt = $dbh->prepare("SELECT id, event_id, title, date, time, banner_image, location, body, description, status FROM events ORDER BY id DESC");
$stmt->execute();
?>
<?php

$page_title = "Events - Admin- Ogeri Health Foundation";
$page_author = "Olayinka!";
$page_description = "";
$page_rel = '../';
$page_name = 'admin';

$customs = array(
  "stylesheets" => ["admin/assets/css/events.css"],
  "scripts" => [""]
);

$addons = array(
  "stylesheets" => ["https://some-external-url.css"],
  "scripts" => ["https://some-external-url.js"]
);

?>
<!DOCTYPE html>
<html>

<head>
  <?php include $page_rel . 'include/head.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <script>
    window.onload = function() {

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


  h2 {
    text-align: center;
    margin-bottom: 30px;
  }

  .filter-section {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
  }

  .filter-section label {
    font-size: 14px;
  }

  input[type="date"] {
    padding: 5px 8px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 14px;
  }

  button {
    padding: 6px 12px;
    font-size: 14px;
    background-color: var(--primary-color, #007bff);
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
  }

  button:hover {
    background-color: #0056b3;
  }

  .dashboard {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
  }

  .card {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    width: 240px;
    text-align: center;
  }

  .card h3 {
    font-size: 16px;
    color: #555;
    margin-bottom: 10px;
  }

  .card p {
    font-size: 24px;
    font-weight: bold;
    color: #222;
  }

  .chart-container {
    max-width: 400px;
    margin: 40px auto;
  }

  canvas {
    max-width: 100%;
    height: auto;
  }
</style>


<body>
  <?php include $page_rel . 'admin/includes/topbar.php'; ?>

  <main>
    <div id="toast-success">
      <div class="icon">✔</div>
      <div id="toast-message">Success message</div>
      <button class="close-btn" onclick="hideToast()">&times;</button>
    </div>

    <div id="bad-toast">
      <div class="bad-icon">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="13" height="13">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </div>
      <div id="bad-toast-message">Error message</div>
      <button class="close-btn" onclick="hideToast()">&times;</button>
    </div>

    <div class="container-fluid main-container">
      <div class="content">
        <div class="page-content">
          <div class="toast-container" id="toastContainer"></div>
          <div>
            <h2>Community Outreach Statistics</h2>

            <div class="filter-section">
              <label>Start Date:
                <input type="date" id="start_date">
              </label>
              <label>End Date:
                <input type="date" id="end_date">
              </label>
              <button onclick="fetchStats()">Filter</button>
              <button onclick="clearFilters()">Clear</button>
            </div>

            <div class="dashboard" id="stats-cards"></div>

            <div class="chart-container">
              <canvas id="genderChart"></canvas>
            </div>
          </div>

          <div class="content-header">
            <div>
              <h2 class="content-title">Events!</h2>
              <p class="content-subtitle">List of Events</p>
            </div>
            <button type="button" class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addEventModal">
              <i class="fas fa-plus"></i> Add Events
            </button>
          </div>

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
                <tbody>
                  <?php
                  $i = 1;
                  while ($event = $stmt->fetch(PDO::FETCH_ASSOC)):
                    $id = htmlspecialchars($event['id']);
                    $eventName = htmlspecialchars($event['title']);
                    $body = htmlspecialchars($event['body']);
                    $description = htmlspecialchars($event['description']);
                    $status = htmlspecialchars($event['status']);
                    $location = htmlspecialchars($event['location']);
                    $date = date("M j, Y", strtotime($event['date']));
                    $time = DateTime::createFromFormat("H:i:s.u", $event['time']);
                    $image = !empty($event['banner_image']) ? "../uploads/" . htmlspecialchars($event['banner_image']) : "../assets/img/donate/donation2-1.png";
                    $eventid = htmlspecialchars($event['event_id']);
                    $rawDate = htmlspecialchars($event['date']);
                    $rawTime = date("H:i", strtotime($event['time']));
                  ?>
                    <tr>
                      <td class="text-center"><?= $i ?></td>
                      <td class="text-center"><?= $eventName ?></td>
                      <td class="text-center"><?= $date ?></td>
                      <td class="text-center"><?= $time->format("g:i A"); ?></td>
                      <td class="text-center"><?= strlen($description) > 30 ? substr($description, 0, 30) . "..." : $description; ?></td>
                      <td class="text-center <?= $status == 'completed' ? 'text-success' : 'text-warning' ?>">
                        <?= $status ?>
                      </td>
                      <td class="text-center">
                        <div class="btn-group">
                          <button type="button" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class='fas fa-ellipsis-v'></i>
                          </button>
                          <ul class="dropdown-menu" style="z-index:9999; background-color:white;min-height: 150px">
                            <li><a class="dropdown-item" href="javascript:;" onclick="viewEvent('<?= $eventid ?>')"><i class="fas fa-eye me-2"></i>View</a></li>
                            <li><a class="dropdown-item" href="javascript:;" onclick="editEvent('<?= $id ?>', '<?= addslashes($eventName) ?>', '<?= $rawDate ?>', '<?= $rawTime ?>', '<?= addslashes($description) ?>', '<?= addslashes($body) ?>', '<?= addslashes($location) ?>', '<?= $status ?>', '<?= $image ?>')"><i class="fas fa-edit me-2"></i>Edit</a></li>
                            <li><a class="dropdown-item" href="javascript:;" onclick="updateEvent('<?= $eventid ?>')"><i class="fas fa-upload me-2"></i>Update</a></li>
                            <li>
                              <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="javascript:;" onclick="deleteEvent('<?= $eventid ?>', '<?= addslashes($eventName) ?>')"><i class="fas fa-trash me-2"></i>Delete</a></li>
                          </ul>
                        </div>
                      </td>
                    </tr>




                    <!-- View Modal -->
                    <div class="modal fade" id="viewEventModal<?= $eventid ?>" tabindex="-1" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content" style='background-color: #fff;'>
                          <div class="modal-header">
                            <h5 class="modal-title">Event Details - <?= $eventid ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                            <div class="status-badge-container mb-3">
                              <span class="status-badge"><?= $status ?></span>
                            </div>

                            <!-- Top Image -->
                            <div class="text-center mb-4">
                              <img src="<?= $image ?>" alt="Event Image" class="img-fluid rounded" style="max-width: 200px;">
                            </div>

                            <!-- Event Details -->
                            <div class="volunteer-details">
                              <div class="row mb-2">
                                <div class="col-md-12 d-flex align-items-start">
                                  <h6 class="me-2" style="min-width: 100px;">Event title:</h6>
                                  <h6 class="mb-0 text-muted"><?= $eventName ?></h6>
                                </div>
                                <div class="col-md-12 d-flex">
                                  <h6 class="me-2" style="min-width: 100px;">Date:</h6>
                                  <h6 class="mb-0 text-muted"><?= $date ?></h6>
                                </div>
                              </div>

                              <div class="row mb-2">
                                <div class="col-md-12 d-flex">
                                  <h6 class="me-2" style="min-width: 100px;">Time:</h6>
                                  <h6 class="mb-0 text-muted"><?= $time->format("g:i A"); ?></h6>
                                </div>
                                <div class="col-md-12 d-flex">
                                  <h6 class="me-2" style="min-width: 100px;">Location:</h6>
                                  <h6 class="mb-0 text-muted"><?= $location ?></h6>
                                </div>
                              </div>

                              <!-- Description (Full Width) -->
                              <div class="row mb-3">
                                <div class="col-12">
                                  <h6>Description:</h6>
                                  <p><?= trim($description) ?></p>
                                </div>
                              </div>

                              <!-- Body Content (Full Width) -->
                              <div class="row">
                                <div class="col-12">
                                  <h6>Body:</h6>
                                  <div class="ck-content p-3 border rounded">
                                    <?= htmlspecialchars_decode($event['body']) ?>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>

                  <?php
                    $i++;
                  endwhile;
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Add Event Modal -->
    <div class="modal fade" id="addEventModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add New Event</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="POST" id="addEventForm" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="eventTitle" class="form-label">Title*</label>
                <input type="text" name="Title" class="form-control" id="eventTitle" placeholder="Enter Title" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Event Banner</label>
                <div class="upload-container">
                  <div class="upload-box text-center" onclick="document.getElementById('cover_image').click();">
                    <input type="file" id="cover_image" name="cover_image" accept="image/*" hidden onchange="previewImage(event)">
                    <img id="preview" src="assets/images/upload-placeholder.svg" alt="Upload Image">
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <label for="eventLocation" class="form-label">Location*</label>
                <input type="text" name="volunteerLocation" class="form-control" id="eventLocation" placeholder="Enter Location" required>
              </div>
              <div class="mb-3">
                <label for="eventTime" class="form-label">Time*</label>
                <input type="time" name="volunteerTime" class="form-control" id="eventTime" required>
              </div>
              <div class="mb-3">
                <label for="eventDate" class="form-label">Date*</label>
                <input type="date" name="volunteerDate" class="form-control" id="eventDate" required>
              </div>
              <div class="mb-3">
                <label for="eventDescription" class="form-label">Description*</label>
                <input type="text" name="volunteerDescription" class="form-control" id="eventDescription" placeholder="Enter Description" required>
              </div>
              <div class="mb-3">
                <label for="eventBody" class="form-label">Body*</label>
                <textarea class="form-control" id="eventBody" name="volunteerBody" rows="5" required></textarea>
              </div>
              <div class="mb-3">
                <label for="eventStatus" class="form-label">Status*</label>
                <select class="form-select" name="volunteerStatus" id="eventStatus" required>
                  <option value="">Select Event Status</option>
                  <option value="completed">Completed</option>
                  <option value="upcoming">Upcoming</option>
                </select>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="addEventBtn">Add Event</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Edit Event Modal -->
    <div class="modal fade" id="editEventModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Event</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="editEventForm" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="edit_id" id="editEventId">
              <div class="mb-3">
                <label for="editEventTitle" class="form-label">Title*</label>
                <input type="text" name="volunteer-title" class="form-control" id="editEventTitle" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Event Banner</label>
                <div class="upload-container">
                  <div class="upload-box text-center" onclick="document.getElementById('editCoverImage').click();">
                    <input type="file" id="editCoverImage" name="volunteer_image" accept="image/*" hidden onchange="previewEditImage(event)">
                    <img id="editPreview" src="" alt="Event Banner">
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <label for="editEventLocation" class="form-label">Location*</label>
                <input type="text" name="volunteer-location" class="form-control" id="editEventLocation" required>
              </div>
              <div class="mb-3">
                <label for="editEventTime" class="form-label">Time*</label>
                <input type="time" name="volunteer-time" class="form-control" id="editEventTime" required>
              </div>
              <div class="mb-3">
                <label for="editEventDate" class="form-label">Date*</label>
                <input type="date" name="volunteer-date" class="form-control" id="editEventDate" required>
              </div>
              <div class="mb-3">
                <label for="editEventDescription" class="form-label">Description*</label>
                <input type="text" name="volunteer-description" class="form-control" id="editEventDescription" required>
              </div>
              <div class="mb-3">
                <label for="editEventBody" class="form-label">Body*</label>
                <textarea class="form-control" id="editEventBody" name="volunteer-body" rows="5" required></textarea>
              </div>
              <div class="mb-3">
                <label for="editEventStatus" class="form-label">Status*</label>
                <select class="form-select" name="volunteer-status" id="editEventStatus" required>
                  <option value="completed">Completed</option>
                  <option value="upcoming">Upcoming</option>
                </select>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" id="updateEventBtn">Update Event</button>
          </div>
        </div>
      </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteEventModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-body text-center">
            <div class="delete-icon">
              <i class="fas fa-trash-alt"></i>
            </div>
            <h5 id="deleteEventName"></h5>
            <p>Are you sure you want to delete this event? This action cannot be undone.</p>
            <div class="delete-actions">
              <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Yes, Delete</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- Update Event Modal (for uploading images) -->
    <div class="modal fade" id="updateEventModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <form id="image-form" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
              <h5 class="modal-title" id="volunteerUpdateModalLabel">Update Event</h5>
              <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body add-border-blue" style="max-height: 70vh; overflow-y: auto; padding: 20px;">
              <input type="hidden" name="event_id" id="event_id">

              <label>Upload Images From the events that just concluded</label>
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

                <!-- Upload Box 5 -->
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

                <!-- Upload Box 6 -->
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

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <div class="form-actions">
                <button type="submit" class="btn btn-primary">Upload</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>


    <style>
      div.dataTables_wrapper div.dataTables_length select {
        padding: 5px 35px;
      }
    </style>

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
    $(document).ready(function() {
      // Function to handle image preview for all upload boxes
      function handleImagePreview(inputId, previewId) {
        $(inputId).change(function() {
          const file = this.files[0];
          if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
              $(previewId + ' img').attr('src', e.target.result);
              $(previewId).show();
              $(previewId).siblings('.upload-content').hide();
            }
            reader.readAsDataURL(file);
          }
        });
      }

      // Initialize preview for all 6 image upload boxes
      for (let i = 1; i <= 6; i++) {
        handleImagePreview('#imageUpload_' + i, '#imagePreview_' + i);
      }

      // Remove uploaded image function
      window.removeUploadedImage = function(boxNumber) {
        $('#imageUpload_' + boxNumber).val(''); // Clear the file input
        $('#imagePreview_' + boxNumber).hide(); // Hide the preview
        $('#imagePreview_' + boxNumber + ' img').attr('src', ''); // Clear the image
        $('#imagePreview_' + boxNumber).siblings('.upload-content').show(); // Show the upload box again
      };

      // Drag and drop functionality
      $('.upload-box').each(function() {
        const $box = $(this);

        $box.on('dragover', function(e) {
          e.preventDefault();
          e.stopPropagation();
          $box.addClass('dragover');
        });

        $box.on('dragleave', function(e) {
          e.preventDefault();
          e.stopPropagation();
          $box.removeClass('dragover');
        });

        $box.on('drop', function(e) {
          e.preventDefault();
          e.stopPropagation();
          $box.removeClass('dragover');

          const files = e.originalEvent.dataTransfer.files;
          if (files.length > 0) {
            const input = $box.find('.file-input')[0];
            input.files = files;
            $(input).trigger('change');
          }
        });
      });
    });
  </script>

  <!-- <script>
    // Global variables
    let currentEventId = null;
    let currentEventName = null;
    let editEventEditor = null;
    let eventEditor; // Global variable to hold the editor instance


    // Initialize DataTable
    $(document).ready(function() {
      // Call it on page load
      initializeCKEditor();

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

    // View Event Function
    function viewEvent(eventId) {
      $('#viewEventModal' + eventId).modal('show');
    }

    // Edit Event Function
    function editEvent(eventId, title, date, time, description, body, location, status, image) {
      $('#editEventId').val(eventId);
      $('#editEventTitle').val(title);
      $('#editEventDate').val(date);
      $('#editEventTime').val(time);
      $('#editEventDescription').val(description);
      $('#editEventLocation').val(location);
      $('#editEventStatus').val(status);
      $('#editPreview').attr('src', image);

      // Store the body content to set after editor is created
      const eventBody = body;

      // Destroy CKEditor instance if it already exists
      if (editEventEditor) {
        editEventEditor.destroy().then(() => {
          createEditor(eventBody); // Pass the body content
        });
      } else {
        createEditor(eventBody); // Pass the body content
      }

      currentEventId = eventId;
      $('#editEventModal').modal('show');
    }

    // Updated createEditor function to accept body content
    function createEditor(bodyContent = '') {
      CKEDITOR.ClassicEditor
        .create(document.getElementById("editEventBody"), {
          toolbar: {
            items: [
              'exportPDF', 'exportWord', '|',
              'findAndReplace', 'selectAll', '|',
              'heading', '|',
              'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript',
              'removeFormat', '|',
              'bulletedList', 'numberedList', 'todoList', '|',
              'outdent', 'indent', '|',
              'undo', 'redo',
              '-',
              'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
              'alignment', '|',
              'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed',
              '|',
              'specialCharacters', 'horizontalLine', 'pageBreak', '|',
              'textPartLanguage', '|',
              'sourceEditing'
            ],
            shouldNotGroupWhenFull: true
          },
          list: {
            properties: {
              styles: true,
              startIndex: true,
              reversed: true
            }
          },
          heading: {
            options: [{
                model: 'paragraph',
                title: 'Paragraph',
                class: 'ck-heading_paragraph'
              },
              {
                model: 'heading1',
                view: 'h1',
                title: 'Heading 1',
                class: 'ck-heading_heading1'
              },
              {
                model: 'heading2',
                view: 'h2',
                title: 'Heading 2',
                class: 'ck-heading_heading2'
              },
              {
                model: 'heading3',
                view: 'h3',
                title: 'Heading 3',
                class: 'ck-heading_heading3'
              },
              {
                model: 'heading4',
                view: 'h4',
                title: 'Heading 4',
                class: 'ck-heading_heading4'
              },
              {
                model: 'heading5',
                view: 'h5',
                title: 'Heading 5',
                class: 'ck-heading_heading5'
              },
              {
                model: 'heading6',
                view: 'h6',
                title: 'Heading 6',
                class: 'ck-heading_heading6'
              }
            ]
          },
          placeholder: 'Enter a detailed description',
          fontFamily: {
            options: [
              'default',
              'Arial, Helvetica, sans-serif',
              'Courier New, Courier, monospace',
              'Georgia, serif',
              'Lucida Sans Unicode, Lucida Grande, sans-serif',
              'Tahoma, Geneva, sans-serif',
              'Times New Roman, Times, serif',
              'Trebuchet MS, Helvetica, sans-serif',
              'Verdana, Geneva, sans-serif'
            ],
            supportAllValues: true
          },
          fontSize: {
            options: [10, 12, 14, 'default', 18, 20, 22],
            supportAllValues: true
          },
          htmlSupport: {
            allow: [{
              name: /.*/,
              attributes: true,
              classes: true,
              styles: true
            }]
          },
          htmlEmbed: {
            showPreviews: true
          },
          link: {
            decorators: {
              addTargetToExternalLinks: true,
              defaultProtocol: 'https://',
              toggleDownloadable: {
                mode: 'manual',
                label: 'Downloadable',
                attributes: {
                  download: 'file'
                }
              }
            }
          },
          mention: {
            feeds: [{
              marker: '@',
              feed: [
                '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes',
                '@chocolate', '@cookie', '@cotton', '@cream',
                '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread',
                '@gummi', '@ice', '@jelly-o',
                '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding',
                '@sesame', '@snaps', '@soufflé',
                '@sugar', '@sweet', '@topping', '@wafer'
              ],
              minimumCharacters: 1
            }]
          },
          removePlugins: [
            'CKBox',
            'CKFinder',
            'EasyImage',
            'RealTimeCollaborativeComments',
            'RealTimeCollaborativeTrackChanges',
            'RealTimeCollaborativeRevisionHistory',
            'PresenceList',
            'Comments',
            'TrackChanges',
            'TrackChangesData',
            'RevisionHistory',
            'Pagination',
            'WProofreader',
            'MathType',
            'SlashCommand',
            'Template',
            'DocumentOutline',
            'FormatPainter',
            'TableOfContents'
          ]
        })
        .then(editor => {
          editEventEditor = editor;
          // Set the body content after editor is created
          if (bodyContent) {
            editor.setData(bodyContent);
          }
        })
        .catch(error => {
          console.error('CKEditor error:', error);
        });
    }


    // Update Event Function (for image uploads)
    function updateEvent(eventId) {
      $('#event_id').val(eventId); // Make sure this matches your hidden input field name
      currentEventId = eventId;
      $('#updateEventModal').modal('show');
    }

    // Handle the image form submission
    $('#image-form').on('submit', function(e) {
      e.preventDefault();

      const formData = new FormData(this);

      $.ajax({
        url: '../api/v1/update_event_details.php',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(data) {
          if (data.success === true) {
            showToast(data.message, 'success');
            $('#updateEventModal').modal('hide');
            setTimeout(() => window.location.reload(), 2000);
          } else {
            showToast(data.message || 'Error occurred', 'error');
          }
        },
        error: function(xhr, status, error) {
          console.error('Error:', error);
          showToast('An error occurred while updating the event', 'error');
        }
      });
    });

    // Delete Event Function
    function deleteEvent(eventId, eventName) {
      currentEventId = eventId;
      currentEventName = eventName;
      $('#deleteEventName').text(`Delete ${eventName} and ${currentEventId} ? `);
      $('#deleteEventModal').modal('show');
    }

    // Add Event AJAX
    $('#addEventBtn').on('click', function() {
      if (eventEditor) {
        $('#eventBody').val(eventEditor.getData());
      }

      const form = $('#addEventForm')[0];
      let formData = new FormData(form);


      $.ajax({
        url: '../api/v1/add_events.php',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(data) {
          if (data.success === true) {
            showToast(data.message, 'success');
            $('#addEventModal').modal('hide');
            setTimeout(() => window.location.reload(), 2000);
          } else {
            showToast(data.message || 'Error occurred', 'error');
          }
        },
        error: function(xhr, status, error) {
          console.error('Error:', error);
          showToast('An error occurred while adding the event', 'error');
        }
      });
    });

    // Update Event AJAX
    $('#updateEventBtn').on('click', function() {
      // Get CKEditor content
      if (editEventEditor) {
        const editorData = editEventEditor.getData();
        $('#editEventBody').val(editorData); // set the hidden form input
      }

      const form = $('#editEventForm')[0];
      let formData = new FormData(form);


      $.ajax({
        url: '../api/v1/update_event.php',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(data) {
          if (data.success === true) {
            showToast(data.message, 'success');
            $('#editEventModal').modal('hide');
            setTimeout(() => window.location.reload(), 2000);
          } else {
            showToast(data.message || 'Error occurred', 'error');
          }
        },
        error: function(xhr, status, error) {
          console.error('Error:', error);
          showToast('An error occurred while updating the event', 'error');
        }
      });
    });

    // Delete Event AJAX
    $('#confirmDeleteBtn').on('click', function() {
      $.ajax({
        url: '../api/v1/delete_event.php',
        method: 'POST',
        data: {
          eventId: currentEventId
        },
        dataType: 'json',
        success: function(data) {
          if (data.success === true) {
            showToast(data.message, 'success');
            $('#deleteEventModal').modal('hide');
            setTimeout(() => window.location.reload(), 2000);
          } else {
            showToast(data.message || 'Error occurred', 'error');
          }
        },
        error: function(xhr, status, error) {
          console.error('Error:', error);
          showToast('An error occurred while deleting the event', 'error');
        }
      });
    });


    // Helper Functions
    function showToast(message, type) {
      if (type === 'success') {
        $('#toast-message').text(message);
        $('#toast-success').addClass('show');
        setTimeout(() => $('#toast-success').removeClass('show'), 5000);
      } else {
        $('#bad-toast-message').text(message);
        $('#bad-toast').addClass('show');
        setTimeout(() => $('#bad-toast').removeClass('show'), 5000);
      }
    }

    function hideToast() {
      $('#toast-success').removeClass('show');
      $('#bad-toast').removeClass('show');
    }

    function previewImage(event) {
      const reader = new FileReader();
      reader.onload = function() {
        $('#preview').attr('src', reader.result);
      };
      reader.readAsDataURL(event.target.files[0]);
    }

    function previewEditImage(event) {
      const reader = new FileReader();
      reader.onload = function() {
        $('#editPreview').attr('src', reader.result);
      };
      reader.readAsDataURL(event.target.files[0]);
    }


    function initializeCKEditor() {
      CKEDITOR.ClassicEditor
        .create(document.getElementById('eventBody'), {
          toolbar: {
            items: [
              'exportPDF', 'exportWord', '|',
              'findAndReplace', 'selectAll', '|',
              'heading', '|',
              'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript',
              'removeFormat', '|',
              'bulletedList', 'numberedList', 'todoList', '|',
              'outdent', 'indent', '|',
              'undo', 'redo',
              '-',
              'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
              'alignment', '|',
              'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed',
              '|',
              'specialCharacters', 'horizontalLine', 'pageBreak', '|',
              'textPartLanguage', '|',
              'sourceEditing'
            ],
            shouldNotGroupWhenFull: true
          },
          list: {
            properties: {
              styles: true,
              startIndex: true,
              reversed: true
            }
          },
          heading: {
            options: [{
                model: 'paragraph',
                title: 'Paragraph',
                class: 'ck-heading_paragraph'
              },
              {
                model: 'heading1',
                view: 'h1',
                title: 'Heading 1',
                class: 'ck-heading_heading1'
              },
              {
                model: 'heading2',
                view: 'h2',
                title: 'Heading 2',
                class: 'ck-heading_heading2'
              },
              {
                model: 'heading3',
                view: 'h3',
                title: 'Heading 3',
                class: 'ck-heading_heading3'
              },
              {
                model: 'heading4',
                view: 'h4',
                title: 'Heading 4',
                class: 'ck-heading_heading4'
              },
              {
                model: 'heading5',
                view: 'h5',
                title: 'Heading 5',
                class: 'ck-heading_heading5'
              },
              {
                model: 'heading6',
                view: 'h6',
                title: 'Heading 6',
                class: 'ck-heading_heading6'
              }
            ]
          },
          placeholder: 'Enter a detailed description',
          fontFamily: {
            options: [
              'default',
              'Arial, Helvetica, sans-serif',
              'Courier New, Courier, monospace',
              'Georgia, serif',
              'Lucida Sans Unicode, Lucida Grande, sans-serif',
              'Tahoma, Geneva, sans-serif',
              'Times New Roman, Times, serif',
              'Trebuchet MS, Helvetica, sans-serif',
              'Verdana, Geneva, sans-serif'
            ],
            supportAllValues: true
          },
          fontSize: {
            options: [10, 12, 14, 'default', 18, 20, 22],
            supportAllValues: true
          },
          htmlSupport: {
            allow: [{
              name: /.*/,
              attributes: true,
              classes: true,
              styles: true
            }]
          },
          htmlEmbed: {
            showPreviews: true
          },
          link: {
            decorators: {
              addTargetToExternalLinks: true,
              defaultProtocol: 'https://',
              toggleDownloadable: {
                mode: 'manual',
                label: 'Downloadable',
                attributes: {
                  download: 'file'
                }
              }
            }
          },
          mention: {
            feeds: [{
              marker: '@',
              feed: [
                '@apple', '@bears', '@brownie', '@cake', '@candy', '@canes',
                '@chocolate', '@cookie', '@cotton', '@cream',
                '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread',
                '@gummi', '@ice', '@jelly-o',
                '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding',
                '@sesame', '@snaps', '@soufflé',
                '@sugar', '@sweet', '@topping', '@wafer'
              ],
              minimumCharacters: 1
            }]
          },
          removePlugins: [
            'CKBox',
            'CKFinder',
            'EasyImage',
            'RealTimeCollaborativeComments',
            'RealTimeCollaborativeTrackChanges',
            'RealTimeCollaborativeRevisionHistory',
            'PresenceList',
            'Comments',
            'TrackChanges',
            'TrackChangesData',
            'RevisionHistory',
            'Pagination',
            'WProofreader',
            'MathType',
            'SlashCommand',
            'Template',
            'DocumentOutline',
            'FormatPainter',
            'TableOfContents'
          ]
        })
        .then(editor => {
          eventEditor = editor;
        })
        .catch(error => {
          console.error('CKEditor initialization error:', error);
        });
    }
  </script> -->


  <script>
    // Complete Update Modal JavaScript Code

    // Global variables
    let currentEventId = null;
    let currentEventName = null;
    let editEventEditor = null;
    let eventEditor; // Global variable to hold the editor instance

    // Enhanced Update Event Function with existing data loading
    function updateEvent(eventId) {
      $('#event_id').val(eventId);
      currentEventId = eventId;

      // Show loading state
      showLoadingInModal();

      // Fetch existing event data
      $.ajax({
        url: '../api/v1/get_event_details.php',
        method: 'POST',
        data: {
          event_id: eventId
        },
        dataType: 'json',
        success: function(data) {
          hideLoadingInModal();
          if (data.success && data.event_details) {
            populateUpdateModal(data.event_details);
          } else {
            // If no existing data, just show empty modal
            resetUpdateModal();
          }
          $('#updateEventModal').modal('show');
        },
        error: function(xhr, status, error) {
          hideLoadingInModal();
          console.error('Error fetching event details:', error);
          resetUpdateModal();
          $('#updateEventModal').modal('show');
          showToast('Could not load existing data', 'warning');
        }
      });
    }

    // Function to populate modal with existing data
    function populateUpdateModal(eventDetails) {
      // Reset modal first
      resetUpdateModal();


      // Populate numeric fields with existing values
      $('#totalAttendees').val(eventDetails.total_attendees || '');
      $('#bpScreened').val(eventDetails.bp_screened || '');
      $('#highBpDetected').val(eventDetails.high_bp_detected || '');
      $('#repeatAttendees').val(eventDetails.repeat_attendees || '');
      $('#counselled').val(eventDetails.counselled || '');
      $('#medicationsDispensed').val(eventDetails.medications_dispensed || '');
      $('#referrals').val(eventDetails.referrals || '');
      $('#avgAge').val(eventDetails.average_age || '');
      $('#genderMale').val(eventDetails.gender_male || '');
      $('#genderFemale').val(eventDetails.gender_female || '');
      $('#villagesServed').val(eventDetails.villages_served || '');

      // Populate existing images
      if (eventDetails.images && eventDetails.images.length > 0) {
        eventDetails.images.forEach((imagePath, index) => {
          if (imagePath && index < 6) { // Only handle up to 6 images
            const boxNumber = index + 1;
            const fullImagePath = `../uploads/events/${imagePath}`;

            // Set the image preview
            $(`#imagePreview_${boxNumber} img`).attr('src', fullImagePath);
            $(`#imagePreview_${boxNumber}`).show();
            $(`#imagePreview_${boxNumber}`).siblings('.upload-content').hide();

            // Add a data attribute to track existing images
            $(`#imagePreview_${boxNumber}`).attr('data-existing-image', imagePath);

            // Add existing image indicator
            $(`#imagePreview_${boxNumber}`).addClass('existing-image');

            // Modify the remove button to handle existing images
            $(`#imagePreview_${boxNumber} .remove-btn`).attr('onclick', `removeExistingImage(${boxNumber})`);
          }
        });
      }
    }

    // Function to reset modal to empty state
    function resetUpdateModal() {
      // Clear all form fields
      $('#updateEventModal input[type="number"]').val('');

      // Reset all image upload boxes
      for (let i = 1; i <= 6; i++) {
        $(`#imageUpload_${i}`).val('');
        $(`#imagePreview_${i}`).hide();
        $(`#imagePreview_${i} img`).attr('src', '');
        $(`#imagePreview_${i}`).removeAttr('data-existing-image');
        $(`#imagePreview_${i}`).removeClass('existing-image');
        $(`#imagePreview_${i}`).siblings('.upload-content').show();
        $(`#imagePreview_${i} .remove-btn`).attr('onclick', `removeUploadedImage(${i})`);
      }

      // Remove any tracking inputs for deleted images
      $('input[name="deleted_images[]"]').remove();
    }

    // Function to show loading state in modal
    function showLoadingInModal() {
      const loadingHtml = `
    <div id="loading-indicator" class="text-center p-4" style="background: rgba(255, 255, 255, 0.9); border-radius: 8px; margin: 20px 0;">
      <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
      <div class="mt-2">Loading existing data...</div>
    </div>
    `;
      $('#updateEventModal .modal-body').prepend(loadingHtml);
    }

    // Function to hide loading state
    function hideLoadingInModal() {
      $('#loading-indicator').remove();
    }

    // Enhanced remove function for existing images
    function removeExistingImage(boxNumber) {
      const existingImage = $(`#imagePreview_${boxNumber}`).attr('data-existing-image');

      if (existingImage) {
        // Add hidden input to track deleted images
        if (!$(`input[name="deleted_images[]"][value="${existingImage}"]`).length) {
          $('#image-form').append(`<input type="hidden" name="deleted_images[]" value="${existingImage}">`);
        }

        // Remove the existing image attribute
        $(`#imagePreview_${boxNumber}`).removeAttr('data-existing-image');
        $(`#imagePreview_${boxNumber}`).removeClass('existing-image');
      }

      // Clear the file input and reset the box
      $(`#imageUpload_${boxNumber}`).val('');
      $(`#imagePreview_${boxNumber}`).hide();
      $(`#imagePreview_${boxNumber} img`).attr('src', '');
      $(`#imagePreview_${boxNumber}`).siblings('.upload-content').show();
      $(`#imagePreview_${boxNumber} .remove-btn`).attr('onclick', `removeUploadedImage(${boxNumber})`);
    }

    // Enhanced remove uploaded image function
    function removeUploadedImage(boxNumber) {
      $('#imageUpload_' + boxNumber).val(''); // Clear the file input
      $('#imagePreview_' + boxNumber).hide(); // Hide the preview
      $('#imagePreview_' + boxNumber + ' img').attr('src', ''); // Clear the image
      $('#imagePreview_' + boxNumber).removeAttr('data-existing-image');
      $('#imagePreview_' + boxNumber).removeClass('existing-image');
      $('#imagePreview_' + boxNumber).siblings('.upload-content').show(); // Show the upload box again
    }

    // Enhanced image preview handling
    $(document).ready(function() {
      // Call it on page load
      initializeCKEditor();

      // Initialize DataTable
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

      // Function to handle image preview for all upload boxes
      function handleImagePreview(inputId, previewId) {
        $(inputId).change(function() {
          const file = this.files[0];
          if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
              $(previewId + ' img').attr('src', e.target.result);
              $(previewId).show();
              $(previewId).siblings('.upload-content').hide();

              // Remove existing image attribute since we're uploading new
              $(previewId).removeAttr('data-existing-image');
              $(previewId).removeClass('existing-image');
              $(previewId + ' .remove-btn').attr('onclick', `removeUploadedImage(${previewId.split('_')[1]})`);
            }
            reader.readAsDataURL(file);
          }
        });
      }

      // Initialize preview for all 6 image upload boxes
      for (let i = 1; i <= 6; i++) {
        handleImagePreview('#imageUpload_' + i, '#imagePreview_' + i);
      }

      // Enhanced drag and drop functionality
      $('.upload-box').each(function() {
        const $box = $(this);

        $box.on('dragover', function(e) {
          e.preventDefault();
          e.stopPropagation();
          $box.addClass('dragover');
        });

        $box.on('dragleave', function(e) {
          e.preventDefault();
          e.stopPropagation();
          $box.removeClass('dragover');
        });

        $box.on('drop', function(e) {
          e.preventDefault();
          e.stopPropagation();
          $box.removeClass('dragover');

          const files = e.originalEvent.dataTransfer.files;
          if (files.length > 0) {
            const input = $box.find('.file-input')[0];
            input.files = files;
            $(input).trigger('change');
          }
        });
      });
    });

    // Enhanced form submission handler
    $('#image-form').on('submit', function(e) {
      e.preventDefault();

      // Remove loading indicator if exists
      hideLoadingInModal();

      const formData = new FormData(this);

      // Show submitting state
      const submitBtn = $('#image-form button[type="submit"]');
      const originalText = submitBtn.text();
      submitBtn.prop('disabled', true).text('Updating...');

      $.ajax({
        url: '../api/v1/update_event_details.php',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(data) {
          if (data.success === true) {
            showToast(data.message, 'success');
            $('#updateEventModal').modal('hide');
            setTimeout(() => window.location.reload(), 2000);
          } else {
            showToast(data.message || 'Error occurred', 'error');
          }
        },
        error: function(xhr, status, error) {
          console.error('Error:', error);
          let errorMessage = 'An error occurred while updating the event';

          // Try to get more specific error message
          if (xhr.responseJSON && xhr.responseJSON.message) {
            errorMessage = xhr.responseJSON.message;
          }

          showToast(errorMessage, 'error');
        },
        complete: function() {
          // Reset button state
          submitBtn.prop('disabled', false).text(originalText);
        }
      });
    });

    // Clean up when modal is hidden
    $('#updateEventModal').on('hidden.bs.modal', function() {
      hideLoadingInModal();
      $('input[name="deleted_images[]"]').remove();
    });

    // View Event Function
    function viewEvent(eventId) {
      $('#viewEventModal' + eventId).modal('show');
    }

    // Edit Event Function
    function editEvent(eventId, title, date, time, description, body, location, status, image) {
      $('#editEventId').val(eventId);
      $('#editEventTitle').val(title);
      $('#editEventDate').val(date);
      $('#editEventTime').val(time);
      $('#editEventDescription').val(description);
      $('#editEventLocation').val(location);
      $('#editEventStatus').val(status);
      $('#editPreview').attr('src', image);

      // Store the body content to set after editor is created
      const eventBody = body;

      // Destroy CKEditor instance if it already exists
      if (editEventEditor) {
        editEventEditor.destroy().then(() => {
          createEditor(eventBody); // Pass the body content
        });
      } else {
        createEditor(eventBody); // Pass the body content
      }

      currentEventId = eventId;
      $('#editEventModal').modal('show');
    }

    // Updated createEditor function to accept body content
    function createEditor(bodyContent = '') {
      CKEDITOR.ClassicEditor
        .create(document.getElementById("editEventBody"), {
          toolbar: {
            items: [
              'exportPDF', 'exportWord', '|',
              'findAndReplace', 'selectAll', '|',
              'heading', '|',
              'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript',
              'removeFormat', '|',
              'bulletedList', 'numberedList', 'todoList', '|',
              'outdent', 'indent', '|',
              'undo', 'redo',
              '-',
              'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
              'alignment', '|',
              'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed',
              '|',
              'specialCharacters', 'horizontalLine', 'pageBreak', '|',
              'textPartLanguage', '|',
              'sourceEditing'
            ],
            shouldNotGroupWhenFull: true
          },
          list: {
            properties: {
              styles: true,
              startIndex: true,
              reversed: true
            }
          },
          heading: {
            options: [{
                model: 'paragraph',
                title: 'Paragraph',
                class: 'ck-heading_paragraph'
              },
              {
                model: 'heading1',
                view: 'h1',
                title: 'Heading 1',
                class: 'ck-heading_heading1'
              },
              {
                model: 'heading2',
                view: 'h2',
                title: 'Heading 2',
                class: 'ck-heading_heading2'
              },
              {
                model: 'heading3',
                view: 'h3',
                title: 'Heading 3',
                class: 'ck-heading_heading3'
              },
              {
                model: 'heading4',
                view: 'h4',
                title: 'Heading 4',
                class: 'ck-heading_heading4'
              },
              {
                model: 'heading5',
                view: 'h5',
                title: 'Heading 5',
                class: 'ck-heading_heading5'
              },
              {
                model: 'heading6',
                view: 'h6',
                title: 'Heading 6',
                class: 'ck-heading_heading6'
              }
            ]
          },
          placeholder: 'Enter a detailed description',
          fontFamily: {
            options: [
              'default',
              'Arial, Helvetica, sans-serif',
              'Courier New, Courier, monospace',
              'Georgia, serif',
              'Lucida Sans Unicode, Lucida Grande, sans-serif',
              'Tahoma, Geneva, sans-serif',
              'Times New Roman, Times, serif',
              'Trebuchet MS, Helvetica, sans-serif',
              'Verdana, Geneva, sans-serif'
            ],
            supportAllValues: true
          },
          fontSize: {
            options: [10, 12, 14, 'default', 18, 20, 22],
            supportAllValues: true
          },
          htmlSupport: {
            allow: [{
              name: /.*/,
              attributes: true,
              classes: true,
              styles: true
            }]
          },
          htmlEmbed: {
            showPreviews: true
          },
          link: {
            decorators: {
              addTargetToExternalLinks: true,
              defaultProtocol: 'https://',
              toggleDownloadable: {
                mode: 'manual',
                label: 'Downloadable',
                attributes: {
                  download: 'file'
                }
              }
            }
          },
          mention: {
            feeds: [{
              marker: '@',
              feed: [
                '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes',
                '@chocolate', '@cookie', '@cotton', '@cream',
                '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread',
                '@gummi', '@ice', '@jelly-o',
                '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding',
                '@sesame', '@snaps', '@soufflé',
                '@sugar', '@sweet', '@topping', '@wafer'
              ],
              minimumCharacters: 1
            }]
          },
          removePlugins: [
            'CKBox',
            'CKFinder',
            'EasyImage',
            'RealTimeCollaborativeComments',
            'RealTimeCollaborativeTrackChanges',
            'RealTimeCollaborativeRevisionHistory',
            'PresenceList',
            'Comments',
            'TrackChanges',
            'TrackChangesData',
            'RevisionHistory',
            'Pagination',
            'WProofreader',
            'MathType',
            'SlashCommand',
            'Template',
            'DocumentOutline',
            'FormatPainter',
            'TableOfContents'
          ]
        })
        .then(editor => {
          editEventEditor = editor;
          // Set the body content after editor is created
          if (bodyContent) {
            editor.setData(bodyContent);
          }
        })
        .catch(error => {
          console.error('CKEditor error:', error);
        });
    }

    // Delete Event Function
    function deleteEvent(eventId, eventName) {
      currentEventId = eventId;
      currentEventName = eventName;
      $('#deleteEventName').text(`Delete ${eventName} and ${currentEventId} ? `);
      $('#deleteEventModal').modal('show');
    }

    // Add Event AJAX
    $('#addEventBtn').on('click', function() {
      if (eventEditor) {
        $('#eventBody').val(eventEditor.getData());
      }

      const form = $('#addEventForm')[0];
      let formData = new FormData(form);

      $.ajax({
        url: '../api/v1/add_events.php',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(data) {
          if (data.success === true) {
            showToast(data.message, 'success');
            $('#addEventModal').modal('hide');
            setTimeout(() => window.location.reload(), 2000);
          } else {
            showToast(data.message || 'Error occurred', 'error');
          }
        },
        error: function(xhr, status, error) {
          console.error('Error:', error);
          showToast('An error occurred while adding the event', 'error');
        }
      });
    });

    // Update Event AJAX
    $('#updateEventBtn').on('click', function() {
      // Get CKEditor content
      if (editEventEditor) {
        const editorData = editEventEditor.getData();
        $('#editEventBody').val(editorData); // set the hidden form input
      }

      const form = $('#editEventForm')[0];
      let formData = new FormData(form);

      $.ajax({
        url: '../api/v1/update_event.php',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(data) {
          if (data.success === true) {
            showToast(data.message, 'success');
            $('#editEventModal').modal('hide');
            setTimeout(() => window.location.reload(), 2000);
          } else {
            showToast(data.message || 'Error occurred', 'error');
          }
        },
        error: function(xhr, status, error) {
          console.error('Error:', error);
          showToast('An error occurred while updating the event', 'error');
        }
      });
    });

    // Delete Event AJAX
    $('#confirmDeleteBtn').on('click', function() {
      $.ajax({
        url: '../api/v1/delete_event.php',
        method: 'POST',
        data: {
          eventId: currentEventId
        },
        dataType: 'json',
        success: function(data) {
          if (data.success === true) {
            showToast(data.message, 'success');
            $('#deleteEventModal').modal('hide');
            setTimeout(() => window.location.reload(), 2000);
          } else {
            showToast(data.message || 'Error occurred', 'error');
          }
        },
        error: function(xhr, status, error) {
          console.error('Error:', error);
          showToast('An error occurred while deleting the event', 'error');
        }
      });
    });

    // Helper Functions
    function showToast(message, type) {
      if (type === 'success') {
        $('#toast-message').text(message);
        $('#toast-success').addClass('show');
        setTimeout(() => $('#toast-success').removeClass('show'), 5000);
      } else {
        $('#bad-toast-message').text(message);
        $('#bad-toast').addClass('show');
        setTimeout(() => $('#bad-toast').removeClass('show'), 5000);
      }
    }

    function hideToast() {
      $('#toast-success').removeClass('show');
      $('#bad-toast').removeClass('show');
    }

    function previewImage(event) {
      const reader = new FileReader();
      reader.onload = function() {
        $('#preview').attr('src', reader.result);
      };
      reader.readAsDataURL(event.target.files[0]);
    }

    function previewEditImage(event) {
      const reader = new FileReader();
      reader.onload = function() {
        $('#editPreview').attr('src', reader.result);
      };
      reader.readAsDataURL(event.target.files[0]);
    }

    function initializeCKEditor() {
      CKEDITOR.ClassicEditor
        .create(document.getElementById('eventBody'), {
          toolbar: {
            items: [
              'exportPDF', 'exportWord', '|',
              'findAndReplace', 'selectAll', '|',
              'heading', '|',
              'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript',
              'removeFormat', '|',
              'bulletedList', 'numberedList', 'todoList', '|',
              'outdent', 'indent', '|',
              'undo', 'redo',
              '-',
              'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
              'alignment', '|',
              'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed',
              '|',
              'specialCharacters', 'horizontalLine', 'pageBreak', '|',
              'textPartLanguage', '|',
              'sourceEditing'
            ],
            shouldNotGroupWhenFull: true
          },
          list: {
            properties: {
              styles: true,
              startIndex: true,
              reversed: true
            }
          },
          heading: {
            options: [{
                model: 'paragraph',
                title: 'Paragraph',
                class: 'ck-heading_paragraph'
              },
              {
                model: 'heading1',
                view: 'h1',
                title: 'Heading 1',
                class: 'ck-heading_heading1'
              },
              {
                model: 'heading2',
                view: 'h2',
                title: 'Heading 2',
                class: 'ck-heading_heading2'
              },
              {
                model: 'heading3',
                view: 'h3',
                title: 'Heading 3',
                class: 'ck-heading_heading3'
              },
              {
                model: 'heading4',
                view: 'h4',
                title: 'Heading 4',
                class: 'ck-heading_heading4'
              },
              {
                model: 'heading5',
                view: 'h5',
                title: 'Heading 5',
                class: 'ck-heading_heading5'
              },
              {
                model: 'heading6',
                view: 'h6',
                title: 'Heading 6',
                class: 'ck-heading_heading6'
              }
            ]
          },
          placeholder: 'Enter a detailed description',
          fontFamily: {
            options: [
              'default',
              'Arial, Helvetica, sans-serif',
              'Courier New, Courier, monospace',
              'Georgia, serif',
              'Lucida Sans Unicode, Lucida Grande, sans-serif',
              'Tahoma, Geneva, sans-serif',
              'Times New Roman, Times, serif',
              'Trebuchet MS, Helvetica, sans-serif',
              'Verdana, Geneva, sans-serif'
            ],
            supportAllValues: true
          },
          fontSize: {
            options: [10, 12, 14, 'default', 18, 20, 22],
            supportAllValues: true
          },
          htmlSupport: {
            allow: [{
              name: /.*/,
              attributes: true,
              classes: true,
              styles: true
            }]
          },
          htmlEmbed: {
            showPreviews: true
          },
          link: {
            decorators: {
              addTargetToExternalLinks: true,
              defaultProtocol: 'https://',
              toggleDownloadable: {
                mode: 'manual',
                label: 'Downloadable',
                attributes: {
                  download: 'file'
                }
              }
            }
          },
          mention: {
            feeds: [{
              marker: '@',
              feed: [
                '@apple', '@bears', '@brownie', '@cake', '@candy', '@canes',
                '@chocolate', '@cookie', '@cotton', '@cream',
                '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread',
                '@gummi', '@ice', '@jelly-o',
                '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding',
                '@sesame', '@snaps', '@soufflé',
                '@sugar', '@sweet', '@topping', '@wafer'
              ],
              minimumCharacters: 1
            }]
          },
          removePlugins: [
            'CKBox',
            'CKFinder',
            'EasyImage',
            'RealTimeCollaborativeComments',
            'RealTimeCollaborativeTrackChanges',
            'RealTimeCollaborativeRevisionHistory',
            'PresenceList',
            'Comments',
            'TrackChanges',
            'TrackChangesData',
            'RevisionHistory',
            'Pagination',
            'WProofreader',
            'MathType',
            'SlashCommand',
            'Template',
            'DocumentOutline',
            'FormatPainter',
            'TableOfContents'
          ]
        })
        .then(editor => {
          eventEditor = editor;
        })
        .catch(error => {
          console.error('CKEditor initialization error:', error);
        });
    }
  </script>


  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    let genderChart = null;

    function buildURL() {
      const url = new URL('../api/v1/stats.php', window.location.href);
      const start = document.getElementById('start_date').value;
      const end = document.getElementById('end_date').value;

      if (start && end) {
        url.searchParams.append('start_date', start);
        url.searchParams.append('end_date', end);
      }

      return url;
    }

    async function fetchStats() {
      const url = buildURL();
      const res = await fetch(url);
      const result = await res.json();

      const container = document.getElementById('stats-cards');
      container.innerHTML = '';

      if (result.success) {
        const d = result.data;
        const stats = {
          "Total Attendees": d.total_attendees,
          "BP Screened": d.bp_screened,
          "High BP Detected": d.high_bp_detected,
          "Repeat Attendees": d.repeat_attendees,
          "Counselled": d.counselled,
          "Medications Dispensed": d.medications_dispensed,
          "Referrals": d.referrals,
          "Average Age": parseFloat(d.average_age).toFixed(1),
          "Villages Served": d.villages_served
        };

        for (let label in stats) {
          const card = document.createElement('div');
          card.className = 'card';
          card.innerHTML = `<h3>${label}</h3><p>${stats[label]}</p>`;
          container.appendChild(card);
        }

        // Gender Chart
        const ctx = document.getElementById('genderChart').getContext('2d');
        if (genderChart) genderChart.destroy();
        genderChart = new Chart(ctx, {
          type: 'pie',
          data: {
            labels: ['Male', 'Female'],
            datasets: [{
              label: 'Gender Breakdown',
              data: [d.gender_male, d.gender_female],
              backgroundColor: ['#4e79a7', '#f28e2b']
            }]
          },
          options: {
            responsive: true,
            plugins: {
              title: {
                display: true,
                text: 'Gender Breakdown of Attendees',
                font: {
                  size: 16
                }
              },
              legend: {
                position: 'bottom'
              }
            }
          }
        });
      } else {
        alert("Failed to fetch stats: " + result.error);
      }
    }

    function clearFilters() {
      document.getElementById('start_date').value = '';
      document.getElementById('end_date').value = '';
      fetchStats();
    }

    // Initial fetch
    fetchStats();
  </script>


</body>


</html>