<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Get Started</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background: url('Images/WallpaperBackgroundAboutUS.jpg') no-repeat center center fixed;
      background-size: cover;
      background-color: #f4f4f4;
    }

    .container {
      display: flex;
      background-color: white;
      width: 80%;
      max-width: 900px;
      height: 300px;
      border-radius: 12px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
      overflow: hidden;
    }

    .image-container {
      width: 50%;
      background: url('images/mainPage.jpg') no-repeat center center;
      background-size: cover;
    }

    .text-container {
      width: 50%;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 20px;
      text-align: center;
    }

    .text-container h1 {
      font-size: 24px;
      color: #333;
      margin-bottom: 20px;
    }

    .text-container a {
      text-decoration: none;
    }

    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      padding: 15px 25px;
      font-size: 18px;
      font-weight: bold;
      color: white;
      background-color: #4a90e2;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      text-transform: uppercase;
      transition: background-color 0.3s, transform 0.3s;
      margin-bottom: 15px;
    }

    .btn:hover {
      background-color: #357ab8;
      transform: translateY(-2px);
    }

    .btn span {
      margin-left: 10px;
      display: inline-block;
    }

    .btn span.arrow {
      font-size: 20px;
    }

    .link {
      font-size: 14px;
      color: #4a90e2;
      text-decoration: none;
      margin-top: 10px;
      transition: color 0.3s;
    }

    .link:hover {
      color: #357ab8;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="image-container"></div>
    <div class="text-container">
      <h1>Work easily for managing your task!</h1>
      <a href="Homepage.html" class="btn">
        Get Started 
        <span class="arrow">→</span>
      </a>
    </div>
  </div>
</body>
</html>
