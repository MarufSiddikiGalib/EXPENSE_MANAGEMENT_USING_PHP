<?php 
include('../config/dbcon.php');
include('header.php');  
session_start() // session underscore start.
?>

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    


<div class = "container"></div>

<div class = "box">
<h3>Expenses</h3>
<button class = "btn" data-toggle="modal" data-target="#exampleModal" data-toggle="modal" data-target="#exampleModal" >ADD EXPENSE</button>
</div>

<h1>Admin Panel</h1>

<table>
    <thead></thead>
        <tr>
            <th>ID</th>
            <th>Category ID</th>
            <th>Item</th>
            <th>price</th>
            <th>Details</th>
            <th>Added on</th>

            <th>Update</th>
            <th>Delete</th>
        </tr>
     </thead>

    <tbody>

     <?php
     
     // Select from database using query
     $query = "SELECT * FROM `expense`";
     $result = mysqli_query($con, $query);

     if(!$result){
        die("query Failed".mysqli_error($con));
     }
     else{
        while($row = mysqli_fetch_assoc($result)){
            ?>
        
        <tr>
            <td> <?php echo $row['id']; ?> </td>
            <td> <?php echo $row['category_id']; ?> </td>
            <td> <?php echo $row['item']; ?> </td>
            <td> <?php echo $row['price']; ?> </td>
            <td> <?php echo $row['details']; ?> </td>
            <td> <?php echo $row['added_on']; ?> </td>
            

            <td><a href="../process/update_category.php?id=<?php echo $row['id']; ?>  " class = "btn btn-success">Update</a></td>
            <td><a href="../process/delete_category.php?id=<?php echo $row['id']; ?>" class = "btn btn-danger">Delete</a></td>
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
    <h5 class="modal-title" id="exampleModalLabel">ADD EXPENSE</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">

    


            <div class="form-group">
                <label for="firstname">Category ID</label>
                <input type="text" id="category_id" name="category_id" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="firstname">Item</label>
                <input type="text" id="item" name="item" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="firstname">Price</label>
                <input type="text" id="price" name="price" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="firstname">Details</label>
                <input type="text" id="details" name="details" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="firstname">Added on</label>
                <input type="date" id="added_on" name="added_on" class="form-control" required>
            </div>
           

  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <input type="submit" name="add_expense" class="btn btn-primary" value="ADD">
  </div>
</div>
</div>
</div>

   </form>

</div>






</body>
</html>