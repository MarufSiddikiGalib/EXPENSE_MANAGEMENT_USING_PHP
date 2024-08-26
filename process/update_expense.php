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
         $query = "SELECT * FROM `expense` WHERE `id` = '$id' ";
         $result = mysqli_query($con, $query);

         if(!$result){
            die("query Failed".mysqli_error($con));
         }
         else{
            $row = mysqli_fetch_assoc($result);
            //print_r($row);
      }
       }
       
      
      // Select input named 'update_expense' using POST method
      if (isset($_POST['update_expense'])){
          // Collect the id from url using GET method and store it to $id_new
          if (isset($_GET['id_new'])){
               $id_new = $_GET['id_new'];
   
               
          }
           // Collect inputs
          $category = $_POST["category"];
          $item = $_POST["item"];
          $price = $_POST["price"];
          $details = $_POST["details"];
          $expense_date = $_POST["expense_date"];
   
          date_default_timezone_set('Asia/Dhaka');
          $added_on = date('Y-m-d h:i:s');

         


         // Update the expense into the database
         $query = "UPDATE `expense` SET `category` = '$category', `item` = '$item', `price` = '$price' , `details` = '$details' , `added_on` = '$added_on'  WHERE `id` = '$id_new'";

         // Executing the query
         $result = mysqli_query($con, $query);

         if(!$result){
            die("query Failed".mysqli_error($con));
         }
         else{
            //Throw update messsage to url. Message showed in ./operations/expense.php
            header("Location:../operations/expense.php?update_msg=Succesfully_updated_the_item");  
      }

         }
     
     
       ?>






<form action="update_expense.php?id_new=<?php echo $id; ?> " method = "POST">

<h1>Update expense</h1>
    






<div class="form-group">
    <label for="item">Item</label>
    <input type="text" id="item" name="item" class="form-control" value= "<?php echo $row['item'] ?>" required>
</div>
<div class="form-group">
    <label for="price">Price</label>
    <input type="text" id="price" name="price" class="form-control" value= "<?php echo $row['price'] ?>"   required>
</div>
<div class="form-group">
    <label for="details">Details</label>
    <input type="tel" id="details" name="details" class="form-control" value= "<?php echo $row['details'] ?>" required>
</div>
<div class="form-group">
    <label for="expense_date">Expense date</label>
    <input type="date" id="expense_date" name="expense_date" class="form-control" value= "<?php echo $row['expense_date'] ?>" required>
</div>




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







       
     <input type="submit" name="update_expense" class="btn btn-primary" value="UPDATE">

     </form>


</body
</html>