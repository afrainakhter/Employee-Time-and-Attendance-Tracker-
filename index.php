<!DOCTYPE html>
<html lang="en">


<!-- login23:11-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Employee Attendance Management System</title>
 
    <link rel="stylesheet" href="stylebeforelogin.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css"
      rel="stylesheet" />
   

  
</head>


<?php
session_start();
include('includes/connection.php');

if (isset($_REQUEST['login'])) {

    $username = mysqli_real_escape_string($connection, $_REQUEST['username']);
    $password = mysqli_real_escape_string($connection, $_REQUEST['pwd']);

    // Fetch user data by username
    $fetch_query = mysqli_query($connection, "SELECT * FROM tbl_employee WHERE username ='$username' AND role=0");
    $res = mysqli_num_rows($fetch_query);

    if ($res > 0) {
        $data = mysqli_fetch_array($fetch_query);
        
        // Verify the password
        if ($password === $data['password']) {
            // Successful login with initial password, prompt for password reset
            $_SESSION['employee_id'] = $data['id'];
            header('location: reset_password_form.php');
            exit();
        } elseif (password_verify($password, $data['password'])) {
            // Password already hashed, proceed with login
            $name = $data['first_name'] . ' ' . $data['last_name'];
            $role = $data['role'];
            $id = $data['id'];

            $_SESSION['name'] = $name;
            $_SESSION['role'] = $role;
            $_SESSION['id'] = $id;

            // Check if the user needs to reset their password
            if ($data['password_reset'] == 0) {
                // Redirect to the password reset page
                header('location: reset_password_form.php');
                exit(); // Ensure no further code execution after the redirect
            } else {
                // Proceed to the profile page
                header('location: profile.php');
                exit(); // Ensure no further code execution after the redirect
            }
        } else {
            // Incorrect password
            $msg = "Incorrect login details.";
        }
    } else {
        // User not found
        $msg = "Incorrect login details.";
    }
}
?>


<body style="width: 100%;">


<nav >
      <div class="nav_content">
        <div class="logo"><a href="#index.php">TimeVista</a></div>
         <label for="check" class="checkbox"><i class="ri-menu-line"></i></label>
        <input type="checkbox" name="check" id="check" />
        
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="contact.php">Contact</a></li>

          <li><a href="#login">Login</a></li>
         </ul>
      </div>
    </nav>
    
    <style>
        div .content{
            
            margin-left: 15rem;
        }

    </style>



    <div class="container">
      <div class="content">
    <div class="image">
    <img src="assets/img/employeebg.jpg" alt="img">
    </div>
    <div class="login-box" id="login">
      <img src="assets/img/tvlogo.png" />
      <h2>Employee Login</h2>
      <form method="post">
        <input type="text" name="username" placeholder="Username" />
        <input type="password" name="pwd" placeholder="Password" />
        <button type="submit" name="login">Sign In</button>
      </form>
      <br />
     

            <a href='admin' style="color:black;">Login as Admin</a>
      </div>
    </div>
    </div>
</div>




</body>



</html>