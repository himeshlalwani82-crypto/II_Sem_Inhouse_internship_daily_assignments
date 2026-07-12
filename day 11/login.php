<?php
// login.php — Find the bugs!
$email = $_POST['email'];
$password = $_POST['password'];
$sql = "SELECT * FROM users
WHERE email = '$email'";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);
if ($user['password'] == $password) {
$_SESSION['user_id'] = $user['id'];
header("Location: dashboard.php");
}
echo "Invalid credentials.";
?>