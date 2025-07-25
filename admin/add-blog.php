<?php
session_start();
?>
<?php

$page_title = "Add Blog - Admin- Ogeri Health Foundation";

$page_author = "Praise";

$page_description = "";

$page_rel = '../';

$page_name = 'admin';

$customs = array(
  "stylesheets" => ["admin/assets/css/add-blog.css"],
  "scripts" => ["admin/assets/js/demo.js"]
);

$addons = array(
  "stylesheets" => ["https://some-external-url.css"],
  "scripts" => ["https://some-external-url.js"]
);

?>
<!DOCTYPE html>
<html>

<head>

  <?php include $page_rel . 'admin/includes/admin-head.php'; ?>

  <style>
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
      max-width: 300px;
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
      cursor: pointer;
      z-index: 99999;
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



  <script>
    document.addEventListener('DOMContentLoaded', function() {

      for (let i = 1; i <= 3; i++) {
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

</head>

<body>

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

  <?php $page = 'Blog'; ?>
  <?php include $page_rel . 'admin/includes/topbar.php'; ?>


  <main>

    <section class="hero">

      <div id="toast-success">
        <div class="icon">✔</div>
        <div id="toast-message">success</div>
        <button class="close-btn" onclick="hideToast()">&times;</button>
      </div>

      <div id="bad-toast">
        <div class="bad-icon"> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="13" height="13">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
          </svg></div>
        <div id="bad-toast-message">login not successful</div>
        <button class="close-btn" onclick="hideToast()">&times;</button>
      </div>
      <div class="container mt-5">
        <button class="back-button" onclick="window.history.back();">
          <img src="<?php echo $page_rel; ?>admin/assets/images/login/back.svg" alt="" />
        </button>
        <div class="row justify-content-center">
          <div class="col-md-8">
            <h2 class="mb-4 fw-bold">Create Blog Post</h2>

            <form method="POST" id="postForm" enctype="multipart/form-data">

              <!-- Blog Title -->
              <div class="mb-3">
                <label class="form-label">Blog Title*</label>
                <input type="text" class="form-control" name="Title" placeholder="Enter Blog Title" value="<?php echo isset($post) ? $post['title'] : ''; ?>" required>
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
                <input type="text" class="form-control" name="Description" placeholder="Enter Description" value="<?php echo isset($post) ? $post['description'] : ''; ?>" required>
              </div>

              <!-- Category -->
              <div class="mb-3">
                    <label class="form-label">Category*</label>
                    <select class="form-select" name="Category" required>
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

              <!-- Body -->
              <div class="mb-3">
                <label class="form-label">Body*</label>
                <textarea class="form-control text-areaa" name="Body" id="body" row="15"></textarea>
              </div>

              <!-- <label for="">Upload Images</label> -->
              <div class="image-upload-container">
                <!-- Upload Box 1 -->
                <!-- <div class="upload-box">
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
                </div> -->

                <!-- Upload Box 2 -->
                <!-- <div class="upload-box">
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
                </div> -->

                <!-- Upload Box 3 -->
                <!-- <div class="upload-box">
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
                </div> -->
              </div>

              <!-- Buttons -->
              <div class="d-flex justify-content-between" style="margin-bottom: 3rem;">
                <button type="submit" name="save_publish" class="btn btn-primary" id="Publish">Save And Publish</button>
                <button type="submit" name="save_draft" class="btn btn-secondary" id="Draft">Save as Draft</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </section>




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

    document.getElementById("Publish").addEventListener("click", function() {
      const form = document.getElementById("postForm");

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

      fetch("../api/v1/post_blog.php", {
          // fetch("https://ogerihealth.org/api/v1/post_blog.php", {
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































    // for draft submission

    document.getElementById("Draft").addEventListener("click", function() {
      const form = document.getElementById("postForm");

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
            setTimeout(hideBadToast, 3000);

            function hideBadToast() {
              const BadToast = document.getElementById('bad-toast');
              BadToast.classList.remove('show');
            }
            return;
          }
        }
      }

      if (!isValid) return;

      fetch("https://ogerihealth.org/api/v1/draft_blog.php", {
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

  <!-- CKEditor Script -->
  <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/super-build/ckeditor.js"></script>
  <script>
    CKEDITOR.ClassicEditor.create(document.getElementById("body"), {
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
    });
  </script>

</body>

</html>