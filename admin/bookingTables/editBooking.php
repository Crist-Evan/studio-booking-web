<?php
    include '../../connection.php';
    $booking_id = $_GET['booking_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newBookingDate = $_POST['booking_date'];
        $newStartTime = $_POST['start_time'];
        $newEndTime = $_POST['end_time'];
        $newStatus = $_POST['status'];

        $query = "UPDATE bookings SET booking_date = ?, start_time = ?, end_time = ?, status = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'ssssi', $newBookingDate, $newStartTime, $newEndTime, $newStatus, $booking_id);
        mysqli_stmt_execute($stmt);

        header("Location: manageBookings.php");
        exit;
    }

    $query = "SELECT * FROM bookings WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $booking_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $booking = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>
</head>
<body>
    <form method="post">
        <label for="booking_date">Tanggal Booking:</label>
        <input type="date" name="booking_date" value="<?= htmlspecialchars($booking['booking_date']) ?>" required><br>

        <label for="start_time">Jam Mulai:</label>
        <input type="time" name="start_time" value="<?= htmlspecialchars($booking['start_time']) ?>" required><br>

        <label for="end_time">Jam Selesai:</label>
        <input type="time" name="end_time" value="<?= htmlspecialchars($booking['end_time']) ?>" required><br>

        <label for="status">Status:</label>
        <select name="status" required>
            <option value="pending" <?= $booking['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
            <option value="confirmed" <?= $booking['status'] == 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
            <option value="cancelled" <?= $booking['status'] == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
        </select><br>

        <input type="submit" value="Edit!">
    </form>
</body>
</html>