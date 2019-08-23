<?php
 require 'app/settings/config.php'; 
 require 'app/models/User.php';
// require 'app/models/Event.php';
 require 'app/models/EventRegistry.php';
session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>News</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Conference project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="public/styles/bootstrap4/bootstrap.min.css">
<link href="public/plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="public/plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="public/plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="public/plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="public/styles/news.css">
<link rel="stylesheet" type="text/css" href="public/styles/news_responsive.css">
</head>
<body>

<div class="super_container">

	<?php
			if(!isset($_SESSION["loggedUser"]) || $_SESSION["loggedUser"]->getIsAdmin() !=1)
			{
				header("Location: /events/index.php");
				exit();
			}	
	?>	 
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
				<li class="menu_item"><a href="index.html">Admin</a></li>
				
			</ul>
		</div>
		<div class="menu_social">
			
		</div>
	</div>
	
	<!-- Home -->

	<div class="home">
		<div class="parallax_background parallax-window" data-parallax="scroll" data-image-src="public/images/news.jpg" data-speed="0.8"></div>

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
													<li class="active"><a href="#">Admin</a></li>
												</ul>
											</nav>
											<div class="header_extra ml-auto">
											<form method="POST" action="/events/app/controller/UserController.php/Logout" id="logout_form">
													<div class="button header_button">
														<a href="javascript:{}" onclick="document.getElementById('logout_form').submit(); return false;">Log Out</a>
													</div> 
												</form>
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
							<div class="current_page">ADMIN - Event - Request</div>
							<div class="breadcrumbs ml-auto">
								<ul>
									<li><a href="index.html">Home</a></li>
									<li>ADMIN</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- News -->

	<div class="news">
		<div style="margin-left: 20px;">
			<div class="row">
				

				<!-- Sidebar -->
				<div class="col-lg-2">
					<div class="sidebar_categories" style="margin: 0;">
						<div class="sidebar_categories_title">Categories</div>
						<ul class="categories_list">
							<li><a href="admin.php">Event Registration</a></li>
							<li><a href="admin-usermgt.php">User Management</a></li>
							<li><a href="#">Event Management</a></li>
						</ul>
					</div>
				</div>

				<div class="col-lg-8 " style="color: black">
					<h2>Event Requests</h2>
					<p>Below you can apprvoe event requests from users</p>         
					<br>                                                                             
					<div class="table-responsive">          
					<table class="table">
					  <thead>
						<tr>
						  <th>#</th>
						  <th>Event Name</th>
						  <th>Event Date</th>
						  <th>Venue</th>
						  <th>User Name</th>
						  <th>User Contact</th>
						  <th>Request Date</th>
						  <th>Approve</th>
						
						</tr>
					  </thead>
					  <tbody>
						  <?php
							  $registryData = EventRegistry::createInstance();
							  $requests =  $registryData -> getEventRegisterRequests();
						  ?>
						  <?php foreach($requests as $request){?>
								<tr>
								<td><?php echo $request["Id"]?></td>
								<td><?php echo $request["Name"]?></td>
								<td><?php echo $request["StartingDateTime"]?></td>
								<td><?php echo $request["Venue"]?></td>
								<td><?php echo $request["FullName"]?></td>
								<td><?php echo $request["ContactNo"]?></td>
								<td><?php echo $request["RegisteredDate"]?></td>
								<td>
									<form method="POST" action="/events/app/controller/EventsController.php/ApproveEvent">
										<input type="hidden" value="<?php echo $request["Id"]?>" name="RegisterId">
										<input type="submit" value="Approve" class="button event_button event_button_1">		
									</form>
								</td>
								</tr>
						  <?php } ?>
					  </tbody>
					</table>
				</div>
			</div>
		</div>
	</div>



	<!-- Footer -->

		
</div>

<script src="public/js/jquery-3.2.1.min.js"></script>
<script src="public/styles/bootstrap4/popper.js"></script>
<script src="public/styles/bootstrap4/bootstrap.min.js"></script>
<script src="public/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="public/plugins/easing/easing.js"></script>
<script src="public/plugins/parallax-js-master/parallax.min.js"></script>
<script src="public/js/news.js"></script>
</body>
</html>