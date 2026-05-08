<?php
include 'db.php';

$d=$_POST['date'];
$t=$_POST['time'];

$q=$conn->query("SELECT * FROM bookings WHERE event_date='$d' AND event_time='$t'");

echo ($q->num_rows>0)?"taken":"available";
?>