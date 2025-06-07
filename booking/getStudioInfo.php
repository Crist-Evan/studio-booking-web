<?php
include '../connection.php';

if (isset($_GET['studio_id'])) {
    $studio_id = $_GET['studio_id'];

    $stmt = mysqli_prepare($conn, "SELECT location, description FROM studios WHERE id = ?");
    mysqli_stmt_bind_param($stmt, 'i', $studio_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $studio = mysqli_fetch_assoc($result);

    echo json_encode($studio);
}
?>
