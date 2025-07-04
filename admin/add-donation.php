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
    
    <?php include $page_rel.'admin/includes/admin-head.php'; ?>

</head>
<body>


    
    <?php $page = 'Blog'; ?>
    <?php include $page_rel.'admin/includes/topbar.php'; ?>


    <main>

        <section class="hero">
            <div class="container mt-5">
            <button class="back-button" onclick="window.history.back();">
                <img src="<?php echo $page_rel; ?>admin/assets/images/login/back.svg" alt="" />
            </button>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <h2 class="mb-4 fw-bold">Create Donation</h2>

                        <form action="save_post.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="post_id" value="<?php echo isset($post) ? $post['id'] : ''; ?>">

                            <!-- Blog Title -->
                            <div class="mb-3">
                                <label class="form-label">Title*</label>
                                <input type="text" class="form-control" name="title" placeholder="Enter Title" value="<?php echo isset($post) ? $post['title'] : ''; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Date*</label>
                                <input type="date" class="form-control" name="date" placeholder="se"  value="<?php echo isset($post) ? $post[''] : ''; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Donation target*</label>
                                <input type="number" class="form-control" name="donation-target" placeholder="Enter donation target" value="<?php echo isset($post) ? $post[''] : ''; ?>" required>
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
                                <label class="form-label">Description*</label>
                                <input type="text" class="form-control" name="description" placeholder="Enter Description" value="<?php echo isset($post) ? $post['description'] : ''; ?>" required>
                            </div>

                            <!-- Category -->
                            <!-- <div class="mb-3">
                                <label class="form-label">Category*</label>
                                <select class="form-select" name="category" required>
                                    <option value="">Choose a Category...</option>
                                    <option value="tech" <?php echo (isset($post) && $post['category'] == 'tech') ? 'selected' : ''; ?>>Tech</option>
                                    <option value="business" <?php echo (isset($post) && $post['category'] == 'business') ? 'selected' : ''; ?>>Business</option>
                                    <option value="health" <?php echo (isset($post) && $post['category'] == 'health') ? 'selected' : ''; ?>>Health</option>
                                </select>
                            </div> -->

                            <!-- Body -->
                            <div class="mb-3">
                                <label class="form-label">Body*</label>
                                <textarea class="form-control text-areaa" id="editor" name="body" row="10"><?php echo isset($post) ? $post['body'] : ''; ?></textarea>
                            </div>

                            <!-- Buttons -->
                            <div class="d-flex justify-content-between">
                                <button type="submit" name="save_publish" class="btn btn-primary">Save And Publish</button>
                                <button type="submit" name="save_draft" class="btn btn-secondary">Save as Draft</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>


        

    </main>



    <?php include $page_rel.'admin/includes/sidebar.php'; ?>

    <script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            document.getElementById('preview').src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<!-- CKEditor Script -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: [
                'heading', '|', 'bold', 'italic', 'underline', '|', 'bulletedList', 'numberedList', '|', 
                'blockQuote', 'link', 'insertTable', 'mediaEmbed', 'undo', 'redo', '|',
                'imageUpload', 'ckfinder', 'alignment', 'fontColor', 'fontSize'
            ],
            ckfinder: {
                uploadUrl: 'upload.php' // Backend file to handle uploads
            }
        }) .then(editor => {
            editor.ui.view.editable.element.style.height = '300px'; // Adjust height here
        })
        .catch(error => {
            console.error(error);
        });
</script>


</body>
</html>
