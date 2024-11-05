<?php
require '../includes/session.php';
checkSession('Admin');

// Only start a session if it's not already active
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check for feedback message
$feedback = isset($_SESSION['feedback']) ? $_SESSION['feedback'] : '';
if ($feedback) {
    unset($_SESSION['feedback']); // Clear the message after displaying it
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Add Book</title>
    <style>
        /* Basic styling for navigation */
        nav {
            margin-bottom: 20px;
        }
    </style>
</head>
<body class="fade-in">
    <nav class="navbar navbar-expand-lg navbar-light">
        <a class="navbar-brand" href="dashboard_admin.php">
            
            The Book Blockbuster
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                
                <li class="nav-item">
                    <a class="nav-link" href="rental_management.php">Manage Rentals</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user_management.php">Manage Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="dashboard_admin.php">Admin Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../includes/logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h2>Add New Book</h2>

        <?php if ($feedback): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($feedback); ?></div>
        <?php endif; ?>

        <form action="../includes/add_book.php" method="POST">
            <div class="form-group">
                <label for="title">Book Title:</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" id="author" name="author" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="genre">Genre:</label>
                <select id="genre" name="genre" class="form-control" required>
                    <option value="">Select Genre</option>
                    <option value="Fiction">Fiction</option>
                    <option value="Non-Fiction">Non-Fiction</option>
                    <option value="Science Fiction">Science Fiction</option>
                    <option value="Biography">Biography</option>
                    <option value="Mystery">Mystery</option>
                    <option value="Fantasy">Fantasy</option>
                    <option value="Romance">Romance</option>
                    <option value="Thriller">Thriller</option>
                    <!-- Add more genres as needed -->
                </select>
            </div>
            
            <div class="form-group">
                <label for="publication_date">Publication Date:</label>
                <input type="date" id="publication_date" name="publication_date" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="isbn">ISBN:</label>
                <input type="text" id="isbn" name="isbn" class="form-control" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Add Book</button>
        </form>

        <a href="dashboard_admin.php" class="btn btn-secondary mt-3">Back to Dashboard</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>