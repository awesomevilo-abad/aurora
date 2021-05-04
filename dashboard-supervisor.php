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
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
		<link rel="stylesheet" href="assets/vendor/select2/select2.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="assets/vendor/dropzone/css/basic.css" />
		<link rel="stylesheet" href="assets/vendor/dropzone/css/dropzone.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css" />
		<link rel="stylesheet" href="assets/vendor/summernote/summernote.css" />
		<link rel="stylesheet" href="assets/vendor/summernote/summernote-bs3.css" />
		<link rel="stylesheet" href="assets/vendor/codemirror/lib/codemirror.css" />
		<link rel="stylesheet" href="assets/vendor/codemirror/theme/monokai.css" />
		<link rel="stylesheet" href="assets/vendor/jquery-datatables-bs3/assets/css/datatables.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css" />



		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>
		<script src="assets/morechart.js"></script>
		<!-- pic -->
		
		<link rel="stylesheet" href="assets/css/lightbox.min.css" />
		<script src="assets/js/lightbox-plus-jquery.min.js"></script>
		<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
		<script src="https://code.highcharts.com/modules/drilldown.js"></script>
		<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
		<script src="https://code.highcharts.com/highcharts.js"></script>
		<script src="https://code.highcharts.com/modules/data.js"></script>
		<script src="https://code.highcharts.com/modules/series-label.js"></script>
		<script src="https://code.highcharts.com/modules/exporting.js"></script>
		<script src="https://code.highcharts.com/modules/export-data.js"></script>
		<!-- Additional files for the Highslide popup effect -->
		<script src="https://www.highcharts.com/media/com_demo/js/highslide-full.min.js"></script>
		<script src="https://www.highcharts.com/media/com_demo/js/highslide.config.js" charset="utf-8"></script>
		<link rel="stylesheet" type="text/css" href="https://www.highcharts.com/media/com_demo/css/highslide.css" />
		<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
		


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

					
                    <div class="col-md-12" id="SaniBuildingGrade">
                        <section class="panel" style="background-color:#fff;color:#fdfdfd">
                                <header class="panel-heading" style="background-color:#34495ed6;color:#fdfdfd">
                                    <h2 class="panel-title" style="color:#fff"> Sanitation Grade</h2>
                                        <p class="panel-subtitle" style="color:#fdfdfd">
                                             
                                        </p>
								</header>

								
								
								<div class="col-md-12">
								
									<div class="col-md-3" style="margin-bottom:10px;">
									 Choose Year
												<select class="form-control populate" id="selectYear" onChange='changeYear(this.value)' required></select>
												
									</div>
									
								</div>
								<div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
						</section>
               		</div>
					<input style="background-color:#fff;color:#6666" type="hidden" id="sanitationbuildingtextbox" >
					<input style="background-color:#fff;color:#6666" type="hidden" id="sanitationbuildingweektextbox" >
					<input style="background-color:#fff;color:#6666" type="hidden" id="sanitationphaseweektextbox" >
					<input style="background-color:#fff;color:#6666" type="hidden" id="sanitationphaseweekchecklisttextbox" >

<!-- 
                 end sanitation
				 start structural -->
	
				 <div class="col-md-12" id="StrBuildingGrade">
                        <section class="panel" style="background-color:#fff;color:#fdfdfd">
                                <header class="panel-heading" style="background-color:#34495ed6;color:#fdfdfd">
                                    <h2 class="panel-title" style="color:#fff"> Structural Grade</h2>
                                        <p class="panel-subtitle" style="color:#fdfdfd">
                                             
                                        </p>
								</header>

								
								
								<div class="col-md-12">
									<div class="col-md-3" style="margin-bottom:10px;">
									Choose Month 
												<select data-plugin-selectTwo name="monthstr" id="monthstr" class="form-control populate" onChange='changeMonth(this.value)' required>
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
								<div id="StructuralBuildingGrade" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
						</section>
               		</div>

							<input style="background-color:#fff;color:#6666" type="hidden" id="structuralbuildingtextbox" >
							<input style="background-color:#fff;color:#6666" type="hidden" id="structuralbuildingweektextbox" >
							<input style="background-color:#fff;color:#6666" type="hidden" id="structuralphaseweektextbox" >
							<input style="background-color:#fff;color:#6666" type="hidden" id="structuralphaseweekchecklisttextbox" >
                               
<!-- 
                 end structural
				 start equipment -->

				 <div class="col-md-12" id="EqBuildingGrade">
                        <section class="panel" style="background-color:#fff;color:#fdfdfd">
                                <header class="panel-heading" style="background-color:#34495ed6;color:#fdfdfd">
                                    <h2 class="panel-title" style="color:#fff"> Equipment Grade</h2>
                                        <p class="panel-subtitle" style="color:#fdfdfd">
                                           
                                        </p>
								</header>

								
								
								<div class="col-md-12">
									<div class="col-md-3" style="margin-bottom:10px;">
									Choose Month 
												<select data-plugin-selectTwo name="montheq" id="montheq" class="form-control populate" onChange='changeMonth(this.value)' required>
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
								<div id="EquipmentBuildingGrade" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
						</section>
               		</div>

							<input style="background-color:#fff;color:#6666" type="hidden" id="equipmentbuildingtextbox" >
							<input style="background-color:#fff;color:#6666" type="hidden" id="equipmentbuildingweektextbox" >
							<input style="background-color:#fff;color:#6666" type="hidden" id="equipmentphaseweektextbox" >
							<input style="background-color:#fff;color:#6666" type="hidden" id="equipmentphaseweekchecklisttextbox" >

				 <!-- end equipment -->
				 <!-- start equipment -->

				 <div class="col-md-6" id="EqBuildingGrade">
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
				 <!-- start decline -->

				 <div class="col-md-6">
                        <section class="panel" style="background-color:#fff;color:#fdfdfd">
                                <header class="panel-heading" style="background-color:#34495ed6;color:#fdfdfd">
                                    <h2 class="panel-title" style="color:#fff"> Declined Phase Monitoring</h2>
                                        <p class="panel-subtitle" style="color:#fdfdfd">
                                             
                                        </p>
								</header>

								
								
								<div class="col-md-6">
									<div class="col-md-12" style="color:#666;margin-bottom:10px;">
									Choose Month 
												<select data-plugin-selectTwo name="monthphase" id="monthphase" class="form-control populate" onchange='changeMonthphase(this.value)' required>
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

								<div class="col-md-6">
									<div class="col-md-12" style="color:#666;margin-bottom:10px;">
									Choose Phase 
											<?php
											$pdo = new PDO('mysql:host=localhost;dbname=aurora', 'root', '');
											$sql = "SELECT * FROM Phase inner join Building on Phase.Bid=Building.id ";
											$stmt = $pdo->prepare($sql);
											$stmt->execute();
											$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
											if ($stmt->rowCount() > 0) { ?>
									
											<select data-plugin-selectTwo name="phase" id="phase" class="form-control populate" onchange="changePhase(this.value)" required>
												<?php foreach ($results as $row) { ?>
													<optgroup label="<?php echo $row['Name']?>">
														<option value="<?php echo $row['Pid']?>"><?php echo $row['PName']?></option>
													</optgroup>	
												<?php } ?>
											</select>
											<?php } ?> 
									</div>
								</div>
								<div id="PhaseDeclineMonitoring" style="min-width: 165px; height: 400px; margin: 0 auto"></div>
						</section>
               		</div>

					
				 <!-- end decline -->
					<!-- start QA -->

					<div class="col-md-12" style="display:None">
                        <section class="panel" style="background-color:#fff;color:#fdfdfd">
                                <header class="panel-heading" style="background-color:#34495ed6;color:#fdfdfd">
                                    <h2 class="panel-title" style="color:#fff">Monthly QA Staff Monitoring</h2>
                                        <p class="panel-subtitle" style="color:#fdfdfd">
                                        </p>
								</header>

								
								
								<div class="col-md-12" >
									<div class="col-md-3" style="color:#666;margin-bottom:10px;">
									
									Choose Month
												<select style="display:" data-plugin-selectTwo name="monthqa" id="monthqa" class="form-control populate" onchange='changeMonthqa(this.value)' required>
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
									<div class="col-md-3" style="color:#666;margin-bottom:10px;">
									
									Choose Year
										<select class="form-control populate" id="selectYearQA" onchange='changeYearQA(this.value)' required>
										</select>
									</div>
									<div class="col-md-6" style="color:#666;margin-bottom:10px;">
									Choose Phase 
										<?php
										$pdo = new PDO('mysql:host=localhost;dbname=aurora', 'root', '');
										$sql = "SELECT * FROM Phase inner join Building on Phase.Bid=Building.id ";
										$stmt = $pdo->prepare($sql);
										$stmt->execute();
										$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
										if ($stmt->rowCount() > 0) { ?>

										<select data-plugin-selectTwo name="phaseQa" id="phaseQa" class="form-control populate"  onChange='changePhaseQA(this.value)' required>
											<option value="1201">CHICKEN CUTTING</option>
											<?php foreach ($results as $row) { ?>
												<optgroup label="<?php echo $row['Name']?>">
													<option value="<?php echo $row['Pid']?>"><?php echo $row['PName']?></option>
												</optgroup>	
											<?php } ?>
										</select>
										<?php } ?> 

									</div>
								</div>

								<div id="QAMonitoring2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
						</section>
               		</div>

				 <!-- end QA -->
				 	<!-- start QA -->

					 <div class="col-md-12" style="display:None">
                        <section class="panel" style="background-color:#fff;color:#fdfdfd">
                                <header class="panel-heading" style="background-color:#34495ed6;color:#fdfdfd">
                                    <h2 class="panel-title" style="color:#fff">Monthly QA Staff Performance</h2>
                                        <p class="panel-subtitle" style="color:#fdfdfd">
											
                                        </p>
								</header>

								
								
								<div class="col-md-12" >
									<div class="col-md-3" style="color:#666;margin-bottom:10px;">
									
												<select style="display:none" data-plugin-selectTwo name="monthqastaff" id="monthqastaff" class="form-control populate" onchange='changeMonthqastaff(this.value)' required>
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

									
									Choose Year
										<select class="form-control populate" id="selectYearQAStaff" onchange='changeYearQAStaff(this.value)' required>
										</select>
									</div>
									<div class="col-md-6" style="color:#666;margin-bottom:10px;">
									Choose QA Staff 
										<?php
										$pdo = new PDO('mysql:host=localhost;dbname=aurora', 'root', '');
										$sql = "SELECT * from qaduration group by qastaff ";
										$stmt = $pdo->prepare($sql);
										$stmt->execute();
										$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
										if ($stmt->rowCount() > 0) { ?>

										<select data-plugin-selectTwo name="phaseQastaff" id="phaseQastaff" class="form-control populate"  onChange='changePhaseQAStaff(this.value)' required>
											<option value=" Melissa Angela Bulos"> Melissa Angela Bulos</option>
											<?php foreach ($results as $row) { ?>
											<option value="<?php echo $row['qastaff']?>"><?php echo $row['qastaff']?></option>
												
											<?php } ?>
										</select>
										<?php } ?> 

									</div>
								</div>

								<div id="QAMonitoringPerformance" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
						</section>
               		</div>

				 <!-- end QA -->

				  <!-- start Protech -->

				  <div class="col-md-12">
                        <section class="panel" style="background-color:#fff;color:#fdfdfd">
                                <header class="panel-heading" style="background-color:#34495ed6;color:#fdfdfd">
                                    <h2 class="panel-title" style="color:#fff"> Protech/Supervisor Sanitation Grade</h2>
                                        <p class="panel-subtitle" style="color:#fdfdfd">
                                             
                                        </p>
								</header>

								
								
								<div class="col-md-12">
									<div class="col-md-4" style="color:#666;margin-bottom:10px;">
									Choose Month 
												<select data-plugin-selectTwo name="monthprotech" id="monthprotech" class="form-control populate" onchange='changeMonthprotech(this.value)' required>
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
									<div class="col-md-4" style="color:#666;margin-bottom:10px;">
										Choose Year
											<select class="form-control populate" id="selectYearProtech" onchange='changeYearProtech(this.value)' required>
											</select>

									</div>
									
									<div class="col-md-4" style="color:#666;margin-bottom:10px;">
										Choose Type
											<select class="form-control populate" id="selectTypeProtech" onchange='changeTypeProtech(this.value)' required>
												<option value="Sanitation">Sanitation</option>
												<option value="Structural">Structural</option>
												<option value="Equipment">Equipment</option>
											</select>

									</div>
								</div>

								<div id="ProtechMonitoring" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
						</section>
               		</div>

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
		<script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
		<script src="assets/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
		<script src="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
		<script src="assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
		<script src="assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
		<script src="assets/vendor/fuelux/js/spinner.js"></script>
		<script src="assets/vendor/dropzone/dropzone.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/markdown.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/to-markdown.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>
		<script src="assets/vendor/codemirror/lib/codemirror.js"></script>
		<script src="assets/vendor/codemirror/addon/selection/active-line.js"></script>
		<script src="assets/vendor/codemirror/addon/edit/matchbrackets.js"></script>
		<script src="assets/vendor/codemirror/mode/javascript/javascript.js"></script>
		<script src="assets/vendor/codemirror/mode/xml/xml.js"></script>
		<script src="assets/vendor/codemirror/mode/htmlmixed/htmlmixed.js"></script>
		<script src="assets/vendor/codemirror/mode/css/css.js"></script>
		<script src="assets/vendor/summernote/summernote.js"></script>
		<script src="assets/vendor/bootstrap-maxlength/bootstrap-maxlength.js"></script>
		<script src="assets/vendor/ios7-switch/ios7-switch.js"></script>
		<script src="assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
		<script src="assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
		<script src="assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>

		<!-- Examples -->
		<!-- <script src="assets/javascripts/tables/examples.datatables.ajax.js"></script> -->
		<script src="assets/javascripts/forms/examples.advanced.form.js" ></script>	    
		<script src="assets/javascripts/tables/examples.datatables.default.js"></script>
		<!-- <script src="Report/history.js"></script> -->
		<script src="Report/dashboard.js"></script>
		<script src="header.js"></script>

		<!-- <script src="assets/javascripts/tables/examples.datatables.tabletools.js"></script> -->
		<script src="assets/javascripts/ui-elements/examples.modals.js"></script>
		
	</body>
</html>
