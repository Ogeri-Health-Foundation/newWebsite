<?php

$page_title = "Ogeri Health Foundation - Contact";

$page_author = "Bolaji!";

$page_description = "";

$page_rel = '';

$page_name = 'contact.php';

$customs = array(
  "stylesheets" => ["assets/css/about.css"],
  "scripts" => ["admin/assets/js/demo.js"]
);

$addons = array(
  "stylesheets" => ["https://some-external-url.css"],
  "scripts" => ["https://some-external-url.js"]
);

?>

<!doctype html>
<html class="no-js" lang="zxx" dir="ltr">

<head>
  <?php include 'include/head.php'; ?>
  


  <style>
    .inbox-icon-container {
    position: fixed;
    bottom: 250px; /* Reduced from 250px */
    right: 20px; /* Reduced from 30px */
    z-index: 100;
}

.inbox-icon {
    width: 60px;
    height: 60px;
    background-color:  #f59e0b;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: all 0.3s ease;
}

.inbox-icon:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.25);
}

.inbox-icon svg {
    width: 28px;
    height: 28px;
    fill: white;
}

.chat-box {
    position: fixed;
    bottom: 90px;
    right: 20px;
    width: 350px;
    height: 450px;
    background-color: white;
    border-radius: 16px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    display: none;
    flex-direction: column;
    overflow: hidden;
    z-index: 99;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.3s ease;
}

.chat-box.active {
    display: flex;
    opacity: 1;
    transform: translateY(0);
}

.chat-header {
    padding: 16px;
    background-color:  #f9f9f9;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.chat-header h3 {
    font-weight: 500;
    color: #000;
    margin: 0; /* Added to remove default margin */
}

.close-btn {
    cursor: pointer;
    background: none;
    border: none;
    color: #000;
    font-size: 20px;
}

.chat-messages {
    flex-grow: 1;
    padding: 16px;
    overflow-y: auto;
    background-color: #f9f9f9;
}

.message {
    margin-bottom: 16px;
    max-width: 80%;
    padding: 12px 16px;
    border-radius: 18px;
    position: relative;
    word-wrap: break-word;
}

.sender {
    background-color:  #f59e0b;
    color: #fff;
    margin-right: auto;
    border-bottom-right-radius: 4px;
}

.receiver {
    background-color: #e5efff;
    color: #333;
    margin-left: auto;
    border-bottom-left-radius: 4px;
}

.message-time {
    font-size: 11px;
    position: absolute;
    bottom: -18px;
    opacity: 0.7;
}

.sender .message-time {
    right: 8px;
    padding: 1rem 0;
}

.receiver .message-time {
    right: 8px;
    padding: 1rem 0;
}

.chat-input {
    padding: 16px;
    border-top: 1px solid #eaeaea;
    display: flex;
    align-items: center;
}

.message-input {
    flex-grow: 1;
    border: 1px solid #e0e0e0;
    border-radius: 24px;
    padding: 12px 16px;
    font-size: 16px;
    outline: none;
    transition: border 0.3s ease;
}

.message-input:focus {
    border-color:  #f59e0b;
}

.attachment-btn, .send-btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    margin-left: 8px;
    background-color: #f5f5f5;
    border: none;
    transition: background-color 0.3s ease;
}

.attachment-btn:hover, .send-btn:hover {
    background-color: #e0e0e0;
}

.send-btn {
    background-color:  #f59e0b;
}

.send-btn:hover {
    background-color:rgb(201, 131, 9);
}

.send-btn svg {
    fill: white;
}

.attachment-options {
    display: none;
    position: absolute;
    bottom: 80px;
    right: 70px;
    background-color: white;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    padding: 8px;
}

.attachment-options.active {
    display: flex;
}

.attachment-option {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    margin: 0 4px;
    background-color: #f5f5f5;
    transition: background-color 0.3s ease;
}

.attachment-option:hover {
    background-color: #e0e0e0;
}

.file-input {
    display: none;
}

.typing-indicator {
    display: flex;
    padding: 8px 0;
    align-items: center;
    margin-left: 8px;
    display: none;
}

.typing-indicator.active {
    display: flex;
}

.typing-indicator span {
    width: 8px;
    height: 8px;
    background-color: #aaa;
    border-radius: 50%;
    margin: 0 2px;
    animation: typing 1s infinite;
    opacity: 0.6;
}

.typing-indicator span:nth-child(2) {
    animation-delay: 0.2s;
}

.typing-indicator span:nth-child(3) {
    animation-delay: 0.4s;
}

.contact-thumb1-1 {
    background: white;
    padding: 60px 30px;
    border-radius: 12px;
    text-align: center;
    position: relative;
  }

  .contact-thumb1-1::before {
    content: '';
    display: block;
    width: 80px;
    height: 6px;
    background-color: var(--theme-color2);
    margin: 0 auto 20px auto;
    border-radius: 3px;
  }

  .contact-thumb1-1 h2 {
    background: linear-gradient(90deg, var(--theme-dark), var(--theme-color));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    font-size: 2.8rem;
    font-weight: 800;
    line-height: 1.2;
    max-width: 600px;
    margin: 0 auto;
  }

  @media (max-width: 576px) {
    .contact-thumb1-1 h2 {
      font-size: 2rem;
    }
  }

@keyframes typing {
    0% { transform: translateY(0); }
    50% { transform: translateY(-5px); }
    100% { transform: translateY(0); }
}

/* Mobile Responsive Styles */
@media (max-width: 480px) {
    .chat-box {
        width: 100%;
        height: 100%;
        bottom: 0;
        right: 0;
        border-radius: 0;
        max-height: 100vh;
    }
    
    .message {
        max-width: 85%;
    }
    
    .inbox-icon-container {
        bottom: 250px;
        right: 20px;
    }
    
    .attachment-options {
        right: 16px;
        bottom: 70px;
    }
}

/* Tablet Responsive Styles */
@media (min-width: 481px) and (max-width: 768px) {
    .chat-box {
        width: 90%;
        right: 5%;
        max-width: 400px;
        height: 70vh;
    }
    
    .inbox-icon-container {
        bottom: 250px;
        right: 20px;
    }
}

/* Ensure proper padding for the input area on smaller screens */
@media (max-width: 320px) {
    .chat-input {
        padding: 12px 8px;
    }
    
    .message-input {
        padding: 10px 12px;
        font-size: 14px;
    }
    
    .attachment-btn, .send-btn {
        width: 36px;
        height: 36px;
        margin-left: 4px;
    }
}

/* Fix for landscape orientation on mobiles */
@media (max-height: 500px) and (orientation: landscape) {
    .chat-box {
        height: 85vh;
        bottom: 10px;
    }
    
    .chat-messages {
        padding: 10px;
    }
    
    .chat-header {
        padding: 10px 16px;
    }
    
    .inbox-icon-container {
        bottom: 250px;
    }
}

/* Fix for devices with notches (safe area) */
@supports (padding: max(0px)) {
    .chat-box {
        padding-bottom: env(safe-area-inset-bottom);
        padding-left: env(safe-area-inset-left);
        padding-right: env(safe-area-inset-right);
    }
    
    .inbox-icon-container {
        bottom: 250px;
        right: calc(20px + env(safe-area-inset-right));
    }
}
  </style>


</head>


<body>
  
  <!--[if lte IE 9]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

  <!--********************************
   		Code Start From Here 
	******************************** -->

  <!--==============================
    Header
============================== -->

  <?php include 'include/header.php'; ?>

  <!--==============================
    Breadcumb
============================== -->
  <div
    class="breadcumb-wrapper"
    data-bg-src="assets/img/contact.jpg"
    data-overlay="theme">
    <div class="container">
      <div class="breadcumb-content">
        <h1 class="breadcumb-title">Contact us</h1>
        <ul class="breadcumb-menu">
          <li><a href="index.php">Home</a></li>
          <li>Contact us</li>
        </ul>
      </div>
    </div>
  </div>
  <!--==============================
Contact Area   
==============================-->
  <div
    class="space overflow-hidden contact-area-1 position-relative z-index-common">
    <div class="container">
      <div class="contact-wrap1">
        <div class="row gx-60 gy-40">
          <div class="col-xl-4 col-lg-5">
            <div class="contact-feature">
              <div class="box-icon">
                <i class="fas fa-map-location-dot"></i>
              </div>
              <div class="media-body">
                <h3 class="box-title">Address</h3>
                <p class="box-text">
                  Afikpo North, Ebonyi State
                </p>
              </div>
            </div>
            <!-- <div class="contact-feature">
              <div class="box-icon" data-theme-color="#FFAC00">
                <i class="fas fa-phone-volume"></i>
              </div>
              <div class="media-body">
                <h3 class="box-title">Phone</h3>
                <p class="box-text">
                  <a href="tel:+447710619941">+44 7710 619941</a>
                </p>
                <p class="box-text">
                  <a href="tel:+447710619941">+44 7710 619941</a>
                </p>
              </div>
            </div> -->
            <div class="contact-feature">
              <div class="box-icon" data-theme-color="#122F2A">
                <i class="fas fa-envelope"></i>
              </div>
              <div class="media-body">
                <h3 class="box-title">Email</h3>
                <p class="box-text">
                  <a href="mailto:info@ogerihealth.org">info@ogerihealth.org</a>
                </p>
                
              </div>
            </div>
            <div class="contact-feature" data-theme-color="#FF5528">
              <div class="box-icon">
                <i class="fas fa-comment-question"></i>
              </div>
              <div class="media-body">
                <h3 class="box-title">Have Questions?</h3>
                <p class="box-text">
                  Discover more by visiting us or joining our community
                </p>
              </div>
            </div>
          </div>
          <div class="col-xl-8 col-lg-7">
            <div class="contact-map">
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3644.7310056272386!2d89.2286059153658!3d24.00527418490799!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39fe9b97badc6151%3A0x30b048c9fb2129bc!2sAngfuztheme!5e0!3m2!1sen!2sbd!4v1651028958211!5m2!1sen!2sbd"
                allowfullscreen=""
                loading="lazy"></iframe>
            </div>
          </div>
        </div>
      </div>
      <div class="contact-page-form-wrap space-top">
        <div class="row gy-40">
            <div class="col-xl-6 ">
                <div class="contact-thumb1-1">
                    <h2>
                        Get In Touch<br />
                        With Us
                    </h2>
                    
                </div>
            </div>
          <div class="col-xl-6 ">
            <!--==============================
Contact Area  
==============================-->
            <div class="contact-form-v1 contact-page-form">
              <form
                action=""
                method="POST"
                class="contact-form style-border ajax-contact">
                <div class="row">
                  <div class="form-group style-border col-12">
                    <input
                      type="text"
                      class="form-control" 
                      name="name"
                      id="name"
                      placeholder="Your Name" />
                  </div>
                  <div class="form-group style-border col-12">
                    <input
                      type="email"
                      class="form-control"
                      name="email"
                      id="email"
                      placeholder="Email Address" />
                  </div>
                  <div class="form-group style-border col-12">
                    <input
                      type="number"
                      class="form-control"
                      name="number"
                      id="number"
                      placeholder="Phone Number" />
                  </div>

                  <div class="form-group style-border col-12">
                    <input
                      type="text"
                      class="form-control"
                      name="subject"
                      id="company"
                      placeholder="Subject" />
                  </div>
                  <div class="form-group style-border col-12">
                    <textarea
                      name="message"
                      id="message"
                      cols="30"
                      rows="3"
                      class="form-control"
                      placeholder="Type Your Message"></textarea>
                  </div>
                  <div class="form-btn col-12">
                    <button class="th-btn" id="submitBtn" type="submit">
                        <span class="btn-text">Send a Message</span>
                        <span class="btn-loader" style="display: none; margin-left: 8px; ">
                        <img src="assets/loader/Animation-1750057122629.gif" alt="Loading" width="30px" />
                        </span>
                    </button>
                </div>
                </div>
                <!-- <p class="form-messages mb-0 mt-3"></p> -->
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="inbox-icon-container">
        <div class="inbox-icon" id="inboxIcon">
        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M8 12H8.01M12 12H12.01M16 12H16.01M21.0039 12C21.0039 16.9706 16.9745 21 12.0039 21C9.9675 21 3.00463 21 3.00463 21C3.00463 21 4.56382 17.2561 3.93982 16.0008C3.34076 14.7956 3.00391 13.4372 3.00391 12C3.00391 7.02944 7.03334 3 12.0039 3C16.9745 3 21.0039 7.02944 21.0039 12Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
        </div>
    </div>
    
    <div class="chat-box" id="chatBox">
        <div class="chat-header">
            <h3>Messages</h3>
            <button class="close-btn" id="closeBtn">×</button>
        </div>
        <div class="chat-messages" id="chatMessages">
            <!-- Messages will be inserted here -->
        </div>
        <div class="typing-indicator" id="typingIndicator">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="chat-input">
            <input type="text" class="message-input" id="messageInput" placeholder="Type a message...">
            <button class="attachment-btn" id="attachmentBtn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="#555">
                    <path d="M16.5 6v11.5c0 2.21-1.79 4-4 4s-4-1.79-4-4V5c0-1.38 1.12-2.5 2.5-2.5s2.5 1.12 2.5 2.5v10.5c0 0.55-0.45 1-1 1s-1-0.45-1-1V6H10v9.5c0 1.38 1.12 2.5 2.5 2.5s2.5-1.12 2.5-2.5V5c0-2.21-1.79-4-4-4S7 2.79 7 5v12.5c0 3.04 2.46 5.5 5.5 5.5s5.5-2.46 5.5-5.5V6h-1.5z"/>
                </svg>
            </button>
            <button class="send-btn" id="sendBtn">
                <svg width="20" height="20" viewBox="0 0 24 24">
                    <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                </svg>
            </button>
        </div>
        <div class="attachment-options" id="attachmentOptions">
            <div class="attachment-option" id="cameraOption">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="#555">
                    <path d="M12 15.2c-1.74 0-3.15-1.42-3.15-3.15 0-1.74 1.41-3.15 3.15-3.15s3.15 1.41 3.15 3.15c0 1.73-1.41 3.15-3.15 3.15zm0-8.3c-2.86 0-5.15 2.29-5.15 5.15s2.29 5.15 5.15 5.15 5.15-2.29 5.15-5.15-2.29-5.15-5.15-5.15zm8-1.74v12.16c0 1.52-1.23 2.77-2.75 2.77h-10.5c-1.52 0-2.75-1.25-2.75-2.77V5.16c0-1.52 1.23-2.77 2.75-2.77h2.69l1.52-1.42h2.12l1.52 1.42h2.65c1.52 0 2.75 1.25 2.75 2.77z"/>
                </svg>
            </div>
            <div class="attachment-option" id="galleryOption">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="#555">
                    <path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/>
                </svg>
            </div>
            <input type="file" id="fileInput" class="file-input" accept="image/*">
        </div>
    </div>
    <div id="alert-container" style="
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        display: none;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        font-weight: bold;
        color: white;
        background-color: #28a745;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        "></div>
       <script>
            document.addEventListener("DOMContentLoaded", function () {
                const form = document.querySelector(".contact-form");
                const submitBtn = document.getElementById("submitBtn");
                const btnText = submitBtn.querySelector(".btn-text");
                const btnLoader = submitBtn.querySelector(".btn-loader");
                const alertBox = document.getElementById("alert-container");

                function showAlert(message, type = "success") {
                alertBox.textContent = message;
                alertBox.style.backgroundColor = type === "success" ? "#28a745" : "#dc3545";
                alertBox.style.display = "block";

                setTimeout(() => {
                    alertBox.style.display = "none";
                }, 4000);
                }

                form.addEventListener("submit", async function (e) {
                e.preventDefault();

                // Disable button and show loader
                submitBtn.disabled = true;
                btnText.textContent = "Sending";
                btnLoader.style.display = "inline-block";

                try {
                    const response = await fetch("mail.php", {
                    method: "POST",
                    body: new FormData(form),
                    });

                    const result = await response.json();

                    showAlert(result.message, result.status);

                    if (result.status === "success") {
                    form.reset();
                    }
                } catch (err) {
                    showAlert("Unexpected error occurred", "error");
                } finally {
                    // Re-enable button and reset UI
                    submitBtn.disabled = false;
                    btnText.textContent = "Send a Message";
                    btnLoader.style.display = "none";
                }
                });
            });
        </script>
<script>
const inboxIcon = document.getElementById('inboxIcon');
const chatBox = document.getElementById('chatBox');
const closeBtn = document.getElementById('closeBtn');
const messageInput = document.getElementById('messageInput');
const sendBtn = document.getElementById('sendBtn');
const chatMessages = document.getElementById('chatMessages');
const attachmentBtn = document.getElementById('attachmentBtn');
const attachmentOptions = document.getElementById('attachmentOptions');
const cameraOption = document.getElementById('cameraOption');
const galleryOption = document.getElementById('galleryOption');
const fileInput = document.getElementById('fileInput');
const typingIndicator = document.getElementById('typingIndicator');

// WebSocket connection
let socket;
let userId = localStorage.getItem('chatUserId') || 'user_' + Math.floor(Math.random() * 1000);
// Store the last time user was online
let lastOnline = localStorage.getItem('lastOnlineTime') || new Date().toISOString();
let unreadMessageCount = 0;

// Track displayed messages to prevent duplicates
const displayedMessages = new Set();

// Store userId in localStorage
localStorage.setItem('chatUserId', userId);

// Message history array
let messageHistory = [];

// Add event listeners for online/offline status
window.addEventListener('online', handleOnline);
window.addEventListener('offline', handleOffline);
window.addEventListener('beforeunload', updateLastOnlineTime);
window.addEventListener('visibilitychange', handleVisibilityChange);

// Handle when page becomes visible again
function handleVisibilityChange() {
    if (document.visibilityState === 'visible') {
        console.log('Page became visible, reconnecting if needed');
        if (!socket || socket.readyState !== WebSocket.OPEN) {
            connectWebSocket();
        } else {
            // Even if socket is open, request missed messages
            requestMissedMessages();
        }
    } else {
        // Page is hidden, update last online time
        updateLastOnlineTime();
    }
}

// Handle reconnecting when user comes back online
function handleOnline() {
    console.log('Browser is online, reconnecting...');
    if (!socket || socket.readyState !== WebSocket.OPEN) {
        connectWebSocket();
    } else {
        // Even if socket is open, request missed messages
        requestMissedMessages();
    }
}

// Handle user going offline
function handleOffline() {
    console.log('Browser went offline');
    updateLastOnlineTime();
}

// Update the last online timestamp
function updateLastOnlineTime() {
    lastOnline = new Date().toISOString();
    localStorage.setItem('lastOnlineTime', lastOnline);
    console.log('Updated last online time:', lastOnline);
}

// Request any messages missed while offline
function requestMissedMessages() {
    if (socket && socket.readyState === WebSocket.OPEN) {
        console.log('Requesting missed messages since:', lastOnline);
        socket.send(JSON.stringify({
            type: 'fetchMissedMessages',
            userId: userId,
            since: lastOnline
        }));
        
        // Update last online time after successfully requesting missed messages
        updateLastOnlineTime();
    }
}

// Function to update the unread message badge
function updateUnreadBadge() {
    // Check if badge already exists
    let badge = document.getElementById('unreadBadge');
    
    // If no unread messages, remove the badge if it exists
    if (unreadMessageCount <= 0) {
        if (badge) {
            badge.remove();
        }
        return;
    }
    
    // Create badge if it doesn't exist
    if (!badge) {
        badge = document.createElement('div');
        badge.id = 'unreadBadge';
        badge.style.position = 'absolute';
        badge.style.top = '-8px';
        badge.style.right = '-8px';
        badge.style.backgroundColor = '#ff4040';
        badge.style.color = 'white';
        badge.style.borderRadius = '50%';
        badge.style.width = '20px';
        badge.style.height = '20px';
        badge.style.display = 'flex';
        badge.style.justifyContent = 'center';
        badge.style.alignItems = 'center';
        badge.style.fontSize = '12px';
        badge.style.fontWeight = 'bold';
        
        // Make sure inboxIcon has position relative for proper badge positioning
        inboxIcon.style.position = 'relative';
        inboxIcon.appendChild(badge);
    }
    
    // Update count
    badge.textContent = unreadMessageCount > 99 ? '99+' : unreadMessageCount;
}

// Load message history from localStorage
function loadMessageHistory() {
    const storedMessages = localStorage.getItem('chatMessages');
    if (storedMessages) {
        messageHistory = JSON.parse(storedMessages);
        
        // Display stored messages
        messageHistory.forEach(msg => {
            if (msg.type === 'message') {
                displayMessage(msg.content, msg.messageType, msg.timestamp);
            } else if (msg.type === 'image') {
                displayImageMessage(msg.content, msg.messageType, msg.timestamp);
            }
        });
    }
}

function saveMessageHistory() {
    localStorage.setItem('chatMessages', JSON.stringify(messageHistory));
}

// Generate a unique message identifier
function generateMessageId(type, content, timestamp) {
    return `${type}_${content.substring(0, 20)}_${timestamp}`;
}

// Connect to WebSocket server
function connectWebSocket() {
    socket = new WebSocket('wss://messagesocket-production.up.railway.app');
    // socket = new WebSocket('ws://localhost:3000');

    
    socket.onopen = function() {
        console.log('Connected to WebSocket server');
        
        // Send user identification
        socket.send(JSON.stringify({
            type: 'identity',
            userId: userId
        }));
        
        // Request any missed messages since last online time
        requestMissedMessages();
    };
    
    socket.onmessage = function(event) {
        const data = JSON.parse(event.data);
        
        // Update lastMessageTime when receiving any message
        if (data.type === 'message' || data.type === 'image') {
            const timestamp = data.timestamp || new Date().toISOString();
            localStorage.setItem('lastMessageTime', timestamp);
        }
        
        // Handle missed messages
        if (data.type === 'missedMessages' && Array.isArray(data.messages)) {
            data.messages.forEach(msg => {
                // Generate a unique message ID
                const messageId = generateMessageId(msg.type, msg.content, msg.timestamp);
                
                // Check if we've already displayed this message
                if (!displayedMessages.has(messageId)) {
                    displayedMessages.add(messageId);
                    
                    if (msg.type === 'message') {
                        displayMessage(msg.content, 'receiver', msg.timestamp);
                        messageHistory.push({
                            type: 'message',
                            content: msg.content,
                            messageType: 'receiver',
                            timestamp: msg.timestamp
                        });
                    } else if (msg.type === 'image') {
                        displayImageMessage(msg.content, 'receiver', msg.timestamp);
                        messageHistory.push({
                            type: 'image',
                            content: msg.content,
                            messageType: 'receiver',
                            timestamp: msg.timestamp
                        });
                    }
                    
                    // Increment unread count for each missed message
                    if (!chatBox.classList.contains('active')) {
                        unreadMessageCount++;
                    }
                } else {
                    console.log('Skipping duplicate missed message:', messageId);
                }
            });
            
            // Save updated message history
            saveMessageHistory();
            
            // Update unread badge
            updateUnreadBadge();
            
            // Save unread count to localStorage
            localStorage.setItem('unreadMessageCount', unreadMessageCount);
        }
        
        if (data.type === 'message') {
            // Generate a unique message ID
            const messageId = generateMessageId('message', data.content, data.timestamp);
            
            // Check if we've already displayed this message
            if (!displayedMessages.has(messageId)) {
                displayedMessages.add(messageId);
                
                displayMessage(data.content, 'receiver', data.timestamp);
                
                // Save to message history
                messageHistory.push({
                    type: 'message',
                    content: data.content,
                    messageType: 'receiver',
                    timestamp: data.timestamp
                });
                saveMessageHistory();
                
                // If chat is not open, increment unread count
                if (!chatBox.classList.contains('active')) {
                    unreadMessageCount++;
                    
                    // Save unread count to localStorage
                    localStorage.setItem('unreadMessageCount', unreadMessageCount);
                    
                    // Update badge
                    updateUnreadBadge();
                }
            } else {
                console.log('Skipping duplicate message:', messageId);
            }
        } else if (data.type === 'typing') {
            if (data.isTyping) {
                typingIndicator.classList.add('active');
            } else {
                typingIndicator.classList.remove('active');
            }
        } else if (data.type === 'image') {
            // Generate a unique message ID
            const messageId = generateMessageId('image', data.content, data.timestamp);
            
            // Check if we've already displayed this message
            if (!displayedMessages.has(messageId)) {
                displayedMessages.add(messageId);
                
                displayImageMessage(data.content, 'receiver', data.timestamp);
                
                // Save to message history
                messageHistory.push({
                    type: 'image',
                    content: data.content,
                    messageType: 'receiver',
                    timestamp: data.timestamp
                });
                saveMessageHistory();
                
                // If chat is not open, increment unread count
                if (!chatBox.classList.contains('active')) {
                    unreadMessageCount++;
                    
                    // Save unread count to localStorage
                    localStorage.setItem('unreadMessageCount', unreadMessageCount);
                    
                    // Update badge
                    updateUnreadBadge();
                }
            } else {
                console.log('Skipping duplicate image:', messageId);
            }
        } else if (data.type === 'messagesRead') {
            // Server confirmed messages are marked as read
            console.log('Messages marked as read');
        } else if (data.type === 'history') {
            // If we receive history from server and there are unread messages,
            // count them and update the badge
            if (data.history && Array.isArray(data.history)) {
                let unreadCount = 0;
                
                data.history.forEach(msg => {
                    // Generate a unique message ID for history items
                    const messageId = generateMessageId(
                        msg.message_type === 'text' ? 'message' : 'image',
                        msg.content,
                        msg.timestamp
                    );
                    
                    // Mark message as displayed to prevent duplicates
                    displayedMessages.add(messageId);
                    
                    if (msg.sender_id === 'admin' && msg.is_read === 0) {
                        unreadCount++;
                    }
                });
                
                if (unreadCount > 0) {
                    unreadMessageCount = unreadCount;
                    localStorage.setItem('unreadMessageCount', unreadMessageCount);
                    updateUnreadBadge();
                }
            }
        }
    };
    
    socket.onclose = function() {
        console.log('Disconnected from WebSocket server');
        // Save last online time before disconnection
        updateLastOnlineTime();
        // Try to reconnect after 5 seconds
        setTimeout(connectWebSocket, 5000);
    };
    
    socket.onerror = function(error) {
        console.error('WebSocket error:', error);
        updateLastOnlineTime();
    };
}

// Initialize WebSocket connection and load message history
document.addEventListener('DOMContentLoaded', function() {
    loadMessageHistory();
    
    // Load unread message count from localStorage
    unreadMessageCount = parseInt(localStorage.getItem('unreadMessageCount') || '0');
    updateUnreadBadge();
    
    connectWebSocket();
});

// Toggle chat box visibility
inboxIcon.addEventListener('click', () => {
    chatBox.classList.toggle('active');
    
    if (chatBox.classList.contains('active')) {
        messageInput.focus();
        
        // Clear unread count when chat is opened
        unreadMessageCount = 0;
        localStorage.setItem('unreadMessageCount', '0');
        updateUnreadBadge();
        
        // Mark messages as read on the server
        if (socket && socket.readyState === WebSocket.OPEN) {
            socket.send(JSON.stringify({
                type: 'markAsRead',
                userId: userId
            }));
        }
    }
});

// Close chat box
closeBtn.addEventListener('click', () => {
    chatBox.classList.remove('active');
    updateLastOnlineTime(); // Update last online time when closing chat
});

// Send message when button is clicked
sendBtn.addEventListener('click', sendMessage);

// Send message when Enter key is pressed
messageInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') {
        sendMessage();
    }
});

// Typing indicator
let typingTimeout;
messageInput.addEventListener('input', () => {
    // Notify server that user is typing
    if (socket && socket.readyState === WebSocket.OPEN) {
        socket.send(JSON.stringify({
            type: 'typing',
            isTyping: true,
            userId: userId
        }));
    }
    
    // Clear existing timeout
    clearTimeout(typingTimeout);
    
    // Set new timeout to stop typing indicator after 2 seconds of inactivity
    typingTimeout = setTimeout(() => {
        if (socket && socket.readyState === WebSocket.OPEN) {
            socket.send(JSON.stringify({
                type: 'typing',
                isTyping: false,
                userId: userId
            }));
        }
    }, 2000);
});

// Toggle attachment options
attachmentBtn.addEventListener('click', () => {
    attachmentOptions.classList.toggle('active');
});

// Handle camera option
cameraOption.addEventListener('click', () => {
    // Check if browser supports getUserMedia
    if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => {
                // Create temporary video and canvas elements
                const video = document.createElement('video');
                const canvas = document.createElement('canvas');
                video.srcObject = stream;
                video.play();
                
                // After 3 seconds, take a snapshot
                setTimeout(() => {
                    canvas.width = video.videoWidth;
                    canvas.height = video.videoHeight;
                    canvas.getContext('2d').drawImage(video, 0, 0);
                    
                    // Convert canvas to data URL
                    const imageData = canvas.toDataURL('image/jpeg');
                    
                    // Stop the video stream
                    stream.getTracks().forEach(track => track.stop());
                    
                    // Send the image
                    sendImage(imageData);
                    
                    // Hide attachment options
                    attachmentOptions.classList.remove('active');
                }, 3000);
            })
            .catch(error => {
                console.error('Error accessing camera:', error);
                alert('Unable to access camera. Please check your permissions.');
            });
    } else {
        alert('Your browser does not support camera access.');
    }
});

// Handle gallery option
galleryOption.addEventListener('click', () => {
    fileInput.click();
});

// Handle file selection
fileInput.addEventListener('change', () => {
    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            const imageData = e.target.result;
            sendImage(imageData);
        };
        
        reader.readAsDataURL(fileInput.files[0]);
        
        // Reset file input
        fileInput.value = '';
        
        // Hide attachment options
        attachmentOptions.classList.remove('active');
    }
});

// Send message function
function sendMessage() {
    const message = messageInput.value.trim();
    
    if (message !== '') {
        // Get current timestamp
        const timestamp = new Date().toISOString();
        
        // Generate a message ID and add to displayed messages set
        const messageId = generateMessageId('message', message, timestamp);
        displayedMessages.add(messageId);
        
        // Display message locally
        displayMessage(message, 'sender', timestamp);
        
        // Save to message history
        messageHistory.push({
            type: 'message',
            content: message,
            messageType: 'sender',
            timestamp: timestamp
        });
        saveMessageHistory();
        
        // Send message to server
        if (socket && socket.readyState === WebSocket.OPEN) {
            socket.send(JSON.stringify({
                type: 'message',
                content: message,
                userId: userId,
                timestamp: timestamp
            }));
        }
        
        // Clear input
        messageInput.value = '';
        
        // Focus on input
        messageInput.focus();
        
        // Update last online time
        updateLastOnlineTime();
    }
}

// Send image function
function sendImage(imageData) {
    // Get current timestamp
    const timestamp = new Date().toISOString();
    
    // Generate a message ID and add to displayed messages set
    const messageId = generateMessageId('image', imageData, timestamp);
    displayedMessages.add(messageId);
    
    // Display image locally
    displayImageMessage(imageData, 'sender', timestamp);
    
    // Save to message history
    messageHistory.push({
        type: 'image',
        content: imageData,
        messageType: 'sender',
        timestamp: timestamp
    });
    saveMessageHistory();
    
    // Send image to server
    if (socket && socket.readyState === WebSocket.OPEN) {
        socket.send(JSON.stringify({
            type: 'image',
            content: imageData,
            userId: userId,
            timestamp: timestamp
        }));
    }
    
    // Update last online time
    updateLastOnlineTime();
}

// Display message function
function displayMessage(message, messageType, timestamp) {
    const messageElement = document.createElement('div');
    messageElement.classList.add('message', messageType);
    messageElement.textContent = message;
    
    // Add timestamp
    const timeElement = document.createElement('span');
    timeElement.classList.add('message-time');
    
    // Format timestamp
    const messageTime = new Date(timestamp);
    timeElement.textContent = messageTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    
    messageElement.appendChild(timeElement);
    chatMessages.appendChild(messageElement);
    
    // Scroll to bottom
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

// Display image message function
function displayImageMessage(imageData, messageType, timestamp) {
    const messageElement = document.createElement('div');
    messageElement.classList.add('message', messageType);
    
    // Create image element
    const imageElement = document.createElement('img');
    imageElement.src = imageData;
    imageElement.style.maxWidth = '100%';
    imageElement.style.borderRadius = '8px';
    
    messageElement.appendChild(imageElement);
    
    // Add timestamp
    const timeElement = document.createElement('span');
    timeElement.classList.add('message-time');
    
    // Format timestamp
    const messageTime = new Date(timestamp);
    timeElement.textContent = messageTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    
    messageElement.appendChild(timeElement);
    chatMessages.appendChild(messageElement);
    
    // Scroll to bottom
    chatMessages.scrollTop = chatMessages.scrollHeight;
}

// Add function to clear chat history
function clearChatHistory() {
    messageHistory = [];
    displayedMessages.clear(); // Clear the displayed messages set too
    localStorage.removeItem('chatMessages');
    localStorage.removeItem('unreadMessageCount');
    unreadMessageCount = 0;
    updateUnreadBadge();
    chatMessages.innerHTML = '';
}
    </script>

  <!--==============================
	Footer Area
==============================-->
  <?php include 'include/footer.php'; ?>
  <!--********************************
			Code End  Here 
	******************************** -->

  <!-- Scroll To Top -->
  <div class="scroll-top">
    <svg
      class="progress-circle svg-content"
      width="100%"
      height="100%"
      viewBox="-1 -1 102 102">
      <path
        d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98"
        style="
            transition: stroke-dashoffset 10ms linear 0s;
            stroke-dasharray: 307.919, 307.919;
            stroke-dashoffset: 307.919;
          "></path>
    </svg>
  </div>

  <!--==============================
    All Js File
============================== -->
  <!-- Jquery -->
  <script src="assets/js/vendor/jquery-3.7.1.min.js"></script>
  <!-- Swiper Js -->
  <script src="assets/js/swiper-bundle.min.js"></script>
  <!-- Bootstrap -->
  <script src="assets/js/bootstrap.min.js"></script>
  <!-- Magnific Popup -->
  <script src="assets/js/jquery.magnific-popup.min.js"></script>
  <!-- Counter Up -->
  <script src="assets/js/jquery.counterup.min.js"></script>
  <!-- Range Slider -->
  <script src="assets/js/jquery-ui.min.js"></script>
  <!-- Isotope Filter -->
  <script src="assets/js/imagesloaded.pkgd.min.js"></script>
  <script src="assets/js/isotope.pkgd.min.js"></script>

  <!-- Main Js File -->
  <script src="assets/js/main.js"></script>
</body>

</html>