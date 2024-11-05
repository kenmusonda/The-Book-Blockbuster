<?php
require '../includes/session.php';
checkSession('Admin');
require '../config/db.php';

// Get book details if `id` is present
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM Books WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    $book = $stmt->fetch();
}

if (!$book) {
    $_SESSION['feedback'] = "Book not found.";
    header('Location: manage_books.php');
    exit();
}

// Update book details
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $publication_date = $_POST['publication_date'];
    $isbn = $_POST['isbn'];

    $sql = "UPDATE Books SET title = :title, author = :author, genre = :genre, 
            publication_date = :publication_date, isbn = :isbn WHERE id = :id";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':title' => $title,
        ':author' => $author,
        ':genre' => $genre,
        ':publication_date' => $publication_date,
        ':isbn' => $isbn,
        ':id' => $id
    ]);

    $_SESSION['feedback'] = "Book updated successfully!";
    header('Location: manage_books.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Update Book</title>
</head>
<body>
    <h2>Update Book</h2>

    <form action="update_book.php?id=<?php echo $book['id']; ?>" method="POST">
        <label for="title">Book Title:</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($book['title']); ?>" required>
        
        <label for="author">Author:</label>
        <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($book['author']); ?>" required>
        
        <label for="genre">Genre:</label>
        <select id="genre" name="genre" required>
            <option value="">Select Genre</option>
            <option value="Fiction" <?php if ($book['genre'] == 'Fiction') echo 'selected'; ?>>Fiction</option>
            <!-- Other genre options as before -->
        </select>
        
        <label for="publication_date">Publication Date:</label>
        <input type="date" id="publication_date" name="publication_date" value="<?php echo htmlspecialchars($book['publication_date']); ?>" required>
        
        <label for="isbn">ISBN:</label>
        <input type="text" id="isbn" name="isbn" value="<?php echo htmlspecialchars($book['isbn']); ?>" required>
        
        <button type="submit">Update Book</button>
    </form>
    <a href="manage_books.php">Back to Manage Books</a>
</body>
</html>