<?php
require '../includes/session.php';
checkSession('Customer');
require '../config/db.php';

// Fetch current rentals for the logged-in customer
$userId = $_SESSION['user_id'];
$currentRentalsSql = "SELECT Rentals.*, Books.title 
                      FROM Rentals 
                      JOIN Books ON Rentals.book_id = Books.book_id 
                      WHERE Rentals.user_id = :userId AND Rentals.status = 'Rented'";
$currentRentalsStmt = $pdo->prepare($currentRentalsSql);
$currentRentalsStmt->execute([':userId' => $userId]);
$currentRentals = $currentRentalsStmt->fetchAll();

// Fetch rental history for the logged-in customer
$rentalHistorySql = "SELECT Rentals.*, Books.title 
                     FROM Rentals 
                     JOIN Books ON Rentals.book_id = Books.book_id 
                     WHERE Rentals.user_id = :userId";
$rentalHistoryStmt = $pdo->prepare($rentalHistorySql);
$rentalHistoryStmt->execute([':userId' => $userId]);
$rentalHistory = $rentalHistoryStmt->fetchAll();

// Fetch overdue notifications for the logged-in customer
$overdueSql = "SELECT Rentals.*, Books.title 
               FROM Rentals 
               JOIN Books ON Rentals.book_id = Books.book_id 
               WHERE Rentals.user_id = :userId AND Rentals.status = 'Overdue'";
$overdueStmt = $pdo->prepare($overdueSql);
$overdueStmt->execute([':userId' => $userId]);
$overdueRentals = $overdueStmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Customer Dashboard</title>
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
        <form class="form-inline ml-auto" action="search_books.php" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" name="query" placeholder="Search by title, author, or genre" required>
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
    </div>
</nav>

<div class="container mt-4">
    <h2>Customer Dashboard</h2>
    <p>Welcome, Customer!</p>

    <h3>Your Rented Books</h3>
    <?php if (empty($currentRentals)): ?>
        <p>No currently rented books.</p>
    <?php else: ?>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Book Title</th>
                    <th>Rental Date</th>
                    <th>Due Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($currentRentals as $rental): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($rental['title']); ?></td>
                        <td><?php echo htmlspecialchars($rental['rental_date']); ?></td>
                        <td><?php echo htmlspecialchars($rental['due_date']); ?></td>
                        <td>
                            <form action="../includes/return_book.php" method="post" onsubmit="return confirm('Are you sure you want to return this book?');">
                                <input type="hidden" name="rental_id" value="<?php echo htmlspecialchars($rental['rental_id']); ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Return Book</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <h3>Your Rental History</h3>
    <?php if (empty($rentalHistory)): ?>
        <p>No rental history available.</p>
    <?php else: ?>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Book Title</th>
                    <th>Rental Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rentalHistory as $rental): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($rental['title']); ?></td>
                        <td><?php echo htmlspecialchars($rental['rental_date']); ?></td>
                        <td><?php echo htmlspecialchars($rental['status']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <h3>Overdue Notifications</h3>
    <?php if (empty($overdueRentals)): ?>
        <p>No overdue books.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($overdueRentals as $overdue): ?>
                <li><?php echo htmlspecialchars($overdue['title']); ?> (Due on: <?php echo htmlspecialchars($overdue['due_date']); ?>)</li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>