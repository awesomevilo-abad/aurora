<?php   
 session_start(); 
if(isset($_SESSION['username'])){
echo "Please Wait";
}else{
	header("location:index.php");  
}
 include_once 'startchecklist/Class.php';
 $crudcontroller = new CrudController();
 $dao = new Dao();
 $conn = $dao->openConnection();
 $Datetoday = $crudcontroller->getDate();
 $currentMonth = date("F",strtotime($Datetoday));
 
 echo $_SESSION['position'];


        
    ?>
<!doctype html>
<html class="fixed sidebar-left-collapsed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Aurora</title>
		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
		<link rel="stylesheet" href="assets/vendor/select2/select2.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css" />



		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
		<script src="https://code.highcharts.com/modules/drilldown.js"></script>
		<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/modules/data.js"></script>
		<script src="https://code.highcharts.com/modules/series-label.js"></script>
		<script src="https://code.highcharts.com/modules/exporting.js"></script>
		<script src="https://code.highcharts.com/modules/export-data.js"></script>

	</head>
	<body>
		<section class="body">

		<?php include 'header.php'?>

			<div class="inner-wrapper">
                <div id="sidebar" style="z-index:3px">
                    <?php include 'usersidebar.php'?>
                </div>

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Dashboard</h2>
					
						<div class="right-wrapper pull-right">
							
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>
					
					<center>
						<div id="loader">
						</div>
					</center>
					<div id="showdata" class="col-md-12">

				

				
				 <!-- start equipment -->

				 <div class="col-md-12" id="EqBuildingGrade">
                        <section class="panel" style="background-color:#fff;color:#fdfdfd">
                                <header class="panel-heading" style="background-color:#34495ed6;color:#fdfdfd">
                                    <h2 class="panel-title" style="color:#fff"> Equipment Monitoring</h2>
                                        <p class="panel-subtitle" style="color:#fdfdfd">
                                             
                                        </p>
								</header>

								
								
								<div class="col-md-12">
									<div class="col-md-6" style="margin-bottom:10px;">
									Choose Month 
												<select data-plugin-selectTwo name="montheqmonitoring" id="montheqmonitoring" class="form-control populate" onChange='changeMontheqMonitoring(this.value)' required>
													<option value="<?php echo $currentMonth ?>"><?php echo $currentMonth ?></option>
													<option value="January">January</option>
													<option value="February">February</option>
													<option value="March">March</option>
													<option value="April">April</option>
													<option value="May">May</option>
													<option value="June">June</option>
													<option value="July">July</option>
													<option value="August">August</option>
													<option value="September">September</option>
													<option value="October">October</option>
													<option value="November">November</option>
													<option value="December">December</option>
												</select>

									</div>
								</div>
								<div id="EquipmentBuildingMonitoring" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
						</section>
               		</div>

							<input style="background-color:#fff;color:#6666" type="hidden" id="equipmentbuildingmonitoringtextbox" >
							<input style="background-color:#fff;color:#6666" type="hidden" id="equipmentbuildingmonitoringweektextbox" >
							<input style="background-color:#fff;color:#6666" type="hidden" id="equipmentphaseweekmonitoringtextbox" >
							<input style="background-color:#fff;color:#6666" type="hidden" id="equipmentphaseweekchecklistmonitoringtextbox" >

				 	 <!-- end equipment -->
			

				 <!-- end protechsanitation -->
				</div>
				
            <div>
            <?php include 'rightsidebar.php'?>
            </div>
		</section>

		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Specific Page Vendor -->
		<script src="assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>
		<script src="assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
		<script src="assets/vendor/select2/select2.js"></script>
		<script src="assets/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/markdown.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/to-markdown.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>
		<script src="assets/vendor/codemirror/lib/codemirror.js"></script>
		<script src="assets/vendor/codemirror/addon/selection/active-line.js"></script>
		<script src="assets/vendor/codemirror/mode/javascript/javascript.js"></script>
		<script src="assets/vendor/codemirror/mode/xml/xml.js"></script>
		<script src="assets/vendor/codemirror/mode/htmlmixed/htmlmixed.js"></script>
		<script src="assets/vendor/codemirror/mode/css/css.js"></script>
		<script src="assets/vendor/summernote/summernote.js"></script>
		<script src="assets/vendor/bootstrap-maxlength/bootstrap-maxlength.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>

		<!-- <script src="Report/history.js"></script> -->
		<script src="Report/dashboard.js"></script>
		<script src="header.js"></script>

		
	</body>
</html>
