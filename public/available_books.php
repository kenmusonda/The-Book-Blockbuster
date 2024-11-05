<?php
require '../includes/session.php';
checkSession('Customer');
require '../config/db.php';

$sql = "SELECT * FROM Books WHERE availability = 'Available'";
$stmt = $pdo->query($sql);
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Available Books</title>
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
    <h2>Available Books</h2>
    <?php if (empty($books)): ?>
        <p>No books are currently available.</p>
    <?php else: ?>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>Publication Date</th>
                    <th>ISBN</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($book['title']); ?></td>
                        <td><?php echo htmlspecialchars($book['author']); ?></td>
                        <td><?php echo htmlspecialchars($book['genre']); ?></td>
                        <td><?php echo htmlspecialchars($book['publication_date']); ?></td>
                        <td><?php echo htmlspecialchars($book['isbn']); ?></td>
                        <td>
                            <a href="../includes/rent_book.php?id=<?php echo $book['book_id']; ?>" class="btn btn-primary">Rent</a>
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