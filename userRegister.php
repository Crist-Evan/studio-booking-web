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
        header("Location: index.html");
        exit;
    } else {
        echo "Register gagal: " . mysqli_error($conn);
    }
}
?>