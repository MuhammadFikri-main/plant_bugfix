<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();

if (empty($_SESSION['user_id'])) {
    header('location:login.php');
} else {
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="ecommerce.png">
    <title>My Orders</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style type="text/css" rel="stylesheet">
        /* Your existing CSS styles */
        table {
            width: 750px;
            border-collapse: collapse;
            margin: auto;
        }
        tr:nth-of-type(odd) {
            background: #eee;
        }
        th {
            background: #ff3300;
            color: white;
            font-weight: bold;
        }
        td, th {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
            font-size: 14px;
        }
        @media only screen and (max-width: 760px),
        (min-device-width: 768px) and (max-device-width: 1024px) {
            table {
                width: 100%;
            }
            table, thead, tbody, th, td, tr {
                display: block;
            }
            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }
            tr {
                border: 1px solid #ccc;
            }
            td {
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%;
            }
            td:before {
                position: absolute;
                top: 6px;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                content: attr(data-column);
                color: #000;
                font-weight: bold;
            }
        }
    </style>
</head>
<body>
    <header id="header" class="header-scroll top-header headrom">
        <nav class="navbar navbar-dark">
            <div class="container">
                <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                <a class="navbar-brand" href="index.php">PLANT SHOP</a>
                <div class="collapse navbar-toggleable-md float-lg-right" id="mainNavbarCollapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"><a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a></li>
                        <?php
                        $ress = mysqli_query($db, "SELECT * FROM restaurant");
                        while ($rows = mysqli_fetch_array($ress)) {
                            echo '<li class="nav-item"><a class="nav-link active" href="dishes.php?res_id=' . $rows['rs_id'] . '">Menu</a></li>';
                        }
                        if (empty($_SESSION["user_id"])) {
                            echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a></li>
                                  <li class="nav-item"><a href="registration.php" class="nav-link active">Sign Up</a></li>';
                        } else {
                            echo '<li class="nav-item"><a href="your_orders.php" class="nav-link">My Orders</a></li>
                                  <li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <div class="page-wrapper">
        <div class="inner-page-hero bg-image" data-image-src="images/img/p.jpg">
            <div class="container"></div>
        </div>
        <div class="result-show">
            <div class="container">
                <div class="row"></div>
            </div>
        </div>
        <section class="restaurants-page">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="bg-gray restaurant-entry">
                        <div class="row">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Order Id</th>
                                        <th>Items</th>
                                        <th>Quantities</th>
                                        <th>Prices</th>
                                        <th>Total Price</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Fetch all orders for the current user
                                    $query_res = mysqli_query($db, "SELECT * FROM users_orders WHERE u_id='" . $_SESSION['user_id'] . "' GROUP BY o_id ORDER BY o_id DESC");

                                    if (!mysqli_num_rows($query_res) > 0) {
                                        echo '<tr><td colspan="8"><center>You have No orders Placed yet.</center></td></tr>';
                                    } else {
                                        while ($order = mysqli_fetch_array($query_res)) {
                                            $order_id = $order['o_id'];
                                            // Fetch all items for this order
                                            $items_query = mysqli_query($db, "SELECT * FROM order_items WHERE o_id='$order_id'");
                                            $items = [];
                                            $total_price = 0; // Initialize total price for the order
                                            while ($item = mysqli_fetch_array($items_query)) {
                                                $items[] = $item;
                                                $total_price += $item['price'] * $item['quantity']; // Calculate total price
                                            }
                                            ?>
                                            <tr>
                                                <td data-column="Order Id"><?php echo $order_id; ?></td>
                                                <td data-column="Items">
                                                    <?php
                                                    foreach ($items as $item) {
                                                        echo htmlspecialchars($item['title']) . "<br>";
                                                    }
                                                    ?>
                                                </td>
                                                <td data-column="Quantities">
                                                    <?php
                                                    foreach ($items as $item) {
                                                        echo htmlspecialchars($item['quantity']) . "<br>";
                                                    }
                                                    ?>
                                                </td>
                                                <td data-column="Prices">
                                                    <?php
                                                    foreach ($items as $item) {
                                                        echo "RM " . htmlspecialchars($item['price']) . "<br>";
                                                    }
                                                    ?>
                                                </td>
                                                <td data-column="Total Price">RM <?php echo number_format($total_price, 2); ?></td>
                                                <td data-column="Status">
                                                    <?php
                                                    $status = $order['status'];
                                                    if ($status == "" || $status == "NULL") {
                                                        echo '<button type="button" class="btn btn-info" style="font-weight:bold;">Order placed</button>';
                                                    } elseif ($status == "in process") {
                                                        echo '<button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin" aria-hidden="true"></span>In process</button>';
                                                    } elseif ($status == "closed") {
                                                        echo '<button type="button" class="btn btn-success"><span class="fa fa-check-circle" aria-hidden="true"></span>Delivered</button>';
                                                    } elseif ($status == "rejected") {
                                                        echo '<button type="button" class="btn btn-danger"><i class="fa fa-close"></i>Cancelled by admin</button>';
                                                    } elseif ($status == "cancelled") {
                                                        echo '<button type="button" class="btn btn-danger"><i class="fa fa-close"></i>Cancelled by user</button>';
                                                    }
                                                    ?>
                                                </td>
                                                <td data-column="Date"><?php echo $order['date']; ?></td>
                                                <td data-column="Action">
                                                    <?php
                                                    if ($order['status'] != '' && $order['status'] != 'in process') {
                                                        echo '<a href="delete_orders.php?order_del=' . $order_id . '" onclick="return confirm(\'Are you sure you want to delete this order history?\');" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a>';
                                                    } else {
                                                        echo '<button class="btn btn-danger btn-flat btn-addon btn-xs m-b-10" disabled><i class="fa fa-trash-o" style="font-size:16px"></i></button>';
                                                    }
                                                    if ($order['status'] != 'closed' && $order['status'] != 'in process' && $order['status'] != 'cancelled' && $order['status'] != 'rejected') {
                                                        echo '<a href="cancel_order.php?order_id=' . $order_id . '" onclick="return confirm(\'Are you sure you want to cancel this order?\');"><button class="btn btn-danger btn-flat btn-addon btn-xs m-b-10">Cancel Order</button></a>';
                                                    } else {
                                                        echo '<button class="btn btn-danger btn-addon btn-xs m-b-10" disabled>Cancel Order</button>';
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <footer class="footer">
            <div class="container">
                <!-- Your existing footer code -->
            </div>
        </footer>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
</body>
</html>
<?php
}
?>