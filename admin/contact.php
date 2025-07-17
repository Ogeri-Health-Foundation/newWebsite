<?php
session_start();
?>
<?php

$page_title = "Contact - Ogeri Health Foundation";

$page_author = "Okibe";

$page_description = "";

$page_rel = '../';

$page_name = 'donations';

$customs = array(
    "stylesheets" => ["volunteer/assets/css/volunteers.css"],
    "scripts" => ["assets/js/donations.js"]
);

// $addons = array(
//             "stylesheets" => ["https://some-external-url.css"],
//             "scripts" => ["https://some-external-url.js"]
//            );

?>



<!DOCTYPE html>
<html lang="en">
<head>


<?php include $page_rel . 'admin/includes/admin-head.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Dashboard</title>
  <style>
    :root {
      --primary: #4f46e5;
      --primary-light: #818cf8;
      --secondary: #6b7280;
      --light: #f3f4f6;
      --dark: #1f2937;
      --success: #10b981;
      --danger: #ef4444;
      --warning: #f59e0b;
      --info: #3b82f6;
      --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
      --transition: all 0.3s ease;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }

    body {
      background-color: #f9fafb;
      color: var(--dark);
      line-height: 1.6;
    }

    /* .dashboard {
      max-width: 1200px;
      margin: 2rem auto;
      padding: 1.5rem;
    } */

    .dashboard-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 1.5rem;
    }

    .dashboard-title {
      font-size: 1.875rem;
      font-weight: 700;
      color: var(--dark);
    }

    .actions {
      display: flex;
      gap: 0.5rem;
    }

    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 0.5rem 1rem;
      border-radius: 0.375rem;
      font-weight: 500;
      cursor: pointer;
      transition: var(--transition);
      border: none;
      outline: none;
      gap: 0.5rem;
    }

    .btn-primary {
      background-color: var(--primary);
      color: white;
    }

    .btn-primary:hover {
      background-color: var(--primary-light);
    }

    .btn-icon {
      padding: 0.5rem;
      border-radius: 0.375rem;
      background-color: white;
      color: var(--secondary);
      border: 1px solid #e5e7eb;
    }

    .btn-icon:hover {
      background-color: var(--light);
      color: var(--dark);
    }

    .search-bar {
      display: flex;
      align-items: center;
      margin-bottom: 1.5rem;
      gap: 1rem;
    }

    .search-input {
      display: flex;
      align-items: center;
      background-color: white;
      border-radius: 0.375rem;
      padding: 0.625rem 1rem;
      flex-grow: 1;
      border: 1px solid #e5e7eb;
      box-shadow: var(--shadow);
    }

    .search-input input {
      border: none;
      outline: none;
      width: 100%;
      margin-left: 0.5rem;
      font-size: 0.875rem;
    }

    .notification-badge {
      position: relative;
    }

    .badge {
      position: absolute;
      top: -5px;
      right: -5px;
      background-color: var(--danger);
      color: white;
      border-radius: 50%;
      width: 18px;
      height: 18px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.75rem;
      font-weight: 600;
    }

    .contacts-list {
      background-color: white;
      border-radius: 0.5rem;
      box-shadow: var(--shadow);
      overflow: hidden;
    }

    .contacts-header {
      display: grid;
      grid-template-columns: 3fr 2fr 2fr 1fr;
      padding: 1rem 1.5rem;
      background-color: #f8fafc;
      border-bottom: 1px solid #e5e7eb;
      font-weight: 600;
      color: var(--secondary);
    }

    .contact-item {
      display: grid;
      grid-template-columns: 3fr 2fr 2fr 1fr;
      padding: 1rem 1.5rem;
      border-bottom: 1px solid #e5e7eb;
      align-items: center;
      transition: var(--transition);
    }

    .contact-item:hover {
      background-color: #f9fafb;
    }

    .contact-item:last-child {
      border-bottom: none;
    }

    .contact-info {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background-color: #e5e7eb;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 600;
      color: var(--secondary);
      overflow: hidden;
    }

    .avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .name-role {
      display: flex;
      flex-direction: column;
    }

    .name {
      font-weight: 600;
    }

    .role {
      font-size: 0.75rem;
      color: var(--secondary);
    }

    .contact-email, .contact-phone {
      color: var(--secondary);
    }

    .contact-actions {
      display: flex;
      gap: 0.75rem;
      justify-content: flex-end;
    }

    .action-icon {
      color: var(--secondary);
      cursor: pointer;
      transition: var(--transition);
    }

    .action-icon:hover {
      color: var(--dark);
    }

    .star.active {
      color: var(--warning);
    }

    .notification-panel {
      position: fixed;
      top: 0;
      right: -360px;
      width: 360px;
      height: 100vh;
      background-color: white;
      box-shadow: -4px 0 10px rgba(0, 0, 0, 0.1);
      z-index: 100;
      transition: var(--transition);
      display: flex;
      flex-direction: column;
    }

    .notification-panel.open {
      right: 0;
    }

    .panel-header {
      padding: 1.5rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: 1px solid #e5e7eb;
    }

    .panel-title {
      font-weight: 600;
    }

    .panel-close {
      cursor: pointer;
      padding: 0.25rem;
    }

    .panel-tabs {
      display: flex;
      border-bottom: 1px solid #e5e7eb;
    }

    .panel-tab {
      flex: 1;
      padding: 0.75rem;
      text-align: center;
      font-weight: 500;
      cursor: pointer;
      transition: var(--transition);
      color: var(--secondary);
    }

    .panel-tab.active {
      color: var(--primary);
      border-bottom: 2px solid var(--primary);
    }

    .panel-content {
      padding: 1rem;
      flex-grow: 1;
      overflow-y: auto;
    }

    .notification-item, .message-item {
      padding: 1rem;
      border-radius: 0.375rem;
      background-color: #f9fafb;
      margin-bottom: 1rem;
      border-left: 3px solid transparent;
    }

    .notification-item {
      border-left-color: var(--info);
    }

    .message-item {
      border-left-color: var(--success);
    }

    .notification-time, .message-time {
      font-size: 0.75rem;
      color: var(--secondary);
      margin-top: 0.5rem;
    }

    .overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.4);
      opacity: 0;
      visibility: hidden;
      transition: var(--transition);
      z-index: 50;
    }

    .overlay.active {
      opacity: 1;
      visibility: visible;
    }

    .pagination {
      display: flex;
      justify-content: center;
      margin-top: 1.5rem;
      gap: 0.5rem;
    }

    .pagination-item {
      width: 36px;
      height: 36px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 0.375rem;
      cursor: pointer;
      transition: var(--transition);
    }

    .pagination-item:hover {
      background-color: #e5e7eb;
    }

    .pagination-item.active {
      background-color: var(--primary);
      color: white;
    }

    svg {
      width: 20px;
      height: 20px;
    }

    .empty-state {
      display: none;
      padding: 2rem;
      text-align: center;
      color: var(--secondary);
    }

    @media (max-width: 768px) {
      .contacts-header, .contact-item {
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
      }
      
      .contact-email, .contact-phone {
        display: none;
      }
      
      .contacts-header span:nth-child(2),
      .contacts-header span:nth-child(3) {
        display: none;
      }
      
      .notification-panel {
        width: 300px;
      }
    }
  </style>



</head>
<body>
<?php $page = 'Blog'; ?>
    <?php include $page_rel . 'admin/includes/topbar.php'; ?>

  <main class="dashboard">
    <div class="dashboard-header">
      <h1 class="dashboard-title">Contacts</h1>
      <div class="actions">
        <button class="btn btn-primary">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
          </svg>
          Add Contact
        </button>
        <button class="btn btn-icon notification-badge" id="notificationToggle">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
          </svg>
          <span class="badge">0</span>
        </button>
        <button class="btn btn-icon notification-badge" id="messageToggle">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
          </svg>
          <span id="badgee" class="badge">2</span>
        </button>
      </div>
    </div>

    <div class="search-bar">
      <div class="search-input">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="11" cy="11" r="8"></circle>
          <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg>
        <input type="text" placeholder="Search contacts..." id="searchInput">
      </div>
      <!-- <button class="btn btn-icon">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
        </svg>
      </button> -->
    </div>

    <div class="contacts-list">
      <div class="contacts-header">
        <span>Name</span>
        <span>Email</span>
        <span>Phone</span>
        <span>Actions</span>
      </div>

      <div class="contact-item">
        <div class="contact-info">
          <div class="avatar">
            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Alex">
          </div>
          <div class="name-role">
            <div class="name">Alex Johnson</div>
            <div class="role">Product Manager</div>
          </div>
        </div>
        <div class="contact-email">alex@example.com</div>
        <div class="contact-phone">+1 (555) 123-4567</div>
        <div class="contact-actions">
          <svg class="action-icon star active" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
          </svg>
          <svg class="action-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
            <polyline points="22,6 12,13 2,6"></polyline>
          </svg>
          <svg class="action-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
          </svg>
        </div>
      </div>

      <div class="contact-item">
        <div class="contact-info">
          <div class="avatar">
            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Sarah">
          </div>
          <div class="name-role">
            <div class="name">Sarah Miller</div>
            <div class="role">UI Designer</div>
          </div>
        </div>
        <div class="contact-email">sarah@example.com</div>
        <div class="contact-phone">+1 (555) 234-5678</div>
        <div class="contact-actions">
          <svg class="action-icon star" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
          </svg>
          <svg class="action-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
            <polyline points="22,6 12,13 2,6"></polyline>
          </svg>
          <svg class="action-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
          </svg>
        </div>
      </div>

      <div class="contact-item">
        <div class="contact-info">
          <div class="avatar">
            <img src="https://randomuser.me/api/portraits/men/62.jpg" alt="Michael">
          </div>
          <div class="name-role">
            <div class="name">Michael Chen</div>
            <div class="role">Developer</div>
          </div>
        </div>
        <div class="contact-email">michael@example.com</div>
        <div class="contact-phone">+1 (555) 345-6789</div>
        <div class="contact-actions">
          <svg class="action-icon star" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
          </svg>
          <svg class="action-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
            <polyline points="22,6 12,13 2,6"></polyline>
          </svg>
          <svg class="action-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
          </svg>
        </div>
      </div>

      <div class="contact-item">
        <div class="contact-info">
          <div class="avatar">
            <img src="https://randomuser.me/api/portraits/women/26.jpg" alt="Emily">
          </div>
          <div class="name-role">
            <div class="name">Emily Davis</div>
            <div class="role">Marketing Lead</div>
          </div>
        </div>
        <div class="contact-email">emily@example.com</div>
        <div class="contact-phone">+1 (555) 456-7890</div>
        <div class="contact-actions">
          <svg class="action-icon star active" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
          </svg>
          <svg class="action-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
            <polyline points="22,6 12,13 2,6"></polyline>
          </svg>
          <svg class="action-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
          </svg>
        </div>
      </div>

      <div class="contact-item">
        <div class="contact-info">
          <div class="avatar">
            <img src="https://randomuser.me/api/portraits/men/76.jpg" alt="James">
          </div>
          <div class="name-role">
            <div class="name">James Wilson</div>
            <div class="role">Sales Representative</div>
          </div>
        </div>
        <div class="contact-email">james@example.com</div>
        <div class="contact-phone">+1 (555) 567-8901</div>
        <div class="contact-actions">
          <svg class="action-icon star" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
          </svg>
          <svg class="action-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
            <polyline points="22,6 12,13 2,6"></polyline>
          </svg>
          <svg class="action-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
          </svg>
        </div>
      </div>
    </div>

    <div class="empty-state">
      <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="7" r="4"></circle>
        <path d="M5 21v-2a7 7 0 0 1 14 0v2"></path>
      </svg>
      <h3>No contacts found</h3>
      <p>Try adjusting your search or filter to find what you're looking for.</p>
    </div>

    <div class="pagination">
      <div class="pagination-item">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="15 18 9 12 15 6"></polyline>
        </svg>
      </div>
      <div class="pagination-item active">1</div>
      <div class="pagination-item">2</div>
      <div class="pagination-item">3</div>
      

      <!-- next onee -->
      <div class="pagination-item">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <polyline points="9 18 15 12 9 6"></polyline>
        </svg>
      </div>
    </div>
  </main>

  <div class="notification-panel" id="notificationPanel">
    <div class="panel-header">
      <div class="panel-close" id="panelClose">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </div>
    </div>
    <div class="panel-tabs">
      <div class="panel-tab active" data-tab="notifications">Notifications (3)</div>
      <div class="panel-tab" id="MyMessages" data-tab="messages"></div>
    </div>
    <div class="panel-content" id="notificationsContent">
      
     
      <div class="notification-item">
        <div class="notification-content">
          <strong>New contact:</strong> Rebecca Wong has been added to your contacts
        </div>
        <div class="notification-time">Yesterday</div>
      </div>
    </div>
    <div class="panel-content" id="messagesContent" style="display: none;">
      <div class="message-item">
        <div class="message-content">
          <strong>Hello Admin</strong> Click the button below to get redirected to the message section
        </div>
        <button onclick="redirectAdmin()" class="btn btn-primary" style="margin-top: 0.6rem;">View Messages <svg fill="#fff" width="20px" height="20px" viewBox="0 0 64 64" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;" stroke="#fff">

<g id="SVGRepo_bgCarrier" stroke-width="0"/>

<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>

<g id="SVGRepo_iconCarrier"> <rect id="Icons" x="-896" y="0" width="1280" height="800" style="fill:none;"/> <g id="Icons1" serif:id="Icons"> <g id="Strike"> </g> <g id="H1"> </g> <g id="H2"> </g> <g id="H3"> </g> <g id="list-ul"> </g> <g id="hamburger-1"> </g> <g id="hamburger-2"> </g> <g id="list-ol"> </g> <g id="list-task"> </g> <g id="trash"> </g> <g id="vertical-menu"> </g> <g id="horizontal-menu"> </g> <g id="sidebar-2"> </g> <g id="Pen"> </g> <g id="Pen1" serif:id="Pen"> </g> <g id="clock"> </g> <g id="external-link"> <path d="M36.026,20.058l-21.092,0c-1.65,0 -2.989,1.339 -2.989,2.989l0,25.964c0,1.65 1.339,2.989 2.989,2.989l26.024,0c1.65,0 2.989,-1.339 2.989,-2.989l0,-20.953l3.999,0l0,21.948c0,3.308 -2.686,5.994 -5.995,5.995l-28.01,0c-3.309,0 -5.995,-2.687 -5.995,-5.995l0,-27.954c0,-3.309 2.686,-5.995 5.995,-5.995l22.085,0l0,4.001Z"/> <path d="M55.925,25.32l-4.005,0l0,-10.481l-27.894,27.893l-2.832,-2.832l27.895,-27.895l-10.484,0l0,-4.005l17.318,0l0.002,0.001l0,17.319Z"/> </g> <g id="hr"> </g> <g id="info"> </g> <g id="warning"> </g> <g id="plus-circle"> </g> <g id="minus-circle"> </g> <g id="vue"> </g> <g id="cog"> </g> <g id="logo"> </g> <g id="radio-check"> </g> <g id="eye-slash"> </g> <g id="eye"> </g> <g id="toggle-off"> </g> <g id="shredder"> </g> <g id="spinner--loading--dots-" serif:id="spinner [loading, dots]"> </g> <g id="react"> </g> <g id="check-selected"> </g> <g id="turn-off"> </g> <g id="code-block"> </g> <g id="user"> </g> <g id="coffee-bean"> </g> <g id="coffee-beans"> <g id="coffee-bean1" serif:id="coffee-bean"> </g> </g> <g id="coffee-bean-filled"> </g> <g id="coffee-beans-filled"> <g id="coffee-bean2" serif:id="coffee-bean"> </g> </g> <g id="clipboard"> </g> <g id="clipboard-paste"> </g> <g id="clipboard-copy"> </g> <g id="Layer1"> </g> </g> </g>

</svg></button>
      </div>
      
    </div>
  </div>

  <div class="overlay" id="overlay"></div>

  <?php include $page_rel . 'admin/includes/sidebar.php'; ?>

  <script>

window.onload = function () {

  const messageArea = document.getElementById("MyMessages");
  const Badge = document.getElementById("badge");
  const Badgee = document.getElementById("badgee");

fetch("http://localhost/ohfWebsite/api/v1/getMessageCount.php")
.then(async response => {
  const data = await response.json(); 
  message = data.message;
  messageArea.textContent = `Messages (${message})`;
  Badge.textContent = message;
  Badgee.textContent = message;

 

  console.log("Auth Data:", data);
  return data;
})
.catch(error => {
  console.error("Fetch error:", error);
});


};







    // Toggle notification panel
    const notificationToggle = document.getElementById('notificationToggle');
    const messageToggle = document.getElementById('messageToggle');
    const notificationPanel = document.getElementById('notificationPanel');
    const panelClose = document.getElementById('panelClose');
    const overlay = document.getElementById('overlay');
    const notificationsTab = document.querySelector('.panel-tab[data-tab="notifications"]');
    const messagesTab = document.querySelector('.panel-tab[data-tab="messages"]');
    const notificationsContent = document.getElementById('notificationsContent');
    const messagesContent = document.getElementById('messagesContent');
    const searchInput = document.getElementById('searchInput');
    const contactItems = document.querySelectorAll('.contact-item');
    const emptyState = document.querySelector('.empty-state');
    const starIcons = document.querySelectorAll('.star');

    notificationToggle.addEventListener('click', () => {
      notificationPanel.classList.add('open');
      overlay.classList.add('active');
      notificationsTab.classList.add('active');
      messagesTab.classList.remove('active');
      notificationsContent.style.display = 'block';
      messagesContent.style.display = 'none';
    });

    messageToggle.addEventListener('click', () => {
      notificationPanel.classList.add('open');
      overlay.classList.add('active');
      notificationsTab.classList.remove('active');
      messagesTab.classList.add('active');
      notificationsContent.style.display = 'none';
      messagesContent.style.display = 'block';
    });

    panelClose.addEventListener('click', () => {
      notificationPanel.classList.remove('open');
      overlay.classList.remove('active');
    });

    overlay.addEventListener('click', () => {
      notificationPanel.classList.remove('open');
      overlay.classList.remove('active');
    });

    // Tabs functionality
    notificationsTab.addEventListener('click', () => {
      notificationsTab.classList.add('active');
      messagesTab.classList.remove('active');
      notificationsContent.style.display = 'block';
      messagesContent.style.display = 'none';
    });

    messagesTab.addEventListener('click', () => {
      messagesTab.classList.add('active');
      notificationsTab.classList.remove('active');
      messagesContent.style.display = 'block';
      notificationsContent.style.display = 'none';
    });

    // Search functionality
    searchInput.addEventListener('input', () => {
      const searchValue = searchInput.value.toLowerCase();
      let hasResults = false;

      contactItems.forEach(item => {
        const name = item.querySelector('.name').textContent.toLowerCase();
        const email = item.querySelector('.contact-email').textContent.toLowerCase();
        const phone = item.querySelector('.contact-phone').textContent.toLowerCase();
        const role = item.querySelector('.role').textContent.toLowerCase();

        if (name.includes(searchValue) || email.includes(searchValue) || phone.includes(searchValue) || role.includes(searchValue)) {
          item.style.display = 'grid';
          hasResults = true;
        } else {
          item.style.display = 'none';
        }
      });

      if (hasResults) {
        emptyState.style.display = 'none';
      } else {
        emptyState.style.display = 'block';
      }
    });

    // Star toggle functionality
    starIcons.forEach(star => {
      star.addEventListener('click', () => {
        star.classList.toggle('active');
        
        if (star.classList.contains('active')) {
          star.setAttribute('fill', 'currentColor');
          star.setAttribute('stroke', 'currentColor');
        } else {
          star.setAttribute('fill', 'none');
          star.setAttribute('stroke', 'currentColor');
        }
      });
    });

    function redirectAdmin(){
      location.href = "message-admin.php";
    }

    const paginationItems = document.querySelectorAll('.pagination-item');
    
    paginationItems.forEach(item => {
      item.addEventListener('click', () => {
        if (!item.classList.contains('active') && item.textContent) {
          paginationItems.forEach(i => i.classList.remove('active'));
          item.classList.add('active');
          // Here you would load the appropriate page of contacts
          // This is just a mockup so we're not implementing actual pagination
        }
      });
    });
  </script>
</body>
</html>