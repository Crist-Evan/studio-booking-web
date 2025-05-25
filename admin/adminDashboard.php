<?php
    session_start();
    if ($_SESSION['role'] !== 'admin') {
    header("Location: /index.html");
    exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <a href="manageUsers.php">manage users</a>
    <a href="manageStudios.php">manage studios</a>
    <a href="manageBookings.php">manage bookings</a>
</body>
</html>