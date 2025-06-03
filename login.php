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

    if ($user && password_verify($userpass, $user['password'])) {
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
        $error_message = "Email atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<meta http-equiv="x-ua-compatible" content="ie=edge" />
<title>Tekkom Studio | Login</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.0.0/mdb.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body style="background-color:rgb(50, 43, 28);" >

<section class="min-vh-100 d-flex align-items-center">
  <div class="container">
    <div class="row justify-content-center align-items-center">
      <div class="col-md-10 col-lg-8">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-5 d-none d-md-block">
              <img src="assets/2.jpeg" alt="login form" class="img-fluid" style="height: 100%; object-fit: cover; border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-7 d-flex align-items-center">
              <div class="card-body px-4 py-3 text-black w-100">

            <div class="d-flex align-items-center justify-content-center mb-2">
              <img src="assets/logo.png" alt="Logo" style="height: 50px; margin-right: 0.2rem;">
                <span class="h4 fw-bold mb-0">Tekkom Studio</span>
            </div>

                <p class="mb-3" style="letter-spacing: 0.5px;">Login to continue</p>

                <?php if (!empty($error_message)): ?>
                  <div class="alert alert-danger py-2" role="alert" style="font-size: 0.9rem;">
                    <?= $error_message ?>
                  </div>
                <?php endif; ?>

                <form method="POST" action="">
                  <div class="mb-3">
                    <label for="username" style="font-size: 0.9rem; color: #555; margin-bottom: 0.2rem; display: block;">Username</label>
                    <input type="text" id="username" name="username" required
                      style="border-radius: 0.3rem; border: 1px solid #ccc; font-size: 0.9rem; width: 100%; padding: 0.375rem 0.75rem;" />
                  </div>

                  <div class="mb-3">
                    <label for="userpass" style="font-size: 0.9rem; color: #555; margin-bottom: 0.2rem; display: block;">Password</label>
                    <input type="password" id="userpass" name="userpass" required
                      style="border-radius: 0.3rem; border: 1px solid #ccc; font-size: 0.9rem; width: 100%; padding: 0.375rem 0.75rem;" />
                  </div>

                  <div class="mb-3">
                    <button class="btn btn-dark btn-sm w-100" type="submit" style="border-radius: 0.3rem;">Login</button>
                  </div>

                  <div class="text-center">
                    <span class="small">Don't have an account? 
                      <a href="register.php">Register</a>
                    </span><br>
                  </div>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.0.0/mdb.min.js"></script>
</body>
</html>
