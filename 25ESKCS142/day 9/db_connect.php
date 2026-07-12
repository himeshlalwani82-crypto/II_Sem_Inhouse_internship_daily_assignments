<?php
$host     = "localhost";
$username = "root";
$password = "";
$database = "student_management";

// Establish MySQL connection
$conn = mysqli_connect($host, $username, $password, $database);

// Verify successful connection state
if (!$conn) {
    die("<div class='alert alert-danger m-3'><strong>Database Connection Failed:</strong> " . mysqli_connect_error() . "</div>");
}
?>