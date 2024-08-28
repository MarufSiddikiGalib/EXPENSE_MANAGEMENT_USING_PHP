<?php 
include('../config/dbcon.php');  
include('header.php');  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  
    <!-- <link rel="stylesheet" href="../style/style_home.css"> -->
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
        
        
        
        

<div class = "container"></div>

<div class = "box">
<h3>ALL USERS</h3>
<button class = "btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-toggle="modal" data-target="#exampleModal" >ADD USER</button>
</div>

<h1>Admin Panel</h1>

<table class = "table table-bordered">
    <thead></thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>username</th>
            <th>mobile Number</th>
            <th>email</th>
            <th>dob</th>
            <th>Role</th>

            <th>Update</th>
            <th>Delete</th>
        </tr>
     </thead>

    <tbody>

     <?php
     
     // Select from database using query
     $query = "SELECT * FROM `users`";
     $result = mysqli_query($con, $query);

     if(!$result){
        die("query Failed".mysqli_error($con));
     }
     else{
        while($row = mysqli_fetch_assoc($result)){
            ?>
        
        <tr>
            <td> <?php echo $row['id']; ?> </td>
            <td> <?php echo $row['first_name']; ?> </td>
            <td> <?php echo $row['last_name']; ?> </td>
            <td> <?php echo $row['username']; ?> </td>
            <td> <?php echo $row['mobile_number']; ?> </td>
            <td> <?php echo $row['email']; ?> </td>
            <td> <?php echo $row['dob']; ?> </td>
            <td> <?php echo $row['role']; ?> </td>
    

            <td><a href="../process/update_user.php?id=<?php echo $row['id']; ?>  " class = "btn btn-success">Update</a></td>
            <td><a href="../process/delete._user.php?id=<?php echo $row['id']; ?>" class = "btn btn-danger" onclick="return confirmDeletion();">Delete</a></td>
             
            <script>
              // javascript for a confirmation alert in time of deleting
              function confirmDeletion() {
              return confirm("Are you sure you want to delete this user?");
              }
            </script> 

        </tr>

            <?php
        }
     }
     
     ?>

       

    </tbody>

</table>



<?php 
  
  if (isset($_GET['message'])){  // extract the message from url

    echo "<h6 class='text-danger'>" . htmlspecialchars($_GET['message']) . "</h6>";

  }


  
  if (isset($_GET['insert_message'])){  // extract the message from url

    echo "<h6 class='text-danger'>" . htmlspecialchars($_GET['insert_message']) . "</h6>";

  }


  if (isset($_GET['update_msg'])){   // extract the message from url

    echo "<h6 class='text-danger'>" . htmlspecialchars($_GET['update_msg']) . "</h6>";

  }


  if (isset($_GET['delete_msg'])){   // extract the message from url

    echo "<h6 class='text-danger'>" . htmlspecialchars($_GET['delete_msg']) . "</h6>";

  }

 ?>



<!-- Modal -->

<form action="../process/insert.php" method="post">

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">ADD USER</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">

    

            <div class="form-group">
                <label for="firstname">First Name</label>
                <input type="text" id="firstname" name="firstname" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" id="lastname" name="lastname" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="mobile">Mobile Number</label>
                <input type="tel" id="mobile" name="mobile" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Re-enter Password</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="role">Role(Admin/User)</label>
                <input type="text" id="role" name="role" class="form-control" required>
            </div>
    

  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <input type="submit" name="add_user" class="btn btn-primary" value="ADD">
  </div>
</div>
</div>
</div>

   </form>

</div>







        


</body>
</html>