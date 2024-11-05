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
    <link rel="stylesheet" href="../assets/style.css">
    <title>Manage Users</title>
</head>
<body>
    <h2>Manage Users</h2>

    <?php if (isset($_SESSION['feedback'])): ?>
        <div class="feedback"><?php echo htmlspecialchars($_SESSION['feedback']); ?></div>
        <?php unset($_SESSION['feedback']); ?>
    <?php endif; ?>

    <table>
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
                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo htmlspecialchars($user['user_type']); ?></td>
                    <td>
                        <a href="update_user.php?id=<?php echo $user['id']; ?>">Update</a> |
                        <a href="../includes/delete_user.php?id=<?php echo $user['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="dashboard_admin.php">Back to Dashboard</a>
</body>
</html>