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
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $query = "UPDATE users SET password = ? WHERE email = ?";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, 'ss', $hash, $email);

            if (mysqli_stmt_execute($stmt)) {
                echo "<p style='color:green;'>Password berhasil diubah. Silakan login.</p>";
                $step = 'done'; // selesai
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
</head>
<body>
    <?php if ($step == 'email'): ?>
    <form method="POST">
        <label for="email">Email: </label>
        <input type="email" name="email" id="email"><br><br>
        <input type="submit" value="Verify">
    </form>

    <?php elseif ($step == 'reset'): ?>
    <form method="POST">
        <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
        <label for="new_pass">New Password: </label>
        <input type="password" name="new_pass" id="new_pass"><br><br>
        <label for="confirm_pass">Confirm Password: </label>
        <input type="password" name="confirm_pass" id="confirm_pass"><br><br>
        <input type="submit" value="Change!">
    </form>

    <?php elseif ($step == 'done'): ?>
        <a href="login.php">Kembali ke login</a>
    <?php endif; ?>
</body>
</html>