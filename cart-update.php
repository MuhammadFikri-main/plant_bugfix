<?php
session_start();

if (isset($_POST['action']) && $_POST['action'] == 'update') {
    $res_id = $_POST['res_id'];
    $d_id = $_POST['d_id'];
    $quantity = $_POST['quantity'];

    // Update the quantity in the cart
    foreach ($_SESSION["cart_item"] as &$item) {
        if ($item["d_id"] == $d_id) {
            $item["quantity"] = $quantity;
            break;
        }
    }
}

// Redirect back to the page displaying the cart
header("Location: dishes.php?res_id=$res_id");
exit();
?>
