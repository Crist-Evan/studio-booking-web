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
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tekkom Studio | Register</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css" rel="stylesheet"/>
</head>
<body style="background-color:rgb(50, 43, 28);">

<section class="min-vh-100 d-flex align-items-center">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card shadow-5-strong" style="border-radius: 20px; overflow: hidden;">
          <div class="row g-0 h-100">

            <!-- Gambar Kiri -->
            <div class="col-md-6 d-none d-md-block">
              <img src="assets/1.jpg" 
                   alt="studio" 
                   style="width: 100%; height: 100%; object-fit: cover;" />
            </div>

            <!-- Form Kanan -->
            <div class="col-md-6 p-5 d-flex flex-column justify-content-between">
              <div>
                <h3 class="fw-bold mb-3 d-flex align-items-center" style="margin-top: -20px;">
                  <img src="assets/logo.png" alt="Logo" style="height: 60px; margin-right: 0.5rem;">
                  Tekkom Studio
                </h3>

                <p class="mb-4">Register a new user</p>

                <form action="register.php" method="POST" onsubmit="return validateForm()">
                  <div data-mdb-input-init class="form-outline mb-3">
                    <input type="text" id="fullname" name="username" class="form-control form-control-lg" required />
                    <label class="form-label" for="fullname">Username</label>
                  </div>

                  <div data-mdb-input-init class="form-outline mb-3">
                    <input type="email" id="email" name="useremail" class="form-control form-control-lg" required />
                    <label class="form-label" for="email">Email</label>
                  </div>

                  <div data-mdb-input-init class="form-outline mb-3">
                    <input type="text" id="phone" name="userphonenumber" class="form-control form-control-lg" required />
                    <label class="form-label" for="phone">Phone Number</label>
                  </div>

                  <div data-mdb-input-init class="form-outline mb-3">
                    <input type="password" id="password" name="userpass" class="form-control form-control-lg" required />
                    <label class="form-label" for="password">Password</label>
                  </div>

                  <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control form-control-lg" required />
                    <label class="form-label" for="confirm_password">Confirm Password</label>
                  </div>

                  <button type="submit" class="btn btn-dark btn-block mb-3">Register</button>
                </form>
              </div>

              <div class="text-center">
                <p class="mb-0">Already have an account? <a href="login.php">Login</a></p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

  <!-- FontAwesome untuk icon musik -->
  <script src="https://kit.fontawesome.com/a2e0b5b217.js" crossorigin="anonymous"></script>
  <!-- MDB -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"></script>
  <!-- Js -->
  <script>
      function validateForm() {
        const pwd = document.getElementById("password").value;
        const conf = document.getElementById("confirm_password").value;
        if (pwd !== conf) {
          alert("Password tidak sama!");
          return false; // Form tidak dikirim
        }
        return true;
      }
    </script>
</body>
</html>
