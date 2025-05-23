<?php
include 'connection.php'; // sesuaikan dengan file koneksi kamu

// Tangkap data dari parameter GET
$date = $_GET['date'];
$studioId = intval($_GET['studio']); // sebaiknya kirim ID, bukan harga

// Cek input aman
if (!$date || !$studioId) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid parameters']);
    exit;
}

// Ambil data booking dari database
$query = "SELECT start_time, end_time FROM bookings WHERE booking_date = ? AND studio_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("si", $date, $studioId);
$stmt->execute();
$result = $stmt->get_result();

$booked = [];
while ($row = $result->fetch_assoc()) {
    $booked[] = $row;
}

header('Content-Type: application/json');
echo json_encode($booked);
?>
