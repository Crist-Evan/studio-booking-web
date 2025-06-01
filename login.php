<?php
session_start();
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $userpass = $_POST['userpass'];

    $query = "SELECT * FROM users WHERE name = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($userpass, $user['password'])){
        // Simpan data ke session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['name'];
        $_SESSION['useremail'] = $user['email'];
        $_SESSION['userphonenumber'] = $user['number_phone'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['message'] = "Login berhasil. Selamat datang " . $user['name'];

        if ($_SESSION['role'] !== 'admin') {
            header("Location: index.php");
            exit;
        } else {
            header("Location: admin/adminDashboard.php");
            exit;
        }
    } else {
        echo "Email atau password salah!";
        echo "<br>Name: $username<br>";
        echo "Password: $userpass<br>";

    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Tekkom Studio | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Fonts -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      crossorigin="anonymous"
    />

    <!-- Plugin CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
      crossorigin="anonymous"
    />

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="adminlte.css" />
  </head>
  <body class="login-page bg-body-secondary">
    <div class="login-box">
      <div class="login-logo">
        <a href="#"><b>Tekkom</b> Studio</a>
      </div>

      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Login to continue</p>

          <!-- BEGIN: Your form with original name/id/action -->
          <form method="post">
            <div class="input-group mb-3">
              <input
                type="text"
                name="username"
                id="username"
                class="form-control"
                placeholder="Username"
                required
              />
              <div class="input-group-text">
                <span class="bi bi-person-fill"></span>
              </div>
            </div>
            <div class="input-group mb-3">
              <input
                type="password"
                name="userpass"
                id="userpass"
                class="form-control"
                placeholder="Password"
                required
              />
              <div class="input-group-text">
                <span class="bi bi-lock-fill"></span>
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block w-100">
                  Login
                </button>
              </div>
            </div>
          </form>
          <!-- END: Your form -->

          <p class="mb-0 mt-3">
            <a href="register.php" class="text-center">Register Here!</a>
          </p>
        </div>
      </div>
    </div>

    <!-- Scripts -->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
      crossorigin="anonymous"
    ></script>
    <script src="adminlte.js"></script>
  </body>
</html>
