<?php
require '../includes/session.php';
checkSession('Customer');
require '../config/db.php';

// Fetch available books
$sql = "SELECT * FROM Books WHERE availability = 'Available'";
$books = $pdo->query($sql)->fetchAll();

// Rent a book
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $book_id = $_POST['book_id'];
    $user_id = $_SESSION['user_id'];
    $rental_date = date('Y-m-d');
    $due_date = date('Y-m-d', strtotime($rental_date . ' + 15 days'));

    // Insert into Rentals table
    $sql = "INSERT INTO Rentals (user_id, book_id, rental_date, due_date, status) VALUES (:user_id, :book_id, :rental_date, :due_date, 'Rented')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':user_id' => $user_id, ':book_id' => $book_id, ':rental_date' => $rental_date, ':due_date' => $due_date]);

    // Update book availability
    $updateBook = "UPDATE Books SET availability = 'Rented' WHERE id = :book_id";
    $stmt = $pdo->prepare($updateBook);
    $stmt->execute([':book_id' => $book_id]);

    $_SESSION['feedback'] = "Book rented successfully!";
    header('Location: rent_book.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rent a Book</title>
</head>
<body>
    <h2>Rent a Book</h2>

    <?php if (isset($_SESSION['feedback'])): ?>
        <div class="feedback"><?php echo htmlspecialchars($_SESSION['feedback']); ?></div>
        <?php unset($_SESSION['feedback']); ?>
    <?php endif; ?>

    <form action="rent_book.php" method="POST">
        <label for="book_id">Choose a Book:</label>
        <select id="book_id" name="book_id" required>
            <?php foreach ($books as $book): ?>
                <option value="<?php echo htmlspecialchars($book['id']); ?>">
                    <?php echo htmlspecialchars($book['title'] . ' by ' . $book['author']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Rent</button>
    </form>
</body>
</html>