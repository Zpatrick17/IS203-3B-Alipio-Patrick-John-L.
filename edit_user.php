<?php
session_start();
include('db.php');

// Check if admin is logged in
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: admin_login.php');
    exit();
}

if (!isset($_GET['id'])) {
    echo "No user ID provided.";
    exit();
}

$user_id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];

    $stmt = $conn->prepare("UPDATE users SET username = ?, email = ?, fullname = ? WHERE id = ?");
    $stmt->bind_param("sssi", $username, $email, $fullname, $user_id);
    if ($stmt->execute()) {
        header('Location: manage_users.php');
        exit();
    } else {
        echo "Error updating user.";
    }
} else {
    // Fetch user details to pre-fill the form
    $stmt = $conn->prepare("SELECT username, email, fullname FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "User not found.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Comprehensive Pet Health Record System</title>
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
            max-width: 600px;
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

        form label {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
            display: block;
        }

        form input[type="text"], form input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 16px;
        }

        form button {
            width: 100%;
            padding: 12px;
            background-color: #4e9a51;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            text-transform: uppercase;
            cursor: pointer;
        }

        form button:hover {
            background-color: #3d7e44;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            font-size: 16px;
            color: #4e9a51;
            text-decoration: none;
        }

        a:hover {
            color: #3d7e44;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <h1>Edit User</h1>
        <nav>
            <a href="admin_dashboard.php">Dashboard</a>
            <a href="manage_users.php">Manage Users</a>
            <a href="manage_vaccinations.php">Manage Vaccinations</a>
            <a href="manage_medical_treatments.php">Manage Medical Treatments</a>
            <a href="manage_checkups.php">Manage Checkups</a>
            <a href="logout.php">Logout</a>
        </nav>
    </div>

    <div class="container">
        <h2>Edit User Details</h2>
        <form method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

            <label for="fullname">Full Name:</label>
            <input type="text" name="fullname" value="<?php echo htmlspecialchars($user['fullname']); ?>" required>

            <button type="submit">Update User</button>
        </form>
        <a href="manage_users.php">Back to User Management</a>
    </div>
</body>
</html>
