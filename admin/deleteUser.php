<?php
    include '../connection.php';
    $user_id = $_GET['user_id'];

    $query = "DELETE FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $user_id);
    mysqli_stmt_execute($stmt);

    header("Location: manageUsers.php");
    exit;
?>