<?php
    include 'connection.php'; // file koneksi ke database

    $username = 'admin';
    $useremail = 'admin@admin.com';
    $userphonenumber = '0813295802';
    $userpass = 'admin123';
    $userrole = 'admin';

    // Enkripsi password
    $hashed_password = password_hash($userpass, PASSWORD_DEFAULT);

    // Simpan ke database
    $query = "INSERT INTO users (name, email, number_phone, password, role) VALUES ('$username', '$useremail', '$userphonenumber', '$hashed_password', '$userrole')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Registrasi berhasil!";
        header("Location: ../login.php");
        exit;
    } else {
        echo "Gagal: " . mysqli_error($conn);
    }
?>
