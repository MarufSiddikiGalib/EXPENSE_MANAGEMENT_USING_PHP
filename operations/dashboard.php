<?php 
include('../config/dbcon.php');
include('header.php');  
session_start(); // session underscore start.
?>

<?php 
// Displaying welcome message with session variable
if (isset($_SESSION['username'])) {
    echo "<h3>Welcome " . $_SESSION['username'] . "</h3>"; 
} else {
    // Throw error message to the url and show the message to index.php
    header('location: index.php?error_msg2=please login to enter the site');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>

<div class="container">
    <h3>Expense Dashboard</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Category</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Function to calculate expenses based on a given date range
            function getExpense($con, $startDate, $endDate) {
                $query = "SELECT SUM(price) AS total FROM expense WHERE expense_date BETWEEN '$startDate' AND '$endDate'";
                $result = mysqli_query($con, $query);
                if ($row = mysqli_fetch_assoc($result)) {
                    return $row['total'] ? $row['total'] : 0;
                }
                return 0;
            }

            // Today's expense
            $today = date('Y-m-d');
            $todaysExpense = getExpense($con, $today, $today);

            // Yesterday's expense
            $yesterday = date('Y-m-d', strtotime('-1 day'));
            $yesterdaysExpense = getExpense($con, $yesterday, $yesterday);

            // This week's expense (from the beginning of the week to today)
            $startOfWeek = date('Y-m-d', strtotime('monday this week'));
            $thisWeeksExpense = getExpense($con, $startOfWeek, $today);

            // This month's expense (from the beginning of the month to today)
            $startOfMonth = date('Y-m-01');
            $thisMonthsExpense = getExpense($con, $startOfMonth, $today);

            // This year's expense (from the beginning of the year to today)
            $startOfYear = date('Y-01-01');
            $thisYearsExpense = getExpense($con, $startOfYear, $today);

            // Total expense
            // started it from 2024 
            $totalExpense = getExpense($con, '2024-01-01', $today); 

            ?>

            <tr>
                <td>Today's expense</td>
                <td><?php echo number_format($todaysExpense, 2); ?></td>
                <td><a href="report.php?from_date=<?php echo $today; ?>&to_date=<?php echo $today; ?>" class="btn btn-primary">Report</a></td>
            </tr>
            <tr>
                <td>Yesterday's expense</td>
                <td><?php echo number_format($yesterdaysExpense, 2); ?></td>
                <td><a href="report.php?from_date=<?php echo $yesterday; ?>&to_date=<?php echo $yesterday; ?>" class="btn btn-primary">Report</a></td>
            </tr>
            <tr>
                <td>This week expense</td>
                <td><?php echo number_format($thisWeeksExpense, 2); ?></td>
                <td><a href="report.php?from_date=<?php echo $startOfWeek; ?>&to_date=<?php echo $today; ?>" class="btn btn-primary">Report</a></td>
            </tr>
            <tr>
                <td>This month expense</td>
                <td><?php echo number_format($thisMonthsExpense, 2); ?></td>
                <td><a href="report.php?from_date=<?php echo $startOfMonth; ?>&to_date=<?php echo $today; ?>" class="btn btn-primary">Report</a></td>
            </tr>
            <tr>
                <td>This year expense</td>
                <td><?php echo number_format($thisYearsExpense, 2); ?></td>
                <td><a href="report.php?from_date=<?php echo $startOfYear; ?>&to_date=<?php echo $today; ?>" class="btn btn-primary">Report</a></td>
            </tr>
            <tr>
                <td>Total expense</td>
                <td><?php echo number_format($totalExpense, 2); ?></td>
                <td><a href="report.php?from_date=1970-01-01&to_date=<?php echo $today; ?>" class="btn btn-primary">Report</a></td>
            </tr>
        </tbody>
    </table>
</div>

</body>
</html>
