<?php
// Establish database connection
$hostname = "imc.kean.edu";
$username = "XXXXX";
$password = "XXXXX";
$dbname = "XXXXX";

$conn = new mysqli($hostname, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Failed to connect with database, try again: " . $conn->connect_error);
}

// Check if cid and oid are present in the URL
if (isset($_GET['cid'], $_GET['oid'])) {
    $customerId = $_GET['cid'];
    $orderId = $_GET['oid'];

    // Check if the order belongs to the logged-in customer
    $checkQuery = "SELECT * FROM CPS3740_2023F.Order_marsanto WHERE cid = $customerId AND oid = $orderId";
    $checkResult = $conn->query($checkQuery);

    if ($checkResult->num_rows > 0) {
        // Order found, proceed to delete it with SQL QUERY
        $deleteQuery = "DELETE FROM CPS3740_2023F.Order_marsanto WHERE oid = $orderId";
        if ($conn->query($deleteQuery) === TRUE) {
            echo "Successfully deleted the order $orderId!";
        } else {
            echo "Error deleting the order: " . $conn->error;
        }
    } else {
        // Order not found or doesn't belong to the logged-in customer
        echo "The order id $orderId for customer id $customerId does not exist, the order cannot be canceled.";
    }
    // Close connection
    $conn->close();
} else {
    echo "Error: Need to provide both 'cid' and 'oid' in the URL.";
}

?>
