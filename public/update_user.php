<?php
require '../includes/session.php';
checkSession('Admin');
require '../config/db.php';

// Get user details if `id` is present
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM Users WHERE user_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    $user = $stmt->fetch();
}

if (!$user) {
    $_SESSION['feedback'] = "User not found.";
    header('Location: user_management.php');
    exit();
}

// Update user details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['email'];
    $user_type = $_POST['user_type'];

    $sql = "UPDATE Users SET email = :username, user_type = :user_type WHERE user_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':username' => $username,
        ':user_type' => $user_type,
        ':id' => $id
    ]);

    $_SESSION['feedback'] = "User updated successfully!";
    header('Location: user_management.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Update User</title>
    <style>
        body {
            background-color: #f8f9fa; /* Light background for the body */
        }
        .container {
            max-width: 500px; /* Limit the container width */
            margin-top: 50px; /* Space from the top */
            padding: 20px; /* Padding for the form */
            background-color: white; /* White background for the form */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Shadow for depth */
        }
        h2 {
            color: #343a40; /* Dark color for the heading */
        }
        .btn-primary {
            background-color: #007bff; /* Primary button color */
            border-color: #007bff; /* Border color */
        }
        .btn-primary:hover {
            background-color: #0056b3; /* Darker blue on hover */
            border-color: #0056b3; /* Border color on hover */
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="dashboard_admin.php">The Book Blockbuster</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="dashboard_admin.php">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="user_management.php">Manage Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="rental_management.php">Rental Management</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="manage_book.php">Book Catalog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../includes/logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <h2 class="text-center">Update User</h2>
    <form action="update_user.php?id=<?php echo $user['user_id']; ?>" method="POST">
        <div class="form-group">
            <label for="email">Email Address:</label>
            <input type="text" id="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="user_type">User Type:</label>
            <select id="user_type" name="user_type" class="form-control" required>
                <option value="Customer" <?php if ($user['user_type'] == 'Customer') echo 'selected'; ?>>Customer</option>
                <option value="Admin" <?php if ($user['user_type'] == 'Admin') echo 'selected'; ?>>Admin</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary btn-block">Update User</button> <!-- Full-width button -->
    </form>
    <a href="user_management.php" class="btn btn-link">Back to Manage Users</a> <!-- Back link styled as a button -->
</div>
</body>
</html>