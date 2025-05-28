<?php
session_start();
if ($_SESSION['role'] !== 'admin') {
header("Location: ../login.php");
exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- Fonts & Styles -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css" />
  <link rel="stylesheet" href="../adminlte.css" />
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
<div class="app-wrapper">

  <!-- Header (navbar) -->
  <nav class="app-header navbar navbar-expand bg-body">
    <div class="container-fluid">
      <ul class="navbar-nav ms-auto">
        <!-- Logout button only -->
        <li class="nav-item">
          <a class="nav-link text-danger" href="../login.php">
            <i class="bi bi-box-arrow-right"></i> Logout
          </a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Sidebar -->
  <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
      <a href="#" class="brand-link">
        <img src="dist/assets/img/AdminLTELogo.png" alt="Admin Logo" class="brand-image opacity-75 shadow">
        <span class="brand-text fw-light">Admin Panel</span>
      </a>
    </div>
    <div class="sidebar-wrapper">
      <nav class="mt-2">
        <ul class="nav flex-column">
          <!-- Ganti bagian ini dengan <a> link dari adminDashboard.php -->
          <li class="nav-item">
            <a href="userTables/manageUsers.php" class="nav-link"><i class="bi bi-people-fill me-2"></i>Kelola Pengguna</a>
          </li>
          <li class="nav-item">
            <a href="studioTables/manageStudios.php" class="nav-link"><i class="bi bi-house-door-fill me-2"></i>Kelola Studio</a>
          </li>
          <li class="nav-item">
            <a href="studioScheduleTables/manageStudioSchedules.php" class="nav-link"><i class="bi bi-calendar-check-fill me-2"></i>Kelola Jadwal Studio</a>
          </li>
          <li class="nav-item">
            <a href="bookingTables/manageBookings.php" class="nav-link"><i class="bi bi-file-earmark-bar-graph-fill me-2"></i>Kelola Booking</a>
          </li>
          <li class="nav-item">
            <a href="paymentTables/managePayments.php" class="nav-link"><i class="bi bi-file-earmark-bar-graph-fill me-2"></i>Kelola Pembayaran</a>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  <!-- Main Content -->
  <main class="app-main">
    <div class="app-content-header">
      <div class="container-fluid">
        <h3 class="mb-0">Dashboard Admin</h3>
      </div>
    </div>

    <div class="app-content">
      <div class="container-fluid">
        <!-- Taruh isi dashboard kamu di sini -->
        <div class="card">
          <div class="card-body">
            <p>Selamat datang di halaman dashboard admin.</p>
            <!-- Tambahkan statistik, ringkasan, grafik, dll di sini -->
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="app-footer">
    <div class="float-end d-none d-sm-inline">Admin Area</div>
    <strong>&copy; 2024 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights reserved.
  </footer>

</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
<script src="../adminlte.js"></script>
</body>
</html>
