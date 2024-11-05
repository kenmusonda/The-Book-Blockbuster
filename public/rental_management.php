<?php
require '../includes/session.php';
checkSession('Admin');
require '../config/db.php';

// Fetch all active rentals
$sql = "SELECT Rentals.*, Books.title, Users.name, Users.email 
        FROM Rentals
        JOIN Books ON Rentals.book_id = Books.book_id
        JOIN Users ON Rentals.user_id = Users.user_id
        WHERE Rentals.status = 'Rented'";
$activeRentals = $pdo->query($sql)->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rental Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css">
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
    <h2 class="mt-4 mb-4">Active Rentals</h2>
    <?php if (empty($activeRentals)): ?>
        <div class="alert alert-info">No active rentals at the moment.</div>
    <?php else: ?>
        <table class="table table-bordered overdue-table">
            <thead>
                <tr>
                    <th>Book Title</th>
                    <th>Customer Name</th>
                    <th>Customer Email</th>
                    <th>Rental Date</th>
                    <th>Due Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($activeRentals as $rental): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($rental['title']); ?></td>
                        <td><?php echo htmlspecialchars($rental['name']); ?></td>
                        <td><?php echo htmlspecialchars($rental['email']); ?></td>
                        <td><?php echo htmlspecialchars($rental['rental_date']); ?></td>
                        <td><?php echo htmlspecialchars($rental['due_date']); ?></td>
                        <td>
                            <form action="return_rental.php" method="post">
                                <input type="hidden" name="rental_id" value="<?php echo htmlspecialchars($rental['id']); ?>">
                                <button type="submit" class="btn btn-danger">Return Book</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>