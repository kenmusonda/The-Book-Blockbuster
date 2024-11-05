<?php
// config/db.php
$host = 'localhost';
$db_name = 'BookRentalApp';
$username = 'root'; // MySQL username
$password = '';     // MySQL password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}
?>