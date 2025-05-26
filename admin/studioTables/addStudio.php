<?php
    include '../../connection.php';

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Studio</title>
</head>
<body>
    <form method="post">
        <label for="name">Name: </label>
        <input type="text" name="name" required/><br /><br />
        <label for="location">Location: </label>
        <textarea name="location" required></textarea><br /><br />
        <label for="description">Description: </label>
        <textarea name="description" required></textarea><br /><br />
        <label for="price_for_hour">Price: </label>
        <input type="number" name="price_per_hour" step="0.01" required><br /><br />
        <input type="submit" value="Add!">
    </form>
</body>
</html>