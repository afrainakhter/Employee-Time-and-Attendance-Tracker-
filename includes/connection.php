

<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "eam_db";

// Attempt to establish a connection
$connection = mysqli_connect($server, $username, $password, $database);

// Check for connection errors
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Now $connection is a valid MySQLi connection that you can use for queries
?>
