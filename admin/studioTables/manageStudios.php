<?php
    session_start();
    include '../../connection.php';
    if ($_SESSION['role'] !== 'admin') {
    header("Location: ../../index.html");
    exit;
    }
    $query = "SELECT * FROM studios";
    $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Studio</title>
</head>
<body>
    <a href="addStudio.php">Add!</a>
    <table border="1">
        <tr>
            <th>id</th>
            <th>name</th>
            <th>location</th>
            <th>description</th>
            <th>price per hour</th>
            <th>is available</th>
            <th>created at</th>
            <th>action</th>
        </tr>
        <?php while ($studio = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $studio['id'] ?></td>
            <td><?= $studio['name'] ?></td>
            <td><?= $studio['location'] ?></td>
            <td><?= $studio['description'] ?></td>
            <td><?= $studio['price_per_hour'] ?></td>
            <td><?= $studio['is_available'] ?></td>
            <td><?= $studio['created_at'] ?></td>
            <td>
                <a href="editStudio.php?studio_id=<?= $studio['id'] ?>">Edit</a>
                <a href="deleteStudio.php?studio_id=<?= $studio['id'] ?>" onclick="return confirm('Yakin?')">Delete</a><br>
                <a href="../studioScheduleTables/addStudioSchedule.php?studio_id=<?= $studio['id'] ?>">Add Schedule</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>