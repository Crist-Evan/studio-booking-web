<?php
    session_start();
    include '../../connection.php';
    if ($_SESSION['role'] !== 'admin') {
    header("Location: ../../login.php");
    exit;
    }
    $query = "SELECT * FROM studio_schedules";
    $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Studio Schedule</title>
</head>
<body>
    <a href="../studioTables/manageStudios.php">Add Schedule From Studio Table's!</a>
    <table border="1">
        <tr>
            <th>id</th>
            <th>studio id</th>
            <th>day of week</th>
            <th>open time</th>
            <th>close time</th>
            <th>action</th>
        </tr>
        <?php while ($studioSchedule = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $studioSchedule['id'] ?></td>
            <td><?= $studioSchedule['studio_id'] ?></td>
            <td><?= $studioSchedule['day_of_week'] ?></td>
            <td><?= $studioSchedule['open_time'] ?></td>
            <td><?= $studioSchedule['close_time'] ?></td>
            <td>
                <a href="editStudioSchedule.php?studio_schedule_id=<?= $studioSchedule['id'] ?>">Edit</a>
                <a href="deleteStudioSchedule.php?studio_schedule_id=<?= $studioSchedule['id'] ?>" onclick="return confirm('Yakin?')">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>