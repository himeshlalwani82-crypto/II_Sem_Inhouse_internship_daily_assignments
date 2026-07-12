<?php
require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Gather text entries cleanly
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $course  = trim($_POST['course'] ?? '');
    $address = trim($_POST['address'] ?? '');
    
    // Server-side check for empty inputs before processing database entry
    if (empty($name) || empty($email) || empty($course) || empty($address)) {
        die("<div class='alert alert-danger m-3'>All form fields are strictly required.</div>");
    }

    // 2. File Upload Infrastructure (Handling the Photo column requirement)
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $uploadDir = 'uploads/';
        
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $fileName = basename($_FILES['photo']['name']);
        // Prefix with unique timestamp hash to protect against file overwriting
        $uniqueFileName = time() . "_" . $fileName;
        $targetFilePath = $uploadDir . $uniqueFileName;

        if (!move_uploaded_file($_FILES['photo']['tmp_name'], $targetFilePath)) {
            die("<div class='alert alert-danger m-3'>Error moving uploaded image file to destination directory.</div>");
        }
    } else {
        die("<div class='alert alert-danger m-3'>A valid profile image file is required.</div>");
    }

    // 3. Secure INSERT Statement Preparation (SQL Injection Protection)
    $sql = "INSERT INTO students (name, email, course, address, photo) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Bind arguments securely: s = string
        mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $course, $address, $uniqueFileName);
        
        if (mysqli_stmt_execute($stmt)) {
            // Success: redirect cleanly to list view
            header("Location: view_records.php?status=success");
            exit();
        } else {
            echo "<div class='alert alert-danger m-3'>Execution Error: " . mysqli_stmt_error($stmt) . "</div>";
        }
        
        mysqli_stmt_close($stmt);
    } else {
        echo "<div class='alert alert-danger m-3'>Statement Compilation Error: " . mysqli_error($conn) . "</div>";
    }

    mysqli_close($conn);
} else {
    header("Location: index.php");
    exit();
}
?>