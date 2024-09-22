<?php
if (isset($_GET['cid'], $_GET['pid'], $_GET['pid_order_qty'])) {
    $customerId = $_GET['cid'];
    $productId = $_GET['pid'];
    $orderQuantity = $_GET['pid_order_qty'];

    //echo $orderQuantity; Debugging just testing - to check value

    // Validate order quantity
    if (!is_numeric($orderQuantity) || $orderQuantity <= 0 || floor($orderQuantity) != $orderQuantity) {
        echo "The order quantity must be a positive numeric value. The order has not been successfully placed.";
    } else {

        // Establish database connection
        $hostname = "XXXXX";
        $username = "XXXXX";
        $password = "XXXXX";
        $dbname = "CPS3740";

        $conn = new mysqli($hostname, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Failed to connect with database, try again: " . $conn->connect_error);
        }

        $sqlQuery = "SELECT * FROM Products WHERE P_Id = $productId";
        $result = $conn->query($sqlQuery);

        //Fetch quantity from table
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $availableQuantity = $row['Quantity'];

            // Perform additional validation to check
            if ($orderQuantity > $availableQuantity) {
                echo "There is only {$availableQuantity} quantity available. The order is not successfully placed."; // order will not be placed in ORDER TABLE
            } else {
                // Insert order into Order_marsanto table
                $insertSql = "INSERT INTO CPS3740_2023F.Order_marsanto (order_qty, cid, pid) VALUES ('$orderQuantity', '$customerId', '$productId')";
                if ($conn->query($insertSql) === TRUE) {
                    echo "The order has been successfully placed.";
                } else {
                    echo "Error placing the order: " . $conn->error;
                }
            }
            // Close CPS3740_F connection
            $conn->close();
        }
    }
} else {
    echo "Customer ID, Product ID, or Order Quantity not provided.";
}
