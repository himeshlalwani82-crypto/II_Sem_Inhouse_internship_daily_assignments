<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card border-0 shadow-sm p-4 bg-white rounded-3">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fw-bold text-dark mb-0">Add Student</h3>
                        <a href="dashboard.php" class="btn btn-outline-primary btn-sm">← View Dashboard</a>
                    </div>
                    
                    <form action="process.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" class="form-control" name="name" required placeholder="John Doe">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email Address</label>
                            <input type="email" class="form-control" name="email" required placeholder="john@example.com">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">CGPA</label>
                                <input type="number" class="form-control" name="cgpa" step="0.01" min="0" max="10" required placeholder="9.10">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Branch Track</label>
                                <select class="form-select" name="branch" required>
                                    <option value="" selected disabled>Select...</option>
                                    <option value="Computer Science">Computer Science</option>
                                    <option value="Information Technology">Information Technology</option>
                                    <option value="Electronics">Electronics</option>
                                    <option value="Mechanical">Mechanical</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Profile Photo</label>
                                <input type="file" class="form-control" name="photo" accept="image/*" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Initial Status</label>
                                <select class="form-select" name="status" required>
                                    <option value="Active" selected>Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Mailing Address</label>
                            <textarea class="form-control" name="address" rows="2" placeholder="Street Address..." required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">Save Student Record</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>