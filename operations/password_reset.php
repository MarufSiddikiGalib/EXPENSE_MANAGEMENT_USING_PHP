<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="../style/reset_password.css">
</head>
<body>
    <div class="reset-container">
        <h2>Reset Password</h2>
        <form action="../process/reset_process.php" method="post">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
            </div>
            <button type="submit" class="btn">Send Link</button>
        </form>
        <a href="index.php">Back to Login</a>

        <?php 

        // Get message from url. message threw from reset_process.php
        if(isset($_GET['error_msg3'])){
            echo "<h5 class='text-danger'>" . htmlspecialchars($_GET['error_msg3']) . "</h5>";
        }

        //   // Get message from url. message threw from reset_process.php
        //   if(isset($_GET['error_msg5'])){
        //     echo "<h6 class='text-success'>" . htmlspecialchars($_GET['error_msg4']) . "</h6>";
        // }
        ?>
    </div>
</body>
</html>