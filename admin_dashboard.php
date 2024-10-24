<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Comprehensive Pet Health Record System</title>
    <link rel="stylesheet" href="styles1.css">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #e8f4f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('pets_background.jpg'); /* Light pet-themed background */
            background-size: cover;
        }

        .dashboard-container {
            background-color: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            width: 100%;
            text-align: center;
        }

        h2 {
            font-size: 36px;
            color: #4e9a51; /* Veterinary-friendly green */
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .welcome-message {
            font-size: 20px;
            color: #333;
            margin-bottom: 30px;
        }

        .dashboard-buttons {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .dashboard-button {
            background-color: #4e9a51;
            color: white;
            padding: 15px;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.3s ease;
            font-size: 18px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            text-transform: uppercase;
        }

        .dashboard-button:hover {
            background-color: #429844;
            transform: scale(1.05);
        }

        .logout-btn {
            background-color: #ff6b6b;
            padding: 10px 30px;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-size: 18px;
            margin-top: 30px;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #e65c5c;
        }

        footer {
            margin-top: 30px;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Admin Dashboard</h2>
        <p class="welcome-message">Hello, <?php echo $_SESSION['username']; ?>! Manage your veterinary system below.</p>

        <div class="dashboard-buttons">
            <a href="manage_users.php" class="dashboard-button">Manage Users</a>
            <a href="manage_pets.php" class="dashboard-button">Manage Pets</a>
            <a href="manage_vaccinations.php" class="dashboard-button">Manage Vaccinations</a>
            <a href="manage_appointments.php" class="dashboard-button">Manage Appointments</a>
            <a href="view_reports.php" class="dashboard-button">View Reports</a>
        </div>

        <a href="logout.php" class="logout-btn">Logout</a>

        <footer>
            &copy; 2024 Comprehensive Pet Health Record System
        </footer>
    </div>
</body>
</html>
