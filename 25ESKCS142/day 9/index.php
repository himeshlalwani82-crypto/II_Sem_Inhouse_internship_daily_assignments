<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 9 | Database Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                
                <div class="card border-0 shadow-sm p-4 bg-white rounded-3">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fw-bold text-dark mb-0">Student Registry</h3>
                        <a href="view_records.php" class="btn btn-outline-secondary btn-sm">View Live Records →</a>
                    </div>
                    
                    <form action="process.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Jane Doe" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email Address</label>
                            <input type="email" class="form-control" name="email" placeholder="jane@example.com" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Course Track</label>
                            <input type="text" class="form-control" name="course" placeholder="e.g., Full-Stack Web Development" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Profile Photo File</label>
                            <input type="file" class="form-control" name="photo" accept="image/*" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Mailing Address</label>
                            <textarea class="form-control" name="address" rows="3" placeholder="Enter physical street address..." required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">Save Student Record</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

</body>
</html>