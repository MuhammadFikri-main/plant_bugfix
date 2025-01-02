    <!DOCTYPE html>
    <html lang="en">
    <?php
    include("connection/connect.php");  //include connection file
    error_reporting(0);  // using to hide undefine undex errors
    session_start(); //start temp session until logout/browser closed

    ?>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="homepage.png">
        <title>Home</title>
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/animsition.min.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="css/style.css" rel="stylesheet"> 
        <!-- Add the new CSS for hover effect -->
    <style>
        /* Styles for active (clicked) state */
        .navbar-nav .nav-item .nav-link.active,
        .navbar-nav .nav-item .nav-link:hover {
            color: white !important; /* Text color for active state and hover state */
        }

        /* Styles for hover state */
        .navbar-nav .nav-item .nav-link:hover {
            color: orange !important; /* Text color for hover state */
        }

        /* Add hover effect to app-section text-img-block */
        .app-section .text-img-block:hover {
            background-color: orange !important; /* Background color on hover */
            
        }

        /* Styles for hover state */
        .navbar-nav .nav-item .nav-link {
            color: orange !important; /* Text color for hover state */
        }
        
    </style>

        <script>
    document.addEventListener("DOMContentLoaded", function () {
        var navLinks = document.querySelectorAll('.navbar-nav .nav-item .nav-link');

        navLinks.forEach(function (link) {
            link.addEventListener('click', function (event) {
                navLinks.forEach(function (el) {
                    el.classList.remove('active');
                });

                event.target.classList.add('active');
            });

            link.addEventListener('mouseover', function () {
                navLinks.forEach(function (el) {
                    el.classList.remove('hover');
                });

                link.classList.add('hover');
            });

            link.addEventListener('mouseout', function () {
                navLinks.forEach(function (el) {
                    el.classList.remove('hover');
                });
            });
        });
    });

    </script>

        
        </head>

    <body>
        <header id="header" class="header-scroll top-header headrom">
                <!-- .navbar -->
                <nav class="navbar navbar-dark">
                    <div class="container">
                        <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                        <a class="navbar-brand" href="index.php"> PLANT SHOP </a>
                        <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                        <ul class="nav navbar-nav">
                                <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
                            <?php
    $ress = mysqli_query($db, "select * from restaurant");

    while ($rows = mysqli_fetch_array($ress)) {
        echo '
        <li class="nav-item">
            <a class="nav-link active" href="dishes.php?res_id=' . $rows['rs_id'] . '">Menu</a>
        </li>';
    }
    ?>

                                <?php
                            if(empty($_SESSION["user_id"]))
                                {
                                    echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>
                                <li class="nav-item"><a href="registration.php" class="nav-link active">Sign Up</a> </li>';
                                }
                            else
                                {
                                        
                                        
                                            echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link ">My Orders</a> </li>';
                                        echo  '<li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a> </li>';
                                }

                            ?>
                                
                            </ul>
                        </div>
                    </div>
                </nav>
            <div class="container">
            <div class="jumbotron">
                <h1 class="text-center" style="color: green;"><img src="images/check.png" style="width:5%;"> Order Placed Successfully.</h1>
            </div>
            <h2 class="text-center"> Thank you for Ordering at Plant Shop! The ordering process is now complete.</h2>
            <br>
    <!-- Display User's Order Details -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Ordered Item</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <!-- <th>Address</th>
                            <th>Date</th> -->
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
    $user_id = $_SESSION["user_id"];
    $order_id = $_GET["o_id"];

    // Use prepared statements to prevent SQL injection
    $stmt = $db->prepare("SELECT users_orders.*, users.address, order_items.title, order_items.quantity, order_items.price 
                                FROM users_orders 
                                INNER JOIN users ON users.u_id = users_orders.u_id 
                                INNER JOIN order_items ON users_orders.o_id = order_items.o_id 
                                WHERE users.u_id = ? AND users_orders.o_id = ?
                                ORDER BY users_orders.o_id DESC");
    $stmt->bind_param("ii", $user_id, $order_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the query was successful
    if (!$result) {
        die("Query failed: " . $stmt->error);
    }

    // Check if there are any rows
    if ($result->num_rows > 0) {
        // Fetch and process all rows
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['title']) . "</td>";
            echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
            echo "<td>RM " . htmlspecialchars($row['price']) . "</td>";
            // echo "<td>" . htmlspecialchars($row['address']) . "</td>";
            // echo "<td>" . htmlspecialchars($row['date']) . "</td>";
            echo "</tr>";
            // Store the total price from the users_orders table
            $total_price = $row['total_price'];
        }
    ?>
    <!-- Display total price in the footer -->
    <tr>
        <td colspan="2" class="text-right"><strong>Total Price:</strong></td>
        <td><strong>RM <?php echo htmlspecialchars(number_format($total_price, 2)); ?></strong></td>
    </tr>
    <?php 
    } else {
        // Display "No orders found" message spanning all columns
        echo "<tr><td colspan='7' class='text-center'>No orders found</td></tr>";
    }

    $stmt->close();
    ?>
                    </tbody>
                </table>
            </div>
        </div>
            
            <br>


        
        
        <!-- Bootstrap core JavaScript
        ================================================== -->
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