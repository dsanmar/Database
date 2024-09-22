<?php
if (isset($_GET['new_qty'], $_GET['pid'], $_GET['cid'], $_GET['oid'])) {
    $NQ = $_GET['new_qty'];
    $productId = $_GET['pid'];
    $customerId = $_GET['cid'];
    $orderId = $_GET['oid'];

// Establish database connection
    $hostname = "imc.kean.edu";
    $username = "XXXXX";
    $password = "XXXXX";
    $dbname = "XXXXX";    

    $conn = new mysqli($hostname, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Failed to connect with database, try again: " . $conn->connect_error);
    }

    // Check if the order belongs to the logged-in customer 
    $checkOrderQuery = "SELECT * FROM CPS3740_2023F.Order_marsanto WHERE oid = $orderId AND cid = $customerId";
    $result = $conn->query($checkOrderQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $availableQuantity = getAvailableQuantity($conn, $productId);

        // Check the value $NQ = new quantity inputted
        if (!is_numeric($NQ) || $NQ <= 0 || floor($NQ) != $NQ) {
            echo "The quantity must be a positive integer. The quantity has not been successfully changed.";
        } elseif ($NQ > $availableQuantity) {
            echo "There is only {$availableQuantity} quantity available. The change is not successful.";
        } else {
            // Update order quantity
            $updateOrderQuery = "UPDATE CPS3740_2023F.Order_marsanto SET order_qty = $NQ WHERE oid = $orderId";
            if ($conn->query($updateOrderQuery) === TRUE) {
                echo "Successfully changed the order {$orderId}!";
            } else {
                echo "Error updating the order: " . $conn->error;
            }
        }
    } else {
        echo "The order id {$orderId} for customer id {$customerId} does not exist, the order cannot be changed.";
    }

    $conn->close();
} else {
    echo "Error message.";
}

// Get available quantity for a product
function getAvailableQuantity($conn, $productId) {
    $availableQuantityQuery = "SELECT Quantity FROM Products WHERE P_Id = $productId";
    $result = $conn->query($availableQuantityQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['Quantity'];
    } else {
        return 0;
    }
}
?>
