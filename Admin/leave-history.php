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
                        <h4 class="page-title">Leave History</h4>
                    </div>
                    
                   
                
                </div>
                <div class="table-responsive">
                                    <table class="datatable table table-stripped ">
                                    <thead>
                                        <tr>
                                            <th>First Name</th>
                                    
                                             <th>LastName</th>
                                            <th>LeaveType</th>
                                            <th>ToDate</th>
                                            <th>FromDate</th>
                                            <th>Description</th>
                                            <th>PostingDate</th>
                                    
                                             <th>EmployeeID</th>

                                             <th>Status</th>
                                        </tr>

                                    </thead>
                                    <tbody>
                                        <?php
                                        if(isset($_GET['ids'])){
                                        $id = $_GET['ids'];
                                        $delete_query = mysqli_query($connection, "delete from tblleaves where Lid='$id'");
                                        }
                                       $fetch_query = mysqli_query($connection, "SELECT tblleaves.Lid, 
               tbl_employee.employee_id, 
               tbl_employee.first_name, 
               tbl_employee.last_name, 
               tblleaves.LeaveType, 
               tblleaves.PostingDate, 
               tblleaves.ToDate, 
               tblleaves.FromDate, 
               tblleaves.Description, 
               CASE 
                   WHEN tblleaves.Status = 0 THEN 'Pending' 
                   WHEN tblleaves.Status = 1 THEN 'Approved' 
                   WHEN tblleaves.Status = 2 THEN 'Declined' 
                   ELSE 'Unknown' 
               END AS Status 
        FROM tblleaves 
        JOIN tbl_employee ON tblleaves.employee_id = tbl_employee.id 
        ORDER BY Lid DESC");
                                        while($row = mysqli_fetch_array($fetch_query))
                                        {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['first_name'] ?></td>
                                            <td><?php echo $row['last_name'] ?></td>
                                            <td><?php echo $row['LeaveType'] ?></td>
                                            <td><?php echo $row['ToDate']; ?></td>
                                            <td><?php echo $row['FromDate']; ?></td>
                                            <td><?php echo $row['Description']; ?></td>
                                             <td><?php echo $row['PostingDate']; ?></td>
                                            
                                              <td><?php echo $row['employee_id']; ?></td>
                                              <td><?php echo $row['Status']; ?></td>


                                            
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
				
            </div>
            
        </div>


<?php include('footer.php'); ?>

