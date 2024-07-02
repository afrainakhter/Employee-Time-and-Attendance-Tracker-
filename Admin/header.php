<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Employee Attendance Management System</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/8ee0e83968.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    
</head>

<body>
    <style>
        body{
                background-color:#bec6d8;
        }
        span{
                color: black;
                 
                
            }
            li a span{
                    color: white;
                }
            .sidebar-inner,.activee{
                background-color: black;
            }
            .activee:hover{
                background-color: darkolivegreen;
            }
            
           #MngLv{
                color: black;

            } 
            .main-wrapper,.header{
                background-color: #040216;
            }


        </style>

    <div class="main-wrapper">
        <div class="header">
			<div class="header-left">
                <a href="dashboard.php" class="logo">
                    <img src="../assets/img/tvlogo.png" width="30" alt="Admin">
                           <span>TimeVista</span>
                </a>
            </div>
			<a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
                   <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img">
							<img class="rounded-circle" src="assets/img/user.jpg" width="24" alt="Admin">
							<span class="status online"></span>
						</span>
                        <span>Admin</span>
                    </a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="logout.php">Logout</a>
					</div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    
                    <ul>
                        
                        <li class="activee">
                            <a href="dashboard.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                        </li>
                        <li class="activee">
                            <a href="employees.php"><i class="fa fa-user"></i> <span>Employees</span></a>
                        </li>
                        <li class="activee">
                            <a href="departments.php"><i class="fa fa-hospital-o"></i> <span>Departments</span></a>
                        </li>
						                   
                        <li class="activee">
                            <a href="shift.php"><i class="fa fa-calendar"></i> <span>Shift</span></a>
                        </li>
                        <li class="activee">
                            <a href="location.php"><i class="fa fa-map-marker"></i> <span>Location</span></a>
                        </li>
                    	<li class="activee">
                        <a href="report.php"><i class="fa fa-file-o"></i> <span>Attendance</span></a>
                        </li>
                        <li class="activee">
                        <a href="leave-section.php"><i class="fa-solid fa-newspaper"></i> <span>Leave Types</span></a>
                        </li>
                        
                    
                        <li class="activee">
                <a ><i class="fa-solid fa-hammer"></i><span>Manage Leave</span></a>

                             <!-- <ul class="collapsee" id="MngLv">
                                 <li><a href="pending-history.php"><i class="fa fa-spinner" id="MngLv"></i><span id="MngLv"> Pending</span></a></li>
                                <li><a href="pending-approve.php"><i class="fa fa-check" id="MngLv"></i> <span id="MngLv">Approved</span></a></li>
                                <li><a href="declined-history.php"><i class="fa fa-times-circle" id="MngLv"></i> <span id="MngLv">Declined</span></a></li>
                                 <li><a href="leave-history.php"><i class="fa fa-history" id="MngLv"></i> <span id="MngLv">Leave History</span></a></li>
                             </ul> -->

                             <ul class="collapsee" id="MngLv">
                                 <li><a href=""><i class="fa fa-spinner" id="MngLv"></i><span id="MngLv"> Pending</span></a></li>
                                <li><a href=""><i class="fa fa-check" id="MngLv"></i> <span id="MngLv">Approved</span></a></li>
                                <li><a href=""><i class="fa fa-times-circle" id="MngLv"></i> <span id="MngLv">Declined</span></a></li>
                                 <li><a href=""><i class="fa fa-history" id="MngLv"></i> <span id="MngLv">Leave History</span></a></li>
                             </ul>
            
            
                        </li>
                        			                       
                    </ul>
                
                </div>
            </div>
      </div>
</div>
