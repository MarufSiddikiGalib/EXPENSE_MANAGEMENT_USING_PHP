<?php include('../config/dbcon.php');  ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>



    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style/style2.css">

</head>
<body>
       

  
       <?php
       
       // Get the id from url using GET method
       if (isset($_GET['id'])){

        $id = $_GET['id'];
       

         // select the user by id from database 
         $query = "SELECT * FROM `category` WHERE `id` = '$id' ";
         $result = mysqli_query($con, $query);

         if(!$result){
            die("query Failed".mysqli_error($con));
         }
         else{
            $row = mysqli_fetch_assoc($result);
            //print_r($row);
      }
       }
       
      
      // Select input named 'update_user' using POST method
      if (isset($_POST['update_user'])){
          // Collect the id from url using GET method and store it to $id_new
          if (isset($_GET['id_new'])){
               $id_new = $_GET['id_new'];
   
               
          }
          // Collect inputs
          $categoryname = $_POST["name"];



         // Update the category into the database
         $query = "UPDATE `category` SET `name` = '$categoryname' WHERE `id` = '$id_new'";

         // Executing the query
         $result = mysqli_query($con, $query);

         if(!$result){
            // Show error
            die("query Failed".mysqli_error($con));
         }
         else{
            //Throw update messsage to url. Message showed in ./operations/home.php
            header("Location:../operations/category.php?update_msg=Succesfully_updated_the_category");  
      }

         }
     
     
       ?>






<form action="update_category.php?id_new=<?php echo $id; ?> " method = "POST">
<h1>Update Category</h1>

    

<div class="form-group">
    <label for="firstname">Category Name</label>
    <input type="text" id="name" name="name" class="form-control" value="<?php echo $row['name'] ?>" required>
</div>




       
     <input type="submit" name="update_user" class="btn btn-primary" value="UPDATE">

     </form>


</body
</html>