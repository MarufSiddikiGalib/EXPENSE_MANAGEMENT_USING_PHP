<?php include('../config/dbcon.php');  
session_start() // session underscore start.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>
    
    <?php 
          //Displaying wellcome message with session variable
          //if we use session variable any time we have to start the seation must
          if(isset($_SESSION['username'])){

              echo "<h3>wellcome " . $_SESSION['username'] . "</h3>"; 

          }
          else{
            //Throw error message to the url and show the message to index.php
            header('location: index.php?error_msg2=please login to enter the site');
          }
    
    
    
    ?>
         

         <a href="../process/logout_process.php" class = "btn btn-danger" >Logout</a>  

        


</body>
</html>