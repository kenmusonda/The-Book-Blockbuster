<?php
// includes/add_book.php
require '../config/db.php';
require '../includes/session.php';
checkSession('Admin');

session_start(); // Start the session if not already started

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $publication_date = $_POST['publication_date'];
    $isbn = $_POST['isbn'];

    // Insert the new book into the database
    try {
        $sql = "INSERT INTO Books (title, author, genre, publication_date, isbn, availability_status) 
                VALUES (:title, :author, :genre, :publication_date, :isbn, 'Available')";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':title' => $title,
            ':author' => $author,
            ':genre' => $genre,
            ':publication_date' => $publication_date,
            ':isbn' => $isbn
        ]);

        // Set session feedback message
        $_SESSION['feedback'] = "Book added successfully!";
        header('Location: ../public/add_book.php'); // Redirect back to the form
        exit();
    } catch (PDOException $e) {
        $_SESSION['feedback'] = "Error: " . $e->getMessage();
        header('Location: ../public/add_book.php');
        exit();
    }
}
?>