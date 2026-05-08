<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user']) || $_SESSION['user']!='admin'){
header("Location: login.php");
exit();
}

$page = $_GET['page'] ?? 'dashboard';

/* EDIT */
$editData=null;
if(isset($_GET['edit'])){
$id=(int)$_GET['edit'];
$editData=$conn->query("SELECT * FROM bookings WHERE id=$id")->fetch_assoc();
}

/* UPDATE */
if(isset($_POST['update_booking'])){
$id=(int)$_POST['id'];

$conn->query("UPDATE bookings SET 
event_name='{$_POST['event_name']}',
course='{$_POST['course']}',
role='{$_POST['role']}',
event_date_start='{$_POST['event_date_start']}',
event_date_end='{$_POST['event_date_end']}',
event_time_start='{$_POST['event_time_start']}',
event_time_end='{$_POST['event_time_end']}'
WHERE id=$id");

header("Location:index.php?page=bookings&msg=updated");
exit();
}

/* COUNTS */
$total=$conn->query("SELECT COUNT(*) t FROM bookings")->fetch_assoc()['t'];
$pending=$conn->query("SELECT COUNT(*) t FROM bookings WHERE status='Pending'")->fetch_assoc()['t'];
$approved=$conn->query("SELECT COUNT(*) t FROM bookings WHERE status='Approved'")->fetch_assoc()['t'];
$completed=$conn->query("SELECT COUNT(*) t FROM bookings WHERE status='Completed'")->fetch_assoc()['t'];

$res=$conn->query("SELECT * FROM bookings ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Panel</title>

<style>
body{
margin:0;
font-family:Segoe UI;
background:#f5f7fb;
display:flex;
}

.sidebar{
width:250px;
background:#0f172a;
color:white;
height:100vh;
padding:20px;
position:fixed;
}

.sidebar img{
width:90px;
height:90px;
object-fit:contain;
display:block;
margin:10px auto;
background:white;
padding:10px;
border-radius:12px;
box-shadow:0 3px 10px rgba(0,0,0,0.4);
}

.sidebar h2{
text-align:center;
margin-top:10px;
font-size:18px;
}

.sidebar a{
display:block;
color:#cbd5e1;
padding:12px;
margin-top:10px;
text-decoration:none;
border-radius:8px;
}

.sidebar a:hover{
background:#1e293b;
color:white;
}
.main{
    margin:20px;
    margin-left:290px; /* para dili matabunan sa sidebar */
    padding:20px;
    width:calc(100% - 310px);
}

/* SUCCESS MESSAGE */
.success{
background:#22c55e;
color:white;
padding:12px;
border-radius:8px;
margin-bottom:15px;
text-align:center;
font-weight:bold;
}

.cards{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
gap:15px;
}

.card{
padding:20px;
border-radius:10px;
color:white;
}

.c1{background:#64748b;}
.c2{background:#64748b;}
.c3{background:#64748b;}
.c4{background:#64748b;}

table{
width:100%;
margin-top:20px;
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
padding:10px;
text-align:center;
border-bottom:1px solid #eee;
}

.btn{
padding:6px 10px;
border:none;
border-radius:6px;
color:white;
cursor:pointer;
font-size:12px;
}

.approve{background:#22c55e;}
.done{background:#3b82f6;}
.edit{background:#f59e0b;}
.delete{background:#ef4444;}

input{
padding:10px;
margin:5px;
border:1px solid #ddd;
border-radius:8px;
width:200px;
}

form{
background:white;
padding:15px;
border-radius:10px;
margin-bottom:15px;
}
</style>
</head>

<body>

<div class="sidebar">
<img src="PCDS.png">
<h2>ADMIN</h2>
<a href="index.php?page=dashboard">Dashboard</a>
<a href="index.php?page=bookings">Bookings</a>
<a href="logout.php">Logout</a>
</div>

<div class="main">

<!-- 🔥 SUCCESS MESSAGE -->
<?php
if(isset($_GET['msg'])){

$msg = $_GET['msg'];

if($msg == "Approved") $text = "Booking Approved Successfully!";
elseif($msg == "Disapproved") $text = "Booking Disapproved!";
elseif($msg == "Completed") $text = "Booking Completed!";
elseif($msg == "updated") $text = "Booking Updated Successfully!";
elseif($msg == "deleted") $text = "Booking Deleted Successfully!";
else $text = "Action Successful!";

echo "<div class='success'>$text</div>";
}
?>

<?php if($page=='dashboard'): ?>

<h2>Dashboard</h2>
<div class="cards">
<div class="card c1">Total <h2><?= $total ?></h2></div>
<div class="card c2">Pending <h2><?= $pending ?></h2></div>
<div class="card c3">Approved <h2><?= $approved ?></h2></div>
<div class="card c4">Completed <h2><?= $completed ?></h2></div>
</div>

<?php else: ?>

<h2>Manage Bookings</h2>

<?php if($editData): ?>
<form method="POST">
<input type="hidden" name="id" value="<?= $editData['id'] ?>">

<input name="event_name" value="<?= $editData['event_name'] ?>" required>
<input name="course" value="<?= $editData['course'] ?>" required>
<input name="role" value="<?= $editData['role'] ?>" required>

<input type="date" name="event_date_start" value="<?= $editData['event_date_start'] ?>" required>
<input type="date" name="event_date_end" value="<?= $editData['event_date_end'] ?>" required>

<input type="time" name="event_time_start" value="<?= $editData['event_time_start'] ?>" required>
<input type="time" name="event_time_end" value="<?= $editData['event_time_end'] ?>" required>



<button name="update_booking" class="btn approve">Save</button>
</form>
<?php endif; ?>

<table>
<tr>
<th>Booking ID</th>
<th>Name</th>
<th>Event</th>
<th>Course</th>
<th>Role</th>
<th>Start</th>
<th>End</th>

<th>Status</th>
<th>Actions</th>
</tr>

<?php while($r=$res->fetch_assoc()): ?>
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
<td><?= $r['course'] ?></td>
<td><?= $r['role'] ?></td>

<td><?= $r['event_date_start'] ?><br><?= date("g:i A", strtotime($r['event_time_start'])) ?></td>
<td><?= $r['event_date_end'] ?><br><?= date("g:i A", strtotime($r['event_time_end'])) ?></td>

<td><?= $r['status'] ?></td>

<td>

<?php if($r['status']=='Pending'): ?>
<a href="status.php?id=<?= $r['id'] ?>&status=Approved"><button class="btn approve">Approve</button></a>
<a href="status.php?id=<?= $r['id'] ?>&status=Disapproved"><button class="btn delete">Disapprove</button></a>
<?php elseif($r['status']=='Approved'): ?>
<a href="status.php?id=<?= $r['id'] ?>&status=Completed"><button class="btn done">Done</button></a>
<?php endif; ?>

<a href="index.php?page=bookings&edit=<?= $r['id'] ?>"><button class="btn edit">Edit</button></a>
<a href="delete.php?id=<?= $r['id'] ?>" class="deleteBtn">
    <button class="btn delete">Delete</button>
</a>

</td>

</tr>
<?php endwhile; ?>

</table>

<?php endif; ?>

</div>
<!-- CUSTOM DELETE MODAL -->
<div id="modal" style="
display:none;
position:fixed;
top:0;left:0;
width:100%;height:100%;
background:rgba(0,0,0,0.5);
justify-content:center;
align-items:center;
">

<div style="
background:white;
padding:20px;
border-radius:10px;
text-align:center;
width:300px;
">

<h3>Are you sure?</h3>
<p>you want to delete this booking?</p>

<button id="yesBtn" style="
background:red;
color:white;
padding:8px 12px;
border:none;
border-radius:6px;
cursor:pointer;
">
Delete
</button>

<button onclick="closeModal()" style="
margin-left:10px;
padding:8px 12px;
border:none;
border-radius:6px;
cursor:pointer;
">
Cancel
</button>

</div>
</div>
<script>
let deleteUrl = "";

// click delete button
document.querySelectorAll('.deleteBtn').forEach(btn=>{
    btn.addEventListener('click', function(e){
        e.preventDefault();
        deleteUrl = this.href;
        document.getElementById('modal').style.display = "flex";
    });
});

// confirm delete
document.getElementById('yesBtn').onclick = function(){
    window.location.href = deleteUrl;
}

// close modal
function closeModal(){
    document.getElementById('modal').style.display = "none";
}
</script>
</body>
</html>