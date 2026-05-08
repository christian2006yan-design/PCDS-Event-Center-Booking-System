<?php
session_start();
include 'db.php';

$user = $_SESSION['user'];

// latest booking per user
$res = $conn->query("
    SELECT event_name, status 
    FROM bookings 
    WHERE username='$user'
    ORDER BY id DESC 
    LIMIT 1
");

$data = $res->fetch_assoc();

echo json_encode($data);
?>