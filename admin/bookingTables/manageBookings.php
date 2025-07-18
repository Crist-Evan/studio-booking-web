<?php
    session_start();
    include '../../connection.php';
    if ($_SESSION['role'] !== 'admin') {
    header("Location: ../../login.php");
    exit;
    }
    $query = "SELECT * FROM bookings";
    $result = mysqli_query($conn, $query)
?>

<!DOCTYPE html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Admin Dashboard | Booking Management</title>
    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
    />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
      integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI="
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="../../adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->
  </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
      <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a
                class="nav-link"
                data-lte-toggle="sidebar"
                href="#"
                role="button"
              >
                <i class="bi bi-list"></i>
              </a>
            </li>
          </ul>
          <!--end::Start Navbar Links-->
          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">
            <!--begin::Fullscreen Toggle-->
            <li class="nav-item">
              <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                <i
                  data-lte-icon="minimize"
                  class="bi bi-fullscreen-exit"
                  style="display: none"
                ></i>
              </a>
            </li>
            <!--end::Fullscreen Toggle-->
            <!-- begin::Logout Links -->
            <li class="nav-item">
              <a class="nav-link text-danger" href="../../logout.php">
                <i class="bi bi-box-arrow-right"></i> Logout
              </a>
            </li>
            <!-- end::Logout Links -->
          </ul>
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav>
      <!--end::Header-->
      <!--begin::Sidebar-->
      <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="../adminDashboard.php" class="brand-link">
            <!--begin::Brand Image-->
            <img
              src="../../assets/logo.png"
              alt="AdminLTE Logo"
              class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">Admin Dashboard</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="menu"
              data-accordion="false"
            >
              <li class="nav-header">USER</li>
              <li class="nav-item">
                <a href="../userTables/manageUsers.php" class="nav-link">
                  <i class="bi bi-people-fill"></i>
                  <p>User Management</p>
                </a>
              </li>
              <li class="nav-header">STUDIO</li>
              <li class="nav-item">
                <a href="../studioTables/manageStudios.php" class="nav-link">
                  <i class="bi bi-houses-fill"></i>
                  <p>Studio Management</p>
                </a>
              </li>
              <li class="nav-item">
                <a
                  href="../studioScheduleTables/manageStudioSchedules.php"
                  class="nav-link"
                >
                  <i class="bi bi-calendar-event-fill"></i>
                  <p>Schedule Management</p>
                </a>
              </li>
              <li class="nav-header">BOOKING</li>
              <li class="nav-item">
                <a href="../bookingTables/manageBookings.php" class="nav-link active">
                  <i class="bi bi-book-fill"></i>
                  <p>Booking Management</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../paymentTables/managePayments.php" class="nav-link">
                  <i class="bi bi-credit-card-fill"></i>
                  <p>Payment Management</p>
                </a>
              </li>
            </ul>
            <!--end::Sidebar Menu-->
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>
      <!--end::Sidebar-->
      <!--begin::App Main-->
      <main class="app-main">
            <div class="app-content-header">
            <div class="container-fluid">
                <h3 class="mb-0">Kelola Booking</h3>
            </div>
            </div>

            <div class="app-content">
            <div class="container-fluid">
                <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Daftar Booking</h3>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                        <th>#</th>
                        <th>Pengguna</th>
                        <th>Studio</th>
                        <th>Tanggal</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th>Status</th>
                        <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        while ($booking = mysqli_fetch_assoc($result)) {
                        $user_id = $booking['user_id'];
                        $user_query = "SELECT name FROM users WHERE id = $user_id";
                        $user_result = mysqli_query($conn, $user_query);
                        $user = mysqli_fetch_assoc($user_result);

                        $studio_id = $booking['studio_id'];
                        $studio_query = "SELECT name FROM studios WHERE id = $studio_id";
                        $studio_result = mysqli_query($conn, $studio_query);
                        $studio = mysqli_fetch_assoc($studio_result);

                        $badge = match ($booking['status']) {
                            'pending' => 'warning',
                            'confirmed' => 'success',
                            'cancelled' => 'danger',
                            default => 'secondary'
                        };
                        echo "<tr>";
                        echo "<td>{$no}</td>";
                        echo "<td>" . htmlspecialchars($user['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($studio['name']) . "</td>";
                        echo "<td>" . htmlspecialchars($booking['booking_date']) . "</td>";
                        echo "<td>" . htmlspecialchars($booking['start_time']) . "</td>";
                        echo "<td>" . htmlspecialchars($booking['end_time']) . "</td>";
                        echo "<td><span class='badge text-bg-$badge'>" . htmlspecialchars($booking['status']) . "</span></td>";
                        echo "<td>
                            <a href='editBooking.php?booking_id={$booking['id']}' class='btn btn-sm btn-warning'><i class='bi bi-pencil'></i></a>
                        </td>";
                        echo "</tr>";
                        $no++;
                        }
                        ?>
                    </tbody>
                    </table>
                </div>
                </div>
            </div>
            </div>
      </main>
      <!--end::App Main-->
      <!--begin::Footer-->
      <footer class="app-footer">
        <!--begin::To the end-->
        <div class="float-end d-none d-sm-inline">Admin Dashboard</div>
        <!--end::To the end-->
        <!--begin::Copyright-->
        <strong>
          Copyright &copy; 2025&nbsp;
          <!-- <a href="https://adminlte.io" class="text-decoration-none"
            >AdminLTE.io</a
          >. -->
        </strong>
        All rights reserved.
        <!--end::Copyright-->
      </footer>
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
      integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="../../adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = ".sidebar-wrapper";
      const Default = {
        scrollbarTheme: "os-theme-light",
        scrollbarAutoHide: "leave",
        scrollbarClickScroll: true,
      };
      document.addEventListener("DOMContentLoaded", function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (
          sidebarWrapper &&
          typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== "undefined"
        ) {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });
    </script>
    <!--end::OverlayScrollbars Configure-->
    <!--end::Script-->
  </body>
  <!--end::Body-->
</html>