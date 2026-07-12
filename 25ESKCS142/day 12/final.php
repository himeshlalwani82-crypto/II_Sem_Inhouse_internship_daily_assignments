<?php
session_start();
require_once 'db.php';

// Route check parameter security configuration guards
if (!isset($_SESSION['user_authenticated'])) {
    die("Access Forbidden: Valid execution sessions missing.");
}

// 1. Fetch live analytical metrics securely
$countResult = mysqli_query($conn, "SELECT COUNT(*) as total FROM students");
$countData   = mysqli_fetch_assoc($countResult);

// 2. Multi-Field Search query handling implementation parameters
$searchKey = isset($_GET['search']) ? trim($_GET['search']) : '';
if (!empty($searchKey)) {
    $stmt = mysqli_prepare($conn, "SELECT * FROM students WHERE name LIKE ? OR email LIKE ? OR course LIKE ? ORDER BY id DESC");
    $searchTerm = "%" . $searchKey . "%";
    mysqli_stmt_bind_param($stmt, "sss", $searchTerm, $searchTerm, $searchTerm);
    mysqli_stmt_execute($stmt);
    $tableResult = mysqli_stmt_get_result($stmt);
} else {
    // Default system operation state fallback configurations
    $tableResult = mysqli_query($conn, "SELECT * FROM students ORDER BY id DESC LIMIT 5");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Production Management Environment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-light">

    <div class="container my-5">
        
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="card p-3 border-0 shadow-sm bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="small d-block text-uppercase fw-bold opacity-75">Active Directory Size</span>
                            <h2 class="fw-bold mb-0 mt-1"><?php echo $countData['total']; ?> Registrations</h2>
                        </div>
                        <i class="bi bi-person-badge-fill fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm p-3 mb-4 bg-white rounded-3">
            <form method="GET" class="row g-2 align-items-center">
                <div class="col-sm-9">
                    <div class="input-group">
                        <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control border-start-0 bg-light" name="search" value="<?php echo htmlspecialchars($searchKey); ?>" placeholder="Search student fields dynamically across system tables...">
                    </div>
                </div>
                <div class="col-sm-3">
                    <button type="submit" class="btn btn-dark w-100 fw-bold">Search Directory</button>
                </div>
            </form>
        </div>

        <div class="card border-0 shadow-sm bg-white rounded-3 overflow-hidden">
            <div class="p-3 border-bottom bg-white d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0 text-dark"><i class="bi bi-table me-2 text-primary"></i>Recent Records Live Matrix</h5>
                <a href="add_student.php" class="btn btn-sm btn-primary">+ Create Record</a>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Student</th>
                            <th>Email Domain</th>
                            <th>Enrolled Subject Area</th>
                            <th>System Timestamp</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(mysqli_num_rows($tableResult) > 0): ?>
                            <?php while($row = mysqli_fetch_assoc($tableResult)): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="uploads/<?php echo htmlspecialchars($row['photo']); ?>" class="rounded-circle border" style="width:40px; height:40px; object-fit:cover;" alt="Avatar">
                                            <span class="fw-bold text-dark"><?php echo htmlspecialchars($row['name']); ?></span>
                                        </div>
                                    </td>
                                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                                    <td><span class="badge bg-light text-dark border px-2.5 py-1.5"><?php echo htmlspecialchars($row['course']); ?></span></td>
                                    <td><small class="text-secondary"><?php echo $row['date_registered'] ?? date("Y-m-d H:i"); ?></small></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr><td colspan="4" class="text-center py-4 text-muted">No configuration records found mapping matching attributes.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>
</html>