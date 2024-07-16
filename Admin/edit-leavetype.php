<?php 
session_start();
if(empty($_SESSION['name'])) {
    header('location:index.php');
    exit();
}

include('includes/connection.php');

$id = $_GET['id'];
$fetch_query = mysqli_query($connection, "SELECT * FROM tblleavetype WHERE id='$id'");
$row = mysqli_fetch_array($fetch_query);

if(isset($_REQUEST['save-leavetype'])) {
    $leaveType = $_REQUEST['leaveType'];
    $description = $_REQUEST['description'];

    $update_query = mysqli_query($connection, "UPDATE tblleavetype SET LeaveType='$leaveType', Description='$description' WHERE id='$id'");
    if($update_query) {
        $msg = "Leave Type updated successfully";
        $fetch_query = mysqli_query($connection, "SELECT * FROM tblleavetype WHERE id='$id'");
        $row = mysqli_fetch_array($fetch_query); 
        header('location:leave-section.php');
        exit();  
    } else {
        $msg = "Error!";
    }
}
include('header.php');
?>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4">
                <h4 class="page-title">Edit Leave Type</h4>
            </div>
            <div class="col-sm-8 text-right m-b-20">
                <a href="leave-section.php" class="btn btn-primary btn-rounded float-right">Back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form method="post">
                    <div class="form-group">
                        <label>Leave Type <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="leaveType" value="<?php echo $row['LeaveType']; ?>">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description"><?php echo $row['Description']; ?></textarea>
                    </div>
                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary submit-btn" name="save-leavetype">Save</button>
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
    if(isset($msg)) {
        echo 'swal("' . $msg . '");';
    }
    ?>
</script>
