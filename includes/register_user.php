<?php
// includes/register_user.php
require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash password
    // User type is now hardcoded as Customer
    $user_type = 'Customer'; 
    $security_question = $_POST['security_question'];
    $security_answer = $_POST['security_answer'];

    // Insert the new user into the database
    try {
        $sql = "INSERT INTO Users (name, email, password, user_type, security_question, security_answer) 
                VALUES (:name, :email, :password, :user_type, :security_question, :security_answer)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $password,
            ':user_type' => $user_type, // Hardcoded to Customer
            ':security_question' => $security_question,
            ':security_answer' => $security_answer
        ]);

        echo "Registration successful! <a href='../public/login.php'>Login here</a>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>