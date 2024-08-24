<?php 
include('../config/dbcon.php'); 

// //Import PHPMailer classes into the global namespace
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP;
// use PHPMailer\PHPMailer\Exception;

// use PHPMailer\PHPMailer\OAuth;
// //Alias the League Google OAuth2 provider class
// use League\OAuth2\Client\Provider\Google;



//  function sendMail($email, $reset_token){
//     require '../PHPMailer/Exception.php';
//     require '../PHPMailer/PHPMailer.php';
//     require '../PHPMailer/SMTP.php';

//     // Load Composer's autoloader
//     require '../vendor/autoload.php'; 

//     //Create object of php mailer and passed true
//     $mail = new PHPMailer(true);


    
//         try {
//             // Server settings
//             $mail->isSMTP();
//             $mail->Host = 'smtp.gmail.com';
//             $mail->Port = 587;
//             $mail->SMTPAuth = true;
//             $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    
//             // OAuth 2.0 settings
//             $clientId = '';
//             $clientSecret = '';
//             $refreshToken = '';

//             //$email = 'noreply06969@gmail.com';
    
//             $provider = new Google([
//                 'clientId' => $clientId,
//                 'clientSecret' => $clientSecret,
//             ]);
    
//             $mail->setOAuth(new OAuth([
//                 'provider' => $provider,
//                 'clientId' => $clientId,
//                 'clientSecret' => $clientSecret,
//                 'refreshToken' => $refreshToken,
//                 'userName' => $email,
//             ]));
    
//             // Recipients
//             $mail->setFrom('', '');
//             $mail->addAddress($email); // Add a recipient
    
//             // Content
//             $mail->isHTML(true);
//             $mail->Subject = "Password reset link";
//             $mail->Body = "We got a request from you to reset your password <br>
//             Click the link bellow: <br>
//             <a href='http://localhost/login_system/update_password.php?email=$email&reset_token=$reset_token'  >Reset your pasword</a>
//             ";
    
//             $mail->send();
//             return true; // Email sent successfully
//         } catch (Exception $e) {
//             return false; // Email failed to send
//         }
    
 
//     // Example usage
//     //sendEmail('recipient@example.com', 'Test Email Subject', 'This is the email body content.');
    



//  }

//Select email from form using POST method
if (isset($_POST['email'])){

    $email = $_POST['email'];
   
   //Select info from database using query
    $query = "SELECT * FROM `users` WHERE `email` = '$email'";
    $result = mysqli_query($con, $query);

   if($result){

    //Selecting row
    if(mysqli_num_rows($result) == 1){
            
    //    $reset_token = bin2hex(random_bytes(16));
    //    date_default_timezone_set('Asia/Dhaka');
    //    $date = date("Y-m-d");

    //    $query = "UPDATE `info` SET `resetToken`='$reset_token',`resetTokenExpire`='$date' WHERE `email` = '$email'";
    //    //$result = mysqli_query($con, $query);
       
    //    //email and reset token stored in sendmail function when the query run
    //    if(mysqli_query($con, $query) && sendMail($email, $reset_token)){
        
           //Throw the email address to the url and change the directory to update_password.php
           header("location:../operations/update_password.php?email=$email"); 
           exit();

       }

       else{
        //Throw error message to the url and change the directory to password_reset.php
        header('location: ../operations/password_reset.php?error_msg3=Email not found'); 
        exit();
     }
       
         }

        //  else{
        //     //Throw error message to the url and change the directory to password_reset.php
        //     header('location: ../operations/password_reset.php?error_msg4=Email not found'); 
        //     exit();
        //  }
         
   
   } 
   
   




?>

