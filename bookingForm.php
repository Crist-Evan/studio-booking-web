<?php
session_start();
include 'connection.php'; // pastikan ini koneksi ke database

$studio_query = "SELECT * FROM studios WHERE is_available = 1";
$studio_result = mysqli_query($conn, $studio_query);

// Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
  header("Location: index.html");
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bookking</title>
  </head>
  <body>
    <form action="" method="post">
      <!-- USER -->
      <label>Nama:</label>
      <input type="text" name="name" value="<?= $user['name'] ?>" readonly><br><br>

      <label>Email:</label>
      <input type="email" name="email" value="<?= $user['email'] ?>" readonly><br><br>

      <label>No. HP:</label>
      <input type="text" name="phone" value="<?= $user['number_phone'] ?>" readonly><br><br>

      <!-- STUDIO -->
      <label>Pilih Studio:</label>
      <select name="studio" id="studio" required>
        <option value="">-- Pilih Studio --</option>
        <?php while ($studio = mysqli_fetch_assoc($studio_result)): ?>
          <option value="<?= $studio['price_per_hour'] ?>"><?= $studio['name'] ?></option>
        <?php endwhile; ?>
      </select>
      <br><br>

      <!-- TIME -->
      <label for="booking_date">Tanggal Booking:</label>
      <input type="date" id="booking_date" name="booking_date" min="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d') ?>" required><br><br>

      <label>Jam Mulai:</label>
      <select name="start_time" id="start_time">
        <?php
          for ($i = 8; $i <= 21; $i++) {
              echo "<option value='$i:00'>$i:00</option>";
          }
        ?>
      </select>

      <label>Jam Selesai:</label>
      <select id="end_time" name="end_time">
      </select><br /><br />

      <input type="submit" value="Book!" />

      <!-- RESULT -->
      <h3>Total: </h3>

      <!-- Javascript -->
      <script src="bookingForm.js"></script>
    </form>
  </body>
</html>
