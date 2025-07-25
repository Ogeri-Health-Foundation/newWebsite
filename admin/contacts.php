<?php
    session_start();
?>
<?php

    $page_title = "Contacts - Admin- Ogeri Health Foundation";

    $page_author = "Praise";

    $page_description = "";

    $page_rel = '../';

    $page_name = 'admin';
 
    $customs = array(
               "stylesheets" => ["volunteer/assets/css/volunteers.css"],
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

    <?php include $page_rel . 'admin/includes/admin-head.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>


    <?php $page = ''; ?>
    <?php include $page_rel . 'admin/includes/topbar.php'; ?>



    <main class="main-content">
        <!-- <div id="toast-success">
            <div class="icon">✔</div>
            <div id="toast-message">login success</div>
            <button class="close-btn" onclick="hideToast()">&times;</button>
        </div>

        <div id="bad-toast">
            <div class="bad-icon"> 
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="13" height="13">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </div>
            <div id="bad-toast-message">login not successful</div>
            <button class="close-btn" onclick="hideToast()">&times;</button>
        </div> -->

        <section class="container">
            <div class="toast-container" id="toastContainer">
                        <!-- Toast will be added dynamically -->
            </div>
            <div class="content-header">
                <div>
                    <h2 class="content-title">Contact Messages!</h2>
                    <p class="content-subtitle">Manage all contact messages from here.</p>
                    
                </div>
                

            </div>
            <div class="table-responsive">
                <table class="contact-table table table-striped" id="contactTable">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Subject</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require '../api/Database/DatabaseConn.php';

                        try {
                            $db = new DatabaseConn();
                            $pdo = $db->connect();

                            // Pagination setup
                            $limit = 10;
                            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                            $offset = ($page - 1) * $limit;

                            // Count total messages
                            $countStmt = $pdo->query("SELECT COUNT(*) as total FROM contact_messages");
                            $totalRows = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];
                            $totalPages = ceil($totalRows / $limit);

                            // Fetch messages
                            $stmt = $pdo->prepare("SELECT * FROM contact_messages ORDER BY id DESC LIMIT :limit OFFSET :offset");
                            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
                            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
                            $stmt->execute();

                            $sn = $offset;
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>
                                    <td>" . ++$sn . "</td>
                                    <td>" . htmlspecialchars($row['name']) . "</td>
                                    <td>" . htmlspecialchars($row['email']) . "</td>
                                    <td>" . htmlspecialchars($row['number']) . "</td>
                                    <td>" . htmlspecialchars($row['company']) . "</td>
                                    <td class='text-center'>
                                        <div class='dropdown'>
                                            <button class='action-button dropdown-toggle' type='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                                <i class='fas fa-ellipsis-v'></i>
                                            </button>
                                            <ul class='dropdown-menu'>
                                                <li>
                                                    <a class='dropdown-item view-btn' href='#' 
                                                    data-bs-toggle='modal' 
                                                    data-bs-target='#viewMessageModal'
                                                    data-id='{$row['id']}'
                                                    data-name='" . htmlspecialchars($row['name'], ENT_QUOTES) . "'
                                                    data-email='" . htmlspecialchars($row['email'], ENT_QUOTES) . "'
                                                    data-number='" . htmlspecialchars($row['number'], ENT_QUOTES) . "'
                                                    data-company='" . htmlspecialchars($row['company'], ENT_QUOTES) . "'
                                                    data-message='" . htmlspecialchars($row['message'], ENT_QUOTES) . "'>
                                                    View Message
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class='dropdown-item text-danger' href='delete-contact.php?id={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this message?\")'>
                                                        Delete Message
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>";
                            }
                        } catch (PDOException $e) {
                            echo "<tr><td colspan='6'>Error fetching data: " . $e->getMessage() . "</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

           
            <!-- <div class="pagination">
                <?php if ($page > 1): ?>
                    <a href="?page=<?php echo $page - 1; ?>" class="btn btn-prev">
                        <i class="fas fa-chevron-left"></i> Previous
                    </a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>" class="btn btn-page <?php echo ($i == $page) ? 'active' : ''; ?>">
                        <?php echo $i; ?>
                    </a>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <a href="?page=<?php echo $page + 1; ?>" class="btn btn-next">
                        Next <i class="fas fa-chevron-right"></i>
                    </a>
                <?php endif; ?>
            </div> -->



        </section>


        <section class="meaningful-name-for-this-section">
            <!------------>
            <!-- Stuffs -->
            <!------------>
        </section>


        <section class="meaningful-name-for-this-section">
            <!------------>
            <!-- Stuffs -->
            <!------------>
        </section>

    </main>
    <div class="modal fade" id="viewMessageModal" tabindex="-1" aria-labelledby="viewMessageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <form form id="replyForm" method="POST" action="reply.php">
                <div class="modal-header">
                <h5 class="modal-title" id="viewMessageModalLabel">Contact Message Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Name:</label>
                    <p id="contactName" class="form-control-plaintext"></p>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <p id="contactEmail" class="form-control-plaintext"></p>
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone:</label>
                    <p id="contactPhone" class="form-control-plaintext"></p>
                </div>

                <div class="mb-3">
                    <label class="form-label">Subject:</label>
                    <p id="contactSubject" class="form-control-plaintext"></p>
                </div>

                <div class="mb-3">
                    <label class="form-label">Message:</label>
                    <p id="contactMessage" class="form-control-plaintext"></p>
                </div>

                <hr>

                <h5>Reply to Contact</h5>
                <input type="hidden" name="toEmail" id="replyToEmail">
                <input type="hidden" name="contactName" id="replyToName">
                <div class="mb-3">
                    <label for="replyMessage" class="form-label">Your Reply</label>
                    <textarea class="form-control" name="replyMessage" id="replyMessage" rows="5" required></textarea>
                </div>
                </div>

                <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Send Reply</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
            </div>
        </div>
    </div>



   <?php include $page_rel . 'admin/includes/sidebar.php'; ?>
   <script>
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
      div.dataTables_wrapper div.dataTables_length select {
        padding: 5px 35px;
      }
    </style>
  
    <script>
    $(document).ready(function() {
      // Call it on page load
     

      $('#contactTable').DataTable({
        dom: '<"row mb-3"<"col-md-4"l>>' + // Show entries
          '<"row mb-3"<"col-md-6"B><"col-md-6 text-end"f>>' + // Buttons and Search filter
          'rt' +
          '<"row mt-3"<"col-md-5"i><"col-md-7"p>>', // Info and Pagination
        buttons: [{
            extend: 'copy',
            className: 'btn btn-primary btn-sm me-1 mb-2 '
          },
          {
            extend: 'csv',
            className: 'btn btn-secondary btn-sm me-1 mb-2'
          },
          {
            extend: 'excel',
            className: 'btn btn-success btn-sm me-1 mb-2'
          },
          {
            extend: 'pdf',
            className: 'btn btn-danger btn-sm me-1 mb-2'
          },
          {
            extend: 'print',
            className: 'btn btn-dark btn-sm mb-2'
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
      }); // <-- Close DataTable initialization here

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

    });
   </script>
   <script>
        document.addEventListener("DOMContentLoaded", function () {
            const viewButtons = document.querySelectorAll(".view-btn");

            viewButtons.forEach(button => {
                button.addEventListener("click", function () {
                    const name = this.dataset.name;
                    const email = this.dataset.email;
                    const phone = this.dataset.number;
                    const subject = this.dataset.company;
                    const message = this.dataset.message;

                    document.getElementById("contactName").textContent = name;
                    document.getElementById("contactEmail").textContent = email;
                    document.getElementById("contactPhone").textContent = phone;
                    document.getElementById("contactSubject").textContent = subject;
                    document.getElementById("contactMessage").textContent = message;

                    document.getElementById("replyToEmail").value = email;
                    document.getElementById("replyToName").value = name;
                });
            });
        });
    </script>
    <script>
        const replyForm = document.getElementById('replyForm');

        replyForm.addEventListener('submit', async function (e) {
            e.preventDefault();

            const formData = new FormData(replyForm);

            try {
                const response = await fetch('reply.php', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();

                showAlert(result.message, result.status);

                if (result.status === 'success') {
                    setTimeout(() => {
                        location.reload(); // Refresh contacts.php
                    }, 2000);
                }

            } catch (error) {
                showAlert('Unexpected error occurred.', 'error');
            }
        });

        function showAlert(message, status) {
            const alertBox = document.createElement('div');
            alertBox.className = `alert alert-${status === 'success' ? 'success' : 'danger'} mt-3`;
            alertBox.textContent = message;

            replyForm.parentElement.insertBefore(alertBox, replyForm);

            setTimeout(() => alertBox.remove(), 4000);
        }
    </script>

</body>

</html>