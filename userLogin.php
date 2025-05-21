<?php
session_start();
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $userpass = $_POST['userpass'];

    $query = "SELECT * FROM users WHERE name = '$username'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($userpass === $user['password'] or $user && password_verify($userpass, $user['password'])){
        // Simpan data ke session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['name'];
        $_SESSION['useremail'] = $user['email'];
        $_SESSION['userphonenumber'] = $user['number_phone'];
        $_SESSION['role'] = $user['role'];

        echo "Login berhasil. Selamat datang " . $user['name'];
        echo "<br><a href='bookingForm.php'>Booking Now!</a>";
        // redirect ke halaman dashboard
    } else {
        echo "Email atau password salah!";
        echo "<br>Name: $username<br>";
        echo "Password: $userpass<br>";

    }
}
?>
