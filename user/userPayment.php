<?php
include '../connection.php';

$booking_id = $_GET['booking_id'] ?? null;

if (!$booking_id) {
  echo "ID booking tidak ditemukan.";
  exit;
}

// Ambil data pembayaran berdasarkan booking_id
$query = "SELECT * FROM payments WHERE booking_id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, 'i', $booking_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$payment = mysqli_fetch_assoc($result);

if (!$payment) {
  echo "Data pembayaran tidak ditemukan.";
  exit;
}

// Tentukan status
$status = $payment['status'];
$badge = 'secondary';
$statusText = 'Status Tidak Diketahui';

if ($status === 'unpaid') {
  $badge = 'warning';
  $statusText = 'Menunggu Pembayaran';
} elseif ($status === 'paid') {
  $badge = 'success';
  $statusText = 'Pembayaran Berhasil';
} elseif ($status === 'failed') {
  $badge = 'danger';
  $statusText = 'Pembayaran Gagal';
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Status Pembayaran</title>

  <!-- Styles AdminLTE & Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
</head>
<body class="bg-light d-flex align-items-center" style="min-height: 100vh;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        <div class="card shadow-lg border-0 mt-4">
          <div class="card-body text-center">
            <h3 class="mb-3">Status Pembayaran</h3>
            <span class="badge bg-<?= $badge ?> px-4 py-2 fs-6 mb-4"><?= $statusText ?></span>

            <!-- QRIS -->
            <div class="mb-4">
              <img src="path/to/qris.png" alt="QRIS Payment" class="img-fluid rounded shadow" style="max-width: 280px;">
            </div>

            <!-- Info Pesanan -->
            <div class="text-start mb-4">
              <p><strong>ID Pesanan:</strong> <?= $payment['id'] ?></p>
              <p><strong>Total Bayar:</strong> Rp <?= number_format($payment['amount'], 0, ',', '.') ?></p>
              <!-- Tambahkan info lain seperti nama studio, waktu booking, dsb jika di-join -->
            </div>

            <!-- Tombol WhatsApp -->
            <a href="https://wa.me/6281313975003?text=Halo%20saya%20ingin%20booking%20studio%20musik" class="btn btn-success btn-lg mb-3" target="_blank">
              <i class="bi bi-whatsapp me-1"></i> Hubungi via WhatsApp
            </a>

            <!-- Tombol Kembali -->
            <div>
              <a href="userHistory.php" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Keluar
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
