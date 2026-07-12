<?php
require_once 'db_connect.php';

// Execute the selection query directly to pull stored inputs
$sql = "SELECT id, name, email, course, address, photo, date_registered FROM students ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Day 9 | View Student Directory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .student-thumb { width: 50px; height: 50px; object-fit: cover; border-radius: 50%; }
        .table align-middle th { font-weight: 600; background-color: #f1f5f9; }
    </style>
</head>
<body class="bg-light">

    <div class="container my-5">
        
        <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
            <div class="alert alert-success alert-dismissible fade show shadow-sm border-0 mb-4" role="alert">
                <strong>✨ Success!</strong> Record processed and appended safely to database records matrix.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card border-0 shadow-sm p-4 bg-white rounded-3">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-3 mb-4">
                <div>
                    <h2 class="fw-bold mb-1">Live Database Directory</h2>
                    <p class="text-muted small mb-0">Displays all persistent records currently committed to your MySQL instance.</p>
                </div>
                <a href="index.php" class="btn btn-primary btn-sm">+ Register New Student</a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle border mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="text-center">Photo</th>
                            <th scope="col">Student Name</th>
                            <th scope="col">Email Address</th>
                            <th scope="col">Course Track</th>
                            <th scope="col">Mailing Address</th>
                            <th scope="col">Registration Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($result) > 0): ?>
                            <?php while($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td class="text-center">
                                        <?php 
                                        $imagePath = 'uploads/' . htmlspecialchars($row['photo']);
                                        if (!empty($row['photo']) && file_exists($imagePath)): 
                                        ?>
                                            <img src="<?php echo $imagePath; ?>" alt="Profile" class="student-thumb border shadow-sm">
                                        <?php else: ?>
                                            <div class="student-thumb bg-secondary text-white d-inline-flex align-items-center justify-content-center text-uppercase small font-weight-bold">?</div>
                                        <?php endif; ?>
                                    </td>
                                    
                                    <td class="fw-semibold text-dark"><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                                    <td><span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-1.5"><?php echo htmlspecialchars($row['course']); ?></span></td>
                                    <td><small class="text-muted"><?php echo htmlspecialchars($row['address']); ?></small></td>
                                    
                                    <td>
                                        <small class="fw-medium text-secondary">
                                            <?php echo date('M d, Y - h:i A', strtotime($row['date_registered'])); ?>
                                        </small>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <p class="mb-0">No data records found in the database table.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php mysqli_close($conn); ?>