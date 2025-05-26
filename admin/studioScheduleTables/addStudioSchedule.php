<?php
    include '../../connection.php';
    $studio_id = $_GET['studio_id'];

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $day = $_POST['day_of_week'];
        $open = $_POST['open_time'];
        $close = $_POST['close_time'];

        $query = "INSERT INTO studio_schedules (studio_id, day_of_week, open_time, close_time) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'isss', $studio_id, $day, $open, $close);
        mysqli_stmt_execute($stmt);

        header("Location: manageStudioSchedules.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Studio Schedule</title>
</head>
<body>
    <form method="post">
        <label for="day_of_week">Day: </label>
        <select name="day_of_week" required>
            <option value="Monday">Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
            <option value="Saturday">Saturday</option>
            <option value="Sunday">Sunday</option>
        </select><br /><br />

        <label for="open_time">Open Time: </label>
        <input type="time" name="open_time" required><br /><br />

        <label for="close_time">Close Time: </label>
        <input type="time" name="close_time" required><br /><br />

        <input type="submit" value="Add!">
    </form>
</body>
</html>