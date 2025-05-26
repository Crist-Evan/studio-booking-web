<?php
    session_start();
    if ($_SESSION['role'] !== 'admin') {
    header("Location: ../index.html");
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
    <a href="userTables/manageUsers.php">manage users</a>
    <a href="studioTables/manageStudios.php">manage studios</a>
    <a href="bookingTables/manageBookings.php">manage bookings</a>
    <a href="paymentTables/managePayments.php">manage payments</a>
</body>
</html>