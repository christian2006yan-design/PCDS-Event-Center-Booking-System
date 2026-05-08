<?php
include 'db.php';

$id = (int)$_GET['id'];

if($id > 0){
    $conn->query("DELETE FROM bookings WHERE id=$id");

    header("Location: index.php?page=bookings&msg=deleted");
    exit();
}else{
    header("Location: index.php?page=bookings&msg=error");
    exit();
}
?>