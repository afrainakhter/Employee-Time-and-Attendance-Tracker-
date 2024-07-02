<?php
session_start();

if (empty($_SESSION['name']) || $_SESSION['role'] != 1) {
    header('location: index.php');
}

include('header.php');
include('includes/connection.php');

$fetch_query = mysqli_query($connection, "select max(id) as id from tblleavetype");

$result = mysqli_fetch_row($fetch_query);

if (isset($_POST['add-leavetype'])) {
    $LeaveType = $_POST['LeaveType'];
    $Description = $_POST['Description'];

    $insert_query = mysqli_query($connection, "insert into tblleavetype set LeaveType='$LeaveType', Description='$Description'");
    
    if ($insert_query) {
        $msg = "Leave Type created successfully";
    } else {
        $msg = "Error!";
    }
}
?>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4">
                <h4 class="page-title">Add Leave Types</h4>
            </div>
            <div class="col-sm-8 text-right m-b-20">
                <a href="leave-section.php" class="btn btn-primary btn-rounded float-right">Back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <form method="post">
                            <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Leave Type <span class="text-danger">*</span></label>
                                            <input class="form-control" type="text" name="LeaveType" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Description <span class="text-danger">*</span></label>
                                            <textarea class="form-control" name="Description" rows="5" style="resize: vertical;" required></textarea>
                                        </div>
                                    </div>
                                </div>
                    <div class="m-t-20 text-center">
                        <button class="btn btn-primary submit-btn" name="add-leavetype">Add This</button>
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
    if (isset($msg)) {
        echo 'swal("' . $msg . '");';
    }
    ?>
</script>
