<?php 
include('../config/dbcon.php');
include('header.php');  
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
    <title>Categories</title>

</head>

<body>

    <div class="container"></div>

    <div class="box">
        <h3>Categories</h3>
        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-toggle="modal"
            data-target="#exampleModal">ADD CATEGORY</button>
    </div>

    <br>

    <table class="table table-bordered">
        <thead></thead>
        <tr>
            <th>ID</th>
            <th>Category Name</th>

            <th>Update</th>
            <th>Delete</th>
        </tr>
        </thead>

        <tbody>

            <?php
     
     // Select from database using query
     $query = "SELECT * FROM `category`";
     $result = mysqli_query($con, $query);

     if(!$result){
        die("query Failed".mysqli_error($con));
     }
     else{
        while($row = mysqli_fetch_assoc($result)){
            ?>

            <tr>
                <td> <?php echo $row['id']; ?> </td>
                <td> <?php echo $row['name']; ?> </td>


                <td><a href="../process/update_category.php?id=<?php echo $row['id']; ?>  "
                        class="btn btn-success">Update</a></td>
                <td><a href="../process/delete_category.php?id=<?php echo $row['id']; ?>"
                        class="btn btn-danger" onclick = "return confirmDeletion();" >Delete</a></td>


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

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">ADD CATEGORY</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">



                        <div class="form-group">
                            <label for="firstname">Category Name</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <input type="submit" name="add_category" class="btn btn-primary" value="ADD">
                    </div>
                </div>
            </div>
        </div>

    </form>

    </div>







</body>

</html>