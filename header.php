<?php
session_start();
include('database.inc.php');
include('function.inc.php');
include('constant.inc.php');

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
        
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
		<style type="text/css">

*{padding:0;margin:0;}


.label-container{
	position:fixed;
	bottom:48px;
	right:105px;
	display:table;
	visibility: hidden;
}

.label-text{
	color:#FFF;
	background:rgba(51,51,51,0.5);
	display:table-cell;
	vertical-align:middle;
	padding:10px;
	border-radius:3px;
}

.label-arrow{
	display:table-cell;
	vertical-align:middle;
	color:#333;
	opacity:0.5;
}

.float{
	position:fixed;
	width:60px;
	height:60px;
	bottom:40px;
	right:40px;
	background-color:#06C;
	color:#FFF;
	border-radius:50px;
	text-align:center;
	box-shadow: 2px 2px 3px #999;
}

.my-float{
	font-size:24px;
	margin-top:18px;
}

a.float + div.label-container {
  visibility: hidden;
  opacity: 0;
  transition: visibility 0s, opacity 0.5s ease;
}

a.float:hover + div.label-container{
  visibility: visible;
  opacity: 1;
}

</style>
    </head>
    <body>

        <!-- header start -->
        <header class="header-area">
            
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
										<li><a href="<?php echo FRONT_SITE_PATH?>index">Home</a></li>
                                        <li><a href="<?php echo FRONT_SITE_PATH?>shop">Movies</a></li>
                                        <li><a href="<?php echo FRONT_SITE_PATH?>sort">Movies Sorting</a></li>
                                        <li><a href="<?php echo FRONT_SITE_PATH?>contact-us">contact us</a></li>
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
										<li><a href="<?php echo FRONT_SITE_PATH?>index">Home</a></li>
                                        <li><a href="<?php echo FRONT_SITE_PATH?>shop">Shop</a></li>
                                        <li><a href="<?php echo FRONT_SITE_PATH?>contact-us">contact us</a></li>
								        
										</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- mobile-menu-area-end -->
        </header>
