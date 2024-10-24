<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit;
}

// Include database connection
include('db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Comprehensive Pet Health Record System</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to the external CSS file -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f9f8;
            margin: 0;
            padding: 0;
        }
        .navbar {
            background-color: #4e9a51;
            padding: 15px;
            color: white;
            text-align: center;
        }
        .navbar h1 {
            margin: 0;
            font-size: 32px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }
        .navbar a {
            float: right;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
            font-size: 18px;
        }
        .navbar a:hover {
            background-color: #3d7e44;
        }
        .dashboard-container {
            padding: 40px;
            text-align: center;
        }
        .dashboard-container h2 {
            margin-bottom: 30px;
            font-size: 28px;
            color: #333;
            border-bottom: 2px solid #4e9a51;
            padding-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1.2px;
        }
        .button {
            background-color: #4e9a51;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 15px 30px;
            margin: 10px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 18px;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #3d7e44;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Dashboard</h1>
        <a href="logout.php">Logout</a> <!-- Ensure this links to logout.php -->
    </div>
    <div class="dashboard-container">
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
        <div>
            <a href="manage_users.php" class="button">Manage Users</a>
            <a href="manage_pets.php" class="button">Manage Pets</a>
            <a href="manage_vaccinations.php" class="button">Manage Vaccinations</a>
            <a href="manage_medical_treatments.php" class="button">Manage Medical Treatments</a>
            <a href="manage_checkups.php" class="button">Manage Checkups</a>
        </div>
    </div>
</body>
</html>
