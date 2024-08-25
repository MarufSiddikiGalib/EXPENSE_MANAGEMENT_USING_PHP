<?php 
include('../config/dbcon.php');  



function reorderAndReset($con) {
   
   // Reorder IDs
   $reorderQuery = "SET @count = 0; UPDATE category SET id = @count:= @count + 1;";
   if (mysqli_multi_query($con, $reorderQuery)) {
       // Wait for the queries to finish
       while (mysqli_next_result($con)) {;}
   } else {
       die("Query Failed: " . mysqli_error($con));
   }

   // Reset auto-increment value
   $resetQuery = "ALTER TABLE category AUTO_INCREMENT = 1;";
   if (!mysqli_query($con, $resetQuery)) {
       die("Query Failed: " . mysqli_error($con));
   }
}





    // Get the id from url using GET method
    if (isset($_GET['id'])){       //extract the id from url
         $id_new = $_GET['id'];

     }

     // Delete the category from database
     $query = "DELETE FROM `category`WHERE `id` = '$id_new'";

     $result = mysqli_query($con, $query);
  
     if(!$result){
        //my sqi error function
        die("query Failed".mysqli_error($con));  //my sqi error function
     }

     else{
        // Call the reorder and reset function after deletion
        reorderAndReset($con); 
        header("Location:../operations/category.php?delete_msg=Succesfully_deleted_the_category");
  }
?>