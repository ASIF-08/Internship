<?php
include('connection.php');

if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];
    
    $sql_1 = "SELECT * FROM customer where id=$from";
    $result1= $conn->query($sql_1);
    $sql_2= "SELECT * FROM customer where id=$to";
    $result2= $conn->query($sql_2);
    if ($result1->num_rows >0 && $result2->num_rows >0) {
      while($sql1= $result1->fetch_assoc() AND $sql2= $result2->fetch_assoc()) {

       
    // $sql1=mysqli_fetch_assoc($query); // returns array or output of user from which the amount is to be transferred.

    



    // constraint to check input of negative value by user
    if (($amount)<0)
   {
        echo '<script type="text/javascript">';
        echo ' alert("Oops! Negative values cannot be transferred")';  // showing an alert box.
        echo '</script>';
    }


  
    // constraint to check insufficient balance.
    else if($amount > $sql1['balance']) 
    {
        
        echo '<script type="text/javascript">';
        echo ' alert("Bad Luck! Insufficient Balance")';  // showing an alert box.
        echo '</script>';
    }
    


    // constraint to check zero values
    else if($amount == 0){

         echo "<script type='text/javascript'>";
         echo "alert('Oops! Zero value cannot be transferred')";
         echo "</script>";
     }


    else {
        
                // deducting amount from sender's account
                $newbalance = $sql1['balance'] - $amount;
                $sql = "UPDATE customer set balance=$newbalance where id=$from";
                mysqli_query($conn,$sql);

                $newbalance = $sql2['balance'] + $amount;
            $sql = "UPDATE customer set balance=$newbalance where id=$to";
            $query=mysqli_query($conn,$sql);
             if($query){
                 echo "<script> alert('Transaction Successful');
                 window.location='index.php';
                 </script>";
                
            }

            $newbalance= 0;
            $amount =0;
        }
                
      }
     }
      else {
        echo "0 results";
      }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Money Bank</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
<?php 
        include('connection.php');
    ?>
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    
  <a class="navbar-brand" href="#">
      <img src="Bank.png" alt="" width="40" height="40" class="d-inline-block align-text-center">
      Money Bank
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="#">About</a>
        </li> -->
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="contact.php">Contact</a>
        </li>
        
      </ul>
    </div>
  </div>
</nav>
<div class="container"><br>
<!-- <div class="d-flex flex-column align-items-center text-center">  -->
<h3 style= "text-align: center;">Transaction</h3><br>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">First Name</th>
              <th scope="col">Last NAme</th>
              <th scope="col">Email</th>
              <th scope="col">Balance</th>
            </tr>
          </thead>
          <tbody>

          <?php 
          $sid=$_GET['id'];
            $sql = "SELECT * FROM customer where id='$sid'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
          ?>
            <tr>
              <td><?php echo $row['id']; ?></td>
              
              <td><?php echo $row['firstname']; ?></td>
              <td><?php echo $row['lastname']; ?></td>
              <td><?php echo $row['email']; ?></td>
              <td><?php echo $row['balance']; ?></td>
            </tr>
            
            <?php
            }
           }
            else {
              echo "0 results";
            }
             ?>
          </tbody>
        </table>
      </div>   
<div class="col-md-12">
  <div class="card mb-3">
    <div class="card-body">
    <form method="post"  class="tabletext" >
    <div class="mb-3">
      <label for="disabledSelect" class="form-label">Select Recipient</label>
      <select name="to" id="disabledSelect" class="form-select">
      <option value="" disabled selected>Choose</option>
            <?php
                include 'connection.php';
                
                $sql = "SELECT * FROM customer where id!=$sid";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error ".$sql."<br>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option class="table" value="<?php echo $rows['id'];?>">
                  
                <?php echo $rows['firstname'];?>&nbsp;&nbsp;<?php echo $rows['lastname'];?>
                </option>
            <?php 
                } 
            ?>
      </select>
    </div>
 
    <hr>
    <div class="row g-3 align-items-center">
  <div class="col-auto">
    <label for="inputPassword6" class="col-form-label">Amount</label>
  </div>
  <div class="col-auto">
    <input type="number"  class="form-control" name="amount" placeholder="Enter Amount">
  </div>
  <div class="col-auto">
    <span id="passwordHelpInline" class="form-text">
      
    </span>
  </div>
</div>
    
    
      <hr>
     
      <div class="row">
        <div class="col-sm-12"> 
          <!-- <a class="btn btn-info btn-lg col-2 " target="__blank" href="asif.php" id="exampleModalLabel">Confirm</a> -->
          <button class="btn btn-primary" name="submit" type="submit" id="btn">Transfer</button>
        </div>
      </div>
</form>
    </div>
  </div>
</div>
</div> 
              </div>
              <?php include('footer.php') ?>
 
</body>
</html>