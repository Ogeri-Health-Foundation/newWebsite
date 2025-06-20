<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toast Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
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
            max-width: 300px;
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
            font-weight: 600;
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
    </style>
</head>
<body>
    <button onclick="showToast()">Show Toast</button>
    
    <div id="toast-success">
        <div class="icon">✔</div>
        <div id="toast-message">login success</div>
        <button class="close-btn" onclick="hideToast()">&times;</button>
    </div>

    <div id="bad-toast">
    <div class="bad-icon">x</div>
        <div id="bad-toast-message">login not successful</div>
        <button class="close-btn" onclick="hideToast()">&times;</button>
    </div>

    <script>
        function showToast() {
            // const toast = document.getElementById('toast-success');
            const bad_toast = document.getElementById('bad-toast');
            // toast.classList.add('show');
            bad_toast.classList.add('show');
            setTimeout(hideToast, 3000); 
        }

        function hideToast() {
            const toast = document.getElementById('toast-success');
            toast.classList.remove('show');
        }
    </script>
</body>
</html>
