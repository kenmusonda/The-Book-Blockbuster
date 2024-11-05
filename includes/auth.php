<?php
// includes/auth.php
session_start();
require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM Users WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verify user exists and password matches
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_type'] = $user['user_type'];

        // Redirect based on user type
        if ($user['user_type'] == 'Admin') {
            header("Location: ../public/dashboard_admin.php");
        } else {
            header("Location: ../public/dashboard_customer.php");
        }
        exit();
    } else {
        echo "Invalid email or password.";
    }
}
?>