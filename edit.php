<?php
include 'db.php';

$id = $_GET['id'];
$row = $conn->query("SELECT * FROM bookings WHERE id=$id")->fetch_assoc();

if (isset($_POST['update'])) {

    $conn->query("UPDATE bookings SET
    event_name='{$_POST['event_name']}',
    event_date='{$_POST['event_date']}',
    event_time='{$_POST['event_time']}',
    guests='{$_POST['guests']}'
    WHERE id=$id");

    header("Location: index.php");
}
?>

<h2>Edit Booking</h2>

<form method="POST">
<input name="event_name" value="<?= $row['event_name'] ?>"><br>
<input type="date" name="event_date" value="<?= $row['event_date'] ?>"><br>
<input type="time" name="event_time" value="<?= $row['event_time'] ?>"><br>
<input name="guests" value="<?= $row['guests'] ?>"><br>
<button name="update">Update</button>
</form>