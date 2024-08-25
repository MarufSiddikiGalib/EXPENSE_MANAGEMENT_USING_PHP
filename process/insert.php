<?php 
// user insertion , category insertion and expense insertion all are here
include('../config/dbcon.php');  


// USER INSERTION

// Select input named "add_user" using POST method
if (isset($_POST['add_user'])){

   // Collect inputs
   $firstname = $_POST["firstname"];
   $lastname = $_POST["lastname"];
   $username = $_POST["username"];
   $mobile = $_POST["mobile"];
   $email = $_POST["email"];
   $dob = $_POST["dob"];
   $password = $_POST["password"];
   $confirm_password = $_POST["confirm_password"];

    if($firstname == "" || empty($firstname)){
        //Throw errror messsage to url. Message showed in ./operations/home.php
        $message = urlencode("INSERT FIRST NAME");
        header("Location: ../operations/home.php?message=" . $message);
        exit;
            
        }

else{

        //Hashing the password before storing it
        //password_hash is a inbuild function
        //PASSWORD_BCRYPT is the hashing algorithm
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert the user into the database
        $query = "INSERT INTO `users` (`first_name`, `last_name`, `username` , `mobile_number` , `email` , `dob` , `Password`) VALUES ('$firstname', '$lastname', '$username' , '$mobile' , '$email' , '$dob' , '$hashedPassword')";

        $result = mysqli_query($con, $query);
     


       if( !$result ){
           // Show error message properly
           die("Query Failed".mysqli_error($con));
        }

       else{
         //Throw success messsage to url. Message showed in ./operations/home.php
         $message = urlencode("USER ADDED SUCCESSFULL");
         header("Location:../operations/home.php?message=" . $message);
         exit;
       }
}


}






// CATEGORY INSERTION



// Select input named "add_category" using POST method
if (isset($_POST['add_category'])){

   // Collect inputs
   $categoryname = $_POST["name"];
   

    if($categoryname == "" || empty($categoryname)){
        //Throw errror messsage to url. Message showed in ./operations/category.php
        $message = urlencode("INSERT FIRST NAME");
        header("Location: ../operations/category.php?message=" . $message);
        exit;
            
        }

else{



        // Insert the category into the database
        $query = "INSERT INTO `category` (`name`) VALUES ('$categoryname')";

        $result = mysqli_query($con, $query);
     


       if( !$result ){
           // Show error message properly
           die("Query Failed".mysqli_error($con));
        }

       else{
         //Throw success messsage to url. Message showed in ./operations/home.php
         $message = urlencode("USER ADDED SUCCESSFULL");
         header("Location:../operations/category.php?message=" . $message);
         exit;
       }
}


}






// EXPENSE INSERTION



// Select input named "add_expense" using POST method
if (isset($_POST['add_expense'])){

   // Collect inputs
   $category_id = $_POST["category_id"];
   $item = $_POST["item"];
   $price = $_POST["price"];
   $details = $_POST["details"];
   $added_on = $_POST["added_on"];
   

    if($item == "" || empty($item)){
        //Throw errror messsage to url. Message showed in ./operations/expense.php
        $message = urlencode("INSERT ITEM");
        header("Location: ../operations/expense.php?message=" . $message);
        exit;
            
        }

else{


        // Insert the expense into the database
        $query = "INSERT INTO `expense` (`category_id`, `item`, `price` , `details` , `added_on`) VALUES ('$category_id', '$item', '$price' , '$details' , '$added_on')";

        $result = mysqli_query($con, $query);
     


       if( !$result ){
           // Show error message properly
           die("Query Failed".mysqli_error($con));
        }

       else{
         //Throw success messsage to url. Message showed in ./operations/expense.php
         $message = urlencode("EXPENSE ADDED SUCCESSFULL");
         header("Location:../operations/expense.php?message=" . $message);
         exit;
       }
}


}




?>