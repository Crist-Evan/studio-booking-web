<?php
    session_start();
    include '../../connection.php';
    if ($_SESSION['role'] !== 'admin') {
    header("Location: ../../login.php");
    exit;
    }
    $query = "SELECT * FROM payments";
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
            <th>booking id</th>
            <th>amount</th>
            <th>method</th>
            <th>status</th>
            <th>paid at</th>
            <th>action</th>
        </tr>
        <?php while ($payment = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?= $payment['id'] ?></td>
            <td><?= $payment['booking_id'] ?></td>
            <td><?= $payment['amount'] ?></td>
            <td><?= $payment['method'] ?></td>
            <td><?= $payment['status'] ?></td>
            <td><?= $payment['paid_at'] ?></td>
            <td>
                <a href="editPayment.php?payment_id=<?= $payment['id'] ?>">edit</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>