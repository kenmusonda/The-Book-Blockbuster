<?php
require '../config/db.php';
require '../includes/session.php';
checkSession('Admin');

// Fetch all rentals with status "Rented" for confirmation
$sql = "SELECT Rentals.*, Books.title, Users.name AS customer_name 
        FROM Rentals 
        JOIN Books ON Rentals.book_id = Books.book_id 
        JOIN Users ON Rentals.user_id = Users.user_id 
        WHERE Rentals.status = 'Rented'";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$pendingReturns = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Admin Dashboard - The Book Blockbuster</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="admin_dashboard.php">The Book Blockbuster - Admin</a>
</nav>

<div class="container mt-4">
    <h2>Admin Dashboard</h2>
    <h3>Pending Book Returns</h3>

    <?php if (empty($pendingReturns)): ?>
        <p>No books pending return confirmation.</p>
    <?php else: ?>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Book Title</th>
                    <th>Customer</th>
                    <th>Rental Date</th>
                    <th>Due Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pendingReturns as $rental): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($rental['title']); ?></td>
                        <td><?php echo htmlspecialchars($rental['customer_name']); ?></td>
                        <td><?php echo htmlspecialchars($rental['rental_date']); ?></td>
                        <td><?php echo htmlspecialchars($rental['due_date']); ?></td>
                        <td>
                            <form action="../includes/return_book.php" method="post">
                                <input type="hidden" name="rental_id" value="<?php echo htmlspecialchars($rental['rental_id']); ?>">
                                <button type="submit" class="btn btn-success btn-sm">Confirm Return</button>
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