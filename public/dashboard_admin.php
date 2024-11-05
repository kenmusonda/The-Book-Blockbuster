<?php
require '../includes/session.php';
checkSession('Admin');
require '../config/db.php';
include '../includes/update_overdue.php';

// Fetch counts for dashboard summary
$totalBooks = $pdo->query("SELECT COUNT(*) FROM Books")->fetchColumn();
$availableBooks = $pdo->query("SELECT COUNT(*) FROM Books WHERE availability = 'Available'")->fetchColumn();
$rentedBooks = $pdo->query("SELECT COUNT(*) FROM Rentals WHERE status = 'Rented'")->fetchColumn();
$overdueBooks = $pdo->query("SELECT COUNT(*) FROM Rentals WHERE status = 'Overdue'")->fetchColumn();

// Fetch list of overdue rentals
$sql = "SELECT Rentals.*, Books.title, Users.name, Users.email 
        FROM Rentals
        JOIN Books ON Rentals.book_id = Books.book_id
        JOIN Users ON Rentals.user_id = Users.user_id
        WHERE Rentals.status = 'Overdue'";
$overdueRentals = $pdo->query($sql)->fetchAll();

// Handle book return
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['returnRental'])) {
    $rentalId = $_POST['rentalId'];
    
    // Update rental status in the database
    $stmt = $pdo->prepare("UPDATE Rentals SET status = 'Returned' WHERE rental_id = ?");
    $stmt->execute([$rentalId]);
    
    // Redirect back to the same page to see changes
    header("Location: dashboard_admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background */
            font-family: Arial, sans-serif; /* Set a cleaner font */
        }
        h2 {
            margin-top: 20px;
            margin-bottom: 20px;
            color: #343a40; /* Darker text color for headings */
        }
        .summary {
            margin-bottom: 30px;
            padding: 20px;
            background-color: #ffffff; /* White background for summary */
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); /* Deeper shadow for better depth */
        }
        table {
            margin-top: 20px;
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


<div class="container mt-4">
    <h2>Admin Dashboard</h2>
    <div class="summary">
        <h4>Library Summary</h4>
        <p>Total Books: <?php echo $totalBooks; ?></p>
        <p>Available Books: <?php echo $availableBooks; ?></p>
        <p>Rented Books: <?php echo $rentedBooks; ?></p>
        <p>Overdue Books: <?php echo $overdueBooks; ?></p>
    </div>

    <h3>Overdue Rentals</h3>
    <?php if (empty($overdueRentals)): ?>
        <p>No overdue rentals.</p>
    <?php else: ?>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Book Title</th>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>Rental Date</th>
                    <th>Due Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($overdueRentals as $rental): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($rental['title']); ?></td>
                        <td><?php echo htmlspecialchars($rental['name']); ?></td>
                        <td><?php echo htmlspecialchars($rental['email']); ?></td>
                        <td><?php echo htmlspecialchars($rental['rental_date']); ?></td>
                        <td><?php echo htmlspecialchars($rental['due_date']); ?></td>
                        <td>
                            <form action="dashboard_admin.php" method="post" onsubmit="return confirm('Confirm return for this book?');">
                                <input type="hidden" name="rentalId" value="<?php echo htmlspecialchars($rental['rental_id']); ?>">
                                <button type="submit" name="returnRental" class="btn btn-success btn-sm">Mark as Returned</button>
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