<?php
session_start();
// Basic authentication guard mock structure 
$_SESSION['user_authenticated'] = true; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student Profile | Final System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { background-color: #f1f5f9; }
        .preview-circle { width: 100px; height: 100px; object-fit: cover; border-radius: 50%; display: none; margin: 10px auto; border: 3px solid #0d6efd; }
    </style>
</head>
<body>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4 shadow-sm border-0 bg-white rounded-3">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="fw-bold mb-0">Create Student Profile</h4>
                        <a href="final_dashboard.php" class="btn btn-sm btn-outline-secondary">Dashboard</a>
                    </div>

                    <form action="save.php" method="POST" enctype="multipart/form-data">
                        
                        <div class="text-center mb-3">
                            <img id="avatarPreview" class="preview-circle shadow-sm" src="#" alt="Local Upload Image Preview">
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold">Full Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Course Group</label>
                            <input type="text" class="form-control" name="course" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Upload Photo File</label>
                            <input type="file" id="photoInput" class="form-control" name="photo" accept="image/*" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label small fw-bold">Address Details</label>
                            <textarea class="form-control" name="address" rows="2" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 fw-bold">Commit & Insert Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('photoInput').addEventListener('change', function(event) {
            const [file] = this.files;
            if (file) {
                const preview = document.getElementById('avatarPreview');
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            }
        });
    </script>
</body>
</html>