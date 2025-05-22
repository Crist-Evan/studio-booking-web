<?php
    include 'connection.php';

    $start = $_POST['start_time'];
    $end = $_POST['end_time'];
    $date = $_POST['booking_date'];
    $studio = $_POST['studio'];

    $start_time = DateTime::createFromFormat('H:i', $start);
    $end_time = DateTime::createFromFormat('H:i', $end);
    $duration = $start_time->diff($end_time);
    $in_min = ($duration->h * 60) + $duration->i;
    $in_hour = intval($in_min / 60);

    echo $start;
    echo '<br>';
    echo $end;
    echo '<br>';
    echo $date;
    echo '<br>';
    echo $studio;
    echo '<br>';
    echo $in_hour;
    echo '<br>';
    echo $studio * $in_hour;
?>