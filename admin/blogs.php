<?php
    session_start();
?>
<?php

    $page_title = "resource - Admin - Ogeri Health Foundation";

    $page_author = "Okibe";

    $page_description = "";

    $page_rel = '../';

    $page_name = 'admin';

    $customs = array(
                "stylesheets" => ["admin/assets/css/blogs.css"],
                "scripts" => ["admin/assets/js/blogs.js"]
               );

    $addons = array(
                "stylesheets" => ["https://some-external-url.css"],
                "scripts" => ["https://some-external-url.js"]
               );

?>

<!DOCTYPE html>
<html lang="en">
  <head>
   <?php include $page_rel.'admin/includes/admin-head.php'; ?>


   <style>
    table {
    width: 100%;
    overflow-x: none ;
    text-align: left;
    border-collapse: separate;
    border-spacing: 0 25px;
    /* border: none !important; */
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
            background:rgb(250, 209, 209);
            color:rgb(185, 16, 16);
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
}

.modal.active {
    display: flex;
    z-index: 1000;
}

.modal-bodyy{
  background-color: #fff;
  padding: 5rem 0;
  height: 100%;
  width: 100%;
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
    /* background-color: transparent; */
}

.modal.active {
    display: flex;
    align-items: center;
}

.modal img{
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

.modal-bodyy{
  background-color: #fff;
  padding: 5rem 0;
  height: 100%;
  width: 100%;
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
    align-items: center;
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

.certification-section, .reason-section {
    margin-bottom: 1.5rem;
}



.certification-section h3, .reason-section h3 {
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


  

window.onload = function () {

  fetch("https://ogerihealth.org/api/v1/auth.php")
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
    <?php $page = 'blogs'; ?>
    <?php include $page_rel.'admin/includes/topbar.php'; ?>

    <main>

    <div class="modal"  tabindex="-1" id="edit-modal">
    <div class="justify-content-center modal-bodyy mt-5" >
            
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
                                <textarea class="form-control text-areaa" id="Body" name="Body" row="30"></textarea>
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-between">
                                <button type="submit" name="save_publish" class="btn btn-primary" id="Publish">Update And Publish</button>
                                <button type="submit" name="save_draft" class="btn btn-secondary" id="Draft">Update as Draft</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="toast-success">
        <div class="icon">✔</div>
        <div id="toast-message">login success</div>
        <button class="close-btn" onclick="hideToast()">&times;</button>
    </div>

    <div id="bad-toast">
    <div class="bad-icon"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="13" height="13">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
    </svg></div>
        <div id="bad-toast-message">login not successful</div>
        <button class="close-btn" onclick="hideBadToast()">&times;</button>
    </div>











    <div class="modal" id="volunteerDetailsModal" >
            <div class="modal-dialog modal-dialog-centered modal-lg" style="display:flex; justify-content:center;">
                <div class="modal-content" style='background-color: #fff;'>
                    <div class="modal-header">
                        <h5 class="modal-title">Blog Details</h5>
                       <svg xmlns="http://www.w3.org/2000/svg"class="btn-close" style="cursor: pointer;" data-bs-dismiss="modal" aria-label="Close" id="close-modal" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="13" height="13">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
    </svg>
                    </div>
                    <div class="modal-body">
                        <div class="status-badge-container">
                            <span class="status-badge" id="detailsStatusBlog">Pending</span>
                        </div>
                        <div class="volunteer-info">
                            <div class="volunteer-photo">
                                <img src="../assets/images/includes/user1.svg"  id="detailsImage">
                            </div>
                            <div class="volunteer-details">
                                <div class="detail-item">
                                    <h6 class="detail-label" >Blog title:</h6>
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


      <section class="head">
        <div class="page-title-box">
          <div class="img-box">
            <img
              src="./assets/images/resources/icons/right-arrow.png"
              alt="right arrow"
              width="14px"
              height="19px"
            />
          </div>
          <h2 class="title">Blogs</h2>
        </div>
        <nav class="resource-nav">
          <div class="search-box">
            <img
              src="./assets/images/resources/icons/search-glass.png"
              alt="search glass"
            />
            <input
              type="text"
              class="filter-text-box"
              placeholder="search any keyword"
            />
            <img
              src="./assets/images/resources/icons/mic.png"
              alt="microphone icon"
            />
          </div>
          <button class="btn-large">
            Export
            <img
              src="./assets/images/resources/icons/Vector.png"
              alt="downward-arrow"
            />
          </button>
          <button class="filter-btn">
            Filter
            <img
              src="./assets/images/resources/icons/filter-icon.png"
              alt="filter-icon"
            />
            <div class="modal-box-filter">
              <div class="action">All</div>
              <div class="action">Published</div>
              <div class="action">Draft</div>
            </div>
          </button>
        </nav>
      </section>
      <section class="blog-table-sect">
      <table>
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
  <tbody class="table-body">
    <!-- Blog rows will be inserted here dynamically -->
  </tbody>
</table>

<!-- Modal Box (Moved outside the table) -->
<div class="modal-box-blog">
                            <div class="action">
                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M12 8.25C9.92893 8.25 8.25 9.92893 8.25 12C8.25 14.0711 9.92893 15.75 12 15.75C14.0711 15.75 15.75 14.0711 15.75 12C15.75 9.92893 14.0711 8.25 12 8.25ZM9.75 12C9.75 10.7574 10.7574 9.75 12 9.75C13.2426 9.75 14.25 10.7574 14.25 12C14.25 13.2426 13.2426 14.25 12 14.25C10.7574 14.25 9.75 13.2426 9.75 12Z" fill="#1C274C"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M12 3.25C7.48587 3.25 4.44529 5.9542 2.68057 8.24686L2.64874 8.2882C2.24964 8.80653 1.88206 9.28392 1.63269 9.8484C1.36564 10.4529 1.25 11.1117 1.25 12C1.25 12.8883 1.36564 13.5471 1.63269 14.1516C1.88206 14.7161 2.24964 15.1935 2.64875 15.7118L2.68057 15.7531C4.44529 18.0458 7.48587 20.75 12 20.75C16.5141 20.75 19.5547 18.0458 21.3194 15.7531L21.3512 15.7118C21.7504 15.1935 22.1179 14.7161 22.3673 14.1516C22.6344 13.5471 22.75 12.8883 22.75 12C22.75 11.1117 22.6344 10.4529 22.3673 9.8484C22.1179 9.28391 21.7504 8.80652 21.3512 8.28818L21.3194 8.24686C19.5547 5.9542 16.5141 3.25 12 3.25ZM3.86922 9.1618C5.49864 7.04492 8.15036 4.75 12 4.75C15.8496 4.75 18.5014 7.04492 20.1308 9.1618C20.5694 9.73159 20.8263 10.0721 20.9952 10.4545C21.1532 10.812 21.25 11.2489 21.25 12C21.25 12.7511 21.1532 13.188 20.9952 13.5455C20.8263 13.9279 20.5694 14.2684 20.1308 14.8382C18.5014 16.9551 15.8496 19.25 12 19.25C8.15036 19.25 5.49864 16.9551 3.86922 14.8382C3.43064 14.2684 3.17374 13.9279 3.00476 13.5455C2.84684 13.188 2.75 12.7511 2.75 12C2.75 11.2489 2.84684 10.812 3.00476 10.4545C3.17374 10.0721 3.43063 9.73159 3.86922 9.1618Z" fill="#1C274C"/>
</svg>
                                <span>View details</span>
                            </div>
                            <div class="action">
                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
                                <span>Edit Blog</span>
                            </div>
                            <div class="action">
                            <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M6.83871 3.53846C6.12608 3.53846 5.54839 4.11246 5.54839 4.82051V19.1795C5.54839 19.8875 6.12608 20.4615 6.83871 20.4615H17.1613C17.8739 20.4615 18.4516 19.8875 18.4516 19.1795V9.14049C18.4516 8.80672 18.3206 8.48611 18.0864 8.2468L13.8594 3.92682C13.6164 3.67854 13.2827 3.53846 12.9342 3.53846H6.83871ZM4 4.82051C4 3.26279 5.27093 2 6.83871 2H12.9342C13.701 2 14.4351 2.30817 14.9696 2.85439L19.1966 7.17437C19.7118 7.70085 20 8.4062 20 9.14049V19.1795C20 20.7372 18.7291 22 17.1613 22H6.83871C5.27093 22 4 20.7372 4 19.1795V4.82051Z" fill="#030D45"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M8.12903 15.0769C8.12903 15.5018 8.47565 15.8462 8.90323 15.8462H15.0968C15.5243 15.8462 15.871 15.5018 15.871 15.0769C15.871 14.6521 15.5243 14.3077 15.0968 14.3077H8.90323C8.47565 14.3077 8.12903 14.6521 8.12903 15.0769Z" fill="#030D45"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M8.12903 10.9744C8.12903 11.3992 8.47565 11.7436 8.90323 11.7436H12C12.4276 11.7436 12.7742 11.3992 12.7742 10.9744C12.7742 10.5495 12.4276 10.2051 12 10.2051H8.90323C8.47565 10.2051 8.12903 10.5495 8.12903 10.9744Z" fill="#030D45"/>
</svg>
                                <span>Save Draft</span>
                            </div>
                            <div class="action">
                            <svg width="20px" height="20px" viewBox="0 0 512 512" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <title>publish</title>
    <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <g id="icon" fill="#000000" transform="translate(85.333333, 45.554327)">
            <path d="M192,7.10542736e-15 L355.849623,152.146079 L326.817043,183.411935 L213.333,78.022 L213.333333,253.11234 C213.333333,333.868643 149.231288,399.653112 69.1338614,402.359081 L64,402.445673 L1.42108547e-14,402.445673 L1.42108547e-14,359.779007 L64,359.779007 C121.3601,359.779007 168.145453,314.50313 170.568117,257.739319 L170.666667,253.11234 L170.666,78.023 L57.1829568,183.411935 L28.1503765,152.146079 L192,7.10542736e-15 Z" id="Combined-Shape">

</path>
        </g>
    </g>
</svg>
                                <span>Publish Blog</span>
                            </div>
                            </div>

      </section>








      <!-- this is the pagination -->
      <section class="pagination-section">
        <button class="btn-previous">
          <img
            src="./assets/images/resources/icons/left-arrow.png"
            alt="left facing arrow"
          />
          Previous
        </button>
        <div class="pages">
          <button class="btn-small active">1</button>
          <button class="btn-small">2</button>
          <button class="btn-small">3</button>
          <button class="btn-small">
            <img
              src="./assets/images/resources/icons/pagination-icon.png"
              alt=""
            />
          </button>
          <button class="btn-small">5</button>
          <button class="btn-small">6</button>
        </div>
        <button class="btn-next">
          Next
          <img
            src="./assets/images/resources/icons/right-l-arrow.png"
            alt="right facing arrow"
          />
        </button>
      </section>




































      <!-- Health workers section -->
      <section class="hc-provider-section">
    <h2 class="title">Health Workers</h2>
    <nav class="resource-nav">
      <div class="search-box">
        <img src="./assets/images/resources/icons/search-glass.png" alt="search glass">
        <input type="text" id="searchInput" class="filter-text-box" placeholder="Search any keyword">
        <img src="./assets/images/resources/icons/mic.png" alt="microphone icon">
      </div>
      <button class="btn-large">Export</button>
      <select id="filterSelect">
        <option value="">All Specializations</option>
        <option value="doctor">Doctor</option>
        <option value="nurse">Nurse</option>
      
        
      </select>
    </nav>

    <table>
      <thead>
        <tr>
          <th>Doctor ID</th>
          <th>Name</th>
          <th>Specialization</th>
          <th>Role</th>
          <th>Availability</th>
        </tr>
      </thead>
      <tbody id="doctorTableBody">
        <!-- Data will be inserted dynamically here -->
      </tbody>
    </table>
  </section>
      <section  class="pagination-section">
        <button class="btn-previous" id="btn-previous">
          <img
            src="./assets/images/resources/icons/left-arrow.png"
            alt="left facing arrow"
          />
          Previous
        </button>
        <div class="pages" id="pages">
          <button class="btn-small active">1</button>
          <button class="btn-small">2</button>
          <button class="btn-small">3</button>
          <button class="btn-small">
            <img
              src="./assets/images/resources/icons/pagination-icon.png"
              alt=""
            />
          </button>
          <button class="btn-small">5</button>
          <button class="btn-small">6</button>
        </div>
        <button class="btn-next" id="btn-next">
          Next
          <img
            src="./assets/images/resources/icons/right-l-arrow.png"
            alt="right facing arrow"
          />
        </button>
      </section>
    </main>
      <?php include $page_rel.'admin/includes/sidebar.php'; ?>
    <script src="./assets/js/blogs.js"></script>











    <script>
       function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            document.getElementById('preview').src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }

function hideBadToast() {
                    const BadToast = document.getElementById('bad-toast');
                    BadToast.classList.remove('show');
                }

                function hideToast() {
                    const Toast = document.getElementById('toast-success');
                    Toast.classList.remove('show');
                }







document.addEventListener("DOMContentLoaded", function () {
  // setInterval(() => {
    // fetchBlogs(); 
// }, 8000); 
  const tableBody = document.querySelector(".table-body");
  const paginationContainer = document.querySelector(".pages");
  const prevBtn = document.querySelector(".btn-previous");
  const nextBtn = document.querySelector(".btn-next");
  const modalBox = document.querySelector(".modal-box-blog");

  let currentPage = 1;
  const perPage = 5;
  let totalPages = 1;
  let sn = 1;

  function fetchBlogs(page = 1) {
    fetch(`https://ogerihealth.org/api/v1/fetch_all_blog.php?page=${page}&per_page=${perPage}`)
      .then((response) => response.json())
      .then((data) => {
        tableBody.innerHTML = data.data
          .map((blog) => `
            <tr>
             <td>${sn++}</td>
              <td class="blog-title">${blog.blog_title}</td>
              <td>${blog.category}</td>
              <td>${blog.created_at}</td>
              <td>${blog.published_at || "Not Published"}</td>
              <td><span class="${blog.status.toLowerCase()}">${blog.status}</span></td>
              <td>
                <img src="./assets/images/resources/img/Icon.png" data-id="${blog.blog_id}" alt="More actions" class="dot-btn"/>
              </td>
            </tr>
          `)
          .join("");

        addDotBtnListeners(); // Attach click event to new buttons
        totalPages = data.last_page;
        updatePagination();
      })
      .catch((error) => console.error("Error fetching blogs:", error));
  }

  function addDotBtnListeners() {
  document.querySelectorAll(".dot-btn").forEach((btn) => {
    btn.addEventListener("click", function (event) {
      const actionMenu = document.querySelector(".modal-box-blog");

      // Get button position relative to viewport
      const rect = event.target.getBoundingClientRect();
      const viewportWidth = window.innerWidth;
      const viewportHeight = window.innerHeight;

      let x = rect.left + window.scrollX + 220; // Adjusted to position near the button
      let y = rect.top + window.scrollY + 20; // Slightly below the button

      // Prevent action menu from going off-screen
      if (x + actionMenu.offsetWidth > viewportWidth) {
        actionMenu.style.display = "none";
        x = viewportWidth - actionMenu.offsetWidth - 220; // Adjust to keep inside viewport
      }
      if (y + actionMenu.offsetHeight > viewportHeight) {
        y = viewportHeight - actionMenu.offsetHeight - 10;
      }

      // Set position and show modal
      actionMenu.style.left = `${x}px`;
      actionMenu.style.top = `${y}px`;
      // actionMenu.classList.remove("hidden");
      actionMenu.style.display = "block";

      actionMenu.setAttribute("data-blog-id", event.target.getAttribute("data-id"));

      console.log(`Showing action menu near dot-btn at: ${x}px, ${y}px`);
    });
  });
}

document.addEventListener("click", function (event) {
    if (!event.target.closest(".dot-btn") && !event.target.closest(".modal-box-blog")) {
        modalBox.style.display = "none";
    }
});

document.querySelectorAll(".modal-box-blog .action").forEach(action => {
    action.addEventListener("click", function () {
        const blogId = modalBox.getAttribute("data-blog-id");
    
        if (!blogId) {
            console.error("No blog ID found for this action.");
            return;
        }

        if (this.textContent.includes("View details")) {
            console.log(`Viewing details for Blog ID: ${blogId}`);
            const ViewModal = document.getElementById("volunteerDetailsModal");
            ViewModal.classList.add('active');
            fetchDataValuee(blogId)

            async function fetchDataValuee(blogId) {
    try {
        const response = await fetch(`https://ogerihealth.org/api/v1/post_blog.php?blogId=${encodeURIComponent(blogId)}`);
        const data = await response.json();

        console.log("Fetched Data:", data);

            let DetailTitle = document.getElementById("detailsTitle");
            let DetailsStatusBlog = document.getElementById("detailsStatusBlog");
            let Image = document.getElementById("detailsImage");
            let DetailDate = document.getElementById("detailsDate");
            let DetailCategory = document.getElementById("detailsCategory");
            let DetailDescription = document.getElementById("detailsDescription");
            let DetailBody = document.getElementById("detailsBody");

        // Populate form fields
        DetailTitle.textContent = data.blog_title;
        DetailsStatusBlog.textContent = data.status;
        DetailDate.textContent = data.created_at;
        DetailDescription.textContent = data.blog_description;
        DetailCategory.textContent = data.category;
        DetailBody.textContent = data.body;
        Image.src = `https://ogerihealth.org/uploads/${data.image}`; 

    } catch (error) {
        console.error("Error fetching data:", error);
    }


 const CloseModal =  document.getElementById("close-modal");
 CloseModal.addEventListener("click", function () {
  ViewModal.classList.remove('active');

 })
}





        } else if (this.textContent.includes("Edit Blog")) {
          const EditModal = document.getElementById("edit-modal");
          EditModal.classList.add('active');
          fetchDataValue(blogId);

  // this is to fetch the data dynamically and insert it in each fields value


  async function fetchDataValue(blogId) {
    try {
        const response = await fetch(`https://ogerihealth.org/api/v1/post_blog.php?blogId=${encodeURIComponent(blogId)}`);
        const data = await response.json();

        console.log("Fetched Data:", data);

        // Get input fields
        let Title = document.getElementById("Title");
        let Description = document.getElementById("Description");
        let Category = document.getElementById("Category");
        let Body = document.getElementById("Body");
        let Image = document.getElementById("preview");

        // Populate form fields
        Title.value = data.blog_title;
        Description.value = data.blog_description;
        Category.value = data.category;
        Body.value = data.body;
        Image.src = `https://ogerihealth.org/uploads/${data.image}`; // Set image preview

    } catch (error) {
        console.error("Error fetching data:", error);
    }
}

// Listen for form submission
document.getElementById("Publish").addEventListener("click", function () {
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
    fetch("https://ogerihealth.org/api/v1/update_post_blog.php", {
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
                    imageUrl = `https://ogerihealth.org/uploads/${data.image}`; // Use existing image
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

            






            // this to save as draf
        } else if (this.textContent.includes("Save Draft")) {
    
    const type = "draft";
    fetch("https://ogerihealth.org/api/v1/update_blog.php", {
      method: "PUT",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ blogId, type}),
    })
    .then(response => response.json()) 
    .then(data => {
                if(data.success === true){
                     const toast = document.getElementById('toast-success');
                    const toastMesaage = document.getElementById('toast-message');
                    toast.classList.add('show');
                    toastMesaage.textContent = data.message;
                    setTimeout(hideToast, 5000);
                    form.reset();
                    document.getElementById('preview').src = "assets/images/upload-placeholder.svg";

        //         function hideToast() {
        //         const toast = document.getElementById('toast-success');
        //         toast.classList.remove('show');
        // }

    }else{
        const BadToast = document.getElementById('bad-toast');
                    const BadToastMesaage = document.getElementById('bad-toast-message');
                    BadToast.classList.add('show');
                    BadToastMesaage.textContent = data.message || `Error ${xhr.status}: ${xhr.statusText}`;;
                    setTimeout(hideBadToast, 5000);

                    // function hideBadToast() {
                    // const BadToast = document.getElementById('bad-toast');
                    // BadToast.classList.remove('show');
                    // }
    }
       
    })
    .catch(error => {
        console.error("Error:", error);
        // alert("An error occurred.");
    });

        } else if (this.textContent.includes("Publish Blog")) {
            console.log(`Publishing Blog ID: ${blogId}`);


          // this to save as published
    const type = "publish";
    fetch("https://ogerihealth.org/api/v1/update_blog.php", {
      method: "PUT",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ blogId, type}),
    })
    .then(response => response.json()) 
    .then(data => {
                if(data.success === true){
                     const toast = document.getElementById('toast-success');
                    const toastMesaage = document.getElementById('toast-message');
                    toast.classList.add('show');
                    toastMesaage.textContent = data.message;
                    setTimeout(hideToast, 5000);
                    form.reset();
                    document.getElementById('preview').src = "assets/images/upload-placeholder.svg";

        //         function hideToast() {
        //         const toast = document.getElementById('toast-success');
        //         toast.classList.remove('show');
        // }

    }else{
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

        modalBox.style.display = "none";
    });
});












































  function updatePagination() {
    paginationContainer.innerHTML = "";
    let startPage = Math.max(1, currentPage - 2);
    let endPage = Math.min(totalPages, startPage + 4);
    startPage = Math.max(1, endPage - 4);

    for (let i = startPage; i <= endPage; i++) {
      let btn = document.createElement("button");
      btn.classList.add("btn-small");
      btn.innerText = i;
      btn.classList.toggle("active", i === currentPage);
      btn.addEventListener("click", function () {
        currentPage = i;
        fetchBlogs(currentPage);
      });
      paginationContainer.appendChild(btn);
    }

    prevBtn.disabled = currentPage === 1;
    nextBtn.disabled = currentPage === totalPages;
  }

  prevBtn.addEventListener("click", () => currentPage > 1 && fetchBlogs(--currentPage));
  nextBtn.addEventListener("click", () => currentPage < totalPages && fetchBlogs(++currentPage));

  // Hide modal if clicked outside
  document.addEventListener("click", function (event) {
    if (!event.target.closest(".dot-btn") && !event.target.closest(".modal-box-blog")) {
      modalBox.style.display = "none";
    }
  });

  fetchBlogs(currentPage);
});
    </script>


































<script>


document.addEventListener("DOMContentLoaded", function () {

//   setInterval(() => {
//   fetchDoctors();
// }, 8000); 

  const searchInput = document.getElementById("searchInput");
  const filterSelect = document.getElementById("filterSelect");
  const tableBody = document.getElementById("doctorTableBody");
  const paginationContainer = document.getElementById("pages");
  const prevBtn = document.getElementById("btn-previous");
  const nextBtn = document.getElementById("btn-next");

  let doctors = []; // Store fetched data
  let currentPage = 1;
  const rowsPerPage = 5;
  let totalPages = 1;

  // Fetch data from API
  async function fetchDoctors() {
    try {
      const response = await fetch("https://ogerihealth.org/api/v1/no_limit_doc.php");
      doctors = await response.json();
      totalPages = Math.ceil(doctors.length / rowsPerPage);
      renderTable(doctors, currentPage);
      setupPagination(doctors);
    } catch (error) {
      console.error("Error fetching doctors:", error);
    }
  }

  // Render paginated table
  function renderTable(data, page) {
    tableBody.innerHTML = "";
    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;
    const paginatedData = data.slice(start, end);

    paginatedData.forEach((doctor) => {
      const row = `
        <tr>
          <td>${doctor.id}</td>
          <td>${doctor.name}</td>
          <td>${doctor.area_of_specialization}</td>
          <td>${doctor.role}</td>
          <td>
            <label class="toggle-switch">
              <input type="checkbox" class="availability-toggle" data-id="${doctor.id}" name="${doctor.role}" ${doctor.is_available ? "checked" : ""}/>
              <span class="slider"></span>
            </label>
          </td>
        </tr>`;
      tableBody.innerHTML += row;
    });

    attachToggleListeners();
  }

  
  function attachToggleListeners() {
    document.querySelectorAll(".toggle-switch input").forEach(input => {
      input.addEventListener("change", function () {
        const doctorId = this.getAttribute("data-id");
        const availability = this.checked ? 1 : 0;
        const role = this.getAttribute("name");
        updateAvailability(doctorId, availability, role);
      });
    });
  }

  function updateAvailability(id, availability, role) {
    fetch("https://ogerihealth.org/api/v1/no_limit_doc.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ id, availability, role }),
    })
      .then((response) => response.json())
      .then((data) => console.log(data.message))
      .catch((error) => console.error("Error updating availability:", error));
  }

  // Search function
  function searchDoctors() {
    const query = searchInput.value.toLowerCase();
    const filteredDoctors = doctors.filter((doctor) =>
      doctor.name.toLowerCase().includes(query) ||
      doctor.specialization.toLowerCase().includes(query) ||
      doctor.role.toLowerCase().includes(query)
    );
    totalPages = Math.ceil(filteredDoctors.length / rowsPerPage);
    renderTable(filteredDoctors, 1);
    setupPagination(filteredDoctors);
  }

  // Filter function
  function filterDoctors() {
    const selectedSpecialization = filterSelect.value;
    let filteredDoctors = doctors;

    if (selectedSpecialization) {
      filteredDoctors = doctors.filter(
        (doctor) => doctor.role === selectedSpecialization
      );
    }
    totalPages = Math.ceil(filteredDoctors.length / rowsPerPage);
    renderTable(filteredDoctors, 1);
    setupPagination(filteredDoctors);
  }

 
function setupPagination(data) {
    paginationContainer.innerHTML = "";
    const totalPages = Math.ceil(data.length / rowsPerPage);

    let startPage = Math.max(1, currentPage - 2);
    let endPage = Math.min(totalPages, startPage + 4);

    if (endPage - startPage < 4) {
        startPage = Math.max(1, endPage - 4);
    }

    for (let i = startPage; i <= endPage; i++) {
        let btn = document.createElement("button");
        btn.classList.add("btn-small");
        btn.innerText = i;
        btn.dataset.page = i; // Store page number for easy selection later
        
        if (i === currentPage) {
            btn.classList.add("active");
        }

        btn.addEventListener("click", function () {
            currentPage = i;
            renderTable(data, currentPage);
            setupPagination(data); // Re-render pagination to update active state
        });

        paginationContainer.appendChild(btn);
    }

    // Disable prev/next buttons if needed
    prevBtn.disabled = currentPage === 1;
    nextBtn.disabled = currentPage === totalPages;

    prevBtn.onclick = function () {
        if (currentPage > 1) {
            currentPage--;
            renderTable(data, currentPage);
            setupPagination(data);
        }
    };

    nextBtn.onclick = function () {
        if (currentPage < totalPages) {
            currentPage++;
            renderTable(data, currentPage);
            setupPagination(data);
        }
    };
}


  // Event Listeners
  searchInput.addEventListener("input", searchDoctors);
  filterSelect.addEventListener("change", filterDoctors);

  
  fetchDoctors();
  
});

// setInterval(() => {
//   fetchDoctors();
// }, 5000); 


</script>

  </body>
</html>