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
    <title>Expense Report</title>
    
<body>

<div class="container">
    <div class="box">
        <h3>Expenses</h3>
    </div>

    <!-- Date Filter Form -->
    <form method="GET" action="report.php">
        <div class="form-group">
            <label for="from_date">From Date:</label>
            <input type="date" id="from_date" name="from_date" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="to_date">To Date:</label>
            <input type="date" id="to_date" name="to_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="report.php" class="btn btn-secondary">Reset</a>
    </form>

    

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Category</th>
                <th>Price (Total)</th>
            </tr>
        </thead>
        <tbody>

        <?php
        // Initialize grand total
        $grand_total = 0;

        // Get date filter values
        $from_date = isset($_GET['from_date']) ? $_GET['from_date'] : '';
        $to_date = isset($_GET['to_date']) ? $_GET['to_date'] : '';



        // Modify query to filter by date if date range is provided
        $query = "SELECT `category`, SUM(`price`) AS total_price FROM `expense`";
        if ($from_date && $to_date) {
            $query .= " WHERE `expense_date` BETWEEN '$from_date' AND '$to_date'";
        }
        $query .= " GROUP BY `category`";



        $result = mysqli_query($con, $query);

        if (!$result) {
            die("Query Failed: " . mysqli_error($con));
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                // Accumulate the grand total
                $grand_total += $row['total_price'];
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['category']); ?></td>
                    <td><?php echo number_format($row['total_price'], 2); ?></td> <!-- argument 2 specifies that number is formatted with 2 decimal places -->
                </tr>
                <?php
            }
        }
        ?>

        <!-- Display Grand Total -->
        <tr>
            <td><strong>Grand Total</strong></td>
            <!-- strong rendering the text in bold , highlight it-->
            <td><strong><?php echo number_format($grand_total, 2); ?></strong></td>
        </tr>

        </tbody>
    </table>
</div>

</body>
</html>
