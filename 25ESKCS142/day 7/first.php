<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upgraded Student Registration System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8fafc; }
        .registration-card { border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        #error-box { display: none; }
    </style>
</head>
<body>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                
                <div id="error-box" class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h5 class="alert-heading">⚠️ Please correct the following errors:</h5>
                    <ul id="error-list" class="mb-0"></ul>
                </div>

                <div class="card registration-card border-0 bg-white p-4 p-md-5">
                    <h2 class="text-center mb-4 fw-bold text-primary">Student Registration</h2>
                    
                    <form id="upgradeForm" action="confirmation.php" method="POST" enctype="multipart/form-data" novalidate>
                        
                        <div class="mb-3">
                            <label for="fullName" class="form-label fw-semibold">Full Name</label>
                            <input type="text" class="form-control" id="fullName" name="fullName" placeholder="John Doe" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="john@example.com" required>
                        </div>

                        <div class="mb-3">
                            <label for="profilePhoto" class="form-label fw-semibold">Profile Photo</label>
                            <input class="form-control" type="file" id="profilePhoto" name="profilePhoto" accept="image/*" required>
                            <div class="form-text">Accepted formats: JPG, PNG, GIF.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label d-block fw-semibold">Gender</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="genderMale" value="Male">
                                <label class="form-check-input-label" for="genderMale">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="genderFemale" value="Female">
                                <label class="form-check-input-label" for="genderFemale">Female</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="genderOther" value="Other">
                                <label class="form-check-input-label" for="genderOther">Other</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="course" class="form-label fw-semibold">Course Module</label>
                            <select class="form-select" id="course" name="course" required>
                                <option value="" selected disabled>Choose your track...</option>
                                <option value="Full-Stack Web Development">Full-Stack Web Development</option>
                                <option value="Data Science & Machine Learning">Data Science & Machine Learning</option>
                                <option value="UI/UX Design Systems">UI/UX Design Systems</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="address" class="form-label fw-semibold">Mailing Address</label>
                            <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter your full street or mailing address" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-2.5 fw-bold text-uppercase">Complete Registration</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>