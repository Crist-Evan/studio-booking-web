<?php
include '../connection.php';

if (isset($_GET['studio_id'])) {
    $studio_id = $_GET['studio_id'];

    // Pastikan studio-nya tersedia/aktif (is_available = TRUE)
    $studio_check = mysqli_prepare($conn, "SELECT is_available FROM studios WHERE id = ?");
    mysqli_stmt_bind_param($studio_check, 'i', $studio_id);
    mysqli_stmt_execute($studio_check);
    $studio_result = mysqli_stmt_get_result($studio_check);
    $studio_data = mysqli_fetch_assoc($studio_result);

    if (!$studio_data || !$studio_data['is_available']) {
        // Studio tidak aktif / tidak ditemukan
        echo json_encode(['error' => 'Studio tidak tersedia']);
        exit;
    }

    // Ambil semua jadwal studio dari studio_schedules
    $query = "SELECT day_of_week, open_time, close_time 
              FROM studio_schedules 
              WHERE studio_id = ? 
              ORDER BY FIELD(day_of_week, 'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'), open_time";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $studio_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $schedule = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $day = $row['day_of_week'];
        $schedule[$day][] = [
            'open' => substr($row['open_time'], 0, 5),   // Format HH:MM
            'close' => substr($row['close_time'], 0, 5)
        ];
    }

    echo json_encode($schedule);
}
?>
