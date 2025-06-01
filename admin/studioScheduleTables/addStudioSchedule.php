<?php
    session_start();
    include '../../connection.php';
    if ($_SESSION['role'] !== 'admin') {
    header("Location: ../../login.php");
    exit;
    }
    
    $studio_id = $_GET['studio_id'];

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $day = $_POST['day_of_week'];
        $open = $_POST['open_time'];
        $close = $_POST['close_time'];

        $query = "INSERT INTO studio_schedules (studio_id, day_of_week, open_time, close_time) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'isss', $studio_id, $day, $open, $close);
        mysqli_stmt_execute($stmt);

        header("Location: manageStudioSchedules.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Admin Dashboard | Schedule Management</title>
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
                  class="nav-link active"
                >
                  <i class="bi bi-calendar-event-fill"></i>
                  <p>Schedule Management</p>
                </a>
              </li>
              <li class="nav-header">BOOKING</li>
              <li class="nav-item">
                <a href="../bookingTables/manageBookings.php" class="nav-link">
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
            <div class="container-fluid d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Tambah Jadwal Studio</h3>
            <a href="manageStudioSchedules.php" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle"></i> Kembali
            </a>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                    <label for="day_of_week" class="form-label">Hari</label>
                    <select name="day_of_week" id="day_of_week" class="form-select" required>
                        <?php
                        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                        foreach ($days as $day) {
                            $selected = $studioSchedule['day_of_week'] === $day ? 'selected' : '';
                            echo "<option value=\"$day\" $selected>$day</option>";
                        }
                        ?>
                    </select>
                    </div>

                    <div class="mb-3">
                    <label for="open_time" class="form-label">Jam Buka</label>
                    <input type="time" name="open_time" id="open_time" class="form-control" required>
                    </div>

                    <div class="mb-3">
                    <label for="close_time" class="form-label">Jam Tutup</label>
                    <input type="time" name="close_time" id="close_time" class="form-control" required>
                    </div>

                    <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save2"></i> Tambahkan
                    </button>
                    </div>
                </form>
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