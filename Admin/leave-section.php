<?php
session_start();



if (empty($_SESSION['name'])) {
    header('location:index.php');
} else {
    
    include('header.php');
    include('includes/connection.php');
    
    }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">


    <style>
     body{
        background-color:  rgb(200, 205, 211);
     }
    
     .content{
                      
 ;
            width: 1200px;
            margin-left: 20px;
            
     }
     .row{
        
        padding-left: 40px;
     }
     #helloman{
        background-color:    rgb(208, 219, 214) ;  
     }
        
        </style>
        
</head>



            
                    
<body>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="page-title">Admin/Leave Types</h4>
            </div>

            <div class="col-sm-12 text-right m-b-20">
                <a href="add-leavetype.php" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Add Types</a>
            </div>

            <div class="col-sm-12">
                <div class="table-responsive">
                    <table class="datatable table table-striped" id="helloman">
                        <thead>
                            <tr>
                                <th>Leave ID</th>
                                <th>Leave Type</th>
                                <th>Description</th>
                                <th>Created</th>
                                <!-- <th>Action</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            if (isset($_GET['ids'])) {
                                $id = $_GET['ids'];
                                $delete_query = mysqli_query($connection, "delete from tblleavetype where id='$id'");
                            }
                            $fetch_query = mysqli_query($connection, "select * from tblleavetype");;

                            if ($fetch_query === false) {
                                die("Error in executing the query: " . mysqli_error($connection));
                            }

                            while ($result = mysqli_fetch_assoc($fetch_query)) {
                                ?>
                                <tr>
                                    <td><?php echo htmlentities($result['id']); ?></td>
                                    <td><?php echo htmlentities($result['LeaveType']); ?></td>
                                    <td><?php echo htmlentities($result['Description']); ?></td>
                                    <td><?php echo htmlentities($result['CreationDate']); ?>
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false" ><i class="fa fa-ellipsis-v" style="color:Blue; margin-left:2px;"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right" >
                                                <a class="dropdown-item" href="edit-leavetype.php?id=<?php echo $result['id']; ?>" ><i class="fa fa-pencil m-r-5" style="color:Green;"></i> Edit</a>
                                                <a class="dropdown-item" href="leave-section.php?ids=<?php echo $result['id']; ?>" onclick="return confirmDelete()"><i class="fa fa-trash-o m-r-5" style="color:Red;"></i> Delete</a>
                                            </div>
                                </td>
                                    <!-- <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right" >
                                                <a class="dropdown-item" href="edit-leavetype.php?id=<?php echo $result['id']; ?>" ><i class="fa fa-pencil m-r-5" style="color:Green;"></i> Edit</a>
                                                <a class="dropdown-item" href="leave-section.php?ids=<?php echo $result['id']; ?>" onclick="return confirmDelete()"><i class="fa fa-trash-o m-r-5" style="color:Red;"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td> -->
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

<?php
    include('footer.php');

?>
<script language="JavaScript" type="text/javascript">
function confirmDelete(){
    return confirm('Are you sure want to delete this Type??');
}
</script>






