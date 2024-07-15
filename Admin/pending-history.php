<?php
session_start();

if (empty($_SESSION['name'])) {
    header('location:index.php');
}

include('header.php');
include('includes/connection.php');

if (isset($_GET['ids'])) {
    $id = $_GET['ids'];
    $delete_query = mysqli_query($connection, "DELETE FROM tblleaves WHERE Lid='$id'");
    
}

if (isset($_POST['approve'])) {
    if (isset($_POST['approve_lid'])) {
        $id = $_POST['approve_lid'];
        $updateQuery = "UPDATE tblleaves SET Status = 1 WHERE Lid = $id";
        mysqli_query($connection, $updateQuery);

        //ekhane leave ta te je employee id ase ota niye aschi
        $fetchEmployeeIDQuery = mysqli_query($connection, "SELECT employee_id FROM tblleaves WHERE Lid = $id");
        $fetchEmployeeIDRow = mysqli_fetch_assoc($fetchEmployeeIDQuery);
        $employeeID = $fetchEmployeeIDRow['employee_id'];

        //Ekhane leave er duration ta variable e rakhtesi 
        $fetchdurationQuery = mysqli_query($connection, "SELECT duration FROM tblleaves WHERE Lid = $id");
        $fetchdurationRow = mysqli_fetch_assoc($fetchdurationQuery);
        $duration = $fetchdurationRow['duration'];

        // employee table er LeaveRemainingThisYear (Lrty) er value niye aschi
        $fetchLrtyQuery = mysqli_query($connection, "SELECT Lrty FROM tbl_employee WHERE id = $employeeID");
        $fetchLrtyRow = mysqli_fetch_assoc($fetchLrtyQuery);
        $currentLrty = $fetchLrtyRow['Lrty'];

        //Lrty Update kore employee table update kortesi 
        if ($currentLrty > 0 && $duration < $currentLrty) {
            $updatedLrty = $currentLrty - $duration;
            $updatedLrty = ($updatedLrty < 0) ? 0 : $updatedLrty;

            $updateLrtyQuery = mysqli_query($connection, "UPDATE tbl_employee SET Lrty = $updatedLrty WHERE id = $employeeID");
            $msg="Employee Leave Has been Approved and Employee Leave Limit for this year is updated";
        }else{

            $error="Durtion Exceeds the limit of Leave Days Remaining!! You Have to Decline";
            $updateQuery = "UPDATE tblleaves SET Status = 0 WHERE Lid = $id";
            mysqli_query($connection, $updateQuery);

        }

        

    }
}

if (isset($_POST['decline'])) {
    if (isset($_POST['decline_lid'])) {
        $id = $_POST['decline_lid'];
        $updateQuery = "UPDATE tblleaves SET Status = 2 WHERE Lid = $id";
        mysqli_query($connection, $updateQuery);
        $msg="Leave Request Is deleted Successfully";
    }
}

$fetch_query = mysqli_query($connection, "SELECT tblleaves.Lid, 
                   tbl_employee.id, 
                   tbl_employee.first_name, 
                   tbl_employee.last_name, 
                   tblleaves.LeaveType, 
                   tblleaves.PostingDate, 
                   tblleaves.ToDate, 
                   tblleaves.FromDate, 
                   tblleaves.duration,
                   tblleaves.Description, 
                   tblleaves.Status 
            FROM tblleaves 
            JOIN tbl_employee ON tblleaves.employee_id = tbl_employee.id 
            WHERE tblleaves.Status = 0
            ORDER BY Lid DESC");
?>

<div class="page-wrapper">
    <div class="content" >
        <div class="row" >
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Pending Leaves</h4>
            </div>
        </div>
        <div class="table-responsive">
            
                <table class="datatable table table-stripped" style="background-color: rgb(191, 196, 173);border-radius:15px;border: black;">
                    <thead>
                        <tr>
                            <th>Leave Id </th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Leave Type</th>
                            <th>To Date</th>
                            <th>From Date</th>
                            <th>Duration(Days)</th>
                            <th>Description</th>
                            <th>Posting Date</th>
                            <th>Employee ID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_array($fetch_query)) {
                            ?>
                                <form method="post">
                            <tr>
                                <td>
                                    <?php echo $row['Lid'] ?>
                                </td>
                                <td>
                                    <?php echo $row['first_name'] ?>
                                </td>
                                <td>
                                    <?php echo $row['last_name'] ?>
                                </td>
                                <td>
                                    <?php echo $row['LeaveType'] ?>
                                </td>
                                <td>
                                    <?php echo $row['ToDate']; ?>
                                </td>
                                <td>
                                    <?php echo $row['FromDate']; ?>
                                </td>
                                <td>
                                    <?php echo $row['duration']; ?>
                                </td>
                                <td>
                                    <?php echo $row['Description']; ?>
                                </td>
                                <td>
                                    <?php echo $row['PostingDate']; ?>
                                </td>
                                <td>
                                    <?php echo $row['id']; ?>
                                </td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <input type="hidden" name="approve_lid" value="<?php echo $row['Lid']; ?>">
                                        <button style="background-color:rgb(44, 202, 163); color: white;width:80px;border-radius: 20px;border-color: white;" type="submit"     name="approve">Approve</button>
                                        <br>
                                        <input type="hidden" name="decline_lid" value="<?php echo $row['Lid']; ?>">
                                        <button style="background-color: red; color: white;width:80px;border-radius: 20px;border-color: white;" type="submit"   name="decline">Decline</button>
                                    </div>
                                </td>
                            </tr>
                            </form>
                        <?php } ?>
                    </tbody>
                </table>
            
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
<script type="text/javascript">
     <?php
        if(isset($msg)) {
            echo 'swal("' . $msg. '");';
            

        }else{
            echo 'swal("' . $error. '");';
        }
       
    ?>
</script>