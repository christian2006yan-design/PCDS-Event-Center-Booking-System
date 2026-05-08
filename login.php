<?php
session_start();
include 'db.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$error = "";

if(isset($_POST['login'])){

    $u = trim($_POST['username']);
    $p = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $u);
    $stmt->execute();
    $res = $stmt->get_result();

    if($res->num_rows === 1){

        $row = $res->fetch_assoc();

        $db_pass = $row['password'];

        // 🔥 FIX: SUPPORT HASHED + PLAIN
        if(password_verify($p, $db_pass) || $p === $db_pass){

            $_SESSION['user'] = $row['username'];

            if(strtolower($row['username']) === "admin"){
                header("Location: index.php");
                exit();
            } else {
                header("Location: guest.php");
                exit();
            }

        } else {
            $error = "Invalid username or password";
        }

    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>

<style>
body{
margin:0;
font-family:Segoe UI;
background:
linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
url('Poly.png');
background-size:cover;
background-position:center;
background-repeat:no-repeat;
height:100vh;
display:flex;
justify-content:center;
align-items:center;
}


.box{
    width:600px;
    background:white;
    padding:30px;
    border-radius:15px;
    text-align:center;
    box-shadow:0 10px 30px rgba(0,0,0,0.3);
}

.logo{
width:90px;
margin-bottom:10px;
}

h2{
margin:10px 0;
color:#0f172a;
}

input{
    width:100%;
    padding:12px;
    margin:10px 0;
    border:1px solid #ddd;
    border-radius:8px;
    font-size:14px;
    box-sizing:border-box;
}

button{
    width:100%;
    padding:12px;
    margin-top:10px;
    background:#1f3b73;
    color:white;
    border:none;
    border-radius:8px;
    font-size:15px;
    cursor:pointer;
}

button:hover{
background:#2e5aa7;
}

.error{
color:white;
background:#ef4444;
padding:10px;
border-radius:8px;
margin-bottom:10px;
}

.link-btn{
    background:#64748b;
}

.link-btn:hover{
    background:#475569;
}
</style>
</head>

<body>

<div class="box">

<img src="PCDS.png" class="logo">

<h2>PCDS EVENT CENTER</h2>

<?php if($error) echo "<div class='error'>$error</div>"; ?>

<form method="POST">

<input type="text" name="username" placeholder="Username" required>

<input type="password" name="password" placeholder="Password" required>

<button type="submit" name="login">Login</button>

</form>

<a href="register.php">
    <button type="button" class="link-btn">Create Account</button>
</a>

</div>

</body>
</html>