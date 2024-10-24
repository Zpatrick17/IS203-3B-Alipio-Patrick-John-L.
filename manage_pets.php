<?php
session_start();
include('db.php');

// Check if admin is logged in
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: admin_login.php');
    exit();
}

// Handle search
$search_term = '';
if (isset($_POST['search'])) {
    $search_term = $_POST['search'];
}

// Fetch all pets with optional search
$stmt = $conn->prepare("SELECT pet_id, pet_name, species, breed, date_of_birth, gender FROM pets 
                         WHERE pet_name LIKE ? OR species LIKE ? OR breed LIKE ?");
$like_term = "%" . $search_term . "%";
$stmt->bind_param("sss", $like_term, $like_term, $like_term);
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Pets - Comprehensive Pet Health Record System</title>
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

        /* Search form */
        form {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        form input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 80%;
        }

        form button {
            padding: 10px 20px;
            background-color: #4e9a51;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-transform: uppercase;
        }

        form button:hover {
            background-color: #3d7e44;
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
        <h1>Manage Pets</h1>
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
        <h2>All Pets</h2>

        <!-- Search Form -->
        <form method="POST" action="">
            <input type="text" name="search" placeholder="Search by pet name, species, or breed" value="<?php echo htmlspecialchars($search_term); ?>">
            <button type="submit">Search</button>
        </form>

        <?php if ($result->num_rows > 0) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Pet Name</th>
                        <th>Species</th>
                        <th>Breed</th>
                        <th>Date of Birth</th>
                        <th>Gender</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?= htmlspecialchars($row['pet_name']); ?></td>
                            <td><?= htmlspecialchars($row['species']); ?></td>
                            <td><?= htmlspecialchars($row['breed']); ?></td>
                            <td><?= htmlspecialchars($row['date_of_birth']); ?></td>
                            <td><?= htmlspecialchars($row['gender']); ?></td>
                            <td>
                                <a href="edit_pet.php?pet_id=<?= $row['pet_id']; ?>">Edit</a> | 
                                <a href="delete_pet.php?pet_id=<?= $row['pet_id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p class="empty-msg">No pets found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
