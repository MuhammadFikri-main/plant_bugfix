<?php
include("connection/connect.php"); //connection to db
error_reporting(0);
session_start();

// Check if order_del parameter is set
if (isset($_GET['order_del'])) {
    // Delete the order
    mysqli_query($db, "DELETE FROM users_orders WHERE o_id = '" . $_GET['order_del'] . "'");
}

// Redirect back to the orders page
header("location:your_orders.php");
exit(); // Ensure no further code is executed
?>