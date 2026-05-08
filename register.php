    <?php
    include 'db.php';

    $error = "";
    $success = "";

    if(isset($_POST['register'])){
        $u = trim($_POST['username']);
        $p = $_POST['password'];

        $check = $conn->query("SELECT * FROM users WHERE username='$u'");

        if($check->num_rows > 0){
            $error = "Username already exists!";
        } else {

            // secure password
            $hashed = password_hash($p, PASSWORD_DEFAULT);

            if($conn->query("INSERT INTO users(username,password) VALUES('$u','$hashed')")){
                $success = "Account created successfully!";
            } else {
                $error = "Something went wrong. Please try again.";
            }
        }
    }
    ?>

    <!DOCTYPE html>
    <html>
    <head>
    <title>Register</title>

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

    input:focus{
    outline:none;
    border-color:#1f3b73;
    }

    /* =======================
    UNIFIED BUTTON STYLE
    ======================= */
    button,
    .btn-link{
    width:100%;
    display:block;
    padding:12px;
    margin-top:10px;
    border-radius:8px;
    font-size:15px;
    cursor:pointer;
    box-sizing:border-box;
    text-align:center;
    }

    /* MAIN BUTTON */
    button{
    background:#1f3b73;
    color:white;
    border:none;
    }

    button:hover{
    background:#2e5aa7;
    }

    /* LINK BUTTON */
    .btn-link{
    background:#64748b;
    color:white;
    text-decoration:none;
    border:none;
    }

    .btn-link:hover{
    background:#64748b;
    }

    /* ERROR BOX */
    .error{
    color:white;
    background:#ef4444;
    padding:10px;
    border-radius:8px;
    margin-bottom:10px;
    font-size:14px;
}
    .success{
color:white;
background:#22c55e;
padding:10px;
border-radius:8px;
margin-bottom:10px;
font-size:14px;
    }
.toast{
position:fixed;
top:20px;
right:20px;
background:#22c55e;
color:white;
padding:15px 20px;
border-radius:10px;
box-shadow:0 5px 15px rgba(0,0,0,0.2);
font-size:14px;
opacity:0;
transform:translateY(-20px);
transition:0.4s;
z-index:999;
}

.toast.show{
opacity:1;
transform:translateY(0);
}

    
    </style>
    </head>

    <body>

    <div class="box">

    <img src="PCDS.png" class="logo">

    <h2>PCDS EVENT CENTER</h2>


   <?php if($error) echo "<div class='error'>$error</div>"; ?>
<?php if($success) echo "<div id='toast' class='toast'>$success</div>"; ?>
    <form method="POST">

    <input type="text" name="username" placeholder="Username" required>

    <input type="password" name="password" placeholder="Password" required>

    <button type="submit" name="register">Create Account</button>

    </form>

    <a href="login.php" class="btn-link">Back to Login</a>

    </div>
    
    </body>
    <script id="1r7x5a">
window.onload = function(){
    var toast = document.getElementById("toast");
    if(toast){
        toast.classList.add("show");

        setTimeout(function(){
            toast.classList.remove("show");
        }, 3000); // mawawala after 3 seconds
    }
}
</script>
    </html>