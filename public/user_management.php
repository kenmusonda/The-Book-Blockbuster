<?php
require '../includes/session.php';
checkSession('Admin'); // Only Admins can access this page
require '../config/db.php';

// Fetch all users from the database
$sql = "SELECT * FROM Users";
$stmt = $pdo->query($sql);
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Manage Users</title>
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background */
        }
        .feedback {
            margin: 20px;
            padding: 10px;
            border: 1px solid #28a745; /* Bootstrap success color */
            background-color: #d4edda; /* Bootstrap success background */
            color: #155724; /* Bootstrap success text color */
            border-radius: 5px;
        }
        h2 {
            margin: 20px 0;
        }
        .table th, .table td {
            vertical-align: middle; /* Center align table content */
        }
        .table thead th {
            background-color: #007bff; /* Bootstrap primary color */
            color: white;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1; /* Light gray hover effect */
        }
        .btn-custom {
            margin-right: 5px;
        }
    </style>
</head>
<body>

    <div class="container">
        <?php if (isset($_SESSION['feedback'])): ?>
            <div class="feedback"><?php echo htmlspecialchars($_SESSION['feedback']); ?></div>
            <?php unset($_SESSION['feedback']); ?>
        <?php endif; ?>

        <!-- Navigation links -->
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

        <h2>Manage Users</h2>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>User Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['user_id']); ?></td>
                        <td><?php echo htmlspecialchars($user['name']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['user_type']); ?></td>
                        <td>
                            <a href="update_user.php?id=<?php echo $user['user_id']; ?>" class="btn btn-warning btn-sm btn-custom">Update</a>
                            <a href="../includes/delete_user.php?user_id=<?php echo $user['user_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="dashboard_admin.php" class="btn btn-primary">Back to Dashboard</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>