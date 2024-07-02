<!DOCTYPE html>
<html lang="en">


<!-- login23:11-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Employee Attendance Management System</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css"> 
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style2.css">
  <style>
    body{
        background: rgb(225, 206, 236);
      
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
           
    }
    nav {
        width: 110%;
  position: fixed;
  top: 0;
  left: 0;
  border-radius: 10px;
  z-index: 99;
 
  
}

.navbar {
  max-width: var(--max-width);
  margin: auto;
  padding: 1.5rem 1rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

  </style>
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->

    
</head>
<?php
session_start();
include('includes/connection.php');
if(isset($_REQUEST['login']))
{
    $username = mysqli_real_escape_string($connection,$_REQUEST['username']);
    $pwd = mysqli_real_escape_string($connection,$_REQUEST['pwd']);
    
    $fetch_query = mysqli_query($connection, "select * from tbl_employee where username ='$username' and password = '$pwd' and role=1");
    $res = mysqli_num_rows($fetch_query);
    if($res>0)
    {
        $data = mysqli_fetch_array($fetch_query);
        $name = $data['first_name'].' '.$data['last_name'];
        $role = $data['role'];
        $_SESSION['name'] = $name;
        $_SESSION['role'] = $role;
        header('location:dashboard.php');
    }
    else
    {
        $msg = "Incorrect login details.";
    }
}
?>

<body width="width:100%;">

    <nav class="navbar" style="margin-left: -10px;">
        <a href="#" class="logo">
            <img src="assets/img/tvlogo.png" alt="logo">
            <h2 style="color:black">TimeVista-Admin</h2>
        </a>
        <span></span><span></span>
        <ul class="links" >
            <span id="closeBtn" class="close-btn material-symbols-rounded">close</span>
            <li><a href="index.php" style="color:black">Home</a></li>
            <span></span>
            <li><a href="about.php" style="color:black">About us</a></li>
            <span></span>
            <li><a href="../contact.php" style="color:black">Contact us</a></li>
            <span></span>
            
        </ul>
        <span></span>
    </nav>
    


    <div class="main-wrapper account-wrapper" >
            
			<div class="account-center" >
            
				<div class="account-box" style="border-radius: 20px;margin-top:-150px;">
                
                    <form method="post" class="form-signin">
						<div class="account-logo">
                        <img src="assets/img/tvlogo.png" style="3%">
                            <h3>TimeVista Admin Login</h3>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" autofocus="" class="form-control" name="username" required>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="pwd" required>
                        </div>
                        <span style="color:red;"><?php if(!empty($msg)){ echo $msg; } ?></span>
                        <br>
                        <div class="form-group text-center">
                            <button type="submit" name="login" class="btn btn-primary account-btn">Login</button>
                        </div>
                        
                           <div class="form-group">
                         <a href='../index.php' style="display: block; text-align: center;color:DarkBlue">Login as Employee</a>
                        </div>
                         </div>
                    </form>
                </div>
			</div>
        
    </div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>


<!-- login23:12-->
</html>