<?php
include 'connection.php';

$booking_id = $_GET['booking_id'] ?? null;

if (!$booking_id) {
  echo "ID booking tidak ditemukan.";
  exit;
}

// Lanjutkan query pembayaran berdasarkan $booking_id
$query = "SELECT * FROM payments WHERE booking_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $booking_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$payment = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Payment</title>
  </head>
  <body>
    <?php
      if ($payment['status'] === 'unpaid') {
    ?>
    <h2>Processing</h2>
    <img src="" alt=""> 
    <p><?= $payment['amount'] ?></p>
    <a
      href="https://wa.me/6281313975003?text=Halo%20saya%20ingin%20booking%20studio%20musik"
      target="_blank"
    >
      <button>Hubungi via WhatsApp</button>
    </a>

    <?php
      } elseif ($payment['status'] === 'paid') {
    ?>
    <h2>Paid</h2>
    <img src="" alt=""> 
    <p><?= $payment['amount'] ?></p>
    <a
      href="https://wa.me/6281313975003?text=Halo%20saya%20ingin%20booking%20studio%20musik"
      target="_blank"
    >
      <button>Hubungi via WhatsApp</button>
    </a>

    <?php
      } elseif ($payment['status'] === 'failed') {
    ?>
    <h2>Failed</h2>
    <img src="" alt=""> 
    <p><?= $payment['amount'] ?></p>
    <a
      href="https://wa.me/6281313975003?text=Halo%20saya%20ingin%20booking%20studio%20musik"
      target="_blank"
    >
      <button>Hubungi via WhatsApp</button>
    </a>

    <?php
      };
    ?>
    
  </body>
</html>
