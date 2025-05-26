<?php
    session_start();
    include '../../connection.php';
    if ($_SESSION['role'] !== 'admin') {
    header("Location: ../../index.html");
    exit;
    }
    $query = "SELECT * FROM bookings";
    $result = mysqli_query($conn, $query)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Booking</title>
</head>
<body>
    <table border="1">
        <tr>
            <th>id</th>
            <th>user id</th>
            <th>studio id</th>
            <th>booking date</th>
            <th>start time</th>
            <th>end time</th>
            <th>status</th>
            <th>created at</th>
            <th>action</th>
        </tr>
        <?php while ($booking = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $booking['id'] ?></td>
            <td><?= $booking['user_id'] ?></td>
            <td><?= $booking['studio_id'] ?></td>
            <td><?= $booking['booking_date'] ?></td>
            <td><?= $booking['start_time'] ?></td>
            <td><?= $booking['end_time'] ?></td>
            <td><?= $booking['status'] ?></td>
            <td><?= $booking['created_at'] ?></td>
            <td>
                <a href="editBooking.php?booking_id=<?= $booking['id'] ?>">edit</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>