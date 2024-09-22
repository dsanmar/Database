<?php
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
  
// Check if the keyword is set in the GET request
   if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];

    // Check if the keyword is an asterisk
    if ($keyword === '*'){
        // Display all rows from the Products table
        $sql = "SELECT * FROM Products";
    } else {
        // Used Escape special characters in the keyword to prevent SQL injection
        $escapedKeyword = mysqli_real_escape_string($conn, $keyword);

        // SQL query to find product names
        $sql = "SELECT * FROM Products WHERE Name LIKE '%$escapedKeyword%'";
    }
    $result = $conn->query($sql);

    // Display results in a table
    if ($result->num_rows > 0) {
        echo "<h2>The results of your search keyword: $keyword</h2>";
        echo "<table border='1'>
                <tr>
                <th>pid</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>vid</th>
                </tr>";
    // Fetch data from Products table
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['P_Id']}</td>
                <td>{$row['Name']}</td>
                <td>{$row['Price']}</td>
                <td>{$row['Quantity']}</td>
                <td>{$row['V_Id']}</td>
                </tr>";
        }
        echo "</table>";
    // Else statement for no results
    } else {
        echo "<p>No results found, try again! {$keyword}</p>";
    }
}
// Close the database connection
$conn->close();
?>
