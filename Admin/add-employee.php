<?php
session_start();
if(empty($_SESSION['name']))
{
    header('location:index.php');
    exit();
}

include('includes/connection.php');

// Correct the paths to PHPMailer files
require 'includes/PHPMailer/src/PHPMailer.php';
require 'includes/PHPMailer/src/SMTP.php';
require 'includes/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$fetch_query = mysqli_query($connection, "SELECT MAX(id) as id FROM tbl_employee");
$row = mysqli_fetch_row($fetch_query);
$emp_id = $row[0] == 0 ? 1 : $row[0] + 1;

if (isset($_POST['add-employee'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $emailid = $_POST['emailid'];
    $pwd = $_POST['pwd'];
    $employee_id = 'EMP-' . $emp_id;
    $joining_date = $_POST['joining_date'];
    $shift = $_POST['shift'];
    $dob = $_POST['dob'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $department = $_POST['department'];
    $status = $_POST['status'];

    $insert_query = mysqli_query($connection, "INSERT INTO tbl_employee SET first_name='$first_name', last_name='$last_name', username='$username', emailid='$emailid', password='$pwd', dob='$dob', employee_id='$employee_id', joining_date='$joining_date', gender='$gender', phone='$phone', shift='$shift', department='$department', status='$status'");

    if ($insert_query>0) {
        $msg = "Employee created successfully";

        // Send email to the new employee
        $mail = new PHPMailer(true);
        try {
            // SMTP configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Gmail SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'zarinroichi@gmail.com'; // Your Gmail address
            $mail->Password = 'bmtl lhvv hqlr eshy'; // Your Gmail App password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Sender and recipient settings
            $mail->setFrom('zarinroichi@gmail.com', 'TimeVista');
            $mail->addAddress($emailid);

            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'Welcome to the Company';
            $mail->Body = "Dear $first_name $last_name,<br><br>Welcome to the company. Your username is <strong>$username</strong> and your password is <strong>$pwd</strong>.<br><br>Best Regards,<br>TimeVista";

            // Send email
            $mail->send();
        } catch (Exception $e) {
            $msg = "Employee created successfully, but email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        // Redirect to employees.php after successful creation
        header('Location: employees.php');
        exit();

    } else {
        $msg = 'Error!';
    }
}
include('header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Employee</title>
    <!-- Include your CSS files -->
    <link rel="stylesheet" href="../path/to/bootstrap.min.css"> <!-- Example path, replace with your actual CSS file -->
    <link rel="stylesheet" href="../path/to/custom.css"> <!-- Example path, replace with your actual CSS file -->
</head>
<body>
    <div class="page-wrapper">
        <div class="content">
            <div class="row">
                <div class="col-sm-4">
                    <h4 class="page-title">Add Employee</h4>
                </div>
                <div class="col-sm-8 text-right m-b-20">
                    <a href="employees.php" class="btn btn-primary btn-rounded float-right">Back</a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form method="post">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>First Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="first_name" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Last Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="last_name" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Username <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" name="username" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input class="form-control" type="email" name="emailid" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control" type="password" name="pwd" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Employee ID <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="employee_id" value="<?php echo 'EMP-' . $emp_id; ?>" disabled>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Joining Date <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker" type="text" name="joining_date" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Shift <span class="text-danger">*</span></label>
                                    <select class="select" name="shift" required>
                                        <option value="">Select</option>
                                        <?php
                                        $fetch_query = mysqli_query($connection, "SELECT start_time, end_time FROM tbl_shift WHERE status=1");
                                        while ($shift = mysqli_fetch_array($fetch_query)) {
                                            echo "<option value='{$shift['start_time']}-{$shift['end_time']}'>{$shift['start_time']}-{$shift['end_time']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Date of Birth <span class="text-danger">*</span></label>
                                    <div class="cal-icon">
                                        <input class="form-control datetimepicker" type="text" name="dob" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Phone </label>
                                    <input class="form-control" type="text" name="phone" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group gender-select">
                                    <label class="gen-label">Gender:</label>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" name="gender" class="form-check-input" value="Male">Male
                                        </label>
                                    </div>
                                    <div class="form-check-inline">
                                        <label class="form-check-label">
                                            <input type="radio" name="gender" class="form-check-input" value="Female">Female
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Department</label>
                                    <select class="select" name="department" required>
                                        <option value="">Select</option>
                                        <?php
                                        $fetch_query = mysqli_query($connection, "SELECT department_name FROM tbl_department WHERE status=1");
                                        while ($dept = mysqli_fetch_array($fetch_query)) {
                                            echo "<option value='{$dept['department_name']}'>{$dept['department_name']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="select" name="status" required>
                                        <option value="">Select</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="m-t-20 text-center">
                            <button class="btn btn-primary submit-btn" name="add-employee">Create Employee</button>
                        </div>
                    </form>
                    <?php if (isset($msg)) { ?>
                        <div class="alert alert-info mt-3">
                            <?php echo $msg; ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php
include('../footer.php');
?>
<script type="text/javascript">
     <?php
        if(isset($msg)) {
            echo 'swal("' . $msg . '");';
        }
    ?>
</script>
