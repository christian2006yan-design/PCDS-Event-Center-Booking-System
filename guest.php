<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>PCDS Booking</title>

<style>
body{
    margin:0;
    font-family:Segoe UI;
    background:#f4f6fb;
}

.header{
    background:#0f172a;
    color:white;
    padding:12px 25px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.header-left{
    display:flex;
    align-items:center;
    gap:15px;
}

.logo{
    width:55px;
    height:55px;
    background:white;
    padding:5px;
    border-radius:10px;
}

.container{
    padding:20px;
    max-width:1000px;
    margin:auto;
}

.card{
    background:white;
    padding:20px;
    border-radius:10px;
    margin-bottom:20px;
}

.row{
    display:flex;
    gap:10px;
}

.row input{
    width:100%;
}

form input, form select{
    width:100%;
    padding:12px;
    margin-bottom:12px;
    border-radius:8px;
    border:1px solid #ddd;
    box-sizing:border-box;
}

form button{
    width:100%;
    padding:12px;
    background:#2c4373;
    color:white;
    border:none;
    border-radius:8px;
    cursor:pointer;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:10px;
    overflow:hidden;
}

th{
    background:#0f172a;
    color:white;
    padding:12px;
}

td{
    text-align:center;
    padding:12px;
    border-bottom:1px solid #eee;
}

.badge{
    background:red;
    color:white;
    padding:4px 8px;
    border-radius:5px;
    font-size:12px;
    
}
label{
    font-size:12px;
    font-weight:500;
    color:#475569;
    margin-bottom:3px;
    display:block;
}
</style>
</head>

<body>

<div class="header">
    <div class="header-left">
        <img src="PCDS.png" class="logo">
        <b>PCDS Event Center</b>
    </div>
    <a href="logout.php" style="color:white;">Logout</a>
</div>

<div class="container">

<!-- ✅ MESSAGE BOX (NO POPUP) -->
<?php if (isset($_GET['error']) && $_GET['error'] == 'conflict') { ?>
    <div style="
        background:#ffe5e5;
        color:#a30000;
        padding:12px;
        margin-bottom:15px;
        border-left:5px solid red;
        border-radius:8px;
    ">
        ❌ Conflict! .
    </div>
<?php } ?>

<?php if (isset($_GET['success'])) { ?>
    <div style="
        background:#e6ffe6;
        color:#006600;
        padding:12px;
        margin-bottom:15px;
        border-left:5px solid green;
        border-radius:8px;
    ">
        ✅ Booking Successful!
<br><br>
Your Booking ID:
<b><?= $_GET['success'] ?></b>
    </div>
<?php } ?>

<!-- FORM -->
<div class="card">
<h3>Create Booking</h3>

<form action="add.php" method="POST">

<input name="event_name" placeholder="Event Name" required>
<input name="booked_by" placeholder="Full Name" required>

<div class="row">

    <!-- START -->
    <div style="flex:1;">
        <label><b>Start</b></label>
        <input type="date" name="event_date_start" required>
        <input type="time" name="event_time_start" required>
    </div>

    <!-- END -->
    <div style="flex:1;">
        <label><b>End</b></label>
        <input type="date" name="event_date_end" required>
        <input type="time" name="event_time_end" required>
    </div>

</div>

<select name="course">
<option>BSIT</option>
<option>BSCRIM</option>
<option>BSHM</option>
<option>BSN</option>
<option>BSRT</option>
</select>

<select name="role">
<option>Student</option>
<option>Teacher</option>
</select>

<button>Book Now</button>

</form>
</div>

<!-- TABLE -->
<table>

<tr>
<th>Booking ID</th>
<th>Booked By</th>
<th>Event</th>
<th>Start</th>
<th>End</th>
<th>Role</th>
<th>Status</th>
</tr>

<?php
$res = $conn->query("SELECT * FROM bookings ORDER BY id DESC");

while($r=$res->fetch_assoc()):

$start = date("Y-m-d H:i", strtotime($r['event_date_start'].' '.$r['event_time_start']));
$end   = date("Y-m-d H:i", strtotime($r['event_date_end'].' '.$r['event_time_end']));
?>

<tr>
<td>
    <span style="
        background:#0f172a;
        color:white;
        padding:5px 10px;
        border-radius:20px;
        font-size:12px;
        font-weight:bold;
        letter-spacing:1px;
    ">
        <?= $r['booking_id'] ?>
    </span>
</td>

<td><?= $r['booked_by'] ?></td>
<td><?= $r['event_name'] ?></td>
<td><?= $start ?></td>
<td><?= $end ?></td>
<td><?= $r['role'] ?></td>
<td style="display:flex; justify-content:center; align-items:center; gap:8px;">

    <span style="
        padding:4px 8px;
        border-radius:5px;
        font-size:12px;
        background:#e2e8f0;
    ">
        <?= $r['status'] ?>
    </span>
<button onclick="deleteBooking(<?= $r['id'] ?>)" 
style="
    background:#ef4444;
    color:white;
    border:none;
    padding:5px 8px;
    border-radius:6px;
    cursor:pointer;
    font-size:12px;
">
Delete
</button>

    </a>

</td>
</tr>

<?php endwhile; ?>

</table>
<script>
function deleteBooking(id){

    if(confirm('Delete this booking?')){

        fetch("delete.php?id=" + id)
        .then(res => res.text())
        .then(data => {

            if(data == "deleted"){
                location.reload(); // stay same page
            }

        });

    }

}
</script>
</div>
</body>
</html>