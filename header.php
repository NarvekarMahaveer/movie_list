<?php
session_start();
include('database.inc.php');
include('function.inc.php');
include('constant.inc.php');
$totalPrice=0;
$getSetting=getSetting();

$website_close=$getSetting['website_close'];
$website_close_msg=$getSetting['website_close_msg'];
$cart_min_price=$getSetting['cart_min_price'];
$cart_min_price_msg=$getSetting['cart_min_price_msg'];

getDishCartStatus();

if(isset($_POST['update_cart'])){
	foreach($_POST['qty'] as $key=>$val){
		if(isset($_SESSION['FOOD_USER_ID'])){
			if($val[0]==0){
				mysqli_query($con,"delete from dish_cart where dish_detail_id='$key' and user_id=".$_SESSION['FOOD_USER_ID']);
			}else{
				mysqli_query($con,"update dish_cart set qty='".$val[0]."' where dish_detail_id='$key' and user_id=".$_SESSION['FOOD_USER_ID']);	
			}
		}else{
			if($val[0]==0){
				unset($_SESSION['cart'][$key]['qty']);
			}else{
				$_SESSION['cart'][$key]['qty']=$val[0];	
			}
		}
	}
}

$cartArr=getUserFullCart();


$totalPrice=getcartTotalPrice();
$totalCartDish=count($cartArr);

$getWalletAmt=0;
if(isset($_SESSION['FOOD_USER_ID'])){
	$getWalletAmt=getWalletAmt($_SESSION['FOOD_USER_ID']);
}
?>
<!doctype html>
<html class="no-js" lang="eng">
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
        <title><?php echo FRONT_SITE_NAME?></title> 
        <link rel="stylesheet" href="<?php echo FRONT_SITE_PATH?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo FRONT_SITE_PATH?>assets/css/animate.css">
        <link rel="stylesheet" href="<?php echo FRONT_SITE_PATH?>assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="<?php echo FRONT_SITE_PATH?>assets/css/slick.css">
        <link rel="stylesheet" href="<?php echo FRONT_SITE_PATH?>assets/css/chosen.min.css">
        <link rel="stylesheet" href="<?php echo FRONT_SITE_PATH?>assets/css/ionicons.min.css">
        <link rel="stylesheet" href="<?php echo FRONT_SITE_PATH?>assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo FRONT_SITE_PATH?>assets/css/simple-line-icons.css">
        <link rel="stylesheet" href="<?php echo FRONT_SITE_PATH?>assets/css/jquery-ui.css">
        <link rel="stylesheet" href="<?php echo FRONT_SITE_PATH?>assets/css/meanmenu.min.css">
        <link rel="stylesheet" href="<?php echo FRONT_SITE_PATH?>assets/css/style.css">
        <link rel="stylesheet" href="<?php echo FRONT_SITE_PATH?>assets/css/responsive.css">
        <script src="<?php echo FRONT_SITE_PATH?>assets/js/vendor/modernizr-2.8.3.min.js"></script>
		<link href='jquery-ui.min.css' rel='stylesheet' type='text/css'>
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 80%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}
</style>


		   
    </head>
    <body>

        <!-- header start -->
        <header class="header-area">
            <div class="header-top black-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-md-4 col-12 col-sm-4">
                            <div class="welcome-area">
                                
                            </div>
                        </div>
						<div class="col-lg-2 col-md-4 col-12 col-sm-4">
							<?php
								if(isset($_SESSION['FOOD_USER_NAME'])){
								?>
							<div id="wallet_top_box">
								<a href="<?php echo FRONT_SITE_PATH?>wallet" style="color:#fff;">
									Wallet Amt:- <?php echo $getWalletAmt?>
								</a>
								
							</div>
								<?php  } ?>
						</div>
                        <div class="col-lg-2 col-md-8 col-12 col-sm-8">
                            <div class="account-curr-lang-wrap f-right">
                                <?php
								if(isset($_SESSION['FOOD_USER_NAME'])){
								?>
								<ul>
                                    <li class="top-hover"><a href="#"><?php echo "Welcome <span id='user_top_name'>".$_SESSION['FOOD_USER_NAME'];?></span>  <i class="ion-chevron-down"></i></a>
                                        <ul>
                                            <li><a href="<?php echo FRONT_SITE_PATH?>profile">Profile  </a></li>
                                            <li><a href="<?php echo FRONT_SITE_PATH?>order_history">Order History</a></li>
                                            <li><a href="<?php echo FRONT_SITE_PATH?>logout">Logout</a></li>
											
                                        </ul>
                                    </li>
                                </ul>
								<?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-middle">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-12 col-sm-4">
                            <div class="logo">
                                <a href="<?php echo FRONT_SITE_PATH?>">
                                    <img alt="" src="<?php echo FRONT_SITE_PATH?>assets/img/logo/logo.png">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-8 col-12 col-sm-8">
                            <div class="header-left f-right">
                                <div class="header-login">
                                    <?php
									if(!isset($_SESSION['FOOD_USER_NAME'])){
										?>
									<a href="<?php echo FRONT_SITE_PATH?>login_register">
                                        <div class="header-icon-style">
                                            <i class="icon-user icons header_icon"></i>
                                        </div>
                                        <div class="login-text-content header_icon">
											
												<p>Register <br> or <span>Sign in</span></p>
												
                                        </div>
                                    </a>
									<?php
											}
											?>
                                </div>
                                <div class="header-wishlist">
                                   &nbsp;
                                </div>
                                <div class="header-cart">
                                    <a href="#">
                                        <div class="header-icon-style">
                                            <i class="icon-handbag icons"></i>
                                            <span class="count-style" id="totalCartDish"><?php echo $totalCartDish?></span>
                                        </div>
                                        <div class="cart-text">
                                            <span class="digit">My Cart</span>
                                            <span class="cart-digit-bold" id="totalPrice">
											<?php 
											if($totalPrice!=0){
												echo $totalPrice.' Rs';
											}
											?></span>
                                        </div>
                                    </a>
									<?php if($totalPrice!=0){?>
									<div class="shopping-cart-content">
                                        <ul id="cart_ul">
											<?php foreach($cartArr as $key=>$list){ ?>
												<li class="single-shopping-cart" id="attr_<?php echo $key?>">
													<div class="shopping-cart-img">
														<a href="javascript:void(0)"><img alt="" src="<?php echo SITE_DISH_IMAGE.$list['image']?>"></a>
													</div>
													<div class="shopping-cart-title">
														<h4><a href="javascript:void(0)">
														<?php echo $list['dish']?>
														</a></h4>
														<h6>Qty: <?php echo $list['qty']?></h6>
														<span><?php echo 
														$list['qty']*$list['price'];?> Rs</span>
													</div>
													<div class="shopping-cart-delete">
														<a href="javascript:void(0)" onclick="delete_cart('<?php echo $key?>')"><i class="ion ion-close"></i></a>
													</div>
												</li>
											<?php } ?>
                                        </ul>
                                        <div class="shopping-cart-total">
                                            <h4>Total : <span class="shop-total" id="shopTotal">
											<?php echo 'Rs ' . $totalPrice?> 
											</span></h4>
                                        </div>
                                        <div class="shopping-cart-btn">
                                            <a href="<?php echo FRONT_SITE_PATH?>cart">view cart</a>
                                            <a href="<?php echo FRONT_SITE_PATH?>checkout">checkout</a>
                                        </div>
                                    </div>
									<?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom transparent-bar black-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="main-menu">
                                <nav>
                                    <ul>
                                        <li><a href="<?php echo FRONT_SITE_PATH?>shop">Shop</a></li>
                                        <li><a href="<?php echo FRONT_SITE_PATH?>about-us">about</a></li>
                                        <li><a href="<?php echo FRONT_SITE_PATH?>contact-us">contact us</a></li>
										<li><a href="<?php echo FRONT_SITE_PATH?>privacy-policy">Privacy Policy</a></li>
                                        <li><a href="<?php echo FRONT_SITE_PATH?>terms-conditions">Terms & Conditions</a></li>
										
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- mobile-menu-area-start -->
			<div class="mobile-menu-area">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="mobile-menu">
								<nav id="mobile-menu-active">
									<ul class="menu-overflow" id="nav">
										<li><a href="<?php echo FRONT_SITE_PATH?>shop">Home</a></li>
										<li><a href="<?php echo FRONT_SITE_PATH?>about-us">About Us</a></li>
										<li><a href="<?php echo FRONT_SITE_PATH?>contact-us">Contact Us</a></li>
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- mobile-menu-area-end -->
        </header>