<!DOCTYPE html>
<html lang="en">
<head>
<script>


  

// window.onload = function () {

//   fetch("https://ogerihealth.org/api/v1/auth.php")
//   .then(async response => {
//     const data = await response.json(); 

//     if (!response.ok) {
//       if (data.message === "Unauthorized") {
//         location.href = "../admin/login.php";
//       }
//       throw new Error(data.message || "Network response was not ok");
//     }

//     console.log("Auth Data:", data);
//     return data;
//   })
//   .catch(error => {
//     console.error("Fetch error:", error);
//   });


// };

      

    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Chat Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7fb;
            overflow: hidden;
        }
        
        .container {
            display: flex;
            height: 100vh;
            position: relative;
        }
        
        .sidebar {
            width: 300px;
            position: fixed;
            height: 100vh;
            top: 0;
            left: 0;
            background-color: #fff;
            border-right: 1px solid #e0e0e0;
            display: flex;
            flex-direction: column;
            z-index: 10;
        }
        
        .header {
            padding: 20px;
            background-color: #4a6eff;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .header h2 {
            font-size: 18px;
            font-weight: 600;
        }
        
        .search-box {
            padding: 15px;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .search-input {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #e0e0e0;
            border-radius: 20px;
            font-size: 14px;
            outline: none;
        }
        
        .search-input:focus {
            border-color: #4a6eff;
        }
        
        .chat-list {
            flex-grow: 1;
            overflow-y: auto;
        }
        
        .chat-item {
            padding: 15px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid #f0f0f0;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        
        .chat-item:hover {
            background-color: #f5f7fb;
        }
        
        .chat-item.active {
            background-color: #e5efff;
        }
        
        .avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background-color: #4a6eff;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 600;
            margin-right: 15px;
        }
        
        .chat-info {
            flex-grow: 1;
        }
        
        .chat-name {
            font-weight: 600;
            margin-bottom: 5px;
            display: flex;
            justify-content: space-between;
        }
        
        .chat-time {
            font-size: 12px;
            color: #999;
        }
        
        .chat-preview {
            font-size: 13px;
            color: #777;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 180px;
        }
        
        .chat-badge {
            background-color: #4a6eff;
            color: white;
            font-size: 12px;
            padding: 3px 8px;
            border-radius: 10px;
            margin-left: 10px;
        }
        
        .main-content {
            margin-left: 300px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            height: 100vh;
            width: calc(100% - 300px);
        }
        
        .chat-header {
            padding: 15px 20px;
            background-color: #fff;
            border-bottom: 1px solid #e0e0e0;
            display: flex;
            align-items: center;
        }
        
        .chat-header .avatar {
            margin-right: 15px;
        }
        
        .user-name {
            font-weight: 600;
            font-size: 16px;
        }
        
        .user-status {
            font-size: 13px;
            color: #999;
        }
        
        .chat-messages {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
            background-color: #f5f7fb;
            height: calc(100vh - 135px);
        }
        
        .message {
            margin-bottom: 20px;
            max-width: 80%;
            padding: 12px 16px;
            border-radius: 18px;
            position: relative;
            word-wrap: break-word;
        }
        
        .message.outgoing {
            background-color: #4a6eff;
            color: white;
            margin-left: auto;
            border-bottom-right-radius: 4px;
        }
        
        .message.incoming {
            background-color: #fff;
            border-bottom-left-radius: 4px;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }
        
        .message-time {
            font-size: 11px;
            position: absolute;
            bottom: -18px;
            opacity: 0.7;
        }
        
        .message.outgoing .message-time {
            right: 8px;
            color: #666;
        }
        
        .message.incoming .message-time {
            left: 8px;
            color: #666;
        }
        
        .image-message img {
            max-width: 250px;
            border-radius: 8px;
        }
        
        .typing-indicator {
            display: flex;
            padding: 8px 15px;
            align-items: center;
            margin-bottom: 20px;
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
        
        @keyframes typing {
            0% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
            100% { transform: translateY(0); }
        }
        
        .chat-input {
            padding: 15px 20px;
            background-color: #fff;
            border-top: 1px solid #e0e0e0;
            display: flex;
            align-items: center;
            position: sticky;
            bottom: 0;
        }
        
        .message-input {
            flex-grow: 1;
            border: 1px solid #e0e0e0;
            border-radius: 24px;
            padding: 12px 16px;
            font-size: 14px;
            outline: none;
            transition: border 0.3s ease;
        }
        
        .message-input:focus {
            border-color: #4a6eff;
        }
        
        .send-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            margin-left: 10px;
            background-color: #4a6eff;
            border: none;
            transition: background-color 0.3s ease;
        }
        
        .send-btn:hover {
            background-color: #3a5bef;
        }
        
        .send-btn svg {
            fill: white;
        }
        
        .no-chat-selected {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #999;
            padding: 20px;
            height: 100%;
        }
        
        .no-chat-selected svg {
            width: 100px;
            height: 100px;
            fill: #ccc;
            margin-bottom: 20px;
        }
        
        .no-chat-selected h3 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 10px;
        }
        
        .no-chat-selected p {
            font-size: 14px;
            text-align: center;
            max-width: 300px;
        }
        
        .notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #4a6eff;
            color: white;
            padding: 15px 20px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
            transform: translateY(100px);
            opacity: 0;
            transition: all 0.3s ease;
            z-index: 100;
        }
        
        .notification.active {
            transform: translateY(0);
            opacity: 1;
        }
        
        .notification-icon {
            margin-right: 10px;
        }
        
        .user-list-empty {
            padding: 20px;
            text-align: center;
            color: #999;
            font-size: 14px;
        }
        
        .user-list-empty svg {
            width: 60px;
            height: 60px;
            fill: #ccc;
            margin-bottom: 10px;
        }
        
        .chat-container {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        /* Media Queries for Responsive Design */

        /* Large screens (standard desktop view) */
        @media screen and (min-width: 1200px) {
            .container {
                max-width: 1400px;
                margin: 0 auto;
            }
        }

        /* Medium-sized screens (small desktops and laptops) */
        @media screen and (max-width: 1199px) {
            .sidebar {
                width: 280px;
            }
            
            .main-content {
                margin-left: 280px;
                width: calc(100% - 280px);
            }
            
            .message {
                max-width: 85%;
            }
        }

        /* Tablets and small laptops */
        @media screen and (max-width: 992px) {
            .sidebar {
                width: 250px;
            }
            
            .main-content {
                margin-left: 250px;
                width: calc(100% - 250px);
            }
            
            .avatar {
                width: 40px;
                height: 40px;
            }
            
            .chat-preview {
                max-width: 150px;
            }
            
            .message {
                max-width: 90%;
                padding: 10px 14px;
            }
            
            .message-input {
                padding: 10px 14px;
            }
        }

        /* Tablets portrait and large phones */
        @media screen and (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: 40vh;
                position: relative;
                border-right: none;
                border-bottom: 1px solid #e0e0e0;
            }
            
            .main-content {
                margin-left: 0;
                width: 100%;
                height: 60vh;
            }
            
            .container {
                flex-direction: column;
            }
            
            .chat-messages {
                height: calc(60vh - 135px);
            }
            
            .chat-preview {
                max-width: calc(100% - 100px);
            }
        }

        /* Mobile phones */
        @media screen and (max-width: 576px) {
            .header {
                padding: 15px;
            }
            
            .header h2 {
                font-size: 16px;
            }
            
            .search-box {
                padding: 10px;
            }
            
            .chat-item {
                padding: 10px;
            }
            
            .avatar {
                width: 35px;
                height: 35px;
                margin-right: 10px;
            }
            
            .chat-header {
                padding: 10px 15px;
            }
            
            .chat-messages {
                padding: 15px;
            }
            
            .message {
                padding: 8px 12px;
                margin-bottom: 15px;
                max-width: 95%;
            }
            
            .message-time {
                font-size: 10px;
                bottom: -16px;
            }
            
            .chat-input {
                padding: 10px 15px;
            }
            
            .message-input {
                padding: 8px 12px;
            }
            
            .send-btn {
                width: 36px;
                height: 36px;
            }
            
            .image-message img {
                max-width: 200px;
            }
            
            .notification {
                padding: 10px 15px;
                max-width: 90%;
            }
        }

        /* Very small mobile devices */
        @media screen and (max-width: 375px) {
            .chat-name {
                font-size: 14px;
            }
            
            .chat-preview {
                font-size: 12px;
                max-width: calc(100% - 80px);
            }
            
            .chat-time {
                font-size: 11px;
            }
            
            .image-message img {
                max-width: 180px;
            }
            
            .user-name {
                font-size: 14px;
            }
            
            .user-status {
                font-size: 12px;
            }
        }

        /* Handle height-constrained devices (like phones in landscape) */
        @media screen and (max-height: 500px) and (min-width: 769px) {
            .sidebar {
                width: 220px;
                position: fixed;
                height: 100vh;
                border-right: 1px solid #e0e0e0;
                border-bottom: none;
            }
            
            .main-content {
                margin-left: 220px;
                width: calc(100% - 220px);
                height: 100vh;
            }
            
            .container {
                flex-direction: row;
            }
            
            .chat-item {
                padding: 8px;
            }
            
            .chat-messages {
                height: calc(100vh - 130px);
            }
            
            .avatar {
                width: 32px;
                height: 32px;
            }
            
            .chat-header {
                padding: 8px 15px;
            }
        }

        /* Special case: Safari iOS fix for 100vh issue */
        @supports (-webkit-touch-callout: none) {
            .container, .sidebar, .main-content {
                height: -webkit-fill-available;
            }
            
            .chat-messages {
                max-height: calc(100vh - 130px - env(safe-area-inset-bottom));
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="header">
                <h2>Admin Chat</h2>
                <div class="connection-status" id="connectionStatus">Offline</div>
            </div>
            <div class="search-box">
                <input type="text" class="search-input" placeholder="Search users..." id="searchInput">
            </div>
            <div class="chat-list" id="chatList">
                <div class="user-list-empty" id="userListEmpty">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm0-14c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm0 6c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4zm0 2c2.21 0 5.2 1.01 6 2H6c.8-.99 3.79-2 6-2z"/>
                    </svg>
                    <p>No users connected yet</p>
                </div>
                <!-- Chat items will be dynamically inserted here -->
            </div>
        </div>
        <div class="main-content" id="mainContent">
            <div class="no-chat-selected" id="noChatSelected">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"/>
                </svg>
                <h3>No chat selected</h3>
                <p>Select a user from the list to start chatting</p>
            </div>
            <div class="chat-container" id="chatContainer" style="display: none;">
                <div class="chat-header" id="chatHeader">
                    <!-- User info will be dynamically inserted here -->
                </div>
                <div class="chat-messages" id="chatMessages">
                    <!-- Messages will be dynamically inserted here -->
                </div>
                <div class="typing-indicator" id="typingIndicator">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="chat-input">
                    <input type="text" class="message-input" id="messageInput" placeholder="Type a message...">
                    <button class="send-btn" id="sendBtn">
                        <svg width="20" height="20" viewBox="0 0 24 24">
                            <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="notification" id="notification">
        <div class="notification-icon">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="white">
                <path d="M20 2H4c-1.1 0-1.99.9-1.99 2L2 22l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-2 12H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"/>
            </svg>
        </div>
        <div class="notification-content" id="notificationContent">
            New message received
        </div>
    </div>
    
    <script>
        window.onload = function () {
    const adminId = 'admin'; // Fixed admin ID
    const connectionStatus = document.getElementById('connectionStatus');
    const chatList = document.getElementById('chatList');
    const userListEmpty = document.getElementById('userListEmpty');
    const mainContent = document.getElementById('mainContent');
    const noChatSelected = document.getElementById('noChatSelected');
    const chatContainer = document.getElementById('chatContainer');
    const chatHeader = document.getElementById('chatHeader');
    const chatMessages = document.getElementById('chatMessages');
    const messageInput = document.getElementById('messageInput');
    const sendBtn = document.getElementById('sendBtn');
    const typingIndicator = document.getElementById('typingIndicator');
    const notification = document.getElementById('notification');
    const notificationContent = document.getElementById('notificationContent');
    const searchInput = document.getElementById('searchInput');

    // Store active users and their chat data
    let users = new Map();
    let currentUser = null;
    let socket = null;
    let localChatCache = new Map(); // Local cache for chat messages

    function fetchAllUsersAndChats() {
        // Only request if connected to WebSocket
        if (socket && socket.readyState === WebSocket.OPEN) {
            console.log('Fetching all users and chats from server');
            socket.send(JSON.stringify({
                type: 'fetchAllChats',
                userId: adminId
            }));
        } else {
            console.log('WebSocket not connected, will try again soon');
            setTimeout(fetchAllUsersAndChats, 1000); 
        }
    }

    function connectWebSocket() {
        socket = new WebSocket('wss://messagesocket-production.up.railway.app');
        
        socket.onopen = function() {
            console.log('Connected to WebSocket server');
            connectionStatus.textContent = 'Online';
            connectionStatus.style.color = '#4caf50';
            
            // Identify as admin
            socket.send(JSON.stringify({
                type: 'identity',
                userId: adminId
            }));
        };
        
        socket.onmessage = function(event) {
            const data = JSON.parse(event.data);
            console.log('Received message:', data);
            
            if (data.type === 'message') {
                // Handle incoming message
                handleIncomingMessage(data);
            } else if (data.type === 'typing') {
                // Handle typing indicator
                handleTypingIndicator(data);
            } else if (data.type === 'image') {
                // Handle incoming image
                handleIncomingImage(data);
            } else if (data.type === 'history') {
                // Handle chat history
                handleChatHistory(data);
            } else if (data.type === 'messageDelivered') {
                // Handle message delivery confirmation
                console.log('Message delivered:', data);
            } else if (data.type === 'adminUpdate') {
                // Handle admin updates with all chats and users
                handleAdminUpdate(data);
            } else if (data.type === 'messagesMarkedAsRead') {
                // Handle read status update confirmation
                console.log('Messages marked as read for:', data.targetUserId);
                
                // Update UI to reflect read status
                if (users.has(data.targetUserId)) {
                    const userObj = users.get(data.targetUserId);
                    userObj.unreadCount = 0;
                    updateUserInList(data.targetUserId);
                }
            }
        };
        
        socket.onclose = function() {
            console.log('Disconnected from WebSocket server');
            connectionStatus.textContent = 'Offline';
            connectionStatus.style.color = '#f44336';
            
            // Try to reconnect after 5 seconds
            setTimeout(connectWebSocket, 5000);
        };
        
        socket.onerror = function(error) {
            console.error('WebSocket error:', error);
            connectionStatus.textContent = 'Error';
            connectionStatus.style.color = '#f44336';
        };
    }

    // Initialize the UI with stored data
    function initializeUI() {
        // Clear chat list
        const chatItems = document.querySelectorAll('.chat-item');
        chatItems.forEach(item => item.remove());
        
        // Check if there are users
        if (users.size > 0) {
            userListEmpty.style.display = 'none';
            
            // Add users to chat list
            users.forEach((userObj, userId) => {
                addUserToList(userId, userObj);
            });
            
            // If there's a current user, select them
            if (currentUser && users.has(currentUser)) {
                selectUser(currentUser);
            }
        } else {
            userListEmpty.style.display = 'block';
            noChatSelected.style.display = 'flex';
            chatContainer.style.display = 'none';
        }
        
        // Fetch all users and chats from server
        // Add a small delay to ensure WebSocket is connected
        setTimeout(fetchAllUsersAndChats, 1000);
    }

    // Handle admin update with all users and chats
    function handleAdminUpdate(data) {
        const { allChats, users: serverUsers } = data;
        
        console.log('Received admin update:', { allChats, serverUsers });
        
        // Process all users from server
        serverUsers.forEach(userObj => {
            const userId = userObj.id;
            if (userId !== adminId && !users.has(userId)) {
                // Add new user
                addUser(userId);
            }
        });
        
        // Process all messages to update user last messages and unread counts
        const userMessages = new Map();
        
        // Group messages by users
        allChats.forEach(message => {
            const otherUser = message.sender_id === adminId ? message.receiver_id : message.sender_id;
            
            if (!userMessages.has(otherUser)) {
                userMessages.set(otherUser, []);
            }
            
            userMessages.get(otherUser).push(message);
        });
        
        // Update each user's last message and cache all messages
        userMessages.forEach((messages, userId) => {
            if (userId !== adminId) {
                // Sort messages by timestamp
                messages.sort((a, b) => new Date(a.timestamp) - new Date(b.timestamp));
                
                // Get last message
                const lastMessage = messages[messages.length - 1];
                
                // Count unread messages (messages to admin that haven't been read)
                const unreadCount = messages.filter(msg => 
                    msg.sender_id === userId && 
                    msg.receiver_id === adminId && 
                    msg.is_read === 0
                ).length;
                
                // Update user object
                const userObj = users.get(userId) || {
                    id: userId
                };
                
                userObj.lastMessage = lastMessage.message_type === 'image' ? '[Image]' : lastMessage.content;
                userObj.lastMessageTime = lastMessage.timestamp;
                userObj.unreadCount = unreadCount;
                
                // Update user in map
                users.set(userId, userObj);
                
                // Update user in UI
                updateUserInList(userId);
                
                // Cache messages
                setCachedHistory(userId, messages);
            }
        });
    }

    // Add user to the UI list
    function addUserToList(userId, userObj) {
        const chatItem = document.createElement('div');
        chatItem.classList.add('chat-item');
        chatItem.dataset.userId = userId;
        
        const userInitial = userId.charAt(0).toUpperCase();
        
        chatItem.innerHTML = `
            <div class="avatar">${userInitial}</div>
            <div class="chat-info">
                <div class="chat-name">
                    ${userId}
                    <span class="chat-time">${userObj.lastMessageTime ? new Date(userObj.lastMessageTime).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) : ''}</span>
                </div>
                <div class="chat-preview">${userObj.lastMessage || ''}</div>
            </div>
            <div class="chat-badge" style="display: ${userObj.unreadCount > 0 ? 'block' : 'none'};">${userObj.unreadCount || ''}</div>
        `;
        
        chatItem.addEventListener('click', () => selectUser(userId));
        
        chatList.appendChild(chatItem);
        
        // Highlight if this is the current user
        if (userId === currentUser) {
            chatItem.classList.add('active');
        }
    }

    // Handle incoming message
    function handleIncomingMessage(data) {
        const { content, senderId, timestamp, isRead = false } = data;
        
        // Check if the message is from a new user
        if (!users.has(senderId) && senderId !== adminId) {
            // Add new user to the list
            addUser(senderId);
        }
        
        if (senderId !== adminId) {
            // Update user's last message
            const userObj = users.get(senderId);
            userObj.lastMessage = content;
            userObj.lastMessageTime = timestamp;
            
            // Only increment unread count if the chat is not open
            userObj.unreadCount = currentUser === senderId ? 0 : (userObj.unreadCount || 0) + 1;
            
            // Update user in the list
            updateUserInList(senderId);
            
            // Show notification if the chat is not open
            if (currentUser !== senderId) {
                showNotification(`New message from ${senderId}`);
            }
        }
        
        // Add message to chat if the current user is the sender
        if (currentUser === senderId || senderId === adminId) {
            addMessageToChat(content, senderId === adminId ? 'outgoing' : 'incoming', timestamp);
        }
        
        // Cache the message locally
        cacheMessage(senderId === adminId ? currentUser : senderId, {
            content,
            sender_id: senderId,
            receiver_id: senderId === adminId ? currentUser : adminId,
            timestamp,
            message_type: 'text',
            is_read: isRead ? 1 : 0
        });
    }

    // Handle typing indicator
    function handleTypingIndicator(data) {
        const { isTyping, userId } = data;
        
        // Show typing indicator only for the current user
        if (currentUser === userId) {
            if (isTyping) {
                typingIndicator.classList.add('active');
            } else {
                typingIndicator.classList.remove('active');
            }
        }
    }

    // Handle incoming image
    function handleIncomingImage(data) {
        const { content, senderId, timestamp, isRead = false } = data;
        
        // Similar to handling text messages
        if (!users.has(senderId) && senderId !== adminId) {
            addUser(senderId);
        }
        
        if (senderId !== adminId) {
            const userObj = users.get(senderId);
            userObj.lastMessage = '[Image]';
            userObj.lastMessageTime = timestamp;
            
            // Only increment unread count if the chat is not open
            userObj.unreadCount = currentUser === senderId ? 0 : (userObj.unreadCount || 0) + 1;
            
            updateUserInList(senderId);
            
            if (currentUser !== senderId) {
                showNotification(`New image from ${senderId}`);
            }
        }
        
        if (currentUser === senderId || senderId === adminId) {
            addImageToChat(content, senderId === adminId ? 'outgoing' : 'incoming', timestamp);
        }
        
        // Cache the image message locally
        cacheMessage(senderId === adminId ? currentUser : senderId, {
            content,
            sender_id: senderId,
            receiver_id: senderId === adminId ? currentUser : adminId,
            timestamp,
            message_type: 'image',
            is_read: isRead ? 1 : 0
        });
    }

    // Handle chat history
    function handleChatHistory(data) {
        const { history, targetUserId } = data;
        
        // Clear existing messages
        chatMessages.innerHTML = '';
        
        // Add messages to chat
        history.forEach(msg => {
            if (msg.message_type === 'text') {
                addMessageToChat(
                    msg.content, 
                    msg.sender_id === adminId ? 'outgoing' : 'incoming', 
                    msg.timestamp
                );
            } else if (msg.message_type === 'image') {
                addImageToChat(
                    msg.content, 
                    msg.sender_id === adminId ? 'outgoing' : 'incoming', 
                    msg.timestamp
                );
            }
        });
        
        // Cache history locally
        setCachedHistory(targetUserId, history);
        
        // Scroll to bottom
        chatMessages.scrollTop = chatMessages.scrollHeight;

        // Reset unread count for current user
        if (users.has(targetUserId)) {
            const userObj = users.get(targetUserId);
            userObj.unreadCount = 0;
            updateUserInList(targetUserId);
        }
    }

    // Add user to list
    function addUser(userId) {
        users.set(userId, {
            id: userId,
            lastMessage: '',
            lastMessageTime: '',
            unreadCount: 0
        });
        
        // Hide empty list message
        userListEmpty.style.display = 'none';
        
        // Add user to chat list
        addUserToList(userId, users.get(userId));
    }

    // Update user in list
    function updateUserInList(userId) {
        const userObj = users.get(userId);
        const chatItem = document.querySelector(`.chat-item[data-user-id="${userId}"]`);
        
        if (chatItem) {
            // Update last message preview
            const chatPreview = chatItem.querySelector('.chat-preview');
            chatPreview.textContent = userObj.lastMessage;
            
            // Update time
            const chatTime = chatItem.querySelector('.chat-time');
            const messageTime = new Date(userObj.lastMessageTime);
            chatTime.textContent = messageTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            
            // Update unread count
            const chatBadge = chatItem.querySelector('.chat-badge');
            if (userObj.unreadCount > 0) {
                chatBadge.textContent = userObj.unreadCount;
                chatBadge.style.display = 'block';
            } else {
                chatBadge.style.display = 'none';
            }
            
            // Move user to the top of the list
            chatList.insertBefore(chatItem, chatList.firstChild);
        } else {
            // Create new chat item if it doesn't exist
            addUserToList(userId, userObj);
        }
    }

    // Select user to chat with
    function selectUser(userId) {
        // Update current user
        currentUser = userId;
        
        // Update UI
        noChatSelected.style.display = 'none';
        chatContainer.style.display = 'flex';
        
        // Highlight selected user
        const chatItems = document.querySelectorAll('.chat-item');
        chatItems.forEach(item => {
            item.classList.remove('active');
            if (item.dataset.userId === userId) {
                item.classList.add('active');
                
                // Reset unread count in UI
                const chatBadge = item.querySelector('.chat-badge');
                chatBadge.style.display = 'none';
            }
        });
        
        // Update chat header
        const userInitial = userId.charAt(0).toUpperCase();
        chatHeader.innerHTML = `
            <div class="avatar">${userInitial}</div>
            <div>
                <div class="user-name">${userId}</div>
                <div class="user-status">Online</div>
            </div>
        `;
        
        // Clear messages
        chatMessages.innerHTML = '';
        
        // Check if we have cached messages
        const cachedHistory = getCachedHistory(userId);
        if (cachedHistory && cachedHistory.length > 0) {
            // Use cached messages
            console.log('Using cached history:', cachedHistory);
            cachedHistory.forEach(msg => {
                if (msg.message_type === 'text') {
                    addMessageToChat(
                        msg.content, 
                        msg.sender_id === adminId ? 'outgoing' : 'incoming', 
                        msg.timestamp
                    );
                } else if (msg.message_type === 'image') {
                    addImageToChat(
                        msg.content, 
                        msg.sender_id === adminId ? 'outgoing' : 'incoming', 
                        msg.timestamp
                    );
                }
            });
            
            // Scroll to bottom
            chatMessages.scrollTop = chatMessages.scrollHeight;
        } else {
            // Request chat history from server
            fetchChatHistory(userId);
        }
        
        // Mark messages as read on the server when admin opens the chat
        markMessagesAsRead(userId);
        
        // Focus on message input
        messageInput.focus();
    }

    // Mark messages as read
    function markMessagesAsRead(userId) {
        socket.send(JSON.stringify({
            type: 'markAsRead',
            userId: adminId,
            targetUserId: userId
        }));
        
        // Optimistically update UI
        if (users.has(userId)) {
            const userObj = users.get(userId);
            userObj.unreadCount = 0;
            updateUserInList(userId);
        }
        
        // Update local cache to mark messages as read
        const cachedHistory = getCachedHistory(userId);
        if (cachedHistory) {
            cachedHistory.forEach(msg => {
                if (msg.sender_id === userId && msg.receiver_id === adminId) {
                    msg.is_read = 1;
                }
            });
            setCachedHistory(userId, cachedHistory);
        }
    }

    // Fetch chat history
    function fetchChatHistory(userId) {
        socket.send(JSON.stringify({
            type: 'fetchHistory',
            userId: adminId,
            targetUserId: userId
        }));
    }

    // Add message to chat
    function addMessageToChat(content, messageType, timestamp) {
        const messageElement = document.createElement('div');
        messageElement.classList.add('message', messageType);
        messageElement.textContent = content;
        
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

    // Add image to chat
    function addImageToChat(imageData, messageType, timestamp) {
        const messageElement = document.createElement('div');
        messageElement.classList.add('message', messageType, 'image-message');
        
        // Create image element
        const imageElement = document.createElement('img');
        imageElement.src = imageData;
        
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

    function sendMessage() {
        const message = messageInput.value.trim();
        
        if (message !== '' && currentUser) {
            // Get current timestamp
            const timestamp = new Date().toISOString();
            
            // Send message to server
            socket.send(JSON.stringify({
                type: 'message',
                content: message,
                userId: adminId,
                targetUserId: currentUser,
                timestamp: timestamp
            }));
            
            // Clear input
            messageInput.value = '';
            
            // Focus on input
            messageInput.focus();
            
            // Add message to chat (optimistic update)
            addMessageToChat(message, 'outgoing', timestamp);
            
            // Cache the message locally
            cacheMessage(currentUser, {
                content: message,
                sender_id: adminId,
                receiver_id: currentUser,
                timestamp: timestamp,
                message_type: 'text',
                is_read: 1  // Admin's messages are already read
            });
            
            // Update last message preview for the current user
            const userObj = users.get(currentUser);
            userObj.lastMessage = message;
            userObj.lastMessageTime = timestamp;
            
            // Update UI
            updateUserInList(currentUser);
        }
    }

    // Show notification
    function showNotification(message) {
        notificationContent.textContent = message;
        notification.classList.add('active');
        
        // Hide notification after 5 seconds
        setTimeout(() => {
            notification.classList.remove('active');
        }, 5000);
    }

    // Search users
    function searchUsers(query) {
        const chatItems = document.querySelectorAll('.chat-item');
        
        chatItems.forEach(item => {
            const userId = item.dataset.userId;
            
            if (userId.toLowerCase().includes(query.toLowerCase())) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    }

    // Cache message locally (memory only)
    function cacheMessage(userId, message) {
        if (!localChatCache.has(userId)) {
            localChatCache.set(userId, []);
        }
        
        const userChatHistory = localChatCache.get(userId);
        userChatHistory.push(message);
        
        // Sort by timestamp
        userChatHistory.sort((a, b) => new Date(a.timestamp) - new Date(b.timestamp));
    }

    // Get cached chat history
    function getCachedHistory(userId) {
        return localChatCache.get(userId) || [];
    }

    // Set cached chat history
    function setCachedHistory(userId, history) {
        localChatCache.set(userId, history);
    }

    // Event listeners
    sendBtn.addEventListener('click', sendMessage);

    messageInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });

    messageInput.addEventListener('input', () => {
        if (currentUser) {
            // Send typing indicator
            socket.send(JSON.stringify({
                type: 'typing',
                isTyping: true,
                userId: adminId,
                targetUserId: currentUser
            }));
            
            // Clear existing timeout
            if (window.typingTimeout) {
                clearTimeout(window.typingTimeout);
            }
            
            // Set new timeout
            window.typingTimeout = setTimeout(() => {
                socket.send(JSON.stringify({
                    type: 'typing',
                    isTyping: false,
                    userId: adminId,
                    targetUserId: currentUser
                }));
            }, 2000);
        }
    });

    notification.addEventListener('click', () => {
        notification.classList.remove('active');
    });

    searchInput.addEventListener('input', (e) => {
        searchUsers(e.target.value);
    });

    // Added event listener for automatically marking messages as read 
    // when chat window is in focus and messages become visible
    chatMessages.addEventListener('scroll', () => {
        // If admin is looking at messages, mark them as read
        if (currentUser) {
            markMessagesAsRead(currentUser);
        }
    });

    // Initialize
    initializeUI();
    connectWebSocket();
}
    </script>
</body>
</html>