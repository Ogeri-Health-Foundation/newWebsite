<?php
    // session_start();
?>
<?php

    $page_title = "Add Community members - Admin - Ogeri Health Foundation";

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
       
   </style>
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
<body>


    
    <?php $page = 'Blog'; ?>
    <?php include $page_rel.'admin/includes/topbar.php'; ?>


    <main>

        <section class="hero">

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
        <button class="close-btn" onclick="hideToast()">&times;</button>
    </div>

    

            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <h3 class="mb-4 fw-bold">Add Health workers</h3>

                        <form method="POST" enctype="multipart/form-data" id="postForm">
                           

                             <!-- Doctor name -->
                             <div class="mb-3">
                                <label class="form-label">Doctor Name*</label>
                                <input type="text" class="form-control" name="Name" placeholder="Enter Your name" value="<?php echo isset($post) ? $post['name'] : ''; ?>" required>
                            </div>

                            <!-- Cover Image -->
                            <div class="mb-3">
                                <label class="form-label">Cover Image</label>
                                <div class="upload-box text-center" onclick="document.getElementById('cover_image').click();">
                                    <input type="file" id="cover_image" name="cover_image" accept="image/*" hidden onchange="previewImage(event)">
                                    <img id="preview" src="<?php echo isset($post['image']) ? 'uploads/' . $post['image'] : 'assets/images/upload-placeholder.svg'; ?>" alt="Upload Image">
                                </div>
                            </div>


                            <!-- Category -->
                            <div class="mb-3">
                                <label class="form-label">Profession</label>
                                <select class="form-select" name="Category" required>
                                    <option value="">Choose a Category...</option>
                                    <option value="doctor" <?php echo (isset($post) && $post['category'] == 'doctor') ? 'selected' : ''; ?>>Doctor</option>
                                    <option value="nurse" <?php echo (isset($post) && $post['category'] == 'nurse') ? 'selected' : ''; ?>>Nurse</option>
                                    <option value="physiologist" <?php echo (isset($post) && $post['category'] == 'physiologist') ? 'selected' : ''; ?>>Physiology</option>
                                </select>
                            </div>

                            <!-- Doctor id -->
                            <div class="mb-3">
                                <label class="form-label">Specialization*</label>
                                <input type="text" class="form-control" name="Specialization" placeholder="Enter your specialization" required>
                            </div>

                           

                            <!-- Buttons -->
                            <div class="d-flex justify-content-between" style="margin-bottom: 3rem;">
                                <button type="submit" name="save_publish" id="Publish" class="btn btn-primary">Save And Publish</button>
                                
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

if (!isValid) return; // Stop if validation fails

    fetch("../api/v1/add_staff.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json()) 
    .then(data => {
        // alert(data.message);
        if (data.success === true) {
    const toast = document.getElementById('toast-success');
    const toastMesaage = document.getElementById('toast-message');
    toast.classList.add('show');
    toastMesaage.textContent = data.message;
    form.reset();
    document.getElementById('preview').src = "assets/images/upload-placeholder.svg";

    setTimeout(() => {
        toast.classList.remove('show');
        // Redirect after toast disappears
        window.location.href = "resource.php";
    }, 3000); // 3 seconds delay before redirect
}

    else{
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
        alert("An error occurred.");
    });
});
</script>




</body>
</html>
