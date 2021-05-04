<?php  
 session_start(); 
 if(isset($_SESSION['username'])){
	echo "Meron";
	}else{
		header("location:index.php");  
	}
 include_once 'startchecklist/Class.php';
 $crudcontroller = new CrudController();
 $dao = new Dao();
 $conn = $dao->openConnection();
 $Datetoday = $crudcontroller->getDate();
 $AcName=$_SESSION['AcName'];
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
		<!-- pic -->
		
		<link rel="stylesheet" href="assets/css/lightbox.min.css" />
		<script src="assets/js/lightbox-plus-jquery.min.js"></script>
		

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
						<h2>Spot Audit History</h2>
					
						<div class="right-wrapper pull-right">
							
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- Main Body select building phase area checklist-->
						<center>
						<div id="loader">
						</div>
						</center>
						<div id="showdata" class="col-md-12">
								
									<section class="panel" style="background-color:#ffffff">
										<header class="panel-heading">
											<h2 class="panel-title">View Records</h2>
												<p class="panel-subtitle">
													View Records
												</p>
										</header>
                                        
                                            <section class="panel">	
                                                <div class="row mg-files" data-sort-destination data-sort-id="media-gallery">
                                                    <div class="isotope-item document">
                                                        <div style="margin:20px;">
                                                        
															 <!-- viewing of checklist -->
															 <form method="post" action="Report/export_visor.php" align="center">  
																	<div class="col-md-3" style="text-align:left">
																		<label for=""><strong>Date Audited</strong></label>
					
																				 <select style="width:300px;display:" onchange="enableBuilding_visor(this.value)" id="Date_visor" name="Date_visor" class="form-control">
																					<option></option>
																				 </select>
																				 
																				 
																				 <?php
																			
																		?>

																	</div>
																	<div class="col-md-3" style="text-align:left">
																		<label for=""><strong>Building</strong></label>
																		<select readonly style="width:300px;" onChange='getBuilding(this.value)' id="Building"  name="Building" class="form-control">
																			<option></option>
																		</select>
																	</div>
																	<div class="col-md-3" style="text-align:left">
																		<label for=""><strong>Phase</strong></label>
																		<select readonly style="width:300px;" onChange='getPhase(this.value)'id="Phase" name="Phase" class="form-control">
																			<option></option>
																		</select>
																	</div>
																	<div class="col-md-3" style="text-align:left">
																		<label for=""><strong>Area</strong></label>
																		<select readonly style="width:300px;"  id="Area" name="Area" class="form-control">
																			<option></option>
																		</select>
																	</div>
																		<div class="col-md-3" style="">
																		
																		
																			<!-- <button type="button" class="btn btn-info fa fa-send" style="background-color:#0088cc;margin-top:25px;" >Export</button> -->
																			<?Php
																				if($_SESSION['position']=="QA Staff" || $_SESSION['position']=="ADMIN"){
																					?><button type="button" onclick="filteredloadData('<?php echo $position ?>')" class="btn btn-default" style="margin-top:25px;" ><img src="icons/view.png" style="height:25px; width:25px">View Records</button><?php
																				}else{
																					?><button type="button" onclick="filteredloadData_visor('<?php echo $position ?>')" class="btn btn-default" style="margin-top:25px;" ><img src="icons/view.png" style="height:25px; width:25px">View Record Visor</button><?php
																				}
																			?>
																			<button type="submit" name="export" value="Export" class="btn btn-default" style="margin-top:25px;" ><img src="icons/export.png" style="height:25px; width:25px">Export</button>
																			
																		</div>
																	</div>
																	</form>  
																			
																		<?Php
																			if($_SESSION['position']=="QA Staff" || $_SESSION['position']=="ADMIN"){
																				?><div id="historytable"> </div><?php
																			}else{
																				?><div id="historytable_visor"> 
																				<input type="hidden" id="DateToday" value="<?php echo $Datetoday?>"/>
																				<input type="hidden" id="AcName" value="<?php echo $AcName?>"/>
																				</div><?php
																			}
																		?>
																		<?Php include("Report/modal_viewarea.php"); ?>
                                                                    </div>
                                                         
                                                            <!-- end viewing of checklist -->

                                                        </div>
                                                         
                                                    </div>
                                                </div>
									        </section>

									
								
					<!-- end body -->	
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

		<!-- Examples -->
		<!-- <script src="assets/javascripts/tables/examples.datatables.ajax.js"></script> -->
		<script src="assets/javascripts/forms/examples.advanced.form.js" ></script>	    
		<script src="assets/javascripts/tables/examples.datatables.default.js"></script>
		<script src="Report/history.js"></script>
		<script src="header.js"></script>
		<!-- <script src="assets/javascripts/tables/examples.datatables.tabletools.js"></script> -->
		<script src="assets/javascripts/ui-elements/examples.modals.js"></script>
		
	</body>
</html>
