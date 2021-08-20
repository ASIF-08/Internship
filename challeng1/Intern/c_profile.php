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
<body style>
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
</nav><br>

<div class="container">
  
    <div class="d-flex flex-column align-items-center text-center"> 
      
  <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="admin" class="rounded-circle" width="200">
  <h3>Customer Profile</h3>
  <div class="mt-3">
  </div>
</div>

<?php 
            $uid=$_GET['edt'];
            $query=mysqli_query($conn,"select * from customer where id='$uid'");
            
            // $sql = "SELECT * FROM customer";
            // $result = $conn->query($sql);

            if ($query->num_rows > 0) {
              while($row = $query->fetch_assoc()) {
          ?>
<div class="col-md-12">
  <div class="card mb-3">
    <div class="card-body">
      <div class="row">
      <div class="col-sm-3">
        <h6 class="mb-0">ID</h6>
        <tr>
          <td><?php echo$row['id'];?></td>
        
    </div>
    <div class="col-sm-9 text-secondary"></div></div>
    <hr>
    <div class="row">
      <div class="col-sm-3">
        <h6 class="mb-0">Full Name</h6>
        
        
          <td><?php echo$row['firstname'];?>&nbsp;<?php echo$row['lastname'];?><td>
        
      </div>
      <div class="col-sm-9 text-secondary"></div>
    </div>
    <hr>
    <div class="row">
      <div class="col-sm-3">
        <h6 class="mb-0">Email</h6>
        
          <td><?php echo $row['email']; ?></td>
        
    </div>
    <div class="col-sm-9 text-secondary"></div></div>
    <hr>
    <div class="row">
      <div class="col-sm-3">
        <h6 class="mb-0">Balance</h6>
        
           <td><?php echo $row['balance']; ?></td>
        </tr>
      </div>
      <div class="col-sm-9 text-secondary"></div>
    </div>
    
      <hr>
     
      <div class="row">
        <div class="col-sm-12"> 
          <a class="btn btn-primary" href="payment.php?id= <?php echo $row['id'] ;?>" id="exampleModalLabel">Make Payment</a>
        </div>
      </div>
      
    </div>
  </div>
</div>
<?php
            }
           }
            else {
              echo "0 results";
            }
             ?>
             <?php include('footer.php') ?>
 
</body>
</html>