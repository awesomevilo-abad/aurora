<?php  
session_start();
if(isset($_SESSION['AcName'])){
	$Position = $_SESSION['position'];
	if($Position == 'ADMIN'){
		$_SESSION["username"];  
		$_SESSION["AcName"];  
			  $_SESSION["name"];  
			  $_SESSION["position"];
		 header("location:BuildingManagement.php");  
	}elseif($Position == 'QA Staff'){
		 $_SESSION["username"];
		 $_SESSION["position"];

		header("location:userStartChecklistCat.php");  

	 
	 }elseif($Position == 'QA Supervisor'){
		 $_SESSION["username"]; 
		 $_SESSION["AcName"];   
		 $_SESSION["position"];
		 header("location:userStartChecklistCat.php");  

	 }
	 elseif($Position == 'Supervisor'){
		 $_SESSION["username"];  
		 $_SESSION["AcName"];  
		 $_SESSION["position"];
		 header("location:dashboard-supervisor.php");  

	 }
	 elseif($Position == 'Manager'){
		 $_SESSION["username"];
		 $_SESSION["AcName"];    
		 $_SESSION["position"];
		 header("location:dashboard.php");  

	 } 
	 elseif($Position == 'QA Manager'){
		 $_SESSION["username"];
		 $_SESSION["AcName"];    
		 $_SESSION["position"];
		 header("location:viewRecord_QAManager.php");  

	 } 
	 elseif($Position == 'Protect' or $Position == 'protect'){
		 $_SESSION["username"];  
		 $_SESSION["AcName"];  
		 $_SESSION["position"];
		 header("location:dashboard-protect.php");  

	 }else{
		 $message = '<label>Wrong Position</label>';  
	 }
}
else{
	// header("location:index.php");
}
//  include "loginprocess.php";
 ?>  
<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:3lo00,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />
		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />
		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />
		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">
		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>

	</head>
	<body>
		<!-- start: page -->
		<section class="body-sign" >
			<div class="center-sign">
				<a href="/" class="logo pull-left">
					<img src="assets/images/aurora2.png" height="65" alt="Porto Admin" />
				</a>

				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Sign In</h2>
					</div>
					
					<div class="panel-body">
						<form action="loginprocess.php" method="post">
							<div class="form-group mb-lg">
								<label>Username</label>
								<div class="input-group input-group-icon">
									<input name="username" type="text" class="form-control input-lg" required/>
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-user"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="form-group mb-lg">
								<div class="clearfix">
									<label class="pull-left">Password</label>
									
								</div>
								<div class="input-group input-group-icon">
									<input name="password" type="password" class="form-control input-lg" required/>
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>
										</span>
									</span>
								</div>
							</div>

							<?php  
							if(isset($message))  
							{  
								echo '<label class="text-danger">'.$message.'</label>';  
							}  
							?>  
							
							<div class="row">
								<div class="col-sm-8">
									<div class="checkbox-custom checkbox-default">
										
									</div>
								</div>
								<div class="col-sm-4 text-right">
									<button type="submit" name="login" class="btn btn-primary hidden-xs">Sign In</button>
								</div>
							</div>

						</form>
					</div>
				</div>

				<p class="text-center text-muted mt-md mb-md">&copy; Copyright 2019. All rights reserved. Template by PIM | Red Dragon Farm.</p>
			</div>
		</section>
		<!-- end: page -->


	</body>
</html>