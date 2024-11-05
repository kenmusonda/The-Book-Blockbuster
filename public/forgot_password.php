<?php
require '../includes/session.php';
require '../config/db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $securityQuestion = trim($_POST['security_question']);
    $securityAnswer = trim($_POST['security_answer']);
    $newPassword = trim($_POST['new_password']);

    // Logic for resetting password using security question
    $sql = "SELECT * FROM Users WHERE email = :email AND security_question = :security_question AND security_answer = :security_answer";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':email' => $email,
        ':security_question' => $securityQuestion,
        ':security_answer' => $securityAnswer,
    ]);

    $user = $stmt->fetch();

    if ($user) {
        // Update the password (make sure to hash it)
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updateSql = "UPDATE Users SET password = :password WHERE email = :email";
        $updateStmt = $pdo->prepare($updateSql);
        $updateStmt->execute([
            ':password' => $hashedPassword,
            ':email' => $email,
        ]);
        $message = "Your password has been reset successfully. You can now log in with your new password.";
    } else {
        $message = "Invalid credentials. Please check your email and answers.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/style.css">
    <title>Forgot Password</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="dashboard_admin.php">The Book Blockbuster</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>
<div class="container mt-4">
    <h2>Reset Your Password</h2>
    <?php if ($message): ?>
        <div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
    <form action="forgot_password.php" method="POST">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="security_question">Security Question:</label>
            <select name="security_question" id="security_question" class="form-control" required>
                <option value="">Select a question</option>
                <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
                <option value="What was the name of your first pet?">What was the name of your first pet?</option>
                <option value="What is your favorite book?">What is your favorite book?</option>
            </select>
        </div>
        <div class="form-group">
            <label for="security_answer">Answer:</label>
            <input type="text" name="security_answer" id="security_answer" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="new_password">New Password:</label>
            <input type="password" name="new_password" id="new_password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Reset Password</button>
    </form>
    <p class="mt-3"><a href="login.php">Back to Login</a></p>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>