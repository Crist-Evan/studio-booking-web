<?php
    include '../../connection.php';
    $studio_id = $_GET['studio_id'];

    $query = "DELETE FROM studios WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $studio_id);
    mysqli_stmt_execute($stmt);

    header("Location: manageStudios.php");
    exit;
?>