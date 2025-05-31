<?php
    session_start();
    include '../connection.php';
    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
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
    <?php
        echo $_SESSION['message'];
        echo "<br><a href='userProfile.php'>Check Your Profile!</a>";
        echo "<br><a href='../booking/bookingForm.php'>Booking Now!</a>";
        echo "<br><a href='userHistory.php'>Check Your History!</a>";
        echo "<br><br><a href='../logout.php'>Logout!</a>";
    ?>
</body>
</html>