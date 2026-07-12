<?php
session_start();
require_once 'db.php';

// Authentication Guard Rule execution verification
if (!isset($_SESSION['user_authenticated'])) {
    die("Access Forbidden: Authentication credentials invalid or session expired.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = htmlspecialchars(trim($_POST['name']));
    $email   = htmlspecialchars(trim($_POST['email']));
    $course  = htmlspecialchars(trim($_POST['course']));
    $address = htmlspecialchars(trim($_POST['address']));

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $nameSegments = explode('.', $_FILES['photo']['name']);
        $extension = strtolower(end($nameSegments));
        
        // Size constraints check logic protection filters
        if ($_FILES['photo']['size'] > 2 * 1024 * 1024) {
            die("File size allocation exceeded: limit max target dimensions to 2MB.");
        }

        $newImageName = time() . "_profile." . $extension;
        move_uploaded_file($_FILES['photo']['tmp_name'], "uploads/" . $newImageName);
    } else {
        die("Fatal Error: profile picture identity payload parameter parsing unverified.");
    }

    $stmt = mysqli_prepare($conn, "INSERT INTO students (name, email, course, address, photo) VALUES (?, ?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $course, $address, $newImageName);
    
    if (mysqli_stmt_execute($stmt)) {
        header("Location: final_dashboard.php?action=success");
        exit();
    }
    mysqli_stmt_close($stmt);
}
?>