<?php
  session_start();
  include '../connection.php';
  if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
  }

  $user_id = $_SESSION['user_id'];
  $query = "SELECT * FROM bookings WHERE user_id = $user_id";
  $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>History</title>
  </head>
  <body>
    <table border="1">
      <tr>
        <th>booking date</th>
        <th>start time</th>
        <th>end time</th>
        <th>status</th>
        <th>action</th>
      </tr>
      <?php while ($booking = mysqli_fetch_assoc($result)): ?>
        <tr>
          <td><?= $booking['booking_date'] ?></td>
          <td><?= $booking['start_time'] ?></td>
          <td><?= $booking['end_time'] ?></td>
          <td><?= $booking['status'] ?></td>
          <td><a href="userPayment.php?booking_id=<?= $booking['id'] ?>">details</a></td>
        </tr>
      <?php endwhile; ?>
    </table>
  </body>
</html>
