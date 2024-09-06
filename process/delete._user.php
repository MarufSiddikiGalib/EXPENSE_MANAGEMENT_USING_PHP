 <?php 
include('../config/dbcon.php');  



function reorderAndReset($con) {
   
   // Reorder IDs of users
   $reorderQuery = "SET @count = 0; UPDATE users SET id = @count:= @count + 1;";
   if (mysqli_multi_query($con, $reorderQuery)) {
       // Wait for the queries to finish
       while (mysqli_next_result($con)) {;}
   } else {
       die("Query Failed: " . mysqli_error($con));
   }



   // Reset auto-increment value of users
   $resetQuery = "ALTER TABLE users AUTO_INCREMENT = 1;";
   if (!mysqli_query($con, $resetQuery)) {
       die("Query Failed: " . mysqli_error($con));
   }



// Reorder IDs of expense
$reorderQuery = "SET @count = 0; UPDATE expense SET id = @count:= @count + 1;";
if (mysqli_multi_query($con, $reorderQuery)) {
    // Wait for the queries to finish
    while (mysqli_next_result($con)) {;}
} else {
    die("Query Failed: " . mysqli_error($con));
}



// Reset auto-increment value of expense
$resetQuery = "ALTER TABLE expense AUTO_INCREMENT = 1;";
if (!mysqli_query($con, $resetQuery)) {
    die("Query Failed: " . mysqli_error($con));
}



}





    // Get the id from url using GET method
    if (isset($_GET['id'])){       //extract the id from url
         $id_new = $_GET['id'];

     }

     // Delete the expenses added by that particuar user we are deleting from database
     $expenseDeleteQuery = "DELETE FROM `expense` WHERE `added_by` = (SELECT `username` FROM `users` WHERE `id` = '$id_new')";
     mysqli_query($con, $expenseDeleteQuery);

     // Delete the user from database
     $userDeleteQuery = "DELETE FROM `users`WHERE `id` = '$id_new'";
     // In the $userDeleteResult we are storing both delete expense and delete user query
     $userDeleteResult = mysqli_query($con, $userDeleteQuery);

  
     if(!$userDeleteResult){
        // My sqi error function
        die("query Failed".mysqli_error($con));  
     }

     else{
        // Call the reorder and reset function after deletion
        reorderAndReset($con); 
        header("Location:../operations/home.php?delete_msg=Succesfully_deleted_the_user");
  }

?> 