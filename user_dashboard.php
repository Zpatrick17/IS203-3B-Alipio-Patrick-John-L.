<?php
session_start();
include('db.php');

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'user') {
    header('Location: user_login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Comprehensive Pet Health Record System</title>
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
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
            font-size: 18px;
            display: inline-block;
        }
        .navbar a:hover {
            background-color: #3d7e44;
            border-radius: 5px;
        }
        .container {
            padding: 40px;
            text-align: center;
        }
        .container h2 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #333;
        }
        .container p {
            font-size: 18px;
            color: #555;
            margin-bottom: 30px;
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
        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }
        .button-container a {
            margin: 10px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>User Dashboard</h1>
        <div>
            <a href="view_pets.php">View Pets</a>
            <a href="add_pet.php">Add Pet</a>
            <a href="view_vaccinations.php">View Vaccinations</a>
            <a href="view_medical_treatments.php">View Medical Treatments</a>
            <a href="view_checkups.php">View Checkups</a>
            <a href="schedule_appointment.php">Schedule Appointment</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    </div>
</body>
</html>
