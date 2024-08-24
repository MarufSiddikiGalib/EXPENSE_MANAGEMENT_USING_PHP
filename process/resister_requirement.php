<?php
 include('../config/dbcon.php');  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input
    $firstname = clean_input($_POST["firstname"]);
    $lastname = clean_input($_POST["lastname"]);
    $username = clean_input($_POST["username"]);
    $mobile = clean_input($_POST["mobile"]);
    $email = clean_input($_POST["email"]);
    $dob = clean_input($_POST["dob"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Initialize an array to hold errors
    $errors = [];

    // Validate first and last names
    if (empty($firstname)) {
        $errors[] = "First name is required.";
    }

    if (empty($lastname)) {
        $errors[] = "Last name is required.";
    }

    // Validate username length (5-15 characters)
    if (strlen($username) < 5 || strlen($username) > 15) {
        $errors[] = "Username must be between 5 and 15 characters.";
    }

    // Validate mobile number (11-digit number)
    if (!preg_match("/^[0-9]{11}$/", $mobile)) {
        $errors[] = "Mobile number must be an 11-digit number.";
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Validate date of birth
    if (empty($dob)) {
        $errors[] = "Date of birth is required.";
    }

    // Validate password strength
    $password_regex = "/^(?=.*[A-Z])(?=.*[!@#$&*]).{8,}$/";
    if (!preg_match($password_regex, $password)) {
        $errors[] = "Password must be at least 8 characters long, include at least one uppercase letter, and one special character.";
    }

    // Check if password and confirm_password match
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";
    }

    // If no errors, proceed with registration
    if (empty($errors)) {



    
        //Hashing the password before storing it
        //password_hash is a inbuild function
        //PASSWORD_BCRYPT is the hashing algorithm
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);


        // Insert the user into the database
        $query = "INSERT INTO `users` (`first_name`, `last_name`, `username` , `mobile_number` , `email` , `dob` , `Password`) VALUES ('$firstname', '$lastname', '$username' , '$mobile' , '$email' , '$dob' , '$hashedPassword')";

        $result = mysqli_query($con, $query);

        if(!$result){
            die ("Query failed" . mysqli_error($con));
        }
        
        else{
            //Throw success message to the url and open to index.php
            header("location:index.php?success_msg=Resistration complete. please login" );
        }

        
        //Change the directory to insert.php
        //header("location:process/insert.php");

        




        
    } else {
        // Display errors
        foreach ($errors as $error) {
            echo "<p class='error'>$error</p>";
        }
    }
}

// Function to sanitize input
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>