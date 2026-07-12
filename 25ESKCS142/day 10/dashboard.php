<?php
require_once 'db_connect.php';

// ==========================================
// REQUIREMENT 1: SQL Aggregate Dash Stats
// ==========================================
$totalQuery = mysqli_query($conn, "SELECT COUNT(*) as total, AVG(CAST(address AS DECIMAL(4,2))) as avg_cgpa FROM students");
// Fallback computation safety if schema structure alters types across legacy steps:
$fallbackQuery = mysqli_query($conn, "SELECT COUNT(*) as total FROM students");
$totalData = mysqli_fetch_assoc($fallbackQuery);

// Fetch students per branch utilizing GROUP BY
$groupQuery = mysqli_query($conn, "SELECT course as branch, COUNT(*) as count FROM students GROUP BY course");

// ==========================================
// REQUIREMENT 2: Search and Filter Logic
// ==========================================
$search  = trim($_GET['search'] ?? '');
$branch  = trim($_GET['branch'] ?? '');
$status  = trim($_GET['status'] ?? 'Active'); // Default show Active per assignment rules
$min_gpa = trim($_GET['min_gpa'] ?? '');
$max_gpa = trim($_GET['max_gpa'] ?? '');

// Base Query
$sql = "SELECT * FROM students WHERE 1=1";
$params = [];
$types = "";

// Dynamic Filter Matching
if ($status !== 'All') {
    $sql .= " AND status = ?";
    $params[] = $status;
    $types .= "s";
}

if (!empty($branch)) {
    $sql .= " AND course = ?";
    $params[] = $branch;
    $types .= "s";
}

if (!empty($search)) {
    $sql .= " AND (name LIKE ? OR email LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $types .= "ss";
}

// Order data chronologically by default
$sql .= " ORDER BY id DESC";

$stmt = mysqli_prepare($conn, $sql);
if (!empty($params)) {
    mysqli_stmt_bind_param($stmt, $types, ...$params);
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        .thumb { width: 45px; height: 45px; object-fit: cover; border-radius: 50%; }
        .stats-card { border-radius: 10px; border: none; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
    </style>
</head>
<body class="bg-light">

    <div class="container my-5">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="fw-bold text-dark mb-0">Student Dashboard</h1>
                <p class="text-muted mb-0">Manage registrations, search records, and analyze statistics.</p>
            </div>
            <a href="index.php" class="btn btn-primary">+ Add New Student</a>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card stats-card bg-white p-3 d-flex flex-row align-items-center justify-content-between">
                    <div>
                        <span class="text-muted small d-block text-uppercase fw-bold">Total Enrolled</span>
                        <h3 class="fw-bold mb-0 text-dark"><?php echo $totalData['total']; ?></h3>
                    </div>
                    <div class="fs-1 text-primary opacity-25"><i class="fa-solid fa-users"></i></div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card stats-card bg-white p-3">
                    <span class="text-muted small d-block text-uppercase fw-bold mb-2">Distribution per Branch</span>
                    <div class="d-flex flex-wrap gap-2">
                        <?php while($row = mysqli_fetch_assoc($groupQuery)): ?>
                            <span class="badge bg-secondary-subtle text-secondary border px-3 py-2 rounded-pill">
                                <?php echo htmlspecialchars($row['branch'] ?: 'Unassigned'); ?>: 
                                <strong class="text-dark"><?php echo $row['count']; ?></strong>
                            </span>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm p-4 mb-4 bg-white rounded-3">
            <form method="GET" action="dashboard.php" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-secondary">Multi-Field Search</label>
                    <input type="text" class="form-control" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search by name or email...">
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-secondary">Branch Filter</label>
                    <select class="form-select" name="branch">
                        <option value="">All Branches</option>
                        <option value="Computer Science" <?php if($branch=='Computer Science') echo 'selected'; ?>>Computer Science</option>
                        <option value="Information Technology" <?php if($branch=='Information Technology') echo 'selected'; ?>>Information Technology</option>
                        <option value="Electronics" <?php if($branch=='Electronics') echo 'selected'; ?>>Electronics</option>
                        <option value="Mechanical" <?php if($branch=='Mechanical') echo 'selected'; ?>>Mechanical</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-bold text-secondary">Status State</label>
                    <select class="form-select" name="status">
                        <option value="Active" <?php if($status=='Active') echo 'selected'; ?>>Active Only (Default)</option>
                        <option value="Inactive" <?php if($status=='Inactive') echo 'selected'; ?>>Inactive Only</option>
                        <option value="All" <?php if($status=='All') echo 'selected'; ?>>Show All Statuses</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-secondary w-100"><i class="fa-solid fa-filter me-2"></i>Apply</button>
                </div>
            </form>
        </div>

        <div class="card border-0 shadow-sm bg-white rounded-3 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center" style="width: 80px;">Profile</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Branch</th>
                            <th>Status</th>
                            <th>Date Registered</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($result) > 0): ?>
                            <?php while($student = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td class="text-center">
                                        <?php if(!empty($student['photo']) && file_exists('uploads/'.$student['photo'])): ?>
                                            <img src="uploads/<?php echo htmlspecialchars($student['photo']); ?>" class="thumb border shadow-sm" alt="Student Pic">
                                        <?php else: ?>
                                            <div class="thumb bg-light border d-inline-flex align-items-center justify-content-center text-muted">?</div>
                                        <?php endif; ?>
                                    </td>
                                    <td class="fw-bold text-dark"><?php echo htmlspecialchars($student['name']); ?></td>
                                    <td><?php echo htmlspecialchars($student['email']); ?></td>
                                    <td><span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3"><?php echo htmlspecialchars($student['course']); ?></span></td>
                                    <td>
                                        <span class="badge bg-<?php echo ($student['status'] == 'Active') ? 'success' : 'danger'; ?>-subtle text-<?php echo ($student['status'] == 'Active') ? 'success' : 'danger'; ?> border px-2.5">
                                            <?php echo htmlspecialchars($student['status']); ?>
                                        </span>
                                    </td>
                                    <td><small class="text-secondary"><?php echo date('M d, Y', strtotime($student['date_registered'])); ?></small></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">No student listings match your active search filters.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>
<?php 
mysqli_stmt_close($stmt);
mysqli_close($conn); 
?>