<?php 
require 'app/models/LoginData.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Contact</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Conference project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="public/styles/bootstrap4/bootstrap.min.css">
<link href="public/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="public/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="public/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="public/plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="public/styles/contact.css">
<link rel="stylesheet" type="text/css" href="public/styles/contact_responsive.css">
</head>
<body>

<div class="super_container">

	<!-- Menu -->

	<div class="menu trans_500">
		<div class="menu_content d-flex flex-column align-items-center justify-content-center text-center">
			<div class="menu_close_container"><div class="menu_close"></div></div>
			<div class="logo menu_logo">
				<a href="#">
					<div class="logo_container d-flex flex-row align-items-start justify-content-start">
						<div class="logo_image"><div><img src="public/images/logo.png" alt=""></div></div>
						<div class="logo_content">
							<div class="logo_text logo_text_not_ie">The Conference</div>
							<div class="logo_sub">August 25, 2018 - Miami Marina Bay</div>
						</div>
					</div>
				</a>
			</div>
			<ul>
				<li class="menu_item"><a href="index.php">Home</a></li>
                <li class="menu_item"><a href="register.php">Register</a></li>
                <li class="menu_item"><a href="login.php">Login</a></li>
			</ul>
		</div>
		
	</div>
	
	<!-- Home -->

	<div class="home">
		<div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="public/images/contact.jpg" data-speed="0.8"></div>

		<!-- Header -->

		<header class="header" id="header">
			<div>
				<div class="header_top">
					<div class="container">
						<div class="row">
							<div class="col">
								<div class="header_top_content d-flex flex-row align-items-center justify-content-start">
									<div>
										<a href="#">
											<div class="logo_container d-flex flex-row align-items-start justify-content-start">
												<div class="logo_image"><div><img src="public/images/logo.png" alt=""></div></div>
												<div class="logo_content">
													<div id="logo_text" class="logo_text logo_text_not_ie">The Conference</div>
													<div class="logo_sub">August 25, 2018 - Miami Marina Bay</div>
												</div>
											</div>
										</a>	
									</div>
									<div class="header_social ml-auto">
										
									</div>
									<div class="hamburger ml-auto"><i class="fa fa-bars" aria-hidden="true"></i></div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="header_nav" id="header_nav_pin">
					<div class="header_nav_inner">
						<div class="header_nav_container">
							<div class="container">
								<div class="row">
									<div class="col">
										<div class="header_nav_content d-flex flex-row align-items-center justify-content-start">
											<nav class="main_nav">
												<ul>
													<li><a href="index.php">Home</a></li>
                                                    <li ><a href="register.php">Register</a></li>
                                                    <li class="active"><a href="login.php">Login</a></li>
												</ul>
											</nav>
											<div class="header_extra ml-auto">
												<!-- <div class="header_search"><i class="fa fa-search" aria-hidden="true"></i></div>
												<div class="button header_button"><a href="#">Buy Tickets Now!</a></div> -->
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="search_container">
							<div class="container">
								<div class="row">
									<div class="col">
										<div class="search_content d-flex flex-row align-items-center justify-content-end">
											<form action="#" id="search_container_form" class="search_container_form">
												<input type="text" class="search_container_input" placeholder="Search" required="required">
												<button class="search_container_button"><i class="fa fa-search" aria-hidden="true"></i></button>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>	
			</div>
		</header>

		<div class="home_content_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_content d-flex flex-row align-items-end justify-content-start">
						
							<div class="current_page">Login </div>
							<div class="breadcrumbs ml-auto">
								<ul>
									<li><a href="index.html">Home</a></li>
									<li>Login</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Contact -->

	<div class="contact" style="background-color:#141170">
		
		<div class="container" >
			<div class="row">
				<div class="col-lg-6">
					<div class="contact_form_container">
						<div class="contact_form_title">Login</div>
						<span style="color:red">
						  <?php
						  
						  	  $login = new LoginData("","");
							  if(isset($_SESSION["loginFormData"]))
								 $login = $_SESSION["loginFormData"];

							  if(isset($_SESSION["loginFormErrors"]))
							     echo "Error :- ".$_SESSION["loginFormErrors"];
						  ?>
					     	
						</span>
						<form method="POST" action="/events/app/controller/UserController.php/Login" class="contact_form" id="contact_form">
							<input type="email" class="contact_input" placeholder="E-mail" required="required" name="Email" value="<?=$login->getEmail()?>">
							<input type="password" class="contact_input" placeholder="Password" required="required" name="Password" value="<?=$login->getPassword()?>">
							<button  type="submit" name="submit"  class="button contact_button" value="Submit"><span>Login</span></button>
						</form>
					</div>
				</div>
				<div class="col-lg-5 offset-lg-1">
					<div class="contact_info_container">
						<div>
							<a href="#">
								<div class="logo_container d-flex flex-row align-items-start justify-content-start">
									<div class="logo_image"><div><img src="images/logo.png" alt=""></div></div>
									<div class="logo_content">
										<div id="logo_text" class="logo_text logo_text_not_ie">The Conference</div>
										<div class="logo_sub">August 25, 2018 - Miami Marina Bay</div>
									</div>
								</div>
							</a>	
						</div>
						<div class="contact_info_list_container">
							<ul class="contact_info_list">
								<li class="d-flex flex-row align-items-start justify-content-start">
									<div><div class="contact_info_icon text-center"><img src="images/contact_1.png" alt=""></div></div>
									<div class="contact_info_text">Blvd Libertad, 34 m05200 Los Angeles, CA</div>
								</li>
								<li class="d-flex flex-row align-items-start justify-content-start">
									<div><div class="contact_info_icon text-center"><img src="images/contact_2.png" alt=""></div></div>
									<div class="contact_info_text">0034 37483 2445 322</div>
								</li>
								<li class="d-flex flex-row align-items-start justify-content-start">
									<div><div class="contact_info_icon text-center"><img src="images/contact_3.png" alt=""></div></div>
									<div class="contact_info_text">hello@company.com</div>
								</li>
							</ul>
						</div>
						<div class="contact_info_pin"><div></div></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Footer -->

	<footer class="footer">
	
		<div class="footer_extra">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="footer_extra_content d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-lg-start justify-content-center">
							<div class="footer_social">
								<div class="footer_social_title">Follow us on Social Media</div>
								<ul class="footer_social_list">
									<!-- <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-behance" aria-hidden="true"></i></a></li>
									<li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li> -->
								</ul>
							</div>
							<div class="footer_extra_right ml-lg-auto text-lg-right">
								<div class="footer_extra_links">
									<ul>
										<li><a href="contact.html">Contact us</a></li>
										<li><a href="#">Sitemap</a></li>
										<li><a href="#">Privacy</a></li>
									</ul>
								</div>
								<div class="copyright"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
		
</div>

<script src="public/js/jquery-3.2.1.min.js"></script>
<script src="public/styles/bootstrap4/popper.js"></script>
<script src="public/styles/bootstrap4/bootstrap.min.js"></script>
<script src="public/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="public/plugins/easing/easing.js"></script>
<script src="public/plugins/parallax-js-master/parallax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA"></script>
<script src="public/js/contact.js"></script>
</body>
</html>