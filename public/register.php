<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Register</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="dashboard_admin.php">The Book Blockbuster</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>

<div class="container mt-4">
    <h2>User Registration</h2>
    <form action="../includes/register_user.php" method="POST">
        <div class="form-group">
            <label for="name">Full Name:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" class="form-control" required>
        </div>
        
        <!-- Remove user type selection -->
        <input type="hidden" name="user_type" value="Customer">
        
        <div class="form-group">
            <label for="security_question">Security Question:</label>
            <select id="security_question" name="security_question" class="form-control" required>
                <option value="">Select a question</option>
                <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
                <option value="What was the name of your first pet?">What was the name of your first pet?</option>
                <option value="What is your favorite book?">What is your favorite book?</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="security_answer">Security Answer:</label>
            <input type="text" id="security_answer" name="security_answer" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>