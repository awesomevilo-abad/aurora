<?php  
 session_start(); 

 if(isset($_SESSION['username'])){
	echo "Please Wait";
	}else{
		header("location:index.php");  
	}

 include_once 'startChecklist/Class.php';
 $crudcontroller = new CrudController();
 $dao = new Dao();
 $conn = $dao->openConnection();
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
                    <?php include 'sidebar.php'?>
                </div>

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Area</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Data Management</span></li>
								<li><span>Area</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- body form -->

					<center>
						<div id="loader">
						</div>
					</center>
						<div id="showdata" class="col-sm-5">
								<form id="formData"  class="form-horizontal" novalidate="novalidate" enctype="multipart/form-data">
									<section class="panel">
										<header class="panel-heading">

											<h2 class="panel-title">Area Management</h2>
											<p class="panel-subtitle">
												Enroll Area Details Here
											</p>
										</header>

										<div class="panel-body">
											<div class="form-group">
												<label class="col-sm-1 control-label"> Name <span class="required">*</span></label>
												<div class="col-sm-12">
													<input type="hidden" name="id" id="id" class="form-control"  required/>
													<input type="text" name="Name" id="Name" class="form-control"  required/>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-1 control-label"> Phase <span class="required">*</span></label>
													<div class="col-sm-12">

															<?php
															$pdo = new PDO('mysql:host=localhost;dbname=aurora', 'root', '');
															$sql = "SELECT * FROM Phase inner join Building on Phase.Bid=Building.id ";
															$stmt = $pdo->prepare($sql);
															$stmt->execute();
															$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
															if ($stmt->rowCount() > 0) { ?>
													
															<select data-plugin-selectTwo name="phase" id="phase" class="form-control populate" required>
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
												<label class="col-sm-1 control-label">Sanitation <span class="required">*</span></label>
												<div class="col-sm-12">
													<input type="float" autocomplete="off" step=".01" name="percentage" id="percentage" class="form-control" placeholder="Sanitation and Structural Weight" required/>
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-1 control-label">Equipment <span class="required">*</span></label>
												<div class="col-sm-12">
													<input type="float" autocomplete="off" step=".01" name="percentageequip" id="percentageequip" class="form-control" placeholder="Sanitation and Structural Weight" required/>
												</div>
											</div>
											
											<div class="form-group">
												<label class="col-sm-1 control-label">Image <span class="required">*</span></label>
												<div class="col-sm-12">
													<input type="file" id="image" name="image" required/>
												</div>
											</div>		
									
										</div>

										<!-- end panel body -->
										<footer class="panel-footer">
											<div class="row">
												<div class="col-sm-9 col-sm-offset-3">
													<button type="submit" id="btnAdd" class="btn btn-primary">Submit</button>
													<button type="button" id="btnUpdate"class="btn btn-primary">Update</button>
													<button type="button" id="btnCancel" class="btn btn-warning">Cancel</button>
													<button type="reset" id="reset" class="btn btn-default">Reset</button>
												</div>
											</div>
										</footer>
									</section>
								</form>
								
								<div id="importarea">
									<!-- Import Area -->
									<section class="panel">
										<header class="panel-heading">
											<!-- <h2 class="panel-title">Import Building</h2> -->
											<p class="panel-subtitle">
												Import Area
											</p>
										</header>

										<div class="panel-body" >
											<form method="post" action="Area/import.php" enctype="multipart/form-data">
												<fieldset>
													<div class="form-group">
														<p>Upload CSV File Only</p>
														<input type="file" name="file"/>
														<input class="btn btn-success" type="submit" name="submit_file" value="Upload"/>	
													</div>
												
												
												</fieldset>
											</form>						
										</div>
									</section>
								</div>
							</div>
							
						
					<!-- end body form -->

					<section class="panel col-xs-7">
							<div id="container">
							</div>
					</section>
					
					<!-- MODAL INCLUDE -->
					<?php include("area/modal_assign.php");?>
					<?php include("area/modal_change.php");?>
					
			
				
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
		<script src="Area/Area.js"></script>
		<script src="header.js"></script>
	</body>
</html>