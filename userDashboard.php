<?php
    session_start();
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
        echo "<br><a href='bookingForm.php'>Booking Now!</a>";
        echo "<br><a href='userHistory.php'>Check Your History!</a>";
    ?>
</body>
</html>