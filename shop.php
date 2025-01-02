<!DOCTYPE html>
<html lang="en">

<?php
include("connection/connect.php"); // connection to db
error_reporting(0);
session_start();

// Fetch product details based on the ID from the URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $stmt = $db->prepare("SELECT * FROM dishes WHERE d_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $product = $stmt->get_result()->fetch_assoc();
    if (!$product) {
        die("Product not found.");
    }
    $restaurant_id = $product['rs_id']; // Get the restaurant ID for related products
} else {
    die("Product ID not provided.");
}

// Fetch related products from the same restaurant
$related_products_query = $db->prepare("SELECT * FROM dishes WHERE rs_id = ? AND d_id != ? LIMIT 3");
$related_products_query->bind_param("ii", $restaurant_id, $product_id);
$related_products_query->execute();
$related_products = $related_products_query->get_result();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        $quantity = $_POST['quantity'];
        $d_id = $_POST['d_id'];

        // Fetch product details
        $stmt = $db->prepare("SELECT * FROM dishes WHERE d_id = ?");
        $stmt->bind_param("i", $d_id);
        $stmt->execute();
        $product = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        // Initialize the cart if it doesn't exist
        if (!isset($_SESSION['cart_item'])) {
            $_SESSION['cart_item'] = [];
        }

        // Add the product to the cart
        if (isset($_SESSION['cart_item'][$d_id])) {
            // Update the quantity if the item already exists
            $_SESSION['cart_item'][$d_id]['quantity'] += $quantity;
        } else {
            // Add the item to the cart
            $_SESSION['cart_item'][$d_id] = [
                'quantity' => $quantity,
                'price' => $product['price'],
                'title' => $product['title']
            ];
        }

        // Redirect based on the button clicked
        if ($_POST['submit'] === 'buynow') {
            // Redirect to the checkout page
            header("Location: checkout.php?res_id={$product['rs_id']}&d_id=$d_id&quantity=$quantity");
            exit();
        } elseif ($_POST['submit'] === 'addtocard') {
            // Redirect back to the dishes page
            header("Location: dishes.php?res_id={$product['rs_id']}&action=add&id=$d_id");
            exit();
        }
    }
}
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="potoffood.png">
    <title><?php echo $product['title']; ?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        /* Consistent image size for product and related products */
        .product-image, .related-products .card-img-top {
            /*width: 400px;
            height: 520px; /* Fixed height for consistency */
            /* object-fit: cover; /* Ensures the image covers the area without distortion */
        }

        /* Carousel image size */
        .carousel-item img {
            width: 100%;
            height: 200px; /* Fixed height for carousel images */
            /* object-fit: cover; */
        }

        /* Related products section */
        .related-products {
            margin-top: 30px;
        }
        .related-products .card {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
<!--header starts-->
<header id="header" style="background-color: #333; padding: 10px 0;">
    <nav style="display: flex; justify-content: space-between; align-items: center; max-width: 1200px; margin: 0 auto; padding: 0 15px;">
        <div style="display: flex; align-items: center;">
            <button style="background: none; border: none; color: white; font-size: 24px; cursor: pointer; display: none;" onclick="toggleNav()">&#9776;</button>
            <a href="index.php" style="color: white; font-size: 24px; text-decoration: none;">PLANT SHOP</a>
        </div>
        <div id="mainNavbarCollapse" style="display: flex; align-items: center;">
            <ul style="list-style: none; display: flex; margin: 0; padding: 0;">
                <li style="margin-right: 20px;"><a href="index.php" style="color: white; text-decoration: none;">Home</a></li>
                <?php
                $ress = mysqli_query($db, "SELECT * FROM restaurant");
                $restaurant_ids = [];
                while ($rows = mysqli_fetch_array($ress)) {
                    $restaurant_ids[] = $rows['rs_id']; // Save each restaurant ID
                    echo '<li style="margin-right: 20px;"><a href="dishes.php?res_id=' . $rows['rs_id'] . '" style="color: white; text-decoration: none;">Menu</a></li>';
                }
                if (empty($_SESSION["user_id"])) {
                    echo '<li style="margin-right: 20px;"><a href="login.php" style="color: white; text-decoration: none;">Login</a></li>
                          <li style="margin-right: 20px;"><a href="registration.php" style="color: white; text-decoration: none;">Sign Up</a></li>';
                } else {
                    echo '<li style="margin-right: 20px;"><a href="your_orders.php" style="color: white; text-decoration: none;">My Orders</a></li>
                          <li style="margin-right: 20px;"><a href="logout.php" style="color: white; text-decoration: none;">Logout</a></li>';
                }
                ?>
            </ul>
        </div>
    </nav>
</header>

<!-- Page wrapper -->
<div class="page-wrapper">
    <div class="container m-t-30">
        <div class="row">
            <!-- Product Image and Carousel -->
            <div class="col-lg-5 mt-5">
                <div class="card mb-3">
                    <img class="product-image" src="admin/Res_img/dishes/<?php echo $product['img']; ?>" alt="<?php echo $product['title']; ?>">
                </div>
                <!-- Start Carousel Wrapper -->
                <div id="multi-item-example" class="col-12 carousel slide carousel-multi-item" data-bs-ride="carousel">
                    <!-- Start Slides -->
                    <div class="carousel-inner product-links-wap" role="listbox">
                        <!-- First slide -->
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col-4">
                                    <a href="#">
                                        <img class="card-img img-fluid" src="admin/Res_img/dishes/<?php echo $product['img']; ?>" alt="Product Image 1">
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a href="#">
                                        <img class="card-img img-fluid" src="admin/Res_img/qr_dishes/<?php echo $product['qr_img']; ?>" alt="Product Image 2">
                                    </a>
                                </div>
                                <!-- <div class="col-4">
                                    <a href="#">
                                        <img class="card-img img-fluid" src="admin/Res_img/dishes/<?php echo $product['img']; ?>" alt="Product Image 3">
                                    </a>
                                </div> -->
                            </div>
                        </div>
                        <!-- /.First slide -->
                    </div>
                    <!-- End Slides -->
                    <!-- Carousel Controls -->
                    <a class="carousel-control-prev" href="#multi-item-example" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#multi-item-example" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <!-- End Carousel Wrapper -->
            </div>

            <!-- Product Details -->
            <div class="col-lg-7 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h1 class="h2"><?php echo $product['title']; ?></h1>
                        <p class="h3 py-2">RM<?php echo $product['price']; ?></p>
                        <p class="py-2">
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-secondary"></i>
                            <span class="list-inline-item text-dark">Rating 4.8 | 36 Comments</span>
                        </p>
                        <h6>Description:</h6>
                        <p><?php echo $product['slogan']; ?></p>
                        <form method="post">
                            <input type="hidden" name="d_id" value="<?php echo $product['d_id']; ?>">
                            <input type="hidden" name="action" value="add">
                            <div class="row">
                                <div class="col-auto">
                                    <ul class="list-inline pb-3">
                                        <li class="list-inline-item">Quantity:</li>
                                        <li class="list-inline-item">
                                            <input class="form-control" type="number" name="quantity" value="1" min="1">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col d-grid">
                                    <button type="submit" class="btn btn-success btn-lg" name="submit" value="addtocard">Add To Cart</button>
                                </div>
                                <div class="col d-grid">
                                    <button type="submit" class="btn btn-primary btn-lg" name="submit" value="buynow">Buy Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products Section -->
        <div class="row related-products">
            <div class="col-12">
                <h3>Related Products</h3>
            </div>
            <?php
            if ($related_products->num_rows > 0) {
                while ($related_product = $related_products->fetch_assoc()) {
                    ?>
                    <div class="col-xs-12 col-sm-6 col-md-4 food-item">
                        <div class="food-item-wrap">
                            <div class="figure-wrap bg-image" data-image-src="admin/Res_img/dishes/<?php echo $related_product['img']; ?>" style="width:100%;height:350px;">
                                <div class="rating pull-left"> 
                                    <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> 
                                </div>
                            </div>
                            <div class="content">
                                <h5><a href="shop.php?id=<?php echo $related_product['d_id']; ?>"><?php echo $related_product['title']; ?></a></h5>
                                <div class="price-btn-block"> 
                                    <span class="price">RM<?php echo $related_product['price']; ?></span>
                                    <a href="shop.php?id=<?php echo $related_product['d_id']; ?>" class="btn theme-btn-dash pull-right">See More</a> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<div class="col-12"><p>No related products found.</p></div>';
            }
            ?>
        </div>
    </div>
</div>

<!-- start: FOOTER -->
<footer class="footer">
    <div class="container">
        <!-- top footer statrs -->
        <div class="row top-footer">
            <div class="col-xs-12 col-sm-4 address color-gray">
                <h5>Address:</h5>
                <p>Tepi Klinik Bidan Jalan Sungai Baru Simpang Ampat, 02700 Kangar, Perlis</p>
                <h5>Operational Hours:</h5>
                <p>Monday to Sunday 5 p.m to 11 p.m  <br>Closed on Tuesday</p>
                <h5>Call us at: <a style="font-family: Arial; color:white;" >+60 11-3630 6284</a></h5>
            </div>

            <div class="col-xs-12 col-sm-2 about color-gray">
            <h5>Social media</h5>
            <a href="https://www.facebook.com/roses.ara.1447" target="_blank">
                <img src="images/i.png" alt="Facebook" width="50" height="50">
            </a>
            <a href="https://www.instagram.com/araroses_solution/" target="_blank">
                <img src="images/ii.png" alt="Instagram" width="50" height="50">
            </a>
            <a href="https://www.tiktok.com/@araroses19" target="_blank">
                <img src="images/t.png" alt="Tiktok" width="50" height="50">
            </a>

            </div>
            <div class="col-xs-12 col-sm-3 popular-locations color-gray">
                <h5>Locations We Deliver To</h5>
                <ul>
                    <li><a >Arau</a> </li>
                    <li><a >Beseri</a> </li>
                    <li><a>Bintong</a> </li>
                    <li><a >Kaki Bukit</a> </li>
                    <li><a >Kuala Perlis</a> </li>
                    <li><a >Kaki Bukit</a> </li>
                    <li><a >Kangar</a> </li>
                    <li><a >Simpang Ampat</a> </li>
                    <li><a >Tambun Tulang</a> </li>
                    <li><a >Mata Ayer</a> </li>
                </ul>
            </div>
            <div class="col-xs-12 col-sm-3 payment-options color-gray">
                <h5>All Major Credit Cards Accepted</h5>
                <ul>
                    <li>
                    <a > <img src="images/paypal.png" alt="Paypal"> </a>
                    </li>
                    <li>
                    <a > <img src="images/mastercard.png" alt="Mastercard"> </a>
                    </li>
                    <li>
                    <a > <img src="images/maestro.png" alt="Maestro"> </a>
                    </li>
                    <li>
                    <a > <img src="images/stripe.png" alt="Stripe"> </a>
                    </li>
                    <li>
                    <a > <img src="images/bitcoin.png" alt="Bitcoin"> </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- top footer ends -->
    </div>
</footer>
<!-- end:Footer -->

<!-- Bootstrap core JavaScript -->
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