<?php
    include '../../connection.php';
    $studio_schedule_id = $_GET['studio_schedule_id'];

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $day = $_POST['day_of_week'];
        $open = $_POST['open_time'];
        $close = $_POST['close_time'];

        $query = "UPDATE studio_schedules SET day_of_week = ?, open_time = ?, close_time = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'sssi', $day, $open, $close, $studio_schedule_id);
        mysqli_stmt_execute($stmt);

        header("Location: manageStudioSchedules.php");
        exit;
    }

    $query = "SELECT * FROM studio_schedules WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $studio_schedule_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $studioSchedule = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Studio Schedule</title>
</head>
<body>
    <form method="post">
        <label for="day_of_week">Day: </label>
        <select name="day_of_week" required>
            <option value="Monday" <?= $studioSchedule['day_of_week'] == 'Monday' ? 'selected' : '' ?>>Monday</option>
            <option value="Tuesday" <?= $studioSchedule['day_of_week'] == 'Tuesday' ? 'selected' : '' ?>>Tuesday</option>
            <option value="Wednesday" <?= $studioSchedule['day_of_week'] == 'Wednesday' ? 'selected' : '' ?>>Wednesday</option>
            <option value="Thursday" <?= $studioSchedule['day_of_week'] == 'Thursday' ? 'selected' : '' ?>>Thursday</option>
            <option value="Friday" <?= $studioSchedule['day_of_week'] == 'Friday' ? 'selected' : '' ?>>Friday</option>
            <option value="Saturday" <?= $studioSchedule['day_of_week'] == 'Saturday' ? 'selected' : '' ?>>Saturday</option>
            <option value="Sunday" <?= $studioSchedule['day_of_week'] == 'Sunday' ? 'selected' : '' ?>>Sunday</option>
        </select><br /><br />

        <label for="open_time">Open Time: </label>
        <input type="time" name="open_time" value="<?= htmlspecialchars($studioSchedule['open_time']) ?>" required><br /><br />

        <label for="close_time">Close Time: </label>
        <input type="time" name="close_time" value="<?= htmlspecialchars($studioSchedule['close_time']) ?>" required><br /><br />

        <input type="submit" value="Edit!">
    </form>
</body>
</html>