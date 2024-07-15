<?php

session_start();
if(empty($_SESSION['name']))
{
    header('location:index.php');
}

include('header.php');

include('includes/connection.php');

// $id = $_SESSION['id'];
// $fetch_query = mysqli_query($connection, "SELECT tblleaves.FromDate,tblleaves.ToDate
//  FROM tblleaves
//  JOIN tbl_employee ON tblleaves.employee_id = tbl_employee.id
//  WHERE tblleaves.Status IN (0, 1) AND tbl_employee.id = $id order by tblleaves.FromDate desc");

//  $res = mysqli_fetch_array($fetch_query);
// $lasttoDate = strtotime($res['toDate']);
//  $lastfromdate=strtotime($res['fromDate']);

//   if( $lastfromdate < strtotime($_SESSION['fromdate']) && strtotime($lasttoDate< $_SESSION['todate'])){
    if(isset($_POST['apply']))
    {
        
        $employee_id =  $_SESSION['id'];
        $LeaveType=$_POST['LeaveType'];
        $fromdate=$_POST['fromdate'];  
        $todate=$_POST['todate'];
        $description=$_POST['description'];  
        $status=0;
        $isread=0;

        $fromTimestamp = strtotime($_POST['fromdate']);
        $toTimestamp = strtotime($_POST['todate']);


$_SESSION['fromTimestamp'] = $fromTimestamp;
$_SESSION['toTimestamp'] = $toTimestamp;


if(isset($fromTimestamp) && isset($toTimestamp)) {
    $diffInSeconds = $toTimestamp - $fromTimestamp;
    $diffInDays = floor($diffInSeconds / (60 * 60 * 24));  
}
        if ( $fromdate>$todate){
            $error=" Please enter correct details: End Data should be ahead of Starting Date in order to be valid! ";
            }else{
                $insert_query = mysqli_query($connection, "INSERT INTO tblleaves set LeaveType='$LeaveType',ToDate='$todate',FromDate='$fromdate',duration='$diffInDays',Description='$description',Status='$status',IsRead='$isread',employee_id='$employee_id'");  
            }

    

      if( $insert_query>0)
      {
          $msg = "Your Leave Application has been requested,Thank you";
          $durnotif = '   Leave Duration: ' . $diffInDays . ' Days';
          
      }
      else
      {
          $msg = "Error!". $error ." ";
          
      }
    }
// }else{
//     $msg= "You already have a Leave pending/ongoing! You Can't request for more";
// }
?>

<!DOCTYPE HTML>
<HTML>
    <head>
        <style>
            #apply{
               
                background-color: green;
                style="display: inline-block;
                align-items: center;
                margin-top: 36px;
                width: 60%;
                height: 50px;
                
                
            }
            #apply:hover{
                    color: white;
                    background-color: darkgreen;
            }
            textarea{
                width: 100%;
            }
            #rqlv{
                padding: 20px;
                background-color: rgb(206, 204, 204);
            }
        </style>
    </head>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-4 ">
                        <h4 class="page-title">Leave Application</h4>
                         
                    </div>
                    <div class="col-sm-8  text-right m-b-20">
                        <a href="profile.php" class="btn btn-primary btn-rounded float-right">Back</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                    <form name="addemp" id="rqlv" method="POST">
                            <div class="row">
                                

                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Employee ID: <span class="text-danger">*</span></label>
                                        <a>
    <?php
    if (!empty($_SESSION['id'])) {
        $emp = $_SESSION['id'];
        $empid_query = mysqli_query($connection, "SELECT employee_id FROM tbl_employee WHERE id = $emp");
        if ($empid_query) {
            $empid_row = mysqli_fetch_assoc($empid_query);
            $empid = $empid_row['employee_id'];
            ?>
            <h1 style="background-color: white;"><?php echo $empid; ?></h1>
            <?php
        } else {
            // Error Hole
            echo "Error: " . mysqli_error($connection);
        }
    }
    ?>
</a>

                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Choose Leave type <span class="text-danger">*</span></label>
                                        <select class="select" name="LeaveType" required>
                                            <option value="">Select</option>
                                            <?php
                                             $fetch_query = mysqli_query($connection, "select LeaveType from tblleavetype");
                                                while($lev = mysqli_fetch_array($fetch_query)){ 
                                            ?>
                                            <option value="<?php echo $lev['LeaveType']; ?>"><?php echo $lev['LeaveType']; ?></option>
                                            <?php } ?>
                                            
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                <div class="form-group">
                                            <label for="example-date-input" class="col-form-label">Starting Date</label>
                                            <input class="form-control" type="date" value="0000-00-00" data-inputmask="'alias': 'date'" required id="example-date-input" name="fromdate">
                                        </div>
                                </div>
                                
                                
                                <div class="col-sm-6">
                                <div class="form-group">
                                            <label for="example-date-input" class="col-form-label">End Date</label>
                                            <input class="form-control" type="date" value="0000-00-00" data-inputmask="'alias': 'date'" required id="example-date-input" name="todate">
                                            
                                        </div>
                                </div>
                               <?php 
                               
                               ?>
                                <div class="col-sm-6">
                                <div class="form-group">
                                            <label for="example-text-input" class="col-form-label">Describe Your Conditions</label>
                                            <textarea class="form-control" name="description" type="text" name="description" length="400" id="example-text-input" rows="5"></textarea>
                                        </div>
                                </div>
                               
                                <div class="col-sm-7">
                                <div class="form-group">
                                <button class="btn btn-primary" name="apply" id="apply" type="submit" >APPLY</button>     
                                </div>
                                </div>
                    </div>
                            
                        </form>
                        
                    </div>
                </div>
            </div>
		</div>
    
<?php
    include('footer.php');
    
  


?>

<script type="text/javascript">
     <?php
        if(isset($msg) && isset($durnotif)) {
            echo 'swal("' . $msg. $durnotif.  '");';
            

        }else{
            echo 'swal("' . $error. '");';
        }
       

    ?>
</script>