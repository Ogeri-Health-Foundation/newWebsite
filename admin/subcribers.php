<?php
session_start();
require '../api/Database/DatabaseConn.php'; 
$db = new DatabaseConn();
$dbh = $db->connect();

// Dates
$today = date('Y-m-d');
$weekAgo = date('Y-m-d', strtotime('-7 days'));

// Subscriber Stats
$total = $dbh->query("SELECT COUNT(*) as count FROM subscribers")->fetch(PDO::FETCH_ASSOC);
$daily = $dbh->query("SELECT COUNT(*) as count FROM subscribers WHERE DATE(subscribed_at) = '$today'")->fetch(PDO::FETCH_ASSOC);
$weekly = $dbh->query("SELECT COUNT(*) as count FROM subscribers WHERE DATE(subscribed_at) >= '$weekAgo'")->fetch(PDO::FETCH_ASSOC);
?>
<?php

$page_title = "Subscribers - Admin- Ogeri Health Foundation";

$page_author = "Praise";

$page_description = "";

$page_rel = '../';

$page_name = 'admin';

$customs = array(
    "stylesheets" => [""],
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


    <?php $page = 'subscribers'; ?>
    <?php include $page_rel . 'admin/includes/topbar.php'; ?>



    <main class="main-content">
        <?php if (isset($_GET['message'])): ?>
            <div id="alertBox" class="alert 
                <?php echo $_GET['status'] === 'success' ? 'alert-success' : 'alert-danger'; ?>
                alert-dismissible fade show position-fixed top-0 end-0 m-4 z-1000" role="alert" style="z-index: 9999;">
                <?php echo htmlspecialchars($_GET['message']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
       <section class="container mt-4 px-4">
            <h2 class="text-xl font-semibold mb-4">Subscribers Overview</h2>

           <div class="row gap-4 mb-6">

                <div class="col-md-3 bg-white shadow rounded-2xl p-4">
                    <h3 class="text-md font-medium mb-2 text-gray-700">Total Subscribers</h3>
                    <p class="text-3xl font-bold text-[--theme-color]"><?= $total['count'] ?? 0 ?></p>
                </div>

                <div class="col-md-3 bg-white shadow rounded-2xl p-4">
                    <h3 class="text-md font-medium mb-2 text-gray-700">New Today</h3>
                    <p class="text-3xl font-bold text-blue-500"><?= $daily['count'] ?? 0 ?></p>
                </div>

                <div class="col-md-3 bg-white shadow rounded-2xl p-4">
                    <h3 class="text-md font-medium mb-2 text-gray-700">This Week</h3>
                    <p class="text-3xl font-bold text-purple-600"><?= $weekly['count'] ?? 0 ?></p>
                </div>

            </div>

            <!-- Subscribers Table -->
            <div class="bg-white shadow rounded-2xl p-4 overflow-auto mt-3">
                <h3 class="text-lg font-semibold mb-4 text-gray-800">Subscribers List</h3>

                <table class="min-w-full border border-gray-300 text-sm" id="subscribersTable">
                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="text-left px-3 py-2 border-b">Email</th>
                            <th class="text-left px-3 py-2 border-b">Date Subscribed</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600">
                        <?php
                        $stmt = $dbh->query("SELECT * FROM subscribers ORDER BY subscribed_at DESC");
                        $rows = $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
                        if (count($rows) > 0) {
                            foreach ($rows as $row) {
                                echo "<tr>";
                                echo "<td class='px-3 py-2 border-b'>{$row['email']}</td>";
                                echo "<td class='px-3 py-2 border-b'>" . date("F j, Y, g:i a", strtotime($row['subscribed_at'])) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='2' class='px-3 py-4 text-center text-gray-400'>No subscribers found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <!-- Newsletter Form -->
            <div class="bg-white shadow rounded-2xl p-4 my-5">
                <h3 class="text-lg font-semibold mb-4">Send Newsletter to All Subscribers</h3>
                <form method="POST" action="send_newsletters.php">
                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Subject</label>
                        <input type="text" name="subject" required class="w-100 border border-gray-300 rounded px-3 py-2" />
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Message</label>
                        <textarea name="body" rows="6" required class="w-100 border border-gray-300 rounded px-3 py-2"></textarea>
                    </div>
                    <button type="submit" class="bg-success text-white px-4 py-2 rounded hover:bg-success-700">Send Newsletter</button>
                </form>
            </div>
        </section>
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

    <script>
        $(document).ready(function() {
      // Call it on page load
     

      $('#subscribersTable').DataTable({
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
      });
    });
    </script>

    <script>
    setTimeout(() => {
        const alert = document.getElementById('alertBox');
        if (alert) {
            alert.classList.remove('show');
            alert.classList.add('hide');
        }
    }, 5000); // hide after 5 seconds
</script>

</body>

</html>