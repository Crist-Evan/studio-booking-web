<?php
session_start();
include 'connection.php';

$booking_id = $_GET['booking_id'] ?? null;
$user_id = $_SESSION['user_id'];

if (!$booking_id) {
  echo "ID booking tidak ditemukan.";
  exit;
}

// Lanjutkan query pembayaran berdasarkan $booking_id
$query = "SELECT * FROM bookings WHERE id = ? AND user_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'ii', $booking_id, $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$booking = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payment</title>
  </head>
  <body>
    <!-- Title (Pending / Success / Failed) -->
    <h2></h2>

    <!-- QR Image -->
    <img src="" alt=""> 

    <!-- information -->
    <p></p>

    <!-- Link or Button to Confirmation -->
    <a
      href="https://wa.me/6281313975003?text=Halo%20saya%20ingin%20booking%20studio%20musik"
      target="_blank"
    >
      <button>Hubungi via WhatsApp</button>
    </a>
  </body>
</html>
