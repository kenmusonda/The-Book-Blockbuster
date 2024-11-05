<?php
// includes/rent_book.php
require '../config/db.php';
require '../includes/session.php';
checkSession('Customer');

if (isset($_GET['id'])) {
    $book_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];
    $rental_date = date('Y-m-d');
    $due_date = date('Y-m-d', strtotime($rental_date . ' + 15 days'));

    try {
        // Check if the user already has 3 rented books
        $sql = "SELECT COUNT(*) FROM Rentals WHERE user_id = :user_id AND status = 'Rented'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':user_id' => $user_id]);
        $rented_books = $stmt->fetchColumn();

        if ($rented_books < 3) {
            // Insert the rental record with status 'Rented'
            $sql = "INSERT INTO Rentals (user_id, book_id, rental_date, due_date, status) 
                    VALUES (:user_id, :book_id, :rental_date, :due_date, 'Rented')";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':user_id' => $user_id,
                ':book_id' => $book_id,
                ':rental_date' => $rental_date,
                ':due_date' => $due_date
            ]);

            // Update the book's availability status in the Books table
            $sql = "UPDATE Books SET availability = 'Rented' WHERE book_id = :book_id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([':book_id' => $book_id]);

            $message = "Book rented successfully! Due date: " . $due_date;
            $is_success = true;
        } else {
            $message = "You can only rent up to 3 books at a time.";
            $is_success = false;
        }
    } catch (PDOException $e) {
        $message = "Error: " . htmlspecialchars($e->getMessage());
        $is_success = false;
    }
} else {
    $message = "Invalid request.";
    $is_success = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .message {
            margin-top: 20px;
            text-align: center;
            font-weight: bold;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
        a {
            display: block;
            margin-top: 15px;
            text-align: center;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
    <title>Rent Book</title>
</head>
<body>

<div class="container">
    <h2 class="text-center">Rent a Book</h2>
    <div class="message <?php echo $is_success ? 'success' : 'error'; ?>">
        <?php echo htmlspecialchars($message); ?>
    </div>
    <?php if (isset($is_success) && !$is_success): ?>
        <a href="../public/available_books.php">Back to Available Books</a>
    <?php elseif (isset($is_success) && $is_success): ?>
        <a href="../public/dashboard_customer.php">Back to Dashboard</a>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>