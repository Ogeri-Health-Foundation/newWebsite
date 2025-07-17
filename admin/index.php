<?php
session_start();
?>
<?php

$page_title = "Home - Admin - Ogeri Health Foundation";

$page_author = "Olayinka";

$page_description = "";

$page_rel = '../';

$page_name = 'Dashboard';

$customs = array(
    "stylesheets" => [""],
    "scripts" => ["volunteer/assets/js/volunteers.js"]
);

// $addons = array(
//             "stylesheets" => ["https://some-external-url.css"],
//             "scripts" => ["https://some-external-url.js"]
//            );

?>
<?php
$connectX = true;
require_once "../include/connectionx.php";

$sql = "SELECT COUNT(*) AS total FROM blog_posts";
$result = $dbh->query($sql);

$sql1 = "SELECT COUNT(*) AS total FROM events";
$result1 = $dbh->query($sql1);

$sql2 = "SELECT COUNT(*) AS total FROM partners";
$result2 = $dbh->query($sql2);

$sql3 = "SELECT COUNT(*) AS total FROM volunteers";
$result3 = $dbh->query($sql3);

$sql4 = "
    SELECT 'doctor' AS role, COUNT(*) AS total FROM doctors
    UNION ALL
    SELECT 'nurses', COUNT(*) FROM nurses
    UNION ALL
    SELECT 'physiologists', COUNT(*) FROM physiologist
";
$result4 = $dbh->query($sql4);

$sql5 = "SELECT COUNT(*) AS total FROM donation_events";
$result5 = $dbh->query($sql5);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include $page_rel . 'admin/includes/admin-head.php'; ?>
    <link rel="stylesheet" href="./assets/css/style.css" />
    <style>
        
    </style>
</head>

<body>

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
    }else if (data.status === "success") {
      console.log("Authenticated successfully");
    } else {
      throw new Error("Unexpected response format");
    }

    console.log("Auth Data:", data);
    return data;
  })
  .catch(error => {
    console.error("Fetch error:", error);
  });


};

      

    </script>
    <!-- Main Content -->
    <?php $page = 'home'; ?>
    <?php include $page_rel . 'admin/includes/topbar.php'; ?>
    <main >
        <!-- Cards -->
        <section class="cards2 container">
            <div class="row gy-5 gap-4 justify-content-center">
                <div class="card3 col-md-4">
                    <span>
                        <h3>Total Volunteer</h3>
                        <?php
                            if ($result3->num_rows > 0) {
                        $row3 = $result3->fetch_assoc();
                        
                                echo  "<h2>".$row3["total"]."</h2>";
                            }
                                    ?>
                        
                        <p><b>+23%</b> since last month</p>
                    </span>
                    <img src="./assets/images/userIcon.svg" alt="User Icon" />
                </div>
                <div class="card3 col-md-4">
                    <span>
                        <h3>Total health worker</h3>
                        <?php
                            if ($result4->num_rows > 0) {
                        $row4 = $result4->fetch_assoc();
                        
                                echo  "<h2>".$row4["total"]."</h2>";
                            }
                                    ?>
                        <p><b>+23%</b> since last month</p>
                    </span>
                    <img src="./assets/images/healthHol.svg" alt="healthHol icon" />
                </div>
                <div class="card3 col-md-4">
                    <span>
                        <h3>Total Events</h3>
                        <?php
                            if ($result1->num_rows > 0) {
                        $row1 = $result1->fetch_assoc();
                        
                                echo  "<h2>".$row1["total"]."</h2>";
                            }
                            ?>
                        <p><b>+23%</b> since last month</p>
                    </span>
                    <figure>
                        <img class="icon" src="./assets/images/appointment_colored.png" alt="" />
                    </figure>
                </div>
                <div class="card3 col-md-4">
                    <span>
                        <h3>Total Blog</h3>
                        <?php
                            if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        
                                echo  "<h2>".$row["total"]."</h2>";
                            }
                                    ?>
                        <p><b>+23%</b> since last month</p>
                    </span>
                    <figure>
                        <img class="icon" src="./assets/images/blog.png" alt="" />
                    </figure>
                </div>
                <div class="card3 col-md-4">
                    <span>
                        <h3>Total Partners</h3>
                        <?php
                            if ($result2->num_rows > 0) {
                        $row2 = $result2->fetch_assoc();
                        
                                echo  "<h2>".$row2["total"]."</h2>";
                            }
                                    ?>
                        <p><b>+23%</b> since last month</p>
                    </span>
                    <img src="./assets/images/userIcon.svg" alt="User Icon" />
                </div>
                <div class="card3 col-md-4">
                    <span>
                        <h3>Total Donation Events</h3>
                        <?php
                            if ($result5->num_rows > 0) {
                        $row5 = $result5->fetch_assoc();
                        
                                echo  "<h2>".$row5["total"]."</h2>";
                            }
                                    ?>
                        <p><b>+23%</b> since last month</p>
                    </span>
                    <img src="./assets/images/healthHol.svg" alt="healthHol icon" />
                </div>
            </div>
        </section>

        <section class="blog container">
            <div class="Blogchart-container">
                <h2>Blog Posts Per Month</h2>
                <canvas id="engagementChart"></canvas>
            </div>


            <?php

            $sql = "SELECT blog_title, image, published_at FROM blog_posts 
                    WHERE status = 'published' 
                    ORDER BY published_at DESC 
                    LIMIT 5";

            $result = $dbh->query($sql);

            $blogs = [];
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $blogs[] = $row;
                }
            }
            
            ?>

            <article>
                <h2>Recent Blog</h2>
                <?php if (empty($blogs)): ?>
                    <div style="display: block; text-align: center; padding: 40px 20px; border: 2px dashed #ccc; border-radius: 10px; margin-top: 20px;">
                        <p style="font-size: 18px; font-weight: 500; color: #555;">No recent blog yet.</p>
                        <a href="add-blog.php" style="display: block; margin:0 auto; margin-top: 15px; background: #ff6b35; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none;">
                            Upload your first blog
                        </a>
                    </div>
                <?php else: ?>

                <?php foreach ($blogs as $blog): ?>
                    <div>
                        <a href="resources.php" class="blog-link">
                            <img src="../uploads/<?= htmlspecialchars($blog['image']) ?>" alt="Blog image"style="border: 2px red solid;"/>
                            <span>
                                <h3 ><?= htmlspecialchars($blog['blog_title']) ?></h3>
                                <p class="" style=" margin-top: -10px;">Date: <?= date("j/n/y", strtotime($blog['published_at'])) ?></p>
                            </span>
                        </a>
                        
                    </div>
                <?php endforeach; ?>

                    <a href="blogs.php">
                        View all blog
                        <img class="icon" src="./assets/images/arrow_right.svg" alt="arrow-right icon" />
                    </a>
                <?php endif; ?>
            </article>


        </section>

        <section class="users container" >
            <article class="table-container">
                <span class="orderList_1_text">
                    <span>
                        <h2>Volunteers</h2>
                    </span>
                    <a href="volunteer/volunteers.php">View all</a>
                </span>
                <table class="volunteers-table" id="">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>Profession</th>
                                    <th>Volunteer Field</th>
                                    <th>Status</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require '../api/Database/DatabaseConn.php'; // Ensure this file contains the database connection

                                try {
                                    $db = new DatabaseConn();
                                    $pdo = $db->connect();

                                    // Limit to 5 volunteers only
                                    $limit = 5;
                                    $stmt = $pdo->prepare("SELECT * FROM volunteers LIMIT :limit");
                                    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
                                    $stmt->execute();

                                    $volunteers = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    if (count($volunteers) > 0) {
                                        $sn = 0;
                                        foreach ($volunteers as $row) {
                                            echo "<tr>
                                                <td>" . ++$sn . "</td>
                                                <td>" . htmlspecialchars($row['name']) . "</td>
                                                <td>" . htmlspecialchars($row['gender']) . "</td>
                                                <td>" . htmlspecialchars($row['profession']) . "</td>
                                                <td>" . htmlspecialchars($row['role']) . "</td>
                                                <td class='" . 
                                                    ($row['status'] === 'Pending' ? 'status-pending' : 
                                                    ($row['status'] === 'Approved' ? 'status-approved' : 
                                                    ($row['status'] === 'Rejected' ? 'status-rejected' : ''))) . 
                                                "'>" . htmlspecialchars($row['status']) . "</td>
                                            </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6' style='text-align:center; padding: 30px;'>
                                                <img src='assets/images/dasboard/no-volunteer.svg' alt='No Volunteers' style='max-width: 200px;' />
                                                <p style='font-size: 18px; font-weight: 500; '>No records found</p>
                                            </td></tr>";
                                    }
                                } catch (PDOException $e) {
                                    echo "<tr><td colspan='6'>Error fetching data: " . $e->getMessage() . "</td></tr>";
                                }
                                ?>
                            </tbody>

                        </table>
            </article>
            <article class="table-container">
                <span class="orderList_1_text">
                    <span>
                        <h2>Health Worker</h2>
                    </span>
                    <a href="#">View all</a>
                </span>
                <table>
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Profession</th>
                            <th>Area of Specialization</th>
                            <th>Availability</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // require '../api/Database/DatabaseConn.php'; // Database connection

                        try {
                            
                            $pdo = $db->connect();

                            // Fetch a combined set of doctors, nurses, and physiologists
                            $sql = "
                                SELECT doctor_name AS name, area_of_specialization, status, is_available, image FROM doctors
                                UNION ALL
                                SELECT nurse_name, area_of_specialization, status, is_available, image FROM nurses
                                UNION ALL
                                SELECT physiologist_name, area_of_specialization, status, is_available, image FROM physiologist
                                LIMIT 5
                            ";

                            $stmt = $pdo->query($sql);
                            $workers = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            if (count($workers) > 0) {
                                $sn = 0;
                                foreach ($workers as $worker) {
                                    $sn++;
                                    $availabilitySwitchId = "switch" . $sn;
                                    echo "<tr>
                                        <td>{$sn}</td>
                                        <td><h4>" . htmlspecialchars($worker['name']) . "</h4></td>
                                        <td>" . htmlspecialchars($worker['area_of_specialization']) . "</td>
                                        <td>" . htmlspecialchars($worker['status']) . "</td>
                                        <td>
                                            <div class='switch-container'>
                                                <input type='checkbox' id='{$availabilitySwitchId}' class='switch' " . ($worker['is_available'] ? "checked" : "") . " />
                                                <label for='{$availabilitySwitchId}' class='switch-label'>
                                                    <span class='switch-indicator'></span>
                                                </label>
                                            </div>
                                        </td>
                                        
                                    </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6' style='text-align:center; padding: 30px;'>
                                        <img src='assets/images/dasboard/no-volunteer.svg' alt='No Records Found' style='max-width: 200px;' />
                                        <p style='font-size: 18px; font-weight: 500; color: #555;'>No records found</p>
                                    
                                    </td></tr>";
                            }
                        } catch (PDOException $e) {
                            echo "<tr><td colspan='6'>Error fetching data: " . $e->getMessage() . "</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>

            </article>
        </section>

        <section class="event container">
            <article class="eventCard">
                <h2>Upcoming Event</h2>
                    <article>
                    <?php
                   

                    try {
                        $db = new DatabaseConn();
                        $pdo = $db->connect();

                        $sql = "SELECT title, date, time FROM events 
                                WHERE status = 'upcoming' 
                                ORDER BY date ASC 
                                LIMIT 5";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();

                        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if (count($events) > 0) {
                            foreach ($events as $event) {
                                $formattedDate = date("j/n/y", strtotime($event['date']));
                                $formattedTime = date("g:i A", strtotime($event['time']));
                                echo "
                                <div>
                                    <span>
                                        <h3>" . htmlspecialchars($event['title']) . "</h3>
                                        <p>
                                            <img class='icon' src='./assets/images/calendar_month_icon.svg' alt='calendar_month_icon' />
                                            {$formattedDate}
                                        </p>
                                        <p>
                                            <img class='icon' src='./assets/images/scheduleIcon.svg' alt='schedule Icon' />
                                            {$formattedTime}
                                        </p>
                                    </span>
                                    <a href='events.php'>
                                        <img src='./assets/images/horizDots.svg' alt='View Event Details' />
                                    </a>
                                </div>
                                ";
                            }
                        } else {
                            echo "  <div style='display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 3rem 1rem; text-align: center;'>
                                        <p style='font-size: 1.2rem; margin-bottom: 1.5rem;'>No upcoming events found.</p>
                                        <a href='events.php' style='background-color: #ff6b35; color: white; padding: 0.75rem 1.5rem; border-radius: 5px; text-decoration: none; font-weight: bold;'>
                                            Add an Event
                                        </a>
                                    </div>";
                        }
                    } catch (PDOException $e) {
                        echo "<p>Error fetching events: " . $e->getMessage() . "</p>";
                    }
                    ?>
                </article>
                <a href="events.php">See All Event <img src="./assets/images/arrow_right.svg" alt="" /></a>
            </article>

            <article class="calendarCard">
                
                <div class="pieChart">
                    <div class="header">
                        <span>Event</span>
                        <div class="dropdown2">
                        <select id="eventFilter">
                            <option value="this_month">This Month</option>
                            <option value="last_month">Last Month</option>
                            <option value="last_3_months">Last 3 Months</option>
                        </select>
                        </div>
                    </div>

                    <div class="pieChart-container">
                        <canvas id="ticketChart"></canvas>
                        <div class="total-text">
                            <span>Total Event</span><br />
                            <strong id="totalTickets"><?= $totalEvents ?></strong>
                        </div>
                    </div>

                    <div class="stats">
                        <div class="stat">
                            <div class="label">
                                <div class="color-box" style="background: #ff6e3b"></div>
                                Upcoming Event
                            </div>
                            <strong><?= $upcoming ?></strong>
                            <span class="percentage"><?= $upcomingPercentage ?>%</span>
                        </div>
                        <div class="stat">
                            <div class="label">
                                <div class="color-box" style="background: #28394b"></div>
                                Event Completed
                            </div>
                            <strong><?= $completed ?></strong>
                            <span class="percentage"><?= $completedPercentage ?>%</span>
                        </div>
                    </div>
                </div>

            </article>
        </section>
    </main>
    <?php include $page_rel . 'admin/includes/sidebar.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('ticketChart').getContext('2d');
        let ticketChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Upcoming Event', 'Event Completed'],
                datasets: [{
                    data: [0, 0],
                    backgroundColor: ['#ff6e3b', '#28394b'],
                }]
            },
            options: {
                cutout: '70%',
                plugins: { legend: { display: false } }
            }
        });

        document.getElementById('eventFilter').addEventListener('change', function () {
            fetchChartData(this.value);
        });

function fetchChartData(filter = 'this_month') {
    fetch(`get_event_stats.php?filter=${filter}`)
        .then(res => res.json())
        .then(data => {
            const total = data.total;
            const upcoming = data.upcoming;
            const completed = data.completed;

            ticketChart.data.datasets[0].data = [upcoming, completed];
            ticketChart.update();

            document.getElementById('totalTickets').textContent = total.toLocaleString();
            document.querySelectorAll('.stats .stat')[0].querySelector('strong').textContent = upcoming.toLocaleString();
            document.querySelectorAll('.stats .stat')[1].querySelector('strong').textContent = completed.toLocaleString();

            const upPct = total > 0 ? ((upcoming / total) * 100).toFixed(1) : 0;
            const compPct = total > 0 ? ((completed / total) * 100).toFixed(1) : 0;
            document.querySelectorAll('.stats .stat')[0].querySelector('.percentage').textContent = `${upPct}%`;
            document.querySelectorAll('.stats .stat')[1].querySelector('.percentage').textContent = `${compPct}%`;
        });
}

// Load initial data
fetchChartData();
</script>


<script>
document.addEventListener("DOMContentLoaded", function () {
  const ctx = document.getElementById("engagementChart");
  if (ctx) {
    const context = ctx.getContext("2d");
    const gradient = context.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, "rgba(255, 110, 59, 0.6)");
    gradient.addColorStop(1, "rgba(255, 110, 59, 0)");

    // Fetch blog post data from PHP
    fetch("get_blog_stats.php")
      .then((response) => response.json())
      .then((monthlyData) => {
        new Chart(context, {
          type: "line",
          data: {
            labels: [
              "Jan", "Feb", "Mar", "Apr", "May", "Jun",
              "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"
            ],
            datasets: [
              {
                label: "Posts Per Month",
                data: monthlyData,
                backgroundColor: gradient,
                borderColor: "#ff6e3b",
                borderWidth: 3,
                pointBackgroundColor: "#fff",
                pointBorderColor: "#ff6e3b",
                pointRadius: 6,
                pointHoverRadius: 8,
                fill: true,
                tension: 0.4,
              },
            ],
          },
          options: {
            responsive: true,
            plugins: {
              legend: {
                display: true,
                position: "top",
              },
            },
            scales: {
              y: {
                beginAtZero: true,
                ticks: {
                  stepSize: 2,
                },
                grid: {
                  borderDash: [5, 5],
                  color: "rgba(0, 0, 0, 0.1)",
                },
              },
              x: {
                grid: {
                  display: false,
                },
              },
            },
          },
        });
      })
      .catch((error) => console.error("Error loading chart data:", error));
  }
});
</script>

</body>

</html>