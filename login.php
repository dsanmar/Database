<?php
// Establish database connection 
$servername = "imc.kean.edu";
$username = "marsanto";
$password = "1149215";
$dbname = "CPS3740"; // Database name to read from Customers table

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Failed to connect with database, try again: " . $conn->connect_error);

echo "Database connected!";
}

// Get the login info from the URL * remember username = Login ID
$login = $_GET['username'];
$password = $_GET['password'];

// Check to see if login is in the table Customers
$checkLogin = "SELECT * FROM Customers WHERE login = '$login'";
$loginResult = $conn->query($checkLogin);

// Check if the login exists, if no stop program
if ($loginResult->num_rows === 0) {
    echo "Erorr Message: Login ID: $login doesn't exist in the database.";
    exit;
}
// Get the login record
$Record = $loginResult->fetch_assoc();

// Check if the password matches
if ($Record['password'] !== $password) {
    echo "Error Message: Login ID: $login EXIST, but the password doesn't match.";
    exit;
}

// Set a cookie for authentication
$cookie = "user_cookie";
$cookieValue = $login;
$cookieExpire = time() + 24 * 60 * 60; // Last 1 day
setcookie($cookie, $cookieValue, $cookieExpire, "/");

//echo "Login successful!"; YAY! it will then proceed with rest of program

// Check if user is from Kean domain and display IP address
$ip = $_SERVER['REMOTE_ADDR'];
echo "<br>IP: $ip\n";
$IPv4 = explode(".",$ip);// spilt token

// Used strpos function to check if the user IP starts with either '10.' OR '131.125.'
if (strpos($ip, '10.') === 0 || strpos($ip, '131.125.') === 0) {
    echo "<br>You are from Kean University.";
} else {
    echo "<br>You are NOT from Kean University.";
}

// Get details based on the Login ID from the URL - assign it to the id variable
$id = $_GET['username'];
$sql = "SELECT *, TIMESTAMPDIFF(YEAR, dob, CURDATE()) AS age, CONCAT(street, ', ', city, ', ', state, ' ', zipcode) AS address FROM Customers WHERE login='$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    // Display user information
    echo "<p><strong>Welcome Customer:</strong> {$user['name']}<br>";
    echo "Gender: {$user['gender']}<br>";
    echo "Birthday: {$user['DOB']}";
    echo ", Age: {$user['age']}<br>";
    echo "Address: {$user['address']}</p>";

// Display image from Customers table
if (!empty($user['img'])) {
    $imageData = base64_encode($user['img']);
    $src = "data:image/jpeg;base64,{$imageData}";
    echo "<img src='{$src}' alt='User Image'>";
}
// Include a hidden input field to store the cid
$sqlQuery = "SELECT id FROM Customers WHERE login='$id'";
$resultsCID = $conn->query($sqlQuery);

if ($resultsCID->num_rows > 0) {
    // Fetch the result row to get the customer ID
    $row = $resultsCID->fetch_assoc();
    
    // Set the value to the retrieved customer ID
    $customerID = $row['id'];

    echo "<input type='hidden' name='cid' value='$customerID'>";
 
    // Add links to page
    echo "<br><a href='logout.php'>Logout</a><br>";
    echo "<a href='order_product.php?cid=$customerID'>Order Product</a><br>";
    echo "<a href='view_order.php?cid=$customerID'>View, Change, Cancel My Order History</a>";
}
else{
    echo "Error: Could not find customerID";
}
} else {
    echo "User not found.";
}

// Close database connection
$conn->close();
?>



 <!--Maria notes
"Order Product" link includes the customer ID as a query parameter 
(cid=$customerID). When someone clicks on this link, the order_product.php page 
will be loaded with the customer ID accessible through $_GET['cid']
-->