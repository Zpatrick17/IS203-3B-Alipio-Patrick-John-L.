<?php
session_start();
include('db.php');

// Check if admin is logged in
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: admin_login.php');
    exit();
}

// Fetch all users except admin
$stmt = $conn->prepare("SELECT id, username, email, fullname FROM users WHERE role = 'user'");
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users - Comprehensive Pet Health Record System</title>
    <link rel="stylesheet" href="styles1.css">
    <style>
        body {
            background-color: #f5f9f8;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .navbar {
            background-color: #4e9a51;
            padding: 15px;
            text-align: center;
        }

        .navbar h1 {
            color: white;
            margin: 0;
            font-size: 32px;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .navbar nav a {
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
        }

        .navbar nav a:hover {
            background-color: #3d7e44;
            border-radius: 5px;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            border-bottom: 2px solid #4e9a51;
            padding-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4e9a51;
            color: white;
            text-transform: uppercase;
            font-size: 16px;
        }

        td {
            font-size: 16px;
        }

        td a {
            text-decoration: none;
            color: #4e9a51;
            font-weight: bold;
        }

        td a:hover {
            color: #3d7e44;
        }

        .empty-msg {
            font-size: 18px;
            color: #666;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Manage Users</h1>
        <nav>
            <a href="admin_dashboard.php">Dashboard</a>
            <a href="manage_pets.php">Manage Pets</a>
            <a href="manage_vaccinations.php">Manage Vaccinations</a>
            <a href="manage_medical_treatments.php">Manage Medical Treatments</a>
            <a href="manage_checkups.php">Manage Checkups</a>
            <a href="logout.php">Logout</a>
        </nav>
    </div>

    <div class="container">
        <h2>All Users</h2>
        <?php if ($result->num_rows > 0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Full Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?= htmlspecialchars($row['username']); ?></td>
                            <td><?= htmlspecialchars($row['email']); ?></td>
                            <td><?= htmlspecialchars($row['fullname']); ?></td>
                            <td>
                                <a href="edit_user.php?id=<?= $row['id']; ?>">Edit</a> | 
                                <a href="delete_user.php?id=<?= $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p class="empty-msg">No users found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
