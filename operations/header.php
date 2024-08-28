<?php 
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_role'])) {
    // Redirect to the login page if the session is not set
    header('Location: ../operations/index.php');
    exit();
}

$user_role = $_SESSION['user_role'];

// Restrict access to admin pages for non-admin users
$admin_pages = ['category.php', 'home.php']; // List of admin-only pages

// Store name of the current page that the user is trying to access
// $_SERVER['PHP_SELF'] returns the path of the currently executing file
// basename() extracts just the file name from that path
$current_page = basename($_SERVER['PHP_SELF']);

// in_array($current_page, $admin_pages) campare the current page with admin pages they matches or not
if ($user_role == 'User' && in_array($current_page, $admin_pages)) {
    // Redirect users away from admin only pages
    header('Location: dashboard.php');
    exit();
}

?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>


<?php 
if ($user_role == 'User') { 
?>
    <a href="dashboard.php" class="btn btn-success">Dashboard</a> 
    <a href="expense.php" class="btn btn-success">Expense</a> 
    <a href="report.php" class="btn btn-success">Report</a> 
    <a href="../process/logout_process.php" class="btn btn-danger">Logout</a> 
<?php 
} elseif ($user_role == 'Admin') { 
?>
    <a href="dashboard.php" class="btn btn-success">Dashboard</a> 
    <a href="category.php" class="btn btn-success">Category</a> 
    <a href="home.php" class="btn btn-success">Users</a> 
    <a href="expense.php" class="btn btn-success">Expense</a> 
    <a href="report.php" class="btn btn-success">Report</a> 
    <a href="../process/logout_process.php" class="btn btn-danger">Logout</a> 
<?php 
}
?>
