<!DOCTYPE html>
<html lang="en">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <title>Order Product</title>
</head>

<body>

 <?php
  // Check if cid is present in URL
  if (isset($_GET['cid'])) {
    // Set value of 'cid' to the variable $customerId
    $customerId = $_GET['cid'];

// Establish database connection
 $hostname = "imc.kean.edu";
 $username = "marsanto";
 $password = "1149215";
 $dbname = "CPS3740";

// Create connection
 $conn = new mysqli($hostname, $username, $password, $dbname);

// Check connection
 if ($conn->connect_error) {
   die("Failed to connect with database, try again: " . $conn->connect_error);
 }

 // Retrieve Products table
 $sqlQuery = "SELECT * FROM Products";
 $result = $conn->query($sqlQuery);

 // Create table headers
 if ($result->num_rows > 0) {
   echo "<table border = '1'>";
   echo "<tr><th>Product ID</th><th>Name</th><th>Price</th><th>Available Quantity</th><th>Vendor ID</th> <th>Customer Order Quantity</th></tr>";

 // Fetch data from database to display
while ($row = $result->fetch_assoc()) {
  echo "<tr>";
  echo "<td>" . $row['P_Id'] . "</td>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td>" . $row['Price'] . "</td>";
  echo "<td>" . $row['Quantity'] . "</td>";
  echo "<td>" . $row['V_Id'] . "</td>";
  echo "<td>";
  echo "<form action='place_order.php' method='GET'>";  
  echo "<input type='hidden' name='cid' value='{$customerId}'>";
  echo "<input type='hidden' name='pid' value='{$row['P_Id']}'>";
  echo "<input type='text' size='5' name='pid_order_qty' required>";
  echo "<input type='submit' value='Place Order'>";
  echo "</form>";
  echo "</td>";
  echo "</tr>";
}
echo "</table>";

} else {
  echo "No products available.";
}
$conn->close();
} else {
  echo "Customer ID not provided.";
}
?>
</body>
</html>