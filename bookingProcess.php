<?php
include 'connection.php';

$user_id = $_POST['user_id'];
$studio_id = $_POST['studio_id'];
$date = $_POST['booking_date'];
$start = $_POST['start_time'];
$end = $_POST['end_time'];
$amount = $_POST['total'];

// 1. Insert ke bookings
$booking_query = "INSERT INTO bookings (user_id, studio_id, booking_date, start_time, end_time) VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $booking_query);
mysqli_stmt_bind_param($stmt, 'iisss', $user_id, $studio_id, $date, $start, $end);
$booking_success = mysqli_stmt_execute($stmt);

if ($booking_success) {
    $booking_id = mysqli_insert_id($conn); // ambil ID dari booking yang baru disimpan

    // 2. Insert ke payments
    $payment_query = "INSERT INTO payments (booking_id, amount) VALUES (?, ?)";
    $stmt2 = mysqli_prepare($conn, $payment_query);
    mysqli_stmt_bind_param($stmt2, 'id', $booking_id, $amount);
    $payment_success = mysqli_stmt_execute($stmt2);

    if ($payment_success) {
        echo "✅ Berhasil! Data booking & pembayaran ditambahkan ke database!";
    } else {
        echo "❌ Gagal menyimpan data pembayaran.";
    }
} else {
    echo "❌ Gagal menyimpan data booking.";
}
?>
