<?php  
 session_start(); 
if(isset($_SESSION['username'])){
}else{
	header("location:index.php");  
}
 include_once 'startChecklist/Class.php';
 
 $crudcontroller = new CrudController();
 $dao = new Dao();
 $conn = $dao->openConnection();
 $Datetoday = $crudcontroller->getDate();
 $currentMonth = date("F",strtotime($Datetoday));
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

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>
		


	</head>
	<body>
		<section class="body">

		<?php include 'header.php'?>

			<div class="inner-wrapper">
                <div id="sidebar" style="z-index:3px">
                    <?php include 'userSidebar.php'?>
                </div>

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Generate Report</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Generate</span></li>
								<li><span>Report</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- body form -->

						<div class="col-sm-4">
								<form id="formManagePoints"  class="form-horizontal" novalidate="novalidate" enctype="multipart/form-data">
                                <section class="panel" style="background-color:#ffffff">
										<header class="panel-heading" style="background-color:#f34639;" >
											<h2 class="panel-title" style="color:#ffffff"> Internal Audit Report</h2>
												<p class="panel-subtitle" style="color:#ffffff">
												 
												</p>
										</header>
										
										<div class="panel-body">
											<div class="form-group">
												<div class="col-sm-12">

								
                                                    
												</div>
                                            </div>
                                            

										<div class="form-group">
											<div class="col-sm-6">
											<input type="hidden" id="QA" name="QA"class="form-control" value="<?php echo $_SESSION['AcName']?>" readonly autocomplete="none"required/>
											<strong><label><strong>Title:</strong></label></strong><input id="Title" name="Title"class="form-control" placeholder="MonthYear_Name ex. June2019_Vince" autocomplete="none"required/>
											<label><small><i>ex. June2019_Vince</i></small></label>
											</div>
										
                                            
                                                <div class="col-sm-6">
												
                                                        <?php
                                                        $pdo = new PDO('mysql:host=localhost;dbname=aurora', 'root', '');
                                                        $sql = "SELECT * FROM Phase inner join Building on Phase.Bid=Building.id ";
                                                        $stmt = $pdo->prepare($sql);
                                                        $stmt->execute();
                                                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                                        if ($stmt->rowCount() > 0) { ?>
                                                
                                                <strong> Phase:</strong> <select data-plugin-selectTwo name="phase" id="phase" onchange="getBuildingfromPhase(this.value)" class="form-control populate" required>
															<option value=""></option>
															<?php foreach ($results as $row) { ?>
                                                                <optgroup label="<?php echo $row['Name']?>">
                                                                    <option value="<?php echo $row['Pid']?>"><?php echo $row['PName']?></option>
                                                                </optgroup>	
                                                            <?php } ?>
                                                        </select>
                                                        <?php } ?> 

                                                </div>
                                        </div>

										<div class="form-group">
											<div class="col-sm-6">
											<!-- <strong><label>Header:</label></strong> -->
											<input id="monthYr" name="monthYr"class="form-control" type="hidden" value="<?php echo date("F o",strtotime($Datetoday)) ?>" required/>
											</div>
										</div>
										<center>
										<div class="form-group">
											<div class="col-sm-4">
                                                    <strong> Week:</strong>	
												
														<select name="Week" id="Week" class="form-control">
																<option value="1">1st Week</option>
																<option value="2">2nd Week</option>
																<option value="3">3rd Week</option>
																<option value="4">4th Week</option>
																<option value="5">5th Week</option>
														</select>
														<input type="hidden" name="BuildingRecord" id="BuildingRecord" class="form-control"  required/>
														<input type="hidden" name="Fid" id="Fid" class="form-control"  required/>
											</div>
											<div class="col-sm-4">
                                                    <strong> Month:</strong>	
												
													<select  style="text-align:center;border:none" class="form-control pull-right" name="month" id="month" required>
														<option value="<?php echo $currentMonth?>" selected><?php echo $currentMonth?> </option>
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
											<div class="col-sm-4">
                                                    <strong> Year:</strong>	
												
													<select  style="text-align:center;border:none" class="form-control pull-right" name="year" id="year" required>
													<?php
													for($i=0;$i<6;$i++){
														$year = date("Y",strtotime($Datetoday))+$i;
														?>
														<option value="<?php echo $year ?>"><?php echo $year ?></option>
														<?php

													}
													?>
													
                    								</select>
											</div>
										</div>
										</center>
											<div class="form-group">
												<div class="col-sm-12">
												<button type="submit" id="btnAddRecord" class="btn btn-default" style="margin-top:25px;" ><img src="icons/submit.png" style="height:25px; width:25px">Submit</button>
												<button type="button" id="btnUpdate"  name="btnUpdate" class="mb-xs mt-xs mr-xs btn btn-default" ><img src="icons/update.png" style="height:25px; width:25px;float:right" data-toggle="tooltip" title="Update">Update</button>
												<button type="button" id="btnCancel" name="btnCancel" class="mb-xs mt-xs mr-xs btn btn-default" ><img src="icons/cancel.png" style="height:25px; width:25px;float:right" data-toggle="tooltip" title="Cancel">Cancel</button>        
												<button type="button" id="Points" onclick="managepoints()" name="Points" class="mb-xs mt-xs mr-xs btn btn-default" ><img src="icons/checklist.png" style="height:25px; width:25px;float:right">Add</button>	
												</div>
											</div>	

                                        </div>
										<footer class="panel-footer">
											<div class="row">
												<div class="col-sm-9 col-sm-offset-3">
												
											
												</div>
											</div>
										</footer>
									</section>
								</form>
							</div>
					<!-- end body form -->
					<section class="panel col-sm-8">
							
							<center>
								<div id="loader">
								</div>
							</center>
							<div id="container">
							</div>
					</section>									
				

					<!-- MODAL INCLUDE -->	
					<?php include("Report/modal_viewallImages.php");?>
			
					<?php include("Report/modal_managepoints.php");?>
					<?php include("Report/modal_correctionimage.php");?>
				
				
				</section>
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

		<script src="assets/javascripts/ui-elements/examples.modals.js"></script>

		<!-- Examples -->
		<script src="Report/createReport.js"></script>
		<!-- <script src="Report/history.js"></script> -->
		<script src="header.js"></script>
		
	</body>
</html>