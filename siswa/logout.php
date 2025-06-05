<?php
session_start();

// Hapus semua session
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Logout...</title>
    <meta http-equiv="refresh" content="3;url=../index2.php?pesan=logout">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            width: 100%;
            background-color: #0d0d0d;
            color: #ffffff;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .loading-wrapper {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #0d0d0d;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .progress-container {
            width: 80%;
            max-width: 600px;
            height: 14px;
            background-color: #222;
            border-radius: 7px;
            overflow: hidden;
            margin-top: 20px;
        }

        .progress-bar {
            width: 0%;
            height: 100%;
            background: linear-gradient(90deg, #00f2ff, #00b3ff);
            animation: growBar 3s forwards;
        }

        @keyframes growBar {
            from { width: 0%; }
            to { width: 100%; }
        }

        h1 {
            font-size: 28px;
            color: #cccccc;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(10px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="loading-wrapper">
        <h1>Logout sedang diproses...</h1>
        <div class="progress-container">
            <div class="progress-bar"></div>
        </div>
    </div>
</body>
</html>
