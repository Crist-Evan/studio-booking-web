<?php
include 'connection.php'; // file koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username     = $_POST['username'];
    $useremail    = $_POST['useremail'];
    $userphonenumber = $_POST['userphonenumber'];
    $userpass = $_POST['userpass'];
    $userrole     = 'client'; // default role

    // Enkripsi password
    $hashed_password = password_hash($userpass, PASSWORD_DEFAULT);

    // Simpan ke database
    $query = "INSERT INTO users (name, email, number_phone, password, role) VALUES ('$username', '$useremail', '$userphonenumber', '$hashed_password', '$userrole')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Registrasi berhasil!";
        echo "<a href='index.html'>Login Skrg!</a>";
    } else {
        echo "Gagal: " . mysqli_error($conn);
    }
}
?>
