<?php
include 'connection.php'; // sesuaikan dengan file koneksi kamu

// Tangkap data dari parameter GET
$date = $_GET['date'];
$studioId = intval($_GET['studio_id']);
$status = 'cancelled';

// Cek input aman
if (!$date || !$studioId) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid parameters']);
    exit;
}

// Ambil data booking dari database
$query = "SELECT start_time, end_time FROM bookings WHERE booking_date = ? AND studio_id = ? AND status != ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "sis", $date, $studioId, $status);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$booked = [];
while ($row = mysqli_fetch_assoc($result)) {
    $booked[] = $row;
}

header('Content-Type: application/json');
echo json_encode($booked);
?>
