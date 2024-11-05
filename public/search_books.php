<?php
require '../includes/session.php';
checkSession('Customer');
require '../config/db.php';

$searchQuery = '';
$searchResults = [];

if (isset($_GET['query'])) {
    $searchQuery = trim($_GET['query']);
    
    // Prepare SQL to search for books based on the title, author, or genre
    // Also check if the book is currently rented out
    $searchSql = "
        SELECT Books.*, Rentals.status AS rental_status 
        FROM Books 
        LEFT JOIN Rentals ON Books.book_id = Rentals.book_id AND Rentals.status = 'Rented' 
        WHERE Books.title LIKE :query OR Books.author LIKE :query OR Books.genre LIKE :query";
    
    $searchStmt = $pdo->prepare($searchSql);
    $searchStmt->execute([':query' => '%' . $searchQuery . '%']);
    $searchResults = $searchStmt->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Search Results</title>
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
    <h2>Search Results for "<?php echo htmlspecialchars($searchQuery); ?>"</h2>

    <?php if (empty($searchResults)): ?>
        <p>No books found matching your search criteria.</p>
    <?php else: ?>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>Publication Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($searchResults as $book): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($book['title']); ?></td>
                        <td><?php echo htmlspecialchars($book['author']); ?></td>
                        <td><?php echo htmlspecialchars($book['genre']); ?></td>
                        <td><?php echo htmlspecialchars($book['publication_date']); ?></td>
                        <td>
                            <?php if ($book['rental_status'] === 'Rented'): ?>
                                <button class="btn btn-secondary btn-sm" disabled>Rented Out</button>
                            <?php else: ?>
                                <form action="../includes/rent_book.php" method="post">
                                    <input type="hidden" name="book_id" value="<?php echo htmlspecialchars($book['book_id']); ?>">
                                    <button type="submit" class="btn btn-primary btn-sm">Rent Book</button>
                                </form>
                            <?php endif; ?>
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