<?php
session_start();

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
            border: 2px red solid !important;
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

            /* border: 2px red solid; */
            width: 30%;
        }

        .volunteer-photo img {
            width: 100%;
            border-radius: 0.5rem;
            /* border: 2px blue solid; */
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
    </style>
</head>

<body>
    <script>


  

document.addEventListener("DOMContentLoaded", function () {

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



        <div class="modal" tabindex="-1" id="edit-modal">
            <div class="justify-content-center modal-bodyy mt-5">

                <div class="row justify-content-center ">
                    <div class="col-md-8">
                        <h2 class="mb-4 fw-bold">Edit Blog Post</h2>



                        <form method="POST" id="postForm" enctype="multipart/form-data">

                            <!-- Blog Title -->
                            <div class="mb-3">
                                <label class="form-label">Blog Title*</label>
                                <input type="text" id="Title" class="form-control" name="Title" placeholder="Enter Blog Title" value="<?php echo isset($post) ? $post['title'] : ''; ?>" required>
                            </div>

                            <!-- Cover Image -->
                            <div class="mb-3">
                                <label class="form-label">Cover Image</label>
                                <div class="upload-box text-center" onclick="document.getElementById('cover_image').click();">
                                    <input type="file" id="cover_image" name="cover_image" accept="image/*" hidden onchange="previewImage(event)">
                                    <img id="preview" src="<?php echo isset($post['image']) ? 'uploads/' . $post['image'] : 'assets/images/upload-placeholder.svg'; ?>" alt="Upload Image">
                                </div>
                            </div>

                            <!-- Blog Description -->
                            <div class="mb-3">
                                <label class="form-label">Blog Description*</label>
                                <input type="text" id="Description" class="form-control" name="Description" placeholder="Enter Description" value="<?php echo isset($post) ? $post['description'] : ''; ?>" required>
                            </div>


                            <!-- Category -->
                            <div class="mb-3">
                                <label class="form-label">Category*</label>
                                <select class="form-select" name="Category" id="Category" required>
                                    <option value="">Choose a Category...</option>
                                    <option value="tech" <?php echo (isset($post) && $post['category'] == 'tech') ? 'selected' : ''; ?>>Tech</option>
                                    <option value="business" <?php echo (isset($post) && $post['category'] == 'business') ? 'selected' : ''; ?>>Business</option>
                                    <option value="health" <?php echo (isset($post) && $post['category'] == 'health') ? 'selected' : ''; ?>>Health</option>
                                </select>
                            </div>

                            <!-- Body -->
                            <div class="mb-3">
                                <label class="form-label">Body*</label>
                                <textarea class="form-control text-areaa" id="Body" name="Body" row="30">
                                <?php echo isset($post) ? $post['body'] : ''; ?>
                                </textarea>
                            </div>

                            <!-- Buttons -->
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

        <div class="modal add-border-blue" id="volunteerDetailsModal">
            <div class="modal-dialog modal-dialog-centered modal-lg add-border-red" style="display:flex; justify-content:center; max-height: 95%; overflow-y: scroll;">
                <div class="modal-content" style='background-color: #fff;'>
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
            <a href="add-blog.php" class="create-blog">
                <span>Add Blog</span>
                <img
                    src="./assets/images/resources/icons/Vector.png"
                    alt="downward-arrow" />
            </a>
        </section>

        <script>
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
                <!-- <div class="drafts">
                    <div class="blog-stats">
                        <p>Blog Post</p>
                        <p id="blog-total2">0</p>
                        <small>
                            <span class="change-amt">+0% </span>since last month
                        </small>
                        </div>
                    <div class="person-icon">
                        <img
                            src="./assets/images/resources/icons/Icon-person.png"
                            alt="person icon"
                            class="person-ic-2"
                            height="20px"
                            width="16px"
                        />
                    </div>
                </div> -->
            </div>
            <div class="graph-container">
                <!-- blog engagement-title and graph filter goes here -->
                <!-- <div class="blog-engagement-header">
                <h2>Blog Engagement</h2>
                <button class="filter-btn">
                Filter
                <img
                    src="./assets/images/resources/icons/filter-icon.png"
                    alt="filter-icon"
                />
                </button>
            </div> -->
                <div class="bp-graph" style="height: 100%; width: 90%">
                    <canvas id="bp-graph" style="height: 100%; width: 100%"></canvas>
                </div>
            </div>
        </section>





        <!-- empty table -->
        <section class="blog-section filled-blog-table container">
            <div class="blog-section-header">
                <h2 class="title-text">Recent Blogs</h2>
                <a href="blogs.php" class="view-all">View All</a>
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





        <!-- doctor and nurses section empty table-->
        <section class="blog-section container mt-5">
            <section class="welcome-box">
                <div class="info-box">
                    <h2>Health workers</h2>
                    <p class="greeting-text">Details and availability</p>
                </div>
                <a href="add-members.php" class="create-blog">
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
                <a href="blogs.php" class="view-all">View All</a>
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


                <div class="modal-box-blog2">
                    <div class="action">
                        <img src="./assets/images/resources/icons/Icon (3).png" width="19" height="14px" />
                        <span>View details</span>
                    </div>

                    <div class="action">
                        <img src="./assets/images/resources/icons/trash-can-10417.png" width="16px" height="18px" />
                        <span>Delete</span>
                    </div>

                </div>

            </div>
        </section>




        <!-- doctors and nurses section filled table -->
    </main>
    <?php include $page_rel . 'admin/includes/sidebar.php'; ?>
    <script src="./assets/js/resources.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        function hideBadToast() {
            const BadToast = document.getElementById('bad-toast');
            BadToast.classList.remove('show');
        }

        function hideToast() {
            const Toast = document.getElementById('toast-success');
            Toast.classList.remove('show');
        }

        document.addEventListener("DOMContentLoaded", function() {
            fetchAvailableDoctors();
            // fetchAvailableNurses();
            fetchTotalHealthWorkers(); // This is All health workers function

            // setInterval(() => {
            //     fetchAvailableDoctors();
            //     // // fetchAvailableNurses();
            //     fetchTotalHealthWorkers();      // This is All health workers function
            // }, 5000);
        });

        function fetchAvailableDoctors() {
            fetch("../api/v1/available_doctors.php")
                .then(response => response.json())
                .then(data => {
                    document.querySelector(".doctor-count").textContent = data.doctor_count + data.nurse_count + data.physiologists_count || 0;
                    console.log(data.count);
                    // document.querySelector(".blog-post .change-amt").textContent = `+${data.percentage_change || 0}% since last month`;
                })
                .catch(error => console.error("Error fetching doctors:", error));
        }

        // function fetchAvailableNurses() {
        //     fetch("https://ogerihealth.org/api/v1/available_nurses.php")
        //         .then(response => response.json())
        //         .then(data => {
        //             document.querySelector(".nurse-count").textContent = data.count || 0;
        //             // document.querySelector(".drafts:nth-of-type(1) .change-amt").textContent = `+${data.percentage_change || 0}% since last month`;
        //         })
        //         .catch(error => console.error("Error fetching nurses:", error));
        // }

        function fetchTotalHealthWorkers() {
            fetch("../api/v1/total_physicians.php")
                .then(response => response.json())
                .then(data => {
                    document.querySelector(".physiologist-count").textContent = data.doctor_count + data.nurse_count + data.physiologists_count || 0;
                    // document.querySelector(".drafts:nth-of-type(2) .change-amt").textContent = `+${data.percentage_change || 0}% since last month`;
                })
                .catch(error => console.error("Error fetching physicians:", error));
        }


        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('preview').src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }


        document.addEventListener("DOMContentLoaded", function() {
            fetchBlogs();
            getBlogTotal()
        });


        async function getBlogTotal() {
            try {
                const response = await fetch("../api/v1/blog_total.php");
                const data = await response.json();

                let DisplayNum = document.getElementById("blog-total");
                let DisplayNum2 = document.getElementById("blog-total2");
                DisplayNum.textContent = data.total
                DisplayNum2.textContent = data.total
            } catch (error) {
                console.error("Error fetching data:", error);
            }
        }

        const modalBox = document.querySelector(".modal-box-blog");

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
                    <td>${blog.category}</td>
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
                .catch(error => console.error("Error fetching blogs:", error));
        }


        function addDotBtnListeners() {
            document.querySelectorAll(".dot-btn").forEach((btn) => {
                btn.addEventListener("click", function(event) {
                    const td = btn.closest("td");
                    const actionMenu = td.querySelector(".modal-box-blog");

                    // Hide other modals first
                    document.querySelectorAll(".modal-box-blog").forEach(menu => {
                        menu.style.display = "none";
                    });

                    // Get the position of the button
                    const rect = btn.getBoundingClientRect();
                    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                    const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;

                    // Position the modal just BELOW the button
                    let x = rect.left + scrollLeft;
                    let y = rect.bottom + scrollTop + 5; // below the button

                    const modalWidth = actionMenu.offsetWidth;

                    // If modal would go off-screen to the right
                    if (x + modalWidth > window.innerWidth - 10) {
                        // Show to the LEFT of the button instead
                        x = rect.right + scrollLeft - modalWidth;
                    }

                    // Apply styles
                    actionMenu.style.position = "absolute";
                    actionMenu.style.right = "70px";
                    actionMenu.style.top = `${y}px`;
                    actionMenu.style.zIndex = 1000;
                    actionMenu.style.display = "block";
                });
            });

            // Hide the menu when clicking outside
            document.addEventListener("click", function(e) {
                if (!e.target.closest(".dot-btn") && !e.target.closest(".modal-box-blog")) {
                    document.querySelectorAll(".modal-box-blog").forEach(menu => {
                        menu.style.display = "none";
                    });
                }
            });
        }


        // document.addEventListener("click", function (event) {
        //     if (!event.target.closest(".dot-btn") && !event.target.closest(".modal-box-blog")) {
        //         modalBox.style.display = "none";
        //     }
        // });
        document.addEventListener("DOMContentLoaded", function() {
            document.addEventListener("click", function(e) {
                const action = e.target.closest(".modal-box-blog .action");

                if (!action) return; // Clicked something else

                console.log("Action clicked:", action.textContent.trim());

                const modalBox2 = action.closest(".modal-box-blog");
                const td = modalBox2.closest("td");
                const dotBtn = td.querySelector(".dot-btn");

                if (!dotBtn) {
                    console.error("No dot button found.");
                    return;
                }

                const blogId = dotBtn.getAttribute("data-id");

                if (!blogId) {
                    console.error("No blog ID found for this action.");
                    return;
                }

                const text = action.textContent.trim();

                if (text.includes("View details")) {
                    const ViewModal = document.getElementById("volunteerDetailsModal");
                    ViewModal.classList.add('active');
                    fetchBlogDetails(blogId);

                    async function fetchBlogDetails(blogId) {
                        try {
                            const response = await fetch(`../api/v1/post_blog.php?blogId=${encodeURIComponent(blogId)}`);
                            const data = await response.json();
                            console.log("Fetched Data:", data);

                            document.getElementById("detailsTitle").textContent = data.blog_title;
                            document.getElementById("detailsStatusBlog").textContent = data.status;
                            document.getElementById("detailsDate").textContent = data.created_at;
                            document.getElementById("detailsCategory").textContent = data.category;
                            document.getElementById("detailsDescription").textContent = data.blog_description;
                            document.getElementById("detailsBody").textContent = data.body;
                            document.getElementById("detailsImage").src = `../uploads/${data.image}`;
                        } catch (error) {
                            console.error("Error fetching blog details:", error);
                        }
                    }

                    document.getElementById("close-modal").addEventListener("click", function() {
                        ViewModal.classList.remove("active");
                    });

                } else if (text.includes("Edit Blog")) {
                    // Continue with your edit logic...
                    const EditModal = document.getElementById("edit-modal");
                    EditModal.classList.add('active');
                    fetchDataValue(blogId);

                    // this is to fetch the data dynamically and insert it in each fields value


                    async function fetchDataValue(blogId) {
                        try {
                            const response = await fetch(`../api/v1/post_blog.php?blogId=${encodeURIComponent(blogId)}`);
                            const data = await response.json();

                            console.log("Fetched Data:", data);

                            let Title = document.getElementById("Title");
                            let Description = document.getElementById("Description");
                            let Category = document.getElementById("Category");
                            let BodyEditor = window.BodyEditor; // Refe
                            let Body = document.getElementById("Body");
                            let Image = document.getElementById("preview");

                            Title.value = data.blog_title;
                            Description.value = data.blog_description;
                            Category.value = data.category;
                            Body.value = data.body;
                            Image.src = `../uploads/${data.image}`;

                            // Set CKEditor content
                            if (BodyEditor) {
                                BodyEditor.setData(data.body);
                            }

                        } catch (error) {
                            console.error("Error fetching data:", error);
                        }
                    }

                    document.getElementById("Publish").addEventListener("click", function() {
                        const form = document.getElementById("postForm");

                        form.onsubmit = (e) => {
                            e.preventDefault();
                        };

                        let formData = new FormData(form);
                        let isValid = true;

                        // Validate form inputs
                        for (let [key, value] of formData.entries()) {
                            if (typeof value === "string") {
                                let trimmedValue = value.trim();
                                formData.set(key, trimmedValue); // Set trimmed value

                                if (trimmedValue === "") {
                                    isValid = false;

                                    const BadToast = document.getElementById('bad-toast');
                                    const BadToastMesaage = document.getElementById('bad-toast-message');
                                    BadToast.classList.add('show');
                                    BadToastMesaage.textContent = `${key} cannot be empty or only spaces.`;
                                    setTimeout(hideBadToast, 5000);



                                    return;
                                }
                            }
                        }

                        formData.append("blogId", blogId);

                        if (!isValid) return;

                        // Check if an image is uploaded
                        const fileInput = document.getElementById("cover_image");
                        if (fileInput.files.length > 0) {
                            formData.append("cover_image", fileInput.files[0]); // Append new image
                        }

                        // Send form data to server
                        fetch("../api/v1/update_post_blog.php", {
                                method: "POST",
                                body: formData
                            })
                            .then(response => response.json()) // Fixed incorrect `.json()` call
                            .then(data => {
                                if (data.success === true) {
                                    const toast = document.getElementById('toast-success');
                                    const toastMesaage = document.getElementById('toast-message');
                                    toast.classList.add('show');
                                    toastMesaage.textContent = data.message;
                                    setTimeout(hideToast, 5000);

                                    // Update preview image dynamically
                                    let imageUrl;
                                    if (fileInput.files.length > 0) {
                                        imageUrl = URL.createObjectURL(fileInput.files[0]); // Use newly uploaded image
                                    } else if (data.image) {
                                        imageUrl = `../uploads/${data.image}`; // Use existing image
                                    }

                                    if (imageUrl) {
                                        document.getElementById("preview").src = imageUrl;
                                    }

                                    // Reset form (except image preview)
                                    form.reset();
                                    document.getElementById('preview').src = "assets/images/upload-placeholder.svg";

                                } else {
                                    const BadToast = document.getElementById('bad-toast');
                                    const BadToastMesaage = document.getElementById('bad-toast-message');
                                    BadToast.classList.add('show');
                                    BadToastMesaage.textContent = data.message || `Error ${xhr.status}: ${xhr.statusText}`;
                                    setTimeout(hideBadToast, 5000);


                                }
                            })
                            .catch(error => {
                                console.error("Error:", error);
                                const BadToast = document.getElementById('bad-toast');
                                const BadToastMesaage = document.getElementById('bad-toast-message');
                                BadToast.classList.add('show');
                                BadToastMesaage.textContent = "Something went wrong.";
                                setTimeout(hideBadToast, 5000);


                            });
                    });


                    function hideBadToast() {
                        const BadToast = document.getElementById('bad-toast');
                        BadToast.classList.remove('show');
                    }


                } else if (text.includes("Save Draft")) {
                    // Paste your Save Draft logic here
                    console.log(`Saving draft for blog ID: ${blogId}`);
                    const type = "draft";
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

                } else if (text.includes("Publish Blog")) {
                    // Paste your Publish logic here
                    console.log(`Publishing blog ID: ${blogId}`);
                    const type = "publish";
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
                }

                // Optional: hide the modal dropdown after action
                modalBox2.style.display = "none";
            });
        });



        function formatDate(dateString) {
            if (!dateString || dateString === "0000-00-00 00:00:00") return "N/A";
            const date = new Date(dateString);
            return date.toLocaleDateString("en-GB");
        }
    </script>

    <style>
        .no-blogs {
            text-align: center;
            font-weight: bold;
            font-size: 18px;
            margin-top: 20px;
            display: none;
        }
    </style>







    <script>
        // setInterval(() => {
        //     fetchBlogs(); 
        //     fetchDoctors();
        // }, 50000); 


        document.addEventListener("DOMContentLoaded", function() {
            fetchDoctors();
        });

        function fetchDoctors() {
            fetch("../api/v1/doctor_route.php")
                .then(response => response.json())
                .then(doctors => {
                    const tableContainer = document.querySelector(".table-container");
                    const table = document.querySelector(".filled-doctors-table");
                    const tbody = table ? table.querySelector("tbody") : null;
                    let emptyMessage = document.querySelector(".empty-doctors-table");

                    if (!tableContainer || !table || !tbody) {
                        console.error("Table or table container not found!");
                        return;
                    }

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

                    if (emptyMessage) {
                        emptyMessage.style.display = "none";
                    }
                    table.style.display = "table";

                    doctors.forEach(doctor => {
                        let prefix = "#Dr-";
                        if (doctor.status === "nurse") {
                            prefix = "#Nr-";
                        } else if (doctor.status === "physiologist") {
                            prefix = "#Phy-";
                        }

                        const row = document.createElement("tr");
                        row.innerHTML = `
                    <td>${prefix}${doctor.id}</td>
                    <td>${doctor.name}</td>
                    <td>${doctor.role}</td>
                    <td>
                        <label class="toggle-switch">
                            <input type="checkbox" data-id="${doctor.id}" name="${doctor.role}" ${doctor.is_available ? "checked" : ""} />
                            <span class="slider"></span>
                        </label>
                    </td>
                    <td>
                        <img src="./assets/images/resources/img/Icon.png" data-id="${doctor.id}" alt="More actions"  class="dot-doc-btn"/>
                    </td>
                `;
                        tbody.appendChild(row);

                        addDotDoctorBtnListeners();
                    });

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
                    const actionMenu = document.querySelector(".modal-box-blog2");

                    // const rect = event.target.getBoundingClientRect();
                    // const viewportWidth = window.innerWidth;
                    // const viewportHeight = window.innerHeight;

                    // let x = rect.left + window.scrollX + -20; 
                    // let y = rect.top + window.scrollY + 10;

                    // if (x + actionMenu.offsetWidth > viewportWidth) {

                    //     x = viewportWidth - actionMenu.offsetWidth - 15;
                    // }
                    // if (y + actionMenu.offsetHeight > viewportHeight) {
                    //     y = viewportHeight - actionMenu.offsetHeight - -200;
                    // }

                    // actionMenu.style.left = `${x}px`;
                    // actionMenu.style.top = `${y}px`;
                    actionMenu.style.display = "block";

                    actionMenu.setAttribute("data-blog-id", event.target.getAttribute("data-id"));

                    document.addEventListener("click", function closeModal(event) {
                        if (!actionMenu.contains(event.target) && !btn.contains(event.target)) {
                            actionMenu.style.display = "none";
                            document.removeEventListener("click", closeModal);
                        }
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


        const ModalBBox = document.querySelector(".modal-box-blog2");

        document.querySelectorAll(".modal-box-blog2 .action").forEach(action => {
            action.addEventListener("click", function() {
                const staff_Id = ModalBBox.getAttribute("data-blog-id");

                if (!staff_Id) {
                    console.error("No blog ID found for this action.");
                    return;
                }

                if (this.textContent.includes("View details")) {
                    console.log("It worked thank God");
                } else if (this.textContent.includes("Delete")) {

                    fetch("../api/v1/delete_staff.php", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                            },
                            body: JSON.stringify({
                                staff_Id
                            }),
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
                        .catch(error => console.error("Error updating availability:", error));
                }
            });
        })

        // document.addEventListener("click", function (event) {
        //     if (!event.target.closest(".dot-btn") && !event.target.closest(".modal-box-blog2")) {
        //         modalBBox.style.display = "none";
        //     }
        // });
    </script>














    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let chartInstance = null; // Store chart instance

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

                        // Draw points on top of the custom curved line
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

            // Function to fetch engagement data from PHP API

            async function fetchEngagementData() {
                try {
                    const response = await fetch("../api/v2/update_engagement.php");
                    const data = await response.json();
                    updateChart(data);
                } catch (error) {
                    console.error("Error fetching engagement data:", error);
                }
            }

            // Function to initialize or update Chart.js graph
            function updateChart(engagementData) {
                const ctx = document.querySelector("#bp-graph").getContext("2d");

                if (!chartInstance) {
                    // Create chart if it doesn't exist
                    chartInstance = new Chart(ctx, {
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
                                borderWidth: 0, // Hide default line
                                pointRadius: 4,
                                pointBackgroundColor: "rgba(75, 192, 192, 1)",
                                pointBorderColor: "rgba(75, 192, 192, 1)",
                            }, ],
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
                        plugins: [CurvedLinePlugin], // Registering the custom plugin
                    });
                } else {
                    // Update chart if it already exists
                    chartInstance.data.datasets[0].data = [
                        engagementData.sun,
                        engagementData.mon,
                        engagementData.tue,
                        engagementData.wed,
                        engagementData.thu,
                        engagementData.fri,
                        engagementData.sat,
                    ];
                    chartInstance.update(); // Refresh chart
                }
            }

            // Fetch data and draw chart on page load
            fetchEngagementData();

            // Auto-update every 5 seconds
            // setInterval(fetchEngagementData, 15000);
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