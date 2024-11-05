<?php
require '../includes/session.php';
checkSession('Admin');
require '../config/db.php';

// Fetch all books from the database
$sql = "SELECT * FROM Books";
$stmt = $pdo->query($sql);
$books = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Manage Books</title>
</head>
<body class="fade-in">
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
                    <a class="nav-link" href="manage_users.php">Manage Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="rental_management.php">Rental Management</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="book_catalog.php">Book Catalog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="add_book.php">Add Book</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../includes/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Manage Books</h2>

        <?php if (isset($_SESSION['feedback'])): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($_SESSION['feedback']); ?></div>
            <?php unset($_SESSION['feedback']); ?>
        <?php endif; ?>

        <table class="table table-striped">
            <thead>
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
                            <a href="update_book.php?id=<?php echo $book['book_id']; ?>" class="btn btn-warning btn-sm">Update</a>
                            <a href="../includes/delete_book.php?id=<?php echo $book['book_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this book?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <a href="add_book.php" class="btn btn-primary">Add New Book</a>
        <a href="dashboard_admin.php" class="btn btn-secondary">Back to Dashboard</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>