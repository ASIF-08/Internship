<?php 
  include('connection.php');

// // Create database
// $sql = "CREATE DATABASE dbintern";
// if (mysqli_query($conn, $sql)) {
//   echo "Database created successfully";
// } else {
//   echo "Error creating database: " . mysqli_error($conn);
// }

// mysqli_close($conn);

//CREATE TABLE
// $sql = "CREATE TABLE customer (
//   id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//   firstname VARCHAR(30) NOT NULL,
//   lastname VARCHAR(30) NOT NULL,
//   email VARCHAR(50),
//   balance int(10)
//   )";
  
//   if (mysqli_query($conn, $sql)) {
//     echo "Table MyGuests created successfully";
//   } else {
//     echo "Error creating table: " . mysqli_error($conn);
//   }
  
//INSERT VALUES
// $sql = "INSERT INTO customer (id,firstname, lastname, email,balance)

// VALUES (10,'Umar', 'Shaikh', 'umar@example.com',100000)";

// if (mysqli_query($conn, $sql)) {
//   echo "New record created successfully";
// } else {
//   echo "Error: " . $sql . "<br>" . mysqli_error($conn);
// }

// Fetch data
$sql = "SELECT * FROM customer";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table><tr><th>ID</th><th>FirstName</th><th>LastName</th><th>Email</th><th>Balance<th></tr>";
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "<tr><td>".$row["id"]."</td><td>".$row["firstname"]."</td><td> ".$row["lastname"]."</td><td> ".$row["email"]."</td><td> ".$row["balance"]."</td></tr>";
  }
  echo "</table>";
} else {
  echo "0 results";
}
  
 
?>
