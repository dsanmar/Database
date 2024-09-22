<!DOCTYPE html>
<html lang="en">
<head>
<style>
table {
  border: 1px solid black;
  width: auto;
  table-layout: auto;
  margin: left;
}

th, td {
  border: 1px solid black;
  padding: 5px;
  text-align: left;
}
</style>
</head>
<body>

<table>
    <tr>
        <th>cid</th>
        <th>login</th>
        <th>password</th>
        <th>name</th>
        <th>dob</th>
        <th>gender</th>
        <th>street</th>
        <th>zipcode</th>
    </tr>

<?php
// Establish database connection 
$hostname = "XXXXX";
$username = "XXXXX";
$password = "XXXXX";
$dbname = "CPS3740";

$conn = new mysqli($hostname, $username, $password, $dbname);
    
    if ($conn->connect_error){
        die("Failed to connect with database, try again: " . $conn->connect_error);
    }
// Get info from Customers table
$sqlQuery = "SELECT id as cid, login, password, name, dob, gender, street, zipcode FROM Customers";
$result = $conn->query($sqlQuery);

// Display data in the table, with it's row
if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['cid'] . "</td>";
    echo "<td>" . $row['login'] . "</td>";
    echo "<td>" . $row['password'] . "</td>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['dob'] . "</td>";
    echo "<td>" . $row['gender'] . "</td>";
    echo "<td>" . $row['street'] . "</td>";
    echo "<td>" . $row['zipcode'] . "</td>";
    echo "</tr>";
}
}
$conn->close();
?> 
</table>
</body>
</html>



