<!DOCTYPE html>
<html>
<head>
<style>
table {
  border: 2px solid black;
  width: 100%;
  table-layout: auto;
  margin: 0 auto;
}

th, td {
  border: 1px solid black;
  padding: 10px; /* Adjust the padding as needed */
  text-align: left;
}

.M {
  color: blue;
}

.F {
  color: red;
}
</style>
</head>
<body>
<table>

  <tr>
    <th>STAFFNo</th>
    <th>FNAME</th>
    <th>LNAME</th>
    <th>POSITION</th>
    <th>SEX</th>
    <th>DOB</th>
    <th>SALARY</th>
    <th>BRANCHNo</th>
  </tr>

<?php
$hostname = "XXXXX";
$username = "XXXXX";
$password = "XXXXX";
$database = "dreamhome";

$conn = new mysqli($hostname, $username, $password, $database);
	
	if ($conn->connect_error){
		die("FAILED!!" . $conn->connect_error);
	}

$sql = "SELECT * FROM Staff";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
   	 while ($row = $result->fetch_assoc()) {
      $genderClass = ($row['sex'] == 'M') ? 'M' : 'F';
    
echo "<tr>";
      echo "<td>" . $row['staffNo'] . "</td>";
      echo "<td>" . $row['fName'] . "</td>";
      echo "<td>" . $row['lName'] . "</td>";
      echo "<td>" . $row['position'] . "</td>";
      echo "<td class='$genderClass'>" . $row['sex'] . "</td>";
      echo "<td>" . $row['DOB'] . "</td>";
      echo "<td>" . $row['salary'] . "</td>";
      echo "<td>" . $row['branchNo'] . "</td>";
      echo "</tr>";
    }
  }
  else {
    echo "<tr><td colspan='8'>No records found</td></tr>";
  }

  $conn->close();

?> 
</table>
</body>
</html>
