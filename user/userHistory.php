<?php
  session_start();
  include '../connection.php';

  $user_id = $_SESSION['user_id'];
  $query = "SELECT * FROM bookings WHERE user_id = $user_id";
  $result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Booking History</title>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous" />

  <!-- Bootstrap & AdminLTE CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css" crossorigin="anonymous" />
  <link rel="stylesheet" href="adminlte.css" />
</head>
<body class="layout-fixed bg-body-tertiary">
  <div class="container mt-5">
    <div class="card">
      <div class="card-header bg-primary text-white">
        <h3 class="card-title">Booking History</h3>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-hover align-middle">
          <thead class="table-dark">
            <tr>
              <th>Booking Date</th>
              <th>Start Time</th>
              <th>End Time</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php while ($booking = mysqli_fetch_assoc($result)): ?>
              <tr>
                <td><?= htmlspecialchars($booking['booking_date']) ?></td>
                <td><?= htmlspecialchars($booking['start_time']) ?></td>
                <td><?= htmlspecialchars($booking['end_time']) ?></td>
                <td>
                  <?php
                    $status = $booking['status'];
                    $badge = 'secondary';
                    if ($status === 'pending') $badge = 'warning';
                    elseif ($status === 'confirmed') $badge = 'success';
                    elseif ($status === 'cancelled') $badge = 'danger';
                  ?>
                  <span class="badge text-bg-<?= $badge ?>"><?= htmlspecialchars($status) ?></span>
                </td>
                <td>
                  <a href="userPayment.php?booking_id=<?= $booking['id'] ?>" class="btn btn-sm btn-outline-primary">
                    <i class="bi bi-receipt"></i> Details
                  </a>
                </td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
  <script src="adminlte.js"></script>
</body>
</html>
