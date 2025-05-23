<?php
    include 'connection.php';

    $user_id = $_POST['user_id'];
    $studio_id = $_POST['studio_id'];
    $date = $_POST['booking_date'];
    $start = $_POST['start_time'];
    $end = $_POST['end_time'];

    $query = "INSERT INTO bookings (user_id, studio_id, booking_date, start_time, end_time) VALUES ('$user_id', '$studio_id', '$date', '$start', '$end')";
    $result = mysqli_query($conn, $query);

    echo "berhasil! data booking ditambahkan ke database!";
?>