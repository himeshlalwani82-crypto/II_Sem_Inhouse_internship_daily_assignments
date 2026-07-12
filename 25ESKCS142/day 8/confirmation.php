<?php
// Processing Server Verification
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit();
}

// 1. POST Processing & Validation
$errors = [];
$name    = trim($_POST['name'] ?? '');
$email   = trim($_POST['email'] ?? '');
$cgpa    = trim($_POST['cgpa'] ?? '');
$branch  = trim($_POST['branch'] ?? '');
$college = trim($_POST['college'] ?? '');

// Server checking for empty input validation states
if (empty($name))    $errors[] = "Student Full Name cannot be left completely blank.";
if (empty($email))   $errors[] = "An Email address is strictly required.";
if (empty($cgpa))    $errors[] = "CGPA performance metric is missing.";
if (empty($branch))  $errors[] = "An academic major track selection option must be chosen.";
if (empty($college)) $errors[] = "The source institution / college field must be assigned.";

// 2. Grade Logic Calculation Engine
function calculateGrade($cgpaValue) {
    $val = floatval($cgpaValue);
    if ($val >= 9.0) {
        return ['letter' => 'A+', 'color' => 'success', 'desc' => 'Outstanding Performance'];
    } elseif ($val >= 8.0) {
        return ['letter' => 'A', 'color' => 'primary', 'desc' => 'Excellent Standing'];
    } elseif ($val >= 7.0) {
        return ['letter' => 'B', 'color' => 'info', 'desc' => 'Good Standing'];
    } elseif ($val >= 5.0) {
        return ['letter' => 'C', 'color' => 'warning', 'desc' => 'Satisfactory Performance'];
    } else {
        return ['letter' => 'F', 'color' => 'danger', 'desc' => 'Academic Notice Required'];
    }
}

// Execute grade evaluation if inputs are populated cleanly
$gradeData = (empty($errors)) ? calculateGrade($cgpa) : null;
?>

<?php include 'header.php'; ?>

<main class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger shadow border-0 p-4" role="alert">
                    <h4 class="alert-heading fw-bold"><i class="fa-solid fa-triangle-exclamation me-2"></i>Form Submission Failed</h4>
                    <p class="mb-3 text-white-50">Please clear out the execution processing validation items below:</p>
                    <hr class="border-danger">
                    <ul class="mb-0 text-white">
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="mt-4">
                        <a href="index.php" class="btn btn-light btn-sm"><i class="fa-solid fa-arrow-left me-2"></i>Return to Registry</a>
                    </div>
                </div>

            <?php else: ?>
                <div class="card gradient-profile-card shadow p-4 p-md-5 text-center text-white">
                    
                    <div class="mb-3">
                        <div class="avatar-placeholder">
                            <i class="fa-solid fa-user-gradient fa-user-graduate"></i>
                        </div>
                    </div>
                    
                    <h2 class="fw-bold mb-1 text-info">Welcome, <?php echo htmlspecialchars($name); ?>!</h2>
                    <p class="text-muted small">Registration verified successfully on: <span class="text-light fw-bold"><?php echo date("F d, Y"); ?></span></p>
                    
                    <div class="alert alert-<?php echo $gradeData['color']; ?> border-0 text-center py-3 my-4 shadow-sm">
                        <span class="d-block small text-uppercase tracking-wider opacity-75">Calculated Academic Standing</span>
                        <strong class="display-4 fw-black d-block my-1"><?php echo $gradeData['letter']; ?></strong>
                        <span class="fw-semibold"><?php echo $gradeData['desc']; ?></span>
                    </div>

                    <h5 class="text-start mb-3 border-bottom border-secondary pb-2 text-secondary-emphasis text-uppercase small tracking-wide">Submitted Records Summary</h5>
                    
                    <div class="table-responsive text-start">
                        <table class="table table-dark table-striped table-hover align-middle border border-secondary">
                            <tbody>
                                <tr>
                                    <th class="w-35 text-muted px-3" scope="row"><i class="fa-solid fa-envelope me-2 text-info"></i>Email Address</th>
                                    <td><?php echo htmlspecialchars($email); ?></td>
                                </tr>
                                <tr>
                                    <th class="text-muted px-3" scope="row"><i class="fa-solid fa-chart-bar me-2 text-info"></i>Academic CGPA</th>
                                    <td class="fw-bold text-info"><?php echo number_format(floatval($cgpa), 2); ?> / 10.00</td>
                                </tr>
                                <tr>
                                    <th class="text-muted px-3" scope="row"><i class="fa-solid fa-code-branch me-2 text-info"></i>Branch Track</th>
                                    <td><?php echo htmlspecialchars($branch); ?></td>
                                </tr>
                                <tr>
                                    <th class="text-muted px-3" scope="row"><i class="fa-solid fa-school me-2 text-info"></i>Institution</th>
                                    <td><?php echo htmlspecialchars($college); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        <a href="index.php" class="btn btn-outline-info px-4"><i class="fa-solid fa-circle-plus me-2"></i>Register New Record</a>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</main>

<?php include 'footer.php'; ?>