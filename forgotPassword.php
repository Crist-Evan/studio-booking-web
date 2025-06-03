<?php
    session_start();
    include 'connection.php';

    $email = '';
    $step = 'email'; // langkah awal

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['email'])) {
        $email = $_POST['email'];
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $step = 'reset'; // lanjut ke form reset password
        } else {
            echo "<p style='color:red;'>Email tidak ditemukan.</p>";
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['new_pass'])) {
        $email = $_POST['email']; // kirim ulang email secara hidden
        $password = $_POST['new_pass'];
        $confirm = $_POST['confirm_pass'];

        if ($password != $confirm) {
            echo "<p style='color:red;'>Password tidak cocok!</p>";
            $step = 'reset'; // tampilkan ulang form reset
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $query = "UPDATE users SET password=? WHERE email=?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 'ss', $hashed, $email);

            if (mysqli_stmt_execute($stmt)) {
                echo "<p style='color:green;'>Password berhasil diubah. Silakan login.</p>";
                header("Location: login.php"); // selesai
                exit;
            } else {
                echo "<p style='color:red;'>Gagal mengubah password.</p>";
                $step = 'reset';
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tekkom Studio | Forgot Password</title>
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
              <img src="assets/3.jpeg" 
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

                <p class="mb-4">Forgot Password?</p>

                <?php if ($step === 'email'): ?>
                <form action="forgotPassword.php" method="POST">
                    <div data-mdb-input-init class="form-outline mb-3">
                        <input type="email" name="email" id="email" class="form-control form-control-lg" required>
                        <label class="form-label" for="email">Registered Email</label>
                    </div>
                    <button type="submit" class="btn btn-dark btn-block mb-3">Sent</button>
                </form>

                <?php elseif ($step === 'reset'): ?>
                <form action="forgotPassword.php" method="POST">
                    <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">

                    <div data-mdb-input-init class="form-outline mb-3">
                        <input type="password" name="new_pass" id="new_pass" class="form-control form-control-lg" required>
                        <label class="form-label" for="new_pass">Password Baru:</label>
                    </div>

                    <div data-mdb-input-init class="form-outline mb-3">
                        <input type="password" name="confirm_pass" id="confirm_pass" class="form-control form-control-lg" required>
                        <label class="form-label" for="confirm_pass">Konfirmasi Password:</label>
                    </div>

                    <button type="submit" class="btn btn-dark btn-block mb-3">Reset Password</button>
                </form>
                <?php endif; ?>
              </div>

              <div class="text-center">
                <p class="mb-0">Remember the Password? <a href="login.php">Login</a></p>
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
</body>
</html>