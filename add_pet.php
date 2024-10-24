<?php
session_start();
include('db.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: user_login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$error = '';

// Handle adding pet
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pet_name = $_POST['pet_name'];
    $species = $_POST['species'];
    $breed = $_POST['breed'];
    $date_of_birth = $_POST['date_of_birth'];
    $gender = $_POST['gender'];

    // Add new pet
    $stmt = $conn->prepare("INSERT INTO pets (user_id, pet_name, species, breed, date_of_birth, gender) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $user_id, $pet_name, $species, $breed, $date_of_birth, $gender);

    if ($stmt->execute()) {
        // Redirect back to add_pet.php to add another pet
        header('Location: add_pet.php');
        exit();
    } else {
        $error = 'Error adding pet. Please try again.';
    }
}

// Fetch pets for the logged-in user
$pets_result = $conn->prepare("SELECT * FROM pets WHERE user_id = ?");
$pets_result->bind_param("i", $user_id);
$pets_result->execute();
$pets = $pets_result->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css"> <!-- Link to the external CSS file -->
    <title>Add Pet</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f9f8;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .error {
            color: red;
            text-align: center;
            margin-bottom: 20px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #4e9a51;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #3d7e44;
        }
        h3 {
            margin-top: 30px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #4e9a51;
            color: white;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px auto;
            background-color: #4e9a51;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #3d7e44;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add a New Pet</h2>

        <?php if ($error): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <input type="text" name="pet_name" placeholder="Pet Name" required>
            <input type="text" name="species" placeholder="Species" required>
            <input type="text" name="breed" placeholder="Breed" required>
            <input type="date" name="date_of_birth" required>
            <select name="gender" required>
                <option value="" disabled selected>Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            <button type="submit">Add Pet</button>
        </form>

        <h3>Your Pets</h3>
        <table>
            <tr>
                <th>Pet Name</th>
                <th>Species</th>
                <th>Breed</th>
                <th>Date of Birth</th>
                <th>Gender</th>
            </tr>
            <?php while ($pet = $pets->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($pet['pet_name']); ?></td>
                    <td><?php echo htmlspecialchars($pet['species']); ?></td>
                    <td><?php echo htmlspecialchars($pet['breed']); ?></td>
                    <td><?php echo htmlspecialchars($pet['date_of_birth']); ?></td>
                    <td><?php echo htmlspecialchars($pet['gender']); ?></td>
                </tr>
            <?php endwhile; ?>
        </table>

        <!-- Back Button to return to user_dashboard.php -->
        <a href="user_dashboard.php" class="button">Back to Dashboard</a>
    </div>
</body>
</html>
