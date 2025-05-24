<?php
  session_start();
  include 'connection.php';

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
      <?php while ($user = mysqli_fetch_assoc($result)): ?>
        <tr>
          <td><?= $user['booking_date'] ?></td>
          <td><?= $user['start_time'] ?></td>
          <td><?= $user['end_time'] ?></td>
          <td><?= $user['status'] ?></td>
          <td><a href="userPayment.php?booking_id=<?= $user['id'] ?>">details</a></td>
        </tr>
      <?php endwhile; ?>
    </table>
  </body>
</html>
