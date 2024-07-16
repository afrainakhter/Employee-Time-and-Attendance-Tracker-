<?php
session_start();
if(empty($_SESSION['name']))
{
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');
?>
<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Shift</h4>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="add-shift.php" class="btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add New Shift</a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-12">
                <input type="text" id="searchInput" onkeyup="searchShifts()" placeholder="Search for shifts.." class="form-control mb-3">
            </div>
        </div>
        <div class="table-responsive">
            <table class="datatable table table-stripped" id="shiftTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(isset($_GET['ids'])){
                        $id = $_GET['ids'];
                        $delete_query = mysqli_query($connection, "delete from tbl_shift where id='$id'");
                    }
                    $fetch_query = mysqli_query($connection, "select * from tbl_shift");
                    while($row = mysqli_fetch_array($fetch_query))
                    {
                    ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['start_time']; ?></td>
                        <td><?php echo $row['end_time']; ?></td>
                        <?php if($row['status']==1) { ?>
                        <td><span class="custom-badge status-green">Active</span></td>
                        <?php } else { ?>
                        <td><span class="custom-badge status-red">Inactive</span></td>
                        <?php } ?>
                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="edit-shift.php?id=<?php echo $row['id'];?>"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                    <a class="dropdown-item" href="shift.php?ids=<?php echo $row['id'];?>" onclick="return confirmDelete()"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include('footer.php');
?>

<script language="JavaScript" type="text/javascript">
function confirmDelete(){
    return confirm('Are you sure want to delete this Shift?');
}

function searchShifts() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("shiftTable");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td");
        if (td.length > 0) {
            var found = false;
            for (var j = 0; j < td.length; j++) {
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
            }
            tr[i].style.display = found ? "" : "none";
        }
    }
}
</script>
