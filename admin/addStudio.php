<?php
    include 'connection.php';

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $name = $_POST['name'];
        $loc = $_POST['location'];
        $desc = $_POST['description'];
        $price = $_POST['price_per_hour'];

        $query = "INSERT INTO studios (name, location, description, price_per_hour) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'sssd', $name, $loc, $desc, $price);
        mysqli_stmt_execute($stmt);

        header("Location: manageStudios.php");
        exit;
    }
?>