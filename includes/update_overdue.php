<?php
require '../config/db.php';

$sql = "UPDATE Rentals SET status = 'Overdue' WHERE due_date < CURDATE() AND status = 'Rented'";
$pdo->query($sql);