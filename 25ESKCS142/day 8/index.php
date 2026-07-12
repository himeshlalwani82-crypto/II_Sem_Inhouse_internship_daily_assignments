<?php include 'header.php'; ?>

<main class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            
            <div class="p-4 p-md-5 form-card shadow">
                <div class="text-center mb-4">
                    <h1 class="fw-bold text-info h2">Student Registration System</h1>
                    <p class="text-muted small">Fill in your information accurately to calculate final standing metrics.</p>
                </div>
                
                <form action="confirmation.php" method="POST" class="needs-validation" novalidate>
                    
                    <div class="mb-3">
                        <label for="name" class="form-label text-light fw-semibold">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-secondary border-secondary text-white"><i class="fa-solid fa-user"></i></span>
                            <input type="text" class="form-control" id="name" name="name" placeholder="John Doe" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label text-light fw-semibold">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-secondary border-secondary text-white"><i class="fa-solid fa-envelope"></i></span>
                            <input type="email" class="form-control" id="email" name="email" placeholder="john@example.com" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cgpa" class="form-label text-light fw-semibold">Current CGPA (0.0 - 10.0)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-secondary border-secondary text-white"><i class="fa-solid fa-chart-line"></i></span>
                                <input type="number" class="form-control" id="cgpa" name="cgpa" step="0.01" min="0" max="10" placeholder="8.75" required>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="branch" class="form-label text-light fw-semibold">Academic Branch</label>
                            <select class="form-select" id="branch" name="branch" required>
                                <option value="" selected disabled>Choose track...</option>
                                <option value="Computer Science">Computer Science</option>
                                <option value="Information Technology">Information Technology</option>
                                <option value="Electronics & Communication">Electronics & Comm</option>
                                <option value="Mechanical Engineering">Mechanical Eng</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="college" class="form-label text-light fw-semibold">University / College Campus Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-secondary border-secondary text-white"><i class="fa-solid fa-building-columns"></i></span>
                            <input type="text" class="form-control" id="college" name="college" placeholder="Institute of Technology" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-info w-100 py-2.5 fw-bold text-uppercase shadow-sm text-dark">
                        <i class="fa-solid fa-paper-plane me-2"></i>Process & Calculate Grade
                    </button>
                </form>
            </div>

        </div>
    </div>
</main>

<?php include 'footer.php'; ?>