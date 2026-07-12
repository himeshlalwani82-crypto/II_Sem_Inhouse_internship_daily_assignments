<?php
require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $cgpa    = trim($_POST['cgpa'] ?? '');
    $branch  = trim($_POST['branch'] ?? '');
    $status  = trim($_POST['status'] ?? 'Active');
    $address = trim($_POST['address'] ?? '');

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

        $uniqueFileName = time() . "_" . basename($_FILES['photo']['name']);
        move_uploaded_file($_FILES['photo']['tmp_name'], $uploadDir . $uniqueFileName);
    } else {
        die("Profile photo missing.");
    }

    // Add extra column hooks for schema tracking compatibility
    $sql = "INSERT INTO students (name, email, course, address, photo, status) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssss", $name, $email, $branch, $address, $uniqueFileName, $status);
        if (mysqli_stmt_execute($stmt)) {
            header("Location: dashboard.php?msg=added");
            exit();
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($conn);
}
?>