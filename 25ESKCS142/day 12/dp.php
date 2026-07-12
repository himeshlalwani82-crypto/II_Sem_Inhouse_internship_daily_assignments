<?php
$conn = mysqli_connect("localhost", "root", "", "student_management");
if (!$conn) {
    die("<div class='alert alert-danger'>Critical Error connecting database node instance: " . mysqli_connect_error() . "</div>");
}
?>