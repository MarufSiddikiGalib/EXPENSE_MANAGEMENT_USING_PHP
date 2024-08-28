<?php 
include('../config/dbcon.php'); 
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    


<?php
       //select login using POST method
       if (isset($_POST['login'])){ 

      $username = $_POST['username'];
      $password = $_POST['password'];
       

       //Select login info from database using my sql query
       //$query = "SELECT * FROM `info` WHERE `username` = '$username' AND `password` = '$password'";
       $query = "SELECT * FROM `users` WHERE `username` = '$username'";
       
       
      
      //Executing the query
       $result = mysqli_query($con, $query);

       if(!$result){
         //Display error in proper way
        die("query Failed".mysqli_error($con));
     }
     
          //Selecting row
          if(mysqli_num_rows($result) === 1){
            
            // Fetch the user data
            $row = mysqli_fetch_assoc($result);

             //Varify from hashed password
             //password_verify is an in built function
             $hashedPassword = $row['password'];
             

             //Given password checked with the hashedPassword
            if(password_verify($password, $hashedPassword)){

             //Get username with the session variable and change the directory to home.php
             $_SESSION['username'] = $username;
             // Get the role. Two role (Admin and User)
             $_SESSION['user_role'] = $row['role'];
          
             header('location: ../operations/dashboard.php');
             exit();
             }

             else{
               //Throw error message to the url and change the directory to index.php
               header('location: ../operations/index.php?error_msg=Incorrect username or password'); 
               exit();
             }

            }

         
       
          else{
            //Throw error message to the url and change the directory to index.php
            header('location: ../operations/index.php?error_msg=Incorrect username or password'); 
            exit();
         }
      }
       
     
?>


</body>
</html>