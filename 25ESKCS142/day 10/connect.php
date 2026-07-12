<?php
$host     = "localhost";
$username = "root";
$password = "";
$database = "student_management";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("<div class='alert alert-danger m-3'><strong>Database Connection Failed:</strong> " . mysqli_connect_error() . "</div>");
}
?>