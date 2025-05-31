<?php
session_start();
include '../connection.php'; // pastikan ini koneksi ke database

$studio_query = "SELECT * FROM studios WHERE is_available = 1";
$studio_result = mysqli_query($conn, $studio_query);

// Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
  header("Location: ../login.php");
  exit;
}

// Ambil data user dari DB
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Booking Form</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Fonts & AdminLTE -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css" crossorigin="anonymous" />
  <link rel="stylesheet" href="../adminlte.css" />
</head>
<body class="layout-fixed bg-body-tertiary">

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="container-fluid d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Booking Form</h3>
        <a href="../user/userDashboard.php" class="btn btn-secondary">
          <i class="bi bi-arrow-left-circle"></i> Kembali
        </a>
      </div>
      <div class="card card-primary card-outline">

        <form action="bookingProcess.php" method="POST">
          <div class="card-body">

            <!-- Identitas Pengguna -->
            <input type="hidden" name="user_id" value="<?= $user_id ?>">
            
            <div class="mb-3">
              <label class="form-label">Name</label>
              <input type="text" class="form-control" name="name" id="name" value="<?= htmlspecialchars($user['name']) ?>" disabled>
            </div>

            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" name="email" id="email" value="<?= htmlspecialchars($user['email']) ?>" disabled>
            </div>

            <div class="mb-3">
              <label class="form-label">Phone Number</label>
              <input type="tel" class="form-control" name="phone" id="phone" value="<?= htmlspecialchars($user['number_phone']) ?>" disabled>
            </div>

            <!-- Studio -->
            <div class="mb-3">
              <label for="studio_id" class="form-label">Select Studio</label>
              <select name="studio_id" id="studio_id" class="form-select" required>
                <option value="" selected disabled>Studio</option>
                <?php while ($studio = mysqli_fetch_assoc($studio_result)): ?>
                  <option value="<?= $studio['id'] ?>" data-price="<?= $studio['price_per_hour'] ?>">
                    <?= $studio['name'] ?>
                  </option>
                <?php endwhile; ?>
              </select>
            </div>

            <!-- Tanggal & Waktu -->
            <div class="mb-3">
              <label for="booking_date" class="form-label">Booking Date</label>
              <input type="date" name="booking_date" id="booking_date" class="form-control" min="<?= date('Y-m-d') ?>" required>
            </div>

            <div class="row mb-3">
              <div class="col-md-6">
                <label for="start_time" class="form-label">Start Booking</label>
                <select name="start_time" id="start_time" class="form-control" required></select>
              </div>
              <div class="col-md-6">
                <label for="end_time" class="form-label">End Booking</label>
                <select name="end_time" id="end_time" class="form-control" required></select>
              </div>
            </div>

            <!-- Result / Total -->
            <div class="mb-3">
              <label class="form-label">Total</label>
              <input type="text" class="form-control-plaintext form-control-lg fw-bold text-primary" id="total"placeholder="Rp -" disabled>
            </div>
            <input type="hidden" id="total_hidden" name="total">

          </div>
          <div class="card-footer d-flex justify-content-between">
            <button type="submit" class="btn btn-primary">Book Now</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script src="../adminlte.js"></script>
<script src="bookingForm.js"></script>
</body>
</html>
