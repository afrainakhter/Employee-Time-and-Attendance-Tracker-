<?php
session_start();
include('includes/connection.php');

if (isset($_POST['reset_password'])) {
    
    $new_password = mysqli_real_escape_string($connection, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($connection, $_POST['confirm_password']);

    // Validate passwords
    if ($new_password != $confirm_password) {
        $msg = "Passwords do not match.";
    } else {
        // Hash the new password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        // Update password and set password_reset flag
        $employee_id = $_SESSION['employee_id'];
        $update_query = mysqli_query($connection, "UPDATE tbl_employee SET password = '$hashed_password', password_reset = 1 WHERE id = '$employee_id'");

        if ($update_query) {
            // Password updated successfully
            header('location: profile.php'); // Redirect to profile page or dashboard
            exit();
        } else {
            $msg = "Error updating password. Please try again.";
        }
    }
}
?>