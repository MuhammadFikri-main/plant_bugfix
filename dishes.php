<!DOCTYPE html>
<html lang="en">

<?php
include("connection/connect.php"); // connection to db
error_reporting(0);
session_start();

include_once 'product-action.php'; //including controller
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags must come first in the head; any other head content must come after these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="potoffood.png">
    <title>Product</title>
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

    /* Ensure consistent slogan length */
    .product-name {
        height: 100px; /* Adjust this value as needed */
        overflow: hidden; /* Hide overflow text */
        display: -webkit-box;
        -webkit-line-clamp: 2; /* Limit to 2 lines */
        -webkit-box-orient: vertical;
        text-overflow: ellipsis; /* Add ellipsis for overflow text */
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
    <!--header starts-->
    <header id="header" class="header-scroll top-header headrom">
        <!-- .navbar -->
        <nav class="navbar navbar-dark">
            <div class="container">
                <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                <a class="navbar-brand" href="index.php"> PLANT SHOP</a>
                <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
                        <?php
                            $ress = mysqli_query($db, "select * from restaurant");

                            while ($rows = mysqli_fetch_array($ress)) {
                                echo '
                                <li class="nav-item">
                                    <a class="nav-link" href="dishes.php?res_id=' . $rows['rs_id'] . '">Menu</a>
                                </li>';
                            }
                        ?>
                        <?php
                        if (empty($_SESSION["user_id"])) {
                            echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>
                              <li class="nav-item"><a href="registration.php" class="nav-link active">Sign Up</a> </li>';
                        } else {
                            echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">My Orders</a> </li>';
                            echo  '<li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a> </li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- /.navbar -->
    </header>

    <!-- Page wrapper -->
    <div class="page-wrapper">
        <!-- top Links -->
        <div class="top-links">
            <div class="container">
                <ul class="row links">

                    
                    <li class="col-xs-12 col-sm-4 link-item active"><span>1</span><a href="dishes.php?res_id=<?php echo $_GET['res_id']; ?>">Pick your favourite plant</a></li>
                    <li class="col-xs-12 col-sm-4 link-item"><span>2</span><a href="#">Get delivered & Pay</a></li>
                </ul>
            </div>
        </div>
        <!-- end:Top links -->

        <!-- Inner page hero -->
        <?php
        $ress = mysqli_query($db, "select * from restaurant where rs_id='$_GET[res_id]'");
        $rows = mysqli_fetch_array($ress);
        ?>
        <section class="inner-page-hero bg-image" data-image-src="images/img/7.jpg">
            <div class="profile">
                <div class="container">
                    <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 profile-img" style="display: flex; justify-content: flex-start; position: relative; overflow: hidden;">
    <div class="image-wrap" style="margin-left: 120px;">
        <figure>
            <?php echo '<img src="admin/Res_img/' . $rows['image'] . '" alt="Restaurant logo" style="width:100px; height:auto;">'; ?>
        </figure>
    </div>
</div>


                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 profile-desc">
                            <div class="pull-left right-text white-txt">
                                <h6><a href="#"><?php echo $rows['title']; ?></a></h6>
                                <p><?php echo $rows['address']; ?></p>
                                <ul class="nav nav-inline">
                                     <li class="nav-item ratings">
                                        <a class="nav-link" href="#"> <span>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star-o"></i>
                                            </span> </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- end:Inner page hero -->

        <div class="breadcrumb">
            <div class="container">
            </div>
        </div>
        <div class="container m-t-30">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">

                    <div class="widget widget-cart">
                        <div class="widget-heading">
                            <h3 class="widget-title text-dark">
                                Your Shopping Cart
                            </h3>
                            <div class="clearfix"></div>
                        </div>
                        <div class="order-row bg-white">
                            <div class="widget-body">
                                <?php

                                $item_total = 0;

                                foreach ($_SESSION["cart_item"] as $item) {
                                ?>
                                    <div class="title-row">
                                        <?php echo $item["title"]; ?><a href="dishes.php?res_id=<?php echo $_GET['res_id']; ?>&action=remove&id=<?php echo $item["d_id"]; ?>">
                                            <i class="fa fa-trash pull-right"></i></a>
                                    </div>

                                    <div class="form-group row no-gutter">
                                        <div class="col-xs-8">
                                            <input type="text" class="form-control b-r-0" value=<?php echo $item["price"]; ?> readonly id="exampleSelect1">
                                        </div>
                                        <div class="col-xs-4">
                                            <form method="post" action="cart-update.php">
                                                <input type="hidden" name="res_id" value="<?php echo $_GET['res_id']; ?>">
                                                <input type="hidden" name="action" value="update">
                                                <input type="hidden" name="d_id" value="<?php echo $item["d_id"]; ?>">
                                                <input class="form-control" type="number" name="quantity" value='<?php echo $item["quantity"]; ?>' id="example-number-input">
                                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                            </form>
                                        </div>
                                    </div>

                                <?php
                                    $item_total += ($item["price"] * $item["quantity"]);
                                }
                                ?>

                            </div>
                        </div>

                        <div class="widget-body">
                            <div class="price-wrap text-xs-center">
                                <p>Total Amount</p>
                                <h3 class="value"><strong>RM<?php echo number_format($item_total, 2); ?></strong></h3>
                                <p>Free Shipping</p>
                                <a href="checkout.php?res_id=<?php echo $_GET['res_id']; ?>&action=check" class="btn theme-btn btn-lg">Checkout</a>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9">
                <?php  // display values and item of food/dishes
                    $stmt = $db->prepare("select * from dishes where rs_id='$_GET[res_id]'");
                    $stmt->execute();
                    $products = $stmt->get_result();
                    if (!empty($products)) 
                    {
                    foreach($products as $product)
                        {
                ?>
                <div class="col-xs-12 col-sm-6 col-md-4 food-item">
                    <form method="post" action='dishes.php?res_id=<?php echo $_GET['res_id'];?>&action=add&id=<?php echo $product['d_id']; ?>'>
                        <div class="food-item-wrap">
                            <div class="figure-wrap bg-image" data-image-src="admin/Res_img/dishes/<?php echo $product['img']; ?>" style="width:100%;height:350px;">
                                <div class="rating pull-left"> 
                                    <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> 
                                </div>
                            </div>
                            <div class="content">
                                <h5><a href="shop.php?id=<?php echo $product['d_id']; ?>"><?php echo $product['title']; ?></a></h5>
                                <div class="product-name"><?php echo $product['slogan']; ?></div>
                                <div class="price-btn-block"> 
                                    <span class="price">RM<?php echo $product['price']; ?></span> 
                                    <input class=" pull-right" type="text" name="quantity" value="1" size="2" />
                                    <input type="submit" class="btn theme-btn-dash pull-right" value="Add to cart" />
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    <?php
                            }
                        }	
                    ?>
                    </div>
                    
                    <!-- end:Bar -->
                    <div class="col-xs-12 col-md-12 col-lg-3">
                        <div class="sidebar-wrap">
                        
                        </div>
                    </div>
                    <!-- end:Right Sidebar -->
                </div>
                <!-- end:row -->
            </div>
            <!-- end:Container -->
            <section class="app-section">
            <div class="app-wrap">
                <div class="container">
                    <div class="row text-img-block text-xs-left">
                        
                    </div>
                </div>
            </div>
        </section>
        <!-- start: FOOTER -->
        <footer class="footer">
            <div class="container">
         <!-- top footer statrs -->
                <div class="row top-footer">
						
						<div class="col-xs-12 col-sm-4 address color-gray">
                            <h5>Address:</h5>
                            <p>Tepi Klinik Bidan Jalan Sungai Baru Simpang Ampat, 02700 Kangar, Perlis</p>
                            <h5>Operational Hours:</h5>
                            <p>Monday to Sunday 
							5 p.m to 11 p.m  <br>Closed on Tuesday</p>
							
                            <h5>Call us at: <a style="font-family: Arial; color:white;" >+60 11-3630 6284</a></h5></div>
                   


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
                <!-- bottom footer ends -->
            </div>
        </footer>
        <!-- end:Footer -->
        </div>
        <!-- end:page wrapper -->
    </div>
    <!--/end:Site wrapper -->
    <!-- Modal -->
    <div class="modal fade" id="order-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                <div class="modal-body cart-addon">
                    <div class="food-item white">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="item-img pull-left">
                                    <a class="restaurant-logo pull-left" href="#"><img src="http://placehold.it/70x70" alt="Food logo"></a>
                                </div>
                                <!-- end:Logo -->
                                <div class="rest-descr">
                                    <h6><a href="#">Sandwich de Alegranza Grande Menü (28 - 30 cm.)</a></h6> </div>
                                <!-- end:Description -->
                            </div>
                            <!-- end:col -->
                            <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center"> <span class="price pull-left">$ 2.99</span></div>
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="row no-gutter">
                                    <div class="col-xs-7">
                                        <select class="form-control b-r-0" id="exampleSelect2">
                                            <option>Size SM</option>
                                            <option>Size LG</option>
                                            <option>Size XL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <input class="form-control" type="number" value="0" id="quant-input-2"> </div>
                                </div>
                            </div>
                        </div>
                        <!-- end:row -->
                    </div>
                    <!-- end:Food item -->
                    <div class="food-item">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="item-img pull-left">
                                    <a class="restaurant-logo pull-left" href="#"><img src="http://placehold.it/70x70" alt="Food logo"></a>
                                </div>
                                <!-- end:Logo -->
                                <div class="rest-descr">
                                    <h6><a href="#">Sandwich de Alegranza Grande Menü (28 - 30 cm.)</a></h6> </div>
                                <!-- end:Description -->
                            </div>
                            <!-- end:col -->
                            <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center"> <span class="price pull-left">$ 2.49</span></div>
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="row no-gutter">
                                    <div class="col-xs-7">
                                        <select class="form-control b-r-0" id="exampleSelect3">
                                            <option>Size SM</option>
                                            <option>Size LG</option>
                                            <option>Size XL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <input class="form-control" type="number" value="0" id="quant-input-3"> </div>
                                </div>
                            </div>
                        </div>
                        <!-- end:row -->
                    </div>
                    <!-- end:Food item -->
                    <div class="food-item">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="item-img pull-left">
                                    <a class="restaurant-logo pull-left" href="#"><img src="http://placehold.it/70x70" alt="Food logo"></a>
                                </div>
                                <!-- end:Logo -->
                                <div class="rest-descr">
                                    <h6><a href="#">Sandwich de Alegranza Grande Menü (28 - 30 cm.)</a></h6> </div>
                                <!-- end:Description -->
                            </div>
                            <!-- end:col -->
                            <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center"> <span class="price pull-left">$ 1.99</span></div>
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="row no-gutter">
                                    <div class="col-xs-7">
                                        <select class="form-control b-r-0" id="exampleSelect5">
                                            <option>Size SM</option>
                                            <option>Size LG</option>
                                            <option>Size XL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <input class="form-control" type="number" value="0" id="quant-input-4"> </div>
                                </div>
                            </div>
                        </div>
                        <!-- end:row -->
                    </div>
                    <!-- end:Food item -->
                    <div class="food-item">
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-lg-6">
                                <div class="item-img pull-left">
                                    <a class="restaurant-logo pull-left" href="#"><img src="http://placehold.it/70x70" alt="Food logo"></a>
                                </div>
                                <!-- end:Logo -->
                                <div class="rest-descr">
                                    <h6><a href="#">Sandwich de Alegranza Grande Menü (28 - 30 cm.)</a></h6> </div>
                                <!-- end:Description -->
                            </div>
                            <!-- end:col -->
                            <div class="col-xs-6 col-sm-2 col-lg-2 text-xs-center"> <span class="price pull-left">$ 3.15</span></div>
                            <div class="col-xs-6 col-sm-4 col-lg-4">
                                <div class="row no-gutter">
                                    <div class="col-xs-7">
                                        <select class="form-control b-r-0" id="exampleSelect6">
                                            <option>Size SM</option>
                                            <option>Size LG</option>
                                            <option>Size XL</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-5">
                                        <input class="form-control" type="number" value="0" id="quant-input-5"> </div>
                                </div>
                            </div>
                        </div>
                        <!-- end:row -->
                    </div>
                    <!-- end:Food item -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn theme-btn">Add to cart</button>
                </div>
            </div>
        </div>
    </div>
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