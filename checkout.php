<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
include_once 'product-action.php';
error_reporting(0);
session_start();
if(empty($_SESSION["user_id"]))
{
	header('location:login.php');
}
else{									  
    foreach ($_SESSION["cart_item"] as $item)
    {

    $item_total += ($item["price"]*$item["quantity"]);
    
        if($_POST['submit'])
        {

            $SQL="insert into users_orders(u_id,title,quantity,price) values('".$_SESSION["user_id"]."','".$item["title"]."','".$item["quantity"]."','".$item["price"]."')";

            mysqli_query($db,$SQL);
            
            $success = header('location:cod.php');

            // Empty the cart after placing the order
            unset($_SESSION["cart_item"]);
            
        }
    }
?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags must come first in the head; any other head content must come after these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="checkout.png">
    <title>Order Checkout</title>
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
    
    <div class="site-wrapper">
        <!--header starts-->
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
?>	<?php
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
            <!-- /.navbar -->
        </header>
        <div class="page-wrapper">
            <div class="top-links">
                <div class="container">
                    <ul class="row links">
                      
                      <li class="col-xs-12 col-sm-4 link-item "><span>1</span><a href="#">Pick your favourite dishes</a></li>
                        <li class="col-xs-12 col-sm-4 link-item active" ><span>2</span><a href="checkout.php">Get delivered & Pay</a></li>
                    </ul>
                </div>
            </div>
			
                <div class="container">
                 
					   <span style="color:green;">
								<?php echo $success; ?>
										</span>
					
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

foreach ($_SESSION["cart_item"] as $item)  // fetch items define current into session ID
{
?>									
									
                                      <div class="title-row">
										<?php echo $item["title"]; ?><a href="dishes.php?res_id=<?php echo $_GET['res_id']; ?> ">
										</a>
										</div>
										
										
                                        <div class="form-group row no-gutter">
                                            <div class="col-xs-8">
                                                 <input type="text" class="form-control b-r-0" value=<?php echo $item["price"]; ?> readonly id="exampleSelect1">
                                                   
                                            </div>
                                            <div class="col-xs-4">
                                               <input class="form-control" type="text" readonly value='<?php echo $item["quantity"]; ?>' id="example-number-input"> </div>
                                        
									  </div>
									  
	<?php
$item_total += ($item["price"]*$item["quantity"]); // calculating current price into cart
}
?>								  
									  
									  
									  
                                    </div>
                                </div>
                               
                                <!-- end:Order row -->
                             
                                <div class="widget-body">
                                    <div class="price-wrap text-xs-center">
                                        <p>Total Amount</p>
                                        <h3 class="value"><strong>RM<?php echo number_format($item_total, 2); ?></strong></h3>
                                        <p>Free Shipping</p>
                                          </div>
                                </div>
								
						
								
								
                            </div>
                    </div>

                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-6">
                      
                        <!-- end:Widget menu -->
                      
				  
            <div class="container m-t-"style="width: 700px;">
			<form action="" method="post">
                <div class="widget clearfix">
                    
                    <div class="widget-body">
                        <form method="post" action="#">
                            <div class="row">
                                
                                <div class="col-sm-12">
                                    <div class="cart-totals margin-b-20">
                                        <div class="cart-totals-title">
                                            <h4>Cart Summary</h4> </div>
                                        <div class="cart-totals-fields">
										
                                            <table class="table">
											<tbody>
                                          
												 
											   
                                                    <tr>
                                                        <td>Cart Subtotal</td>
                                                        <td> RM<?php echo number_format($item_total, 2); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Shipping &amp; Handling</td>
                                                        <td>FREE</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-color"><strong>Total</strong></td>
                                                        <td class="text-color"><strong> RM<?php echo number_format($item_total, 2); ?></strong></td>
                                                    </tr>
                                                </tbody>
												
												
												
												
                                            </table>
                                        </div>
                                    </div>
                                    <!--cart summary-->
                                    <div class="payment-option">
                                        <ul class=" list-unstyled">
                                            <li>
                                                <label class="custom-control custom-radio  m-b-20">
                                                    <input name="mod" id="radioStacked1" checked value="COD" type="radio" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Cash on delivery</span>
                                                    </label>
                                            </li>
                                            <li>
                                                <label class="custom-control custom-radio  m-b-10">
                                                    <input name="mod"  type="radio" value="paypal" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Credit Card<img src="images/paypal.jpg" alt="" width="90"></span> </label>
                                            </li>
                                        </ul>
                                        <p class="text-xs-center"> <input type="submit" onclick="return confirm('Are you sure you want to place an order?');" name="submit"  class="btn btn-outline-success btn-block" value="Order now"> </p>
                                    </div>
									</form>
                                </div>
                            </div>
                       
                    </div>
                </div>
				 </form>
            </div>
                   
        
               
        </div>
        <!-- end:page wrapper -->
         </div>      
                    </div>
          
                    
        
        </div>
        <!-- end:page wrapper -->
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
                            <li><a >Bintong</a> </li>
                            <li><a >Kaki Bukit</a> </li>
                            <li><a >Kuala Perlis</a> </li>
                            <li><a >Kaki Bukit</a> </li>
                            <li><a >Kangar</a> </li>
                            <li><a>Simpang Ampat</a> </li>
                            <li><a >Tambun Tulang</a> </li>
                            <li><a>Mata Ayer</a> </li>
                        </ul>
                    </div>
					 <div class="col-xs-12 col-sm-3 payment-options color-gray">
                            <h5>All Major Credit Cards Accepted</h5>
                            <ul>
                                <li>
                                    <a href="#"> <img src="images/paypal.png" alt="Paypal"> </a>
                                </li>
                                <li>
                                    <a href="#"> <img src="images/mastercard.png" alt="Mastercard"> </a>
                                </li>
                                <li>
                                    <a href="#"> <img src="images/maestro.png" alt="Maestro"> </a>
                                </li>
                                <li>
                                    <a href="#"> <img src="images/stripe.png" alt="Stripe"> </a>
                                </li>
                                <li>
                                    <a href="#"> <img src="images/bitcoin.png" alt="Bitcoin"> </a>
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

<?php
}
?>