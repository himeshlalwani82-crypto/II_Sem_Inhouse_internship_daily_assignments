<?php
// Initialize temporary display values for photo handling
$photoDisplayPath = "https://via.placeholder.com/150"; // Fallback standard placeholder layout UI

// Catch input variables safely if targeted routing criteria met
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = htmlspecialchars($_POST['fullName'] ?? 'N/A');
    $email    = htmlspecialchars($_POST['email'] ?? 'N/A');
    $gender   = htmlspecialchars($_POST['gender'] ?? 'Not Selected');
    $course   = htmlspecialchars($_POST['course'] ?? 'N/A');
    $address  = htmlspecialchars($_POST['address'] ?? 'N/A');

    // Photo file handling logic for the front-end UI visual placeholder presentation
    if (isset($_FILES['profilePhoto']) && $_FILES['profilePhoto']['error'] == 0) {
        $fileName = $_FILES['profilePhoto']['name'];
        $fileTmp  = $_FILES['profilePhoto']['tmp_name'];
        
        // Setup direct temporary file configuration for local presentation
        $targetDirectory = "uploads/";
        
        // Automatically make directory path if it doesn't exist locally
        if (!is_dir($targetDirectory)) {
            mkdir($targetDirectory, 0755, true);
        }
        
        $targetFilePath = $targetDirectory . time() . "_" . basename($fileName);
        
        if (move_uploaded_file($fileTmp, $targetFilePath)) {
            $photoDisplayPath = $targetFilePath;
        }
    }
} else {
    // Force rerouting back to form page entry if reached through invalid context routing channel
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Confirmed | Student Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f1f5f9; }
        .profile-card { border-radius: 16px; box-shadow: 0 10px 25px rgba(0,0,0,0.05); }
        .avatar-preview { width: 130px; height: 130px; object-fit: cover; border-radius: 50%; border: 4px solid #0d6efd; }
    </style>
</head>
<body>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-7">
                
                <div class="card profile-card border-0 bg-white p-4 p-md-5 text-center">
                    <div class="text-success mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                          <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                        </svg>
                    </div>
                    
                    <h2 class="fw-bold mb-2">Registration Successful!</h2>
                    <p class="text-muted mb-4">The following processing record has been generated on our servers.</p>
                    
                    <div class="mb-4">
                        <img src="<?php echo $photoDisplayPath; ?>" alt="Uploaded Student Photo" class="avatar-preview shadow">
                    </div>

                    <hr class="my-4 text-muted">

                    <div class="table-responsive text-start">
                        <table class="table table-bordered align-middle">
                            <tbody>
                                <tr>
                                    <th class="bg-light text-secondary w-30" scope="row">Full Name</th>
                                    <td class="fw-bold text-dark"><?php echo $fullName; ?></td>
                                </tr>
                                <tr>
                                    <th class="bg-light text-secondary" scope="row">Email Address</th>
                                    <td><?php echo $email; ?></td>
                                </tr>
                                <tr>
                                    <th class="bg-light text-secondary" scope="row">Gender Assigned</th>
                                    <td><span class="badge bg-secondary"><?php echo $gender; ?></span></td>
                                </tr>
                                <tr>
                                    <th class="bg-light text-secondary" scope="row">Enrolled Track</th>
                                    <td class="text-primary fw-semibold"><?php echo $course; ?></td>
                                </tr>
                                <tr>
                                    <th class="bg-light text-secondary" scope="row">Mailing Address</th>
                                    <td><small class="text-muted"><?php echo nl2br($address); ?></small></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        <a href="index.php" class="btn btn-outline-primary btn-sm px-4">← Register Another Student</a>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>
</html>