<?php
// Check if 'cid' is set in the GET request
if (isset($_GET['cid'])) {
    $customerId = $_GET['cid'];

    // Establish database connection
    $hostname = "XXXXX";
    $username = "XXXXX";
    $password = "XXXXX";
    $dbname = "CPS3740_2023F";

    // Create connection
    $conn = new mysqli($hostname, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Failed to connect with the database: " . $conn->connect_error);
    }

    // Retrieve orders for the customer
    $sqlQuery = "SELECT O.oid as order_id, P.Name AS Product_name, P.Price, P.Quantity as Available_quantity, P.V_Id as Vendor_id,
    O.order_qty AS Order_qty, O.pid as pid, O.cid as cid
    FROM CPS3740_2023F.Order_marsanto O
    INNER JOIN CPS3740.Products P ON O.pid = P.P_Id
    WHERE O.cid = $customerId";

    $result = $conn->query($sqlQuery);

    // Display orders in HTML table format
    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Available Quantity</th>
                    <th>Vendor ID</th>
                    <th>Customer Order Quantity</th>
                    <th>Action</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['order_id']}</td>
                    <td>{$row['Product_name']}</td>
                    <td>{$row['Price']}</td>
                    <td>{$row['Available_quantity']}</td>
                    <td>{$row['Vendor_id']}</td>
                    <td>{$row['Order_qty']}</td>
                    <td>
                        <a href='cancel_order.php?oid={$row['order_id']}&cid=$customerId'>Cancel Order</a><br>
                        <form action='change_order.php' method='GET'>
                         <input type='text' size='5' name='new_qty' required>
                         <input type='hidden' name='oid' value='{$row['order_id']}'>
                         <input type='hidden' name='cid' value='{$row['cid']}'>
                         <input type='hidden' name='pid' value='{$row['pid']}'>
                        <button type='submit'>Change Order</button>
                        </form>
                    </td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No orders found for the customer.</p>";
    }

    $conn->close();
} else {
    echo "Customer ID not provided.";
}
