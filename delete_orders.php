<?php
include("connection/connect.php"); // Connection to the database
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Check if order_del parameter is set
if (isset($_GET['order_del'])) {
    $order_id = $_GET['order_del'];

    // Step 1: Delete related records in the order_items table
    mysqli_query($db, "DELETE FROM order_items WHERE o_id = '" . $order_id . "'");

    // Step 2: Delete the order from the users_orders table
    mysqli_query($db, "DELETE FROM users_orders WHERE o_id = '" . $order_id . "'");

    // Redirect back to the orders page
    header("location:your_orders.php");
    exit(); // Ensure no further code is executed
}
?>