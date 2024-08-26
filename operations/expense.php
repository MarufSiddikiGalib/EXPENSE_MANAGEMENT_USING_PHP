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
            <th>Category</th>
            <th>Item</th>
            <th>price</th>
            <th>Details</th>
            <th>Expense Date</th>
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
            <td> <?php echo $row['category']; ?> </td>
            <td> <?php echo $row['item']; ?> </td>
            <td> <?php echo $row['price']; ?> </td>
            <td> <?php echo $row['details']; ?> </td>
            <td> <?php echo $row['expense_date']; ?> </td>
            <td> <?php echo $row['added_on']; ?> </td>
            

            <td><a href="../process/update_expense.php?id=<?php echo $row['id']; ?>  " class = "btn btn-success">Update</a></td>
            <td><a href="../process/delete_expense.php?id=<?php echo $row['id']; ?>" class = "btn btn-danger">Delete</a></td>
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
            <label for="category">Category</label>
            <select id="category" name="category" class="form-control" required>

            <option value="" >Select Category ▼</option>
            <?php
              // Fetch categories from the database
              $query = "SELECT id, name FROM category";
              $result = mysqli_query($con, $query);

              if ($result && mysqli_num_rows($result) > 0) {
                  // Loop through the categories and create options
                  while ($row = mysqli_fetch_assoc($result)) {
                      // Show category_name in the dropdown
                      // htmlspecialchars is used to prevent any HTML injection
                      echo '<option value="' . htmlspecialchars($row['name']) . '">' . htmlspecialchars($row['name']) . '</option>';
                  }
              } else {
                  echo '<option value="">No categories found</option>';
              }
              ?>
              
            </select>
          </div>



            <div class="form-group">
                <label for="item">Item</label>
                <input type="text" id="item" name="item" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="text" id="price" name="price" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="details">Details</label>
                <input type="text" id="details" name="details" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="firstname">expense Date</label>
                <input type="date" id="expense_date" name="expense_date" class="form-control" required>
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