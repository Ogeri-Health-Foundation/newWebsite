<?php
session_start();
require '../api/Database/DatabaseConn.php';

// Create an instance of DatabaseConn and establish connection
$db = new DatabaseConn();
$dbh = $db->connect();

$filter = $_GET['filter'] ?? 'all';

switch ($filter) {
    case 'week':
        $sql = "SELECT bp.blog_id, bp.blog_title, COUNT(bv.id) AS views 
                        FROM blog_views bv
                        JOIN blog_posts bp ON bp.blog_id = bv.blog_id
                        WHERE bv.viewed_at >= NOW() - INTERVAL 7 DAY
                        GROUP BY bp.blog_id
                        ORDER BY views DESC
                        LIMIT 5";
        break;

    case 'month':
        $sql = "SELECT bp.blog_id, bp.blog_title, COUNT(bv.id) AS views 
                        FROM blog_views bv
                        JOIN blog_posts bp ON bp.blog_id = bv.blog_id
                        WHERE bv.viewed_at >= NOW() - INTERVAL 30 DAY
                        GROUP BY bp.blog_id
                        ORDER BY views DESC
                        LIMIT 5";
        break;

    default:
        $sql = "SELECT blog_id, blog_title, views FROM blog_posts ORDER BY views DESC LIMIT 5";
}

$stmt = $dbh->prepare($sql);
$stmt->execute();
$topBlogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
$labels = json_encode(array_column($topBlogs, 'blog_title'));
$values = json_encode(array_column($topBlogs, 'views'));

?>


<?php
//  require_once "./api/Middleware/GlobalAuth.php";

//  class Resources {
//      public function __construct() {  
//          $resource = new Auth();
//          $resource->authenticate();
//      }
//  }

//  new Resources();

?>
<?php

$page_title = "resource - Admin - Ogeri Health Foundation";

$page_author = "Okibe";

$page_description = "";

$page_rel = '../';

$page_name = 'admin';

$customs = array(
    "stylesheets" => ["admin/assets/css/resources.css", "admin/assets/css/add-blog.css", "volunteer/assets/css/volunteers.css"],
    "scripts" => [""]
);

$addons = array(
    "stylesheets" => ["https://some-external-url.css"],
    "scripts" => ["https://some-external-url.js"]
);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include $page_rel . 'admin/includes/admin-head.php'; ?>
    <style>
        /* *{
      overflow-x: auto;
        } */
        /* body {
        height: 100vh;
        overflow-x: hidden;
        }

        main {
            padding: 90px 0px;
            overflow-y: hidden !important;
            background-color: #FBFFFE;
        } */
        .add-border-blue {
            border: 2px solid #3B82F6;

        }

        .add-border-red {
            border: 2px solid #EF4444;
        }

        #toast-success {
            position: fixed;
            bottom: -100px;
            left: 50%;
            transform: translateX(-50%);
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
            z-index: 99999;

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

        .dot-btn {
            /* border: 2px red solid !important; */
            cursor: pointer;
        }

        .modal-box-blog {
            display: none;
            position: absolute;
            background: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.15);
            padding: 10px;
            border-radius: 6px;
            min-width: 180px;
        }

        .modal-box-blog .action {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .modal-box-blog .action:hover {
            background: #f0f0f0;
        }



        #bad-toast {
            position: fixed;
            bottom: -100px;
            left: 50%;
            transform: translateX(-50%);
            background: white;
            color: #4a5568;
            display: flex;
            align-items: center;
            width: auto;
            max-width: 300px;
            padding: 15px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: bottom 0.5s ease;
            z-index: 99999;
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


        .modal {
            display: none;
            position: fixed;
            top: 0;
            right: 0 !important;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
            /* background-color: #fff; */
        }

        .modal.active {
            display: flex;
            align-items: center;
        }

        .modal img {
            /* width: 600px; */
            border-radius: 3px;
        }

        .modal-content {
            overflow-y: auto;
            background-color: white;
            border-radius: 0.5rem;
            padding: 2rem;
            width: 100%;
            /* height: 700px; */
            max-width: 750px;
            margin: auto;

        }

        .modal-content h2 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .modal-bodyy {
            background-color: #fff;
            padding: 5rem 0;
            height: 100%;
            width: 70%;
            overflow-y: scroll;

        }

        .upload-box {
            border: 2px dashed #ccc;
            padding: 20px;
            cursor: pointer;
            width: 100%;
            height: 150px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;

        }

        .upload-box img {
            max-height: 100%;
            max-width: 100%;
            object-fit: cover;

        }


        /* Details Modal */
        .details-modal-content {
            max-width: 800px;
            max-height: 90vh;
            overflow-y: auto;
        }

        .details-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .volunteer-photo {
            display: grid;


            width: 30% !important;
        }

        .volunteer-photo img {
            width: 100% !important;
            border-radius: 0.5rem;
            /* border: 2px blue solid; */
        }

        .volunteer-details {
            width: 70% !important;
        }

        .volunteer-info {
            display: flex;
            /* flex-direction: column; */
            gap: 2rem;
            margin-top: 30px;
        }

        .detail-item {
            display: flex;
            gap: 1.5rem;
            align-items: flex-start;
        }

        .detail-label {
            font-weight: 500;
            width: 150px;
        }

        .professional-info {
            margin-top: 20px;
            /* display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem; */
            margin-bottom: 1.5rem;
            /* border: 2px red solid; */
        }

        .certification-section,
        .reason-section {
            margin-bottom: 1.5rem;
        }



        .certification-section h3,
        .reason-section h3 {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .certification-container {
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            padding: 0.5rem;
            position: relative;
        }

        .certification-container img {
            width: 100%;
            height: auto;
        }

        .download-btn {
            position: absolute;
            bottom: 1rem;
            right: 1rem;
        }

        .details-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        /* Delete Modal */
        .delete-modal-content {
            max-width: 450px;
        }

        .delete-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .delete-icon {
            width: 48px;
            height: 48px;
            background-color: rgba(255, 59, 48, 0.1);
            color: var(--danger-color);
            border-radius: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            cursor: pointer;
        }

        .delete-message {
            color: #666;
            margin-bottom: 1.5rem;
        }

        .delete-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
        }

        .doctor-action-menu .action {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            transition: background 0.3s;
        }

        .doctor-action-menu .action:hover {
            background-color: #f1f1f1;
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .modal-content {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            width: 400px;
            max-width: 90%;
            position: relative;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.3);
        }

        .close-btn {
            position: absolute;
            right: 15px;
            top: 10px;
            font-size: 24px;
            cursor: pointer;
        }

        .custom-wide-modal {
            width: 90% !important;
            /* Wider than modal-lg */
            max-width: 1200px;
            /* Optional: limit for huge screens */
            margin: auto;
        }

        .custom-wide-modal .modal-content {
            max-height: 90vh;
            overflow-y: auto;
            /* Optional: keep your border */
        }
    </style>
</head>

<body>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

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


        });
    </script>
    <?php $page = 'resources'; ?>
    <?php include $page_rel . 'admin/includes/topbar.php'; ?>
    <main class="">


        <style>
            /* Edit Modal Styles */
            #edit-modal {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 1000;
                align-items: center;
                justify-content: center;
                overflow-y: auto;
                padding: 20px;
                box-sizing: border-box;
            }

            #edit-modal .modal-dialog {
                display: flex;
                justify-content: center;
                max-height: 95%;
                overflow-y: auto;
                width: 80%;
                max-width: 1200px;
                margin: 0;
            }

            #edit-modal .modal-content {
                background-color: #fff;
                width: 100%;
                border-radius: 8px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                position: relative;
                max-height: 90vh;
                overflow-y: auto;
                padding: 0;
            }

            #edit-modal .modal-header {
                padding: 20px 30px;
                border-bottom: 1px solid #dee2e6;
                display: flex;
                justify-content: space-between;
                align-items: center;
                background-color: #f8f9fa;
                border-radius: 8px 8px 0 0;
            }

            #edit-modal .modal-title {
                margin: 0;
                font-size: 1.25rem;
                font-weight: 600;
                color: #333;
            }

            #edit-modal .close-edit-btn {
                background: none;
                border: none;
                cursor: pointer;
                padding: 5px;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.2s ease;
                border-radius: 4px;
            }

            #edit-modal .close-edit-btn:hover {
                background-color: #e9ecef;
                transform: scale(1.1);
            }

            #edit-modal .modal-body {
                padding: 30px;
            }

            #edit-modal .form-label {
                font-weight: 500;
                margin-bottom: 8px;
                color: #333;
            }

            #edit-modal .form-control {
                border: 1px solid #ced4da;
                border-radius: 4px;
                padding: 10px 12px;
                font-size: 14px;
                transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            }

            #edit-modal .form-control:focus {
                border-color: #80bdff;
                outline: 0;
                box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            }

            #edit-modal .upload-box {
                border: 2px dashed #ccc;
                padding: 20px;
                cursor: pointer;
                width: 100%;
                height: 150px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: #f8f9fa;
                border-radius: 4px;
                transition: border-color 0.2s ease;
            }

            #edit-modal .upload-box:hover {
                border-color: #007bff;
            }

            #edit-modal .upload-box img {
                max-height: 100%;
                max-width: 100%;
                object-fit: cover;
                border-radius: 4px;
            }

            #edit-modal .btn {
                padding: 10px 20px;
                border-radius: 4px;
                font-weight: 500;
                text-decoration: none;
                display: inline-block;
                cursor: pointer;
                transition: all 0.2s ease;
                border: 1px solid transparent;
            }

            #edit-modal .btn-primary {
                background-color: #007bff;
                border-color: #007bff;
                color: #fff;
            }

            #edit-modal .btn-primary:hover {
                background-color: #0056b3;
                border-color: #0056b3;
            }

            #edit-modal .btn-secondary {
                background-color: #6c757d;
                border-color: #6c757d;
                color: #fff;
            }

            #edit-modal .btn-secondary:hover {
                background-color: #545b62;
                border-color: #545b62;
            }

            /* Responsive adjustments */
            @media (max-width: 768px) {
                #edit-modal {
                    padding: 10px;
                }

                #edit-modal .modal-dialog {
                    width: 95%;
                }

                #edit-modal .modal-body {
                    padding: 20px;
                }

                #edit-modal .modal-header {
                    padding: 15px 20px;
                }
            }

            /* Show modal when active */
            #edit-modal.active {
                display: flex !important;
            }
        </style>

        <div class="modal" id="edit-modal">
            <div class="modal-dialog modal-dialog-centered custom-wide-modal" style="display:flex; justify-content:center; max-height: 95%; overflow-y: scroll; width: 80%;">
                <div class="modal-content" style='background-color: #fff; width: 100%;'>
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Blog</h5>
                        <!-- Changed: Removed data-bs-dismiss, added unique ID -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="btn-close close-edit-btn" style="cursor: pointer;" aria-label="Close" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="13" height="13">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="postForm" enctype="multipart/form-data">

                            <div class="mb-3">
                                <label class="form-label">Blog Title*</label>
                                <input type="text" id="Title" class="form-control" name="Title" placeholder="Enter Blog Title" value="<?php echo isset($post) ? $post['title'] : ''; ?>" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Cover Image</label>
                                <div class="upload-box text-center" onclick="document.getElementById('cover_image').click();">
                                    <input type="file" id="cover_image" name="cover_image" accept="image/*" hidden onchange="previewImage(event)">
                                    <img id="preview" src="<?php echo isset($post['image']) ? 'uploads/' . $post['image'] : 'assets/images/upload-placeholder.svg'; ?>" alt="Upload Image">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Blog Description*</label>
                                <input type="text" id="Description" class="form-control" name="Description" placeholder="Enter Description" value="<?php echo isset($post) ? $post['description'] : ''; ?>" required>
                            </div>


                            <div class="mb-3">
                                <label class="form-label">Category*</label>
                                <select class="form-select" name="Category" id="Category" required>
                                    <option value="">Choose a Category...</option>
                                    <option value="community_health_stories" <?php echo (isset($post) && $post['category'] == 'community_health_stories') ? 'selected' : ''; ?>>
                                        Community Health Stories
                                    </option>
                                    <option value="hypertension_heart_health" <?php echo (isset($post) && $post['category'] == 'hypertension_heart_health') ? 'selected' : ''; ?>>
                                        Hypertension & Heart Health
                                    </option>
                                    <option value="health_education_lifestyle" <?php echo (isset($post) && $post['category'] == 'health_education_lifestyle') ? 'selected' : ''; ?>>
                                        Health Education & Lifestyle
                                    </option>
                                    <option value="digital_health_innovation" <?php echo (isset($post) && $post['category'] == 'digital_health_innovation') ? 'selected' : ''; ?>>
                                        Digital Health & Innovation
                                    </option>
                                    <option value="outreach_highlights" <?php echo (isset($post) && $post['category'] == 'outreach_highlights') ? 'selected' : ''; ?>>
                                        Outreach Highlights
                                    </option>
                                    <option value="research_insights" <?php echo (isset($post) && $post['category'] == 'research_insights') ? 'selected' : ''; ?>>
                                        Research & Insights
                                    </option>
                                    <option value="volunteer_partner_spotlights" <?php echo (isset($post) && $post['category'] == 'volunteer_partner_spotlights') ? 'selected' : ''; ?>>
                                        Volunteer & Partner Spotlights
                                    </option>
                                    <option value="events_announcements" <?php echo (isset($post) && $post['category'] == 'events_announcements') ? 'selected' : ''; ?>>
                                        Events & Announcements
                                    </option>
                                    <option value="health_centre_strengthening" <?php echo (isset($post) && $post['category'] == 'health_centre_strengthening') ? 'selected' : ''; ?>>
                                        Health Centre Strengthening
                                    </option>
                                    <option value="funding_support" <?php echo (isset($post) && $post['category'] == 'funding_support') ? 'selected' : ''; ?>>
                                        Funding & Support
                                    </option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Body*</label>
                                <textarea class="form-control text-areaa" id="Body" name="Body" row="30">
                                <?php echo isset($post) ? $post['body'] : ''; ?>
                                </textarea>
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="submit" name="save_publish" class="btn btn-primary" id="Publish">Update And Publish</button>
                                <button type="submit" name="save_draft" class="btn btn-secondary" id="Draft">Cancel</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>

        <!-- view details modal -->

        <div class="modal" id="volunteerDetailsModal">
            <div class="modal-dialog modal-dialog-centered custom-wide-modal" style="display:flex; justify-content:center; max-height: 95%; overflow-y: scroll; width: 80%;">
                <div class="modal-content" style='background-color: #fff; width: 100%;'>
                    <div class="modal-header">
                        <h5 class="modal-title">Blog Details</h5>
                        <svg xmlns="http://www.w3.org/2000/svg" class="btn-close" style="cursor: pointer;" data-bs-dismiss="modal" aria-label="Close" id="close-modal" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="13" height="13">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <div class="modal-body">
                        <div class="status-badge-container">
                            <span class="status-badge" id="detailsStatusBlog">Pending</span>
                        </div>
                        <div class="volunteer-info">
                            <div class="volunteer-photo">
                                <img src="../assets/images/includes/user1.svg" id="detailsImage">
                            </div>
                            <div class="volunteer-details">
                                <div class="detail-item">
                                    <h6 class="detail-label">Blog title:</h6>
                                    <p class="detail-value" id="detailsTitle"></p>
                                </div>
                                <div class="detail-item">
                                    <h6 class="detail-label">Posted Date:</h6>
                                    <p class="detail-value" id="detailsDate"></p>
                                </div>
                                <div class="detail-item">
                                    <h6 class="detail-label">Category:</h6>
                                    <p class="detail-value" id="detailsCategory"></p>
                                </div>
                                <div class="detail-item">
                                    <h6 class="detail-label">Description:</h6>
                                    <p class="detail-value" id="detailsDescription"></p>
                                </div>
                                <div class="detail-item">
                                    <h6 class="detail-label">Body:</h6>
                                    <p class="detail-value" id="detailsBody"></p>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <!-- error or success message -->
        <div id="toast-success">
            <div class="icon">✔</div>
            <div id="toast-message">login success</div>
            <button class="close-btn" onclick="hideToast()">&times;</button>
        </div>

        <div id="bad-toast">
            <div class="bad-icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="13" height="13">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            <div id="bad-toast-message">login not successful</div>
            <button class="close-btn" onclick="hideBadToast()">&times;</button>
        </div>

        <section class="welcome-box container">
            <div class="info-box">
                <h2>Hi Admin</h2>
                <p class="greeting-text">Good afternoon</p>
            </div>
            <a href="add-blog.php" class="create-blog text-decoration-none">
                <span>Add Blog</span>
                <img
                    src="./assets/images/resources/icons/Vector.png"
                    alt="downward-arrow" />
            </a>
        </section>

        <script>
            // const greetingEl = document.querySelector('.greeting-text');

            // const hour = new Date().getHours();
            // let greeting = '';

            // if (hour >= 5 && hour < 12) {
            //     greeting = 'Good morning';
            // } else if (hour >= 12 && hour < 17) {
            //     greeting = 'Good afternoon';
            // } else {
            //     greeting = 'Good evening';
            // }

            // greetingEl.textContent = greeting;
        </script>

        <section class="blog-engagement container">
            <div class="blog_post_total">
                <div class="blog-post">
                    <div class="blog-stats">
                        <p>Blog Post</p>
                        <p id="blog-total">0</p>
                        <small>
                            <span class="change-amt">+0% </span>since last month
                        </small>
                    </div>
                    <div class="person-icon">
                        <img
                            src="./assets/images/resources/icons/Icon-3p.png"
                            alt="people icon"
                            class=""
                            height="25px"
                            width="25px" />
                    </div>
                </div>
            </div>
            <div class="graph-container">
                <div class="bp-graph" style="height: 100%; width: 90%">
                    <canvas id="bp-graph" style="height: 100%; width: 100%"></canvas>
                </div>
            </div>
        </section>
        <section>
            <div class="card mt-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Top Blog Posts</h5>
                    <form method="get">
                        <select class="form-select form-select-sm w-auto" name="filter" onchange="this.form.submit()">
                            <option value="all" <?= $filter == 'all' ? 'selected' : '' ?>>All Time</option>
                            <option value="week" <?= $filter == 'week' ? 'selected' : '' ?>>Last 7 Days</option>
                            <option value="month" <?= $filter == 'month' ? 'selected' : '' ?>>Last 30 Days</option>
                        </select>
                    </form>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <?php foreach ($topBlogs as $blog): ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <?= htmlspecialchars($blog['blog_title']) ?>
                                <span class="badge bg-primary rounded-pill"><?= $blog['views'] ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <canvas id="topBlogsChart" height="100" class="mt-5"></canvas>
        </section>





        <!-- empty table -->
        <section class="blog-section filled-blog-table container">
            <div class="blog-section-header">
                <h2 class="title-text">Recent Blogs</h2>
                <a href="blogs.php" class="view-all text-muted">View All</a>
            </div>
            <div class="table-container">
                <table class="volunteers-table">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Date Created</th>
                            <th>Date Published</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>

                    </thead>
                    <tbody class="blog_table">
                        <!-- <td> -->

                        <!-- </td> -->

                    </tbody>

                </table>



                <p class="no-blogs">No Blogs Available</p>
            </div>
        </section>
        <div id="doctorDetailsModal" class="modal-overlay" style="display: none;">
            <div class="modal-content">
                <span class="close-btn" id="closeDoctorModal">&times;</span>
                <h2>Doctor Details</h2>
                <div id="doctorDetailsBody">
                    <!-- Content will be injected here -->
                    <p>Loading...</p>
                </div>
            </div>
        </div>




        <!-- doctor and nurses section empty table-->
        <section class="blog-section container mt-5">
            <section class="welcome-box">
                <div class="info-box">
                    <h2>Health workers</h2>
                    <p class="greeting-text">Details and availability</p>
                </div>
                <a href="add-members.php" class="create-blog text-decoration-none">
                    Add New
                    <img
                        src="./assets/images/resources/icons/Vector.png"
                        alt="downward-arrow" />
                </a>
            </section>




            <!-- availability -->
            <div class="stats-container-doctors">
                <div class="blog-post">
                    <div class="blog-stats">
                        <p>Avl Health workers</p>
                        <p class="doctor-count">0</p>
                        <small><span class="change-amt">+0% </span> since last month</small>
                    </div>
                    <div class="person-icon">
                        <img
                            src="./assets/images/resources/icons/Icon-3p.png"
                            alt="people icon"
                            class=""
                            height="25px"
                            width="25px" />
                    </div>
                </div>

                <div class="drafts">
                    <div class="blog-stats">
                        <p>Total Health workers</p>
                        <p class="physiologist-count">0</p>
                        <small><span class="change-amt">+0% </span>since last month</small>
                    </div>
                    <div>
                        <img
                            src="./assets/images/resources/icons/persons_2.png"
                            alt="person icon"
                            height="44px"
                            width="44px" />
                    </div>
                </div>
            </div>

            <div class="blog-section-header">
                <h2 class="title-text">Recent Health workers</h2>
                <a href="blogs.php" class="view-all text-muted">View All</a>
            </div>

            <div style="position: relative;">
                <table class="filled-doctors-table">
                    <thead>
                        <tr>
                            <th>Doctor ID</th>
                            <th>Name</th>
                            <!-- <th>Status</th> -->
                            <th>Area of Specialization</th>
                            <th>Availability</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

                <div class="computer-img-box no-doctors-message" style="display: none;">
                    <img
                        src="./assets/images/resources/img/doctor-image.png"
                        alt="computer-image"
                        class="computer-img" />
                    <p>No Health workers yet</p>
                </div>

            </div>
        </section>
        <!-- doctors and nurses section filled table -->
        <style>
            .no-blogs {
                text-align: center;
                font-weight: bold;
                font-size: 18px;
                margin-top: 20px;
                display: none;
            }
        </style>
    </main>
    <?php include $page_rel . 'admin/includes/sidebar.php'; ?>
    <script src="./assets/js/resources.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>







    <!-- After the HTML content, before closing </body> tag -->

    <!-- Main Scripts -->
    <script src="./assets/js/resources.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Utility Functions -->
    <script>
        // Toast message functions
        function showToast(message) {
            const toast = document.getElementById('toast-success');
            const toastMessage = document.getElementById('toast-message');
            if (toast && toastMessage) {
                toast.classList.add('show');
                toastMessage.textContent = message;
                setTimeout(() => toast.classList.remove('show'), 5000);
            }
        }

        function showBadToast(message) {
            const badToast = document.getElementById('bad-toast');
            const badToastMessage = document.getElementById('bad-toast-message');
            if (badToast && badToastMessage) {
                badToast.classList.add('show');
                badToastMessage.textContent = message;
                setTimeout(() => badToast.classList.remove('show'), 5000);
            }
        }

        function hideToast() {
            const Toast = document.getElementById('toast-success');
            Toast.classList.remove('show');
        }

        function hideBadToast() {
            const BadToast = document.getElementById('bad-toast');
            BadToast.classList.remove('show');
        }

        // Date formatting
        function formatDate(dateString) {
            if (!dateString || dateString === "0000-00-00 00:00:00") return "N/A";
            const date = new Date(dateString);
            return date.toLocaleDateString("en-GB");
        }

        // Greeting based on time of day
        function setGreeting() {
            const greetingEl = document.querySelector('.greeting-text');
            const hour = new Date().getHours();
            let greeting = '';

            if (hour >= 5 && hour < 12) {
                greeting = 'Good morning';
            } else if (hour >= 12 && hour < 17) {
                greeting = 'Good afternoon';
            } else {
                greeting = 'Good evening';
            }

            greetingEl.textContent = greeting;
        }
    </script>

    <!-- Blog Related Functions -->
    <script>
        // Global variables
        let currentBlogId = null;
        let isEditModalOpen = false;

        // Main blog fetching function
        function fetchBlogs() {
            fetch("../api/v1/blogs_route.php")
                .then(response => response.json())
                .then(blogs => {
                    const tbody = document.querySelector(".blog_table");
                    const content = document.querySelector(".no-blogs");

                    if (!tbody) {
                        console.error("Table body (tbody) not found!");
                        return;
                    }

                    tbody.innerHTML = "";

                    if (blogs.length === 0) {
                        content.style.display = "block";
                        return;
                    } else {
                        content.style.display = "none";
                    }

                    let sn = 1;

                    blogs.forEach(blog => {
                        const row = document.createElement("tr");
                        row.innerHTML = `
                        <td>${sn++}</td>
                        <td class="blog-title">${blog.blog_title}</td>
                        <td>${blog.category.replace(/_/g, ' ')}</td>
                        <td>${formatDate(blog.created_at)}</td>
                        <td>${formatDate(blog.published_at)}</td>
                        <td><span class="${blog.status.toLowerCase()}">${blog.status}</span></td>
                        <td>
                            <img src="./assets/images/resources/img/Icon.png" data-id="${blog.blog_id}" alt="More actions" class="dot-btn"/>
                            <div class="modal-box-blog">
                                <div class="action">
                                    <i class="fas fa-eye"></i>
                                    <span>View details</span>
                                </div>
                                <div class="action">
                                    <i class="fas fa-edit"></i>
                                    <span>Edit Blog</span>
                                </div>
                                <div class="action">
                                    <i class="fas fa-save"></i>
                                    <span>Save Draft</span>
                                </div>
                                <div class="action">
                                    <i class="fas fa-upload"></i>
                                    <span>Publish Blog</span>
                                </div>
                            </div>
                        </td>
                    `;
                        tbody.appendChild(row);
                    });

                    addDotBtnListeners();
                })
                .catch(error => {
                    console.error("Error fetching blogs:", error);
                    showBadToast("Error loading blogs");
                });
        }

        // Blog statistics
        async function getBlogTotal() {
            try {
                const response = await fetch("../api/v1/blog_total.php");
                const data = await response.json();

                let DisplayNum = document.getElementById("blog-total");
                let DisplayNum2 = document.getElementById("blog-total2");
                DisplayNum.textContent = data.total;
                DisplayNum2.textContent = data.total;
            } catch (error) {
                console.error("Error fetching blog total:", error);
                showBadToast("Error loading blog statistics");
            }
        }

        // Blog action dropdown handlers
        function addDotBtnListeners() {
            document.querySelectorAll(".dot-btn").forEach((btn) => {
                btn.addEventListener("click", function(event) {
                    const td = btn.closest("td");
                    const actionMenu = td.querySelector(".modal-box-blog");

                    // Hide other modals first
                    document.querySelectorAll(".modal-box-blog").forEach(menu => {
                        menu.style.display = "none";
                    });

                    // Position the modal
                    const rect = btn.getBoundingClientRect();
                    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                    const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;

                    let x = rect.left + scrollLeft;
                    let y = rect.bottom + scrollTop + 5;

                    const modalWidth = actionMenu.offsetWidth;
                    if (x + modalWidth > window.innerWidth - 10) {
                        x = rect.right + scrollLeft - modalWidth;
                    }

                    actionMenu.style.position = "absolute";
                    actionMenu.style.right = "70px";
                    actionMenu.style.top = `${y}px`;
                    actionMenu.style.zIndex = 1000;
                    actionMenu.style.display = "block";
                });
            });

            // Hide menu when clicking outside
            document.addEventListener("click", function(e) {
                if (!e.target.closest(".dot-btn") && !e.target.closest(".modal-box-blog")) {
                    document.querySelectorAll(".modal-box-blog").forEach(menu => {
                        menu.style.display = "none";
                    });
                }
            });
        }

        // Blog detail view
        async function fetchBlogDetails(blogId) {
            try {
                const response = await fetch(`../api/v1/post_blog.php?blogId=${encodeURIComponent(blogId)}`);
                const data = await response.json();

                document.getElementById("detailsTitle").textContent = data.blog_title;
                document.getElementById("detailsStatusBlog").textContent = data.status;
                document.getElementById("detailsDate").textContent = data.created_at;
                document.getElementById("detailsCategory").textContent = data.category;
                document.getElementById("detailsDescription").textContent = data.blog_description;
                document.getElementById("detailsBody").innerHTML = data.body;
                document.getElementById("detailsImage").src = `../uploads/${data.image}`;

                const ViewModal = document.getElementById("volunteerDetailsModal");
                ViewModal.classList.add('active');
            } catch (error) {
                console.error("Error fetching blog details:", error);
                showBadToast("Error loading blog details");
            }
        }

        // Blog edit functionality
        function openEditModal(blogId) {
            currentBlogId = blogId;
            const editModal = document.getElementById("edit-modal");
            editModal.style.display = "flex";
            isEditModalOpen = true;
            fetchDataValue(blogId);
        }

        function closeEditModal() {
            const editModal = document.getElementById("edit-modal");
            editModal.style.display = "none";
            isEditModalOpen = false;
            currentBlogId = null;

            const form = document.getElementById("postForm");
            if (form) {
                form.reset();
                document.getElementById('preview').src = "assets/images/upload-placeholder.svg";
            }
        }

        async function fetchDataValue(blogId) {
            try {
                const response = await fetch(`../api/v1/post_blog.php?blogId=${encodeURIComponent(blogId)}`);
                const data = await response.json();

                document.getElementById("Title").value = data.blog_title || '';
                document.getElementById("Description").value = data.blog_description || '';
                document.getElementById("Category").value = data.category || '';
                document.getElementById("Body").value = data.body || '';
                document.getElementById("preview").src = data.image ? `../uploads/${data.image}` : "assets/images/upload-placeholder.svg";

                if (window.BodyEditor) {
                    window.BodyEditor.setData(data.body || '');
                }
            } catch (error) {
                console.error("Error fetching blog data:", error);
                showBadToast("Error loading blog data");
            }
        }

        function initializePublishHandler() {
            const publishBtn = document.getElementById("Publish");
            if (publishBtn) {
                publishBtn.addEventListener("click", handlePublishClick);
            }
        }

        // function handlePublishClick(e) {
        //     e.preventDefault();

        //     if (!currentBlogId) {
        //         showBadToast("No blog selected for editing");
        //         return;
        //     }

        //     const form = document.getElementById("postForm");
        //     let formData = new FormData(form);
        //     let isValid = true;

        //     // Validate form
        //     for (let [key, value] of formData.entries()) {
        //         if (typeof value === "string") {
        //             let trimmedValue = value.trim();
        //             formData.set(key, trimmedValue);

        //             if (trimmedValue === "" && key !== "cover_image") {
        //                 isValid = false;
        //                 showBadToast(`${key} cannot be empty`);
        //                 return;
        //             }
        //         }
        //     }

        //     formData.append("blogId", currentBlogId);

        //     const fileInput = document.getElementById("cover_image");
        //     if (fileInput.files.length > 0) {
        //         formData.append("cover_image", fileInput.files[0]);
        //     }

        //     // Submit form
        //     fetch("../api/v1/update_post_blog.php", {
        //             method: "POST",
        //             body: formData
        //         })
        //         .then(response => response.json())
        //         .then(data => {
        //             if (data.success) {
        //                 showToast(data.message);
        //                 setTimeout(() => {
        //                     closeEditModal();
        //                     fetchBlogs();
        //                 }, 1500);
        //             } else {
        //                 showBadToast(data.message || "Update failed");
        //             }
        //         })
        //         .catch(error => {
        //             console.error("Error:", error);
        //             showBadToast("Network error occurred");
        //         });
        // }
        function handlePublishClick(e) {
            e.preventDefault();

            if (!currentBlogId) {
                showBadToast("No blog selected for editing");
                return;
            }

            // Sync CKEditor content with textarea before creating FormData
            if (window.BodyEditor) {
                document.getElementById("Body").value = window.BodyEditor.getData();
            }

            const form = document.getElementById("postForm");
            let formData = new FormData(form);
            let isValid = true;

            // Validate form
            for (let [key, value] of formData.entries()) {
                if (typeof value === "string") {
                    let trimmedValue = value.trim();
                    formData.set(key, trimmedValue);

                    if (trimmedValue === "" && key !== "cover_image") {
                        isValid = false;
                        showBadToast(`${key} cannot be empty`);
                        return;
                    }
                }
            }

            formData.append("blogId", currentBlogId);

            const fileInput = document.getElementById("cover_image");
            if (fileInput.files.length > 0) {
                formData.append("cover_image", fileInput.files[0]);
            }

            fetch("../api/v1/update_post_blog.php", {
                    method: "POST",
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showToast(data.message);
                        setTimeout(() => {
                            closeEditModal();
                            fetchBlogs();
                        }, 1500);
                    } else {
                        showBadToast(data.message || "Update failed");
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                    showBadToast("Network error occurred");
                });
        }


        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('preview').src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

    <!-- Health Workers Functions -->
    <script>
        // Doctor/nurse related functions
        function fetchDoctors() {
            fetch("../api/v1/doctor_route.php")
                .then(response => response.json())
                .then(doctors => {
                    const tableContainer = document.querySelector(".table-container");
                    const table = document.querySelector(".filled-doctors-table");
                    const tbody = table ? table.querySelector("tbody") : null;
                    let emptyMessage = document.querySelector(".empty-doctors-table");

                    if (!tableContainer || !table || !tbody) return;

                    tbody.innerHTML = "";

                    if (doctors.length === 0) {
                        table.style.display = "none";
                        if (!emptyMessage) {
                            emptyMessage = document.createElement("div");
                            emptyMessage.classList.add("computer-img-box", "empty-doctors-table");
                            emptyMessage.innerHTML = `
                            <img src="./assets/images/resources/img/doctor-image.png" alt="computer-image" class="computer-img" />
                            <p>No Health workers Yet</p>
                        `;
                            tableContainer.appendChild(emptyMessage);
                        } else {
                            emptyMessage.style.display = "block";
                        }
                        return;
                    }

                    if (emptyMessage) emptyMessage.style.display = "none";
                    table.style.display = "table";

                    doctors.forEach((doctor, index) => {
                        const row = document.createElement("tr");
                        row.innerHTML = `
                        <td>${index + 1}</td>
                        <td>${doctor.name}</td>
                        <td>${doctor.role}</td>
                        <td>
                            <label class="toggle-switch">
                                <input type="checkbox" data-id="${doctor.id}" name="${doctor.role}" ${doctor.is_available ? "checked" : ""} />
                                <span class="slider"></span>
                            </label>
                        </td>
                        <td>
                            <img src="./assets/images/resources/img/Icon.png" data-id="${doctor.id}" alt="More actions" class="dot-doc-btn" />
                        </td>
                    `;
                        tbody.appendChild(row);
                    });

                    addDotDoctorBtnListeners();

                    document.querySelectorAll(".toggle-switch input").forEach(input => {
                        input.addEventListener("change", function() {
                            const doctorId = this.getAttribute("data-id");
                            const availability = this.checked ? 1 : 0;
                            const role = this.getAttribute("name");
                            updateAvailability(doctorId, availability, role);
                        });
                    });
                })
                .catch(error => console.error("Error fetching doctors:", error));
        }

        function addDotDoctorBtnListeners() {
            document.querySelectorAll(".dot-doc-btn").forEach((btn) => {
                btn.addEventListener("click", function(event) {
                    const existingMenu = document.querySelector(".doctor-action-menu");
                    if (existingMenu) existingMenu.remove();

                    const doctorId = btn.getAttribute("data-id");

                    const actionMenu = document.createElement("div");
                    actionMenu.className = "doctor-action-menu";
                    actionMenu.innerHTML = `
                    <div class="action" data-action="view" data-id="${doctorId}">
                        <img src="./assets/images/resources/icons/Icon (3).png" width="19" height="14px" />
                        <span>View details</span>
                    </div>
                    <div class="action" data-action="delete" data-id="${doctorId}">
                        <img src="./assets/images/resources/icons/trash-can-10417.png" width="16px" height="18px" />
                        <span>Delete</span>
                    </div>
                `;

                    const rect = btn.getBoundingClientRect();
                    actionMenu.style.position = "absolute";
                    actionMenu.style.top = `${window.scrollY + rect.bottom + 5}px`;
                    actionMenu.style.left = `${window.scrollX + rect.left}px`;
                    actionMenu.style.zIndex = 1000;
                    actionMenu.style.background = "#fff";
                    actionMenu.style.border = "1px solid #ccc";
                    actionMenu.style.boxShadow = "0px 2px 6px rgba(0,0,0,0.2)";
                    actionMenu.style.borderRadius = "8px";
                    actionMenu.style.padding = "10px";
                    actionMenu.style.cursor = "pointer";

                    document.body.appendChild(actionMenu);

                    const closeOnClickOutside = function(e) {
                        if (!actionMenu.contains(e.target)) {
                            actionMenu.remove();
                            document.removeEventListener("click", closeOnClickOutside);
                        }
                    };

                    setTimeout(() => document.addEventListener("click", closeOnClickOutside), 10);

                    actionMenu.querySelectorAll(".action").forEach((actionItem) => {
                        actionItem.addEventListener("click", function() {
                            const action = this.getAttribute("data-action");
                            const id = this.getAttribute("data-id");

                            if (action === "view") {
                                viewDoctorDetails(id);
                            } else if (action === "delete") {
                                deleteDoctor(id);
                            }

                            actionMenu.remove();
                        });
                    });
                });
            });
        }

        function updateAvailability(id, availability, role) {
            fetch("../api/v1/doctor_route.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        id,
                        availability,
                        role
                    }),
                })
                .then(response => response.json())
                .then(data => console.log(data.message))
                .catch(error => console.error("Error updating availability:", error));
        }

        function viewDoctorDetails(id) {
            const modal = document.getElementById("doctorDetailsModal");
            const modalBody = document.getElementById("doctorDetailsBody");
            const closeBtn = document.getElementById("closeDoctorModal");

            modal.style.display = "flex";
            modalBody.innerHTML = "<p>Loading...</p>";

            fetch(`../api/v1/doctor_route.php?id=${id}`)
                .then((res) => res.json())
                .then((data) => {
                    const doctor = data.find((d) => d.id === id);
                    if (!doctor) {
                        modalBody.innerHTML = "<p>Doctor not found.</p>";
                        return;
                    }

                    modalBody.innerHTML = `
                    <img 
                        src="${doctor.image ? '../Staff_images/' + doctor.image : '../assets/img/default-image.jpg'}" 
                        alt="${doctor.name}" 
                        style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%; margin-bottom: 10px;"
                    />
                    <p><strong>ID:</strong> ${doctor.id}</p>
                    <p><strong>Name:</strong> ${doctor.name}</p>
                    <p><strong>Role:</strong> ${doctor.role}</p>
                    <p><strong>Status:</strong> ${doctor.status}</p>
                    <p><strong>Available:</strong> ${doctor.is_available == 1 ? "Yes" : "No"}</p>
                `;
                });

            closeBtn.onclick = () => modal.style.display = "none";
            window.onclick = (e) => {
                if (e.target === modal) modal.style.display = "none";
            };
        }

        function deleteDoctor(id) {
            if (confirm("Are you sure you want to delete this doctor?")) {
                fetch("../api/v1/delete_staff.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({
                            staff_Id: id
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showToast(data.message);
                            fetchDoctors();
                        } else {
                            showBadToast(data.message || "Deletion failed");
                        }
                    })
                    .catch(error => {
                        console.error("Error deleting doctor:", error);
                        showBadToast("Network error occurred");
                    });
            }
        }

        function fetchAvailableDoctors() {
            fetch("../api/v1/available_doctors.php")
                .then(response => response.json())
                .then(data => {
                    document.querySelector(".doctor-count").textContent = data.doctor_count + data.nurse_count + data.physiologists_count || 0;
                })
                .catch(error => console.error("Error fetching doctors:", error));
        }

        function fetchTotalHealthWorkers() {
            fetch("../api/v1/total_physicians.php")
                .then(response => response.json())
                .then(data => {
                    document.querySelector(".physiologist-count").textContent = data.doctor_count + data.nurse_count + data.physiologists_count || 0;
                })
                .catch(error => console.error("Error fetching physicians:", error));
        }
    </script>

    <!-- Chart Functions -->
    <script>
        // Blog engagement chart
        const CurvedLinePlugin = {
            id: "curvedLine",
            afterDatasetsDraw(chart) {
                const ctx = chart.ctx;
                chart.data.datasets.forEach((dataset, i) => {
                    const meta = chart.getDatasetMeta(i);
                    const points = meta.data;
                    if (meta.hidden) return;

                    ctx.save();
                    ctx.lineWidth = 2;
                    ctx.strokeStyle = dataset.borderColor;
                    ctx.beginPath();

                    if (points.length > 1) {
                        ctx.moveTo(points[0].x, points[0].y);
                        for (let j = 0; j < points.length - 1; j++) {
                            const currentPoint = points[j];
                            const nextPoint = points[j + 1];
                            const controlPointX = (currentPoint.x + nextPoint.x) / 2;

                            ctx.bezierCurveTo(
                                controlPointX, currentPoint.y,
                                controlPointX, nextPoint.y,
                                nextPoint.x, nextPoint.y
                            );
                        }
                    }

                    ctx.stroke();
                    ctx.fillStyle = dataset.pointBackgroundColor || dataset.borderColor;
                    points.forEach(point => {
                        ctx.beginPath();
                        ctx.arc(point.x, point.y, 4, 0, Math.PI * 2);
                        ctx.fill();
                    });

                    ctx.restore();
                });
            },
        };

        async function fetchEngagementData() {
            try {
                const response = await fetch("../api/v2/update_engagement.php");
                const data = await response.json();
                updateChart(data);
            } catch (error) {
                console.error("Error fetching engagement data:", error);
            }
        }

        function updateChart(engagementData) {
            const ctx = document.querySelector("#bp-graph").getContext("2d");

            if (!window.chartInstance) {
                window.chartInstance = new Chart(ctx, {
                    type: "line",
                    data: {
                        labels: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                        datasets: [{
                            label: "Blog Engagement",
                            data: [
                                engagementData.sun,
                                engagementData.mon,
                                engagementData.tue,
                                engagementData.wed,
                                engagementData.thu,
                                engagementData.fri,
                                engagementData.sat,
                            ],
                            fill: false,
                            borderColor: "rgba(75, 192, 192, 1)",
                            borderWidth: 0,
                            pointRadius: 4,
                            pointBackgroundColor: "rgba(75, 192, 192, 1)",
                            pointBorderColor: "rgba(75, 192, 192, 1)",
                        }],
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 10
                                },
                            },
                        },
                    },
                    plugins: [CurvedLinePlugin],
                });
            } else {
                window.chartInstance.data.datasets[0].data = [
                    engagementData.sun,
                    engagementData.mon,
                    engagementData.tue,
                    engagementData.wed,
                    engagementData.thu,
                    engagementData.fri,
                    engagementData.sat,
                ];
                window.chartInstance.update();
            }
        }

        // Top blogs chart
        function initTopBlogsChart() {
            const ctx = document.getElementById('topBlogsChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?= $labels ?>,
                    datasets: [{
                        label: 'Views',
                        data: <?= $values ?>,
                        backgroundColor: '#24ABA0'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        }
    </script>

    <!-- Initialization -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Authentication check
            fetch("../api/v1/auth.php")
                .then(async response => {
                    const data = await response.json();
                    if (!response.ok) {
                        if (data.message === "Unauthorized") {
                            location.href = "../admin/login.php";
                        }
                        throw new Error(data.message || "Network response was not ok");
                    }
                })
                .catch(error => {
                    console.error("Fetch error:", error);
                });

            // Initialize components
            setGreeting();
            fetchBlogs();
            getBlogTotal();
            fetchDoctors();
            fetchAvailableDoctors();
            fetchTotalHealthWorkers();
            fetchEngagementData();
            initTopBlogsChart();

            // Modal close handlers
            document.querySelector('.close-edit-btn')?.addEventListener('click', closeEditModal);
            document.getElementById('close-modal')?.addEventListener('click', function() {
                document.getElementById('volunteerDetailsModal').classList.remove('active');
            });
            document.getElementById('closeDoctorModal')?.addEventListener('click', function() {
                document.getElementById('doctorDetailsModal').style.display = 'none';
            });

            // Initialize publish handler
            initializePublishHandler();

            // Blog action handlers
            document.addEventListener("click", function(e) {
                const action = e.target.closest(".modal-box-blog .action");
                if (!action) return;

                const modalBox2 = action.closest(".modal-box-blog");
                const td = modalBox2.closest("td");
                const dotBtn = td.querySelector(".dot-btn");
                const blogId = dotBtn.getAttribute("data-id");

                const text = action.textContent.trim();
                if (text.includes("View details")) {
                    fetchBlogDetails(blogId);
                } else if (text.includes("Edit Blog")) {
                    openEditModal(blogId);
                } else if (text.includes("Save Draft")) {
                    updateBlogStatus(blogId, "draft");
                } else if (text.includes("Publish Blog")) {
                    updateBlogStatus(blogId, "publish");
                }

                modalBox2.style.display = "none";
            });

            function updateBlogStatus(blogId, type) {
                fetch("../api/v1/update_blog.php", {
                        method: "PUT",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify({
                            blogId,
                            type
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showToast(data.message);
                            fetchBlogs();
                        } else {
                            showBadToast(data.message || "Update failed");
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        showBadToast("Network error occurred");
                    });
            }
        });
    </script>










    <!-- CKEditor Script -->
    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/super-build/ckeditor.js"></script>
    <script>
        CKEDITOR.ClassicEditor.create(document.getElementById("Body"), {
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
                window.BodyEditor = editor; // Store the editor instance
                console.log('Editor was initialized', editor);
                // If you want to set initial content from PHP here:
                <?php if (isset($post)): ?>
                    editor.setData(`<?= addslashes($post['body']) ?>`);
                <?php endif; ?>
            })
            .catch(error => {
                console.error(error);
            });
    </script>


</body>

</html>