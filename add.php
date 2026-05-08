<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: guest.php");
    exit();
}

$booked_by = $_POST['booked_by'];
$event_name = $_POST['event_name'];
$event_date_start = $_POST['event_date_start'];
$event_time_start = $_POST['event_time_start'];
$event_date_end = $_POST['event_date_end'];
$event_time_end = $_POST['event_time_end'];
$course = $_POST['course'];
$role = $_POST['role'];

$status = "Pending";

/* 🔥 CONVERT TO UNIX TIME */
$newStart = strtotime($event_date_start . ' ' . $event_time_start);
$newEnd   = strtotime($event_date_end . ' ' . $event_time_end);

/* ❗ VALIDATION */
if ($newEnd <= $newStart) {
    header("Location: guest.php?error=invalidtime");
    exit();
}

/* 🚨 CHECK CONFLICT */
$res = $conn->query("SELECT * FROM bookings");

while ($row = $res->fetch_assoc()) {

    $existingStart = strtotime($row['event_date_start'] . ' ' . $row['event_time_start']);
    $existingEnd   = strtotime($row['event_date_end'] . ' ' . $row['event_time_end']);

    if ($newStart < $existingEnd && $newEnd > $existingStart) {

        header("Location: guest.php?error=conflict");
        exit();
    }
}


/* =====================================
   🔥 GENERATE BOOKING ID
===================================== */

$getLast = $conn->query("SELECT booking_id FROM bookings ORDER BY id DESC LIMIT 1");

if($getLast->num_rows > 0){

    $lastRow = $getLast->fetch_assoc();

    $lastID = intval(str_replace("PCDS-", "", $lastRow['booking_id']));

    $number = str_pad($lastID + 1, 3, "0", STR_PAD_LEFT);

    $booking_id = "PCDS-" . $number;

}else{

    $booking_id = "PCDS-001";
}


/* ✅ INSERT BOOKING */
$stmt = $conn->prepare("
    INSERT INTO bookings
    (
        booking_id,
        booked_by,
        event_name,
        event_date_start,
        event_time_start,
        event_date_end,
        event_time_end,
        course,
        role,
        status
    )
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");

$stmt->bind_param(
    "ssssssssss",
    $booking_id,
    $booked_by,
    $event_name,
    $event_date_start,
    $event_time_start,
    $event_date_end,
    $event_time_end,
    $course,
    $role,
    $status
);

$stmt->execute();

/* SUCCESS */
header("Location: guest.php?success=$booking_id");
exit();
?>