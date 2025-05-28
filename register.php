<?php
include 'connection.php'; // file koneksi ke database

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $useremail = $_POST['useremail'];
    $userphonenumber = $_POST['userphonenumber'];
    $userpass = $_POST['userpass'];
    $userrole = 'client'; // default role

    // Enkripsi password
    $hashed_password = password_hash($userpass, PASSWORD_DEFAULT);

    // Simpan ke database
    $query = "INSERT INTO users (name, email, number_phone, password, role) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'sssss', $username, $useremail, $userphonenumber, $hashed_password, $userrole);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "Register berhasil";
        header("Location: login.php");
        exit;
    } else {
        echo "Register gagal: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Register | My App</title>
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
  <body class="register-page bg-body-secondary">
    <div class="register-box">
      <div class="register-logo">
        <a href="#"><b>My</b>App</a>
      </div>

      <div class="card">
        <div class="card-body register-card-body">
          <p class="register-box-msg">Register a new membership</p>

          <!-- BEGIN: Form milikmu dengan dua input password -->
          <form
            onsubmit="return validateForm()" 
            method="post"
          >
            <div class="input-group mb-3">
              <input
                type="text"
                name="username"
                id="username"
                class="form-control"
                placeholder="Full Name"
                required
              />
              <div class="input-group-text">
                <span class="bi bi-person"></span>
              </div>
            </div>

            <div class="input-group mb-3">
              <input
                type="email"
                name="useremail"
                id="useremail"
                class="form-control"
                placeholder="Email"
                required
              />
              <div class="input-group-text">
                <span class="bi bi-envelope"></span>
              </div>
            </div>

            <div class="input-group mb-3">
              <input
                type="tel"
                name="userphonenumber"
                id="userphonenumber"
                class="form-control"
                placeholder="Phone Number"
                required
              />
              <div class="input-group-text">
                <span class="bi bi-telephone"></span>
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

            <div class="input-group mb-3">
              <input
                type="password"
                name="confirm_pass"
                id="confirm_pass"
                class="form-control"
                placeholder="Confirm Password"
                required
              />
              <div class="input-group-text">
                <span class="bi bi-lock"></span>
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block w-100">
                  Register
                </button>
              </div>
            </div>
          </form>
          <!-- END: Form -->

          <p class="mb-0 mt-3">
            <a href="index.html" class="text-center">Login Here!</a>
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
    <script>
      function validateForm() {
        const pwd = document.getElementById("userpass").value;
        const conf = document.getElementById("confirm_pass").value;
        if (pwd !== conf) {
          alert("Password tidak sama!");
          return false; // Form tidak dikirim
        }
        return true;
      }
    </script>
  </body>
</html>
