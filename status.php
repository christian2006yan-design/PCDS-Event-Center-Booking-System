<?php
include 'db.php';

$id = (int)$_GET['id'];
$status = $_GET['status'];

if($id > 0 && $status != ''){

    $stmt = $conn->prepare("UPDATE bookings SET status=? WHERE id=?");
    $stmt->bind_param("si", $status, $id);
    $stmt->execute();

    header("Location: index.php?page=bookings&msg=$status");
    exit();

} else {
    header("Location: index.php?page=bookings&msg=error");
    exit();
}
?>