<?php
    include '../../connection.php';
    $studio_id = $_GET['studio_id'];

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $name = $_POST['name'];
        $loc = $_POST['location'];
        $desc = $_POST['description'];
        $price = $_POST['price_per_hour'];
        $is_available = $_POST['is_available'];

        $query = "UPDATE studios SET name = ?, location = ?, description = ?, price_per_hour = ?, is_available = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'sssdii', $name, $loc, $desc, $price, $is_available, $studio_id);
        mysqli_stmt_execute($stmt);

        header("Location: manageStudios.php");
        exit;
    }

    $query = "SELECT * FROM studios WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $studio_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $studio = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Studio</title>
</head>
<body>
    <form method="post">
        <label for="name">Name: </label>
        <input type="text" name="name" value="<?= $studio['name'] ?>" required/><br /><br />
        <label for="location">Location: </label>
        <textarea name="location" required><?= $studio['location'] ?></textarea><br /><br />
        <label for="description">Description: </label>
        <textarea name="description" required><?= $studio['description'] ?></textarea><br /><br />
        <label for="price_for_hour">Price: </label>
        <input type="number" name="price_per_hour" step="0.01"  value="<?= $studio['price_per_hour'] ?>" required><br /><br />
        <label for="is_available">Available?: </label>
        <select name="is_available" required>
            <option value="1" <?= $studio['is_available'] == 1 ? 'selected' : '' ?>>Yes</option>
            <option value="0" <?= $studio['is_available'] == 0 ? 'selected' : '' ?>>No</option>
        </select><br /><br />
        <input type="submit" value="Edit!">
    </form>
</body>
</html>