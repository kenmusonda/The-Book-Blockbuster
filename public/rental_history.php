<?php
require '../includes/session.php';
checkSession('Customer');
require '../config/db.php';

$user_id = $_SESSION['user_id'];
$sql = "SELECT Rentals.*, Books.title, Books.author FROM Rentals 
        JOIN Books ON Rentals.book_id = Books.book_id
        WHERE Rentals.user_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':user_id' => $user_id]);
$rentals = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Your Rental History</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="dashboard_customer.php">The Book Blockbuster</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="dashboard_customer.php">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="available_books.php">Book Catalog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="rental_history.php">Rental History</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../includes/logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-4">
    <h2>Your Rental History</h2>
    <?php if (empty($rentals)): ?>
        <p>You have no rental history available.</p>
    <?php else: ?>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Rental Date</th>
                    <th>Due Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rentals as $rental): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($rental['title']); ?></td>
                        <td><?php echo htmlspecialchars($rental['author']); ?></td>
                        <td><?php echo htmlspecialchars($rental['rental_date']); ?></td>
                        <td><?php echo htmlspecialchars($rental['due_date']); ?></td>
                        <td><?php echo htmlspecialchars($rental['status']); ?></td>
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