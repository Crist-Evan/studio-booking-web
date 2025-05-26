<?php
    include '../../connection.php';
    $studio_schedule_id = $_GET['studio_schedule_id'];

    $query = "DELETE FROM studio_schedules WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $studio_schedule_id);
    mysqli_stmt_execute($stmt);

    header("Location: manageStudioSchedules.php");
    exit;
?>