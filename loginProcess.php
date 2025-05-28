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

    if ($userpass === $user['password'] or $user && password_verify($userpass, $user['password'])){
        // Simpan data ke session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['name'];
        $_SESSION['useremail'] = $user['email'];
        $_SESSION['userphonenumber'] = $user['number_phone'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['message'] = "Login berhasil. Selamat datang " . $user['name'];

        if ($_SESSION['role'] !== 'admin') {
            header("Location: user/userDashboard.php");
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
