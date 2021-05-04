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
    $Datetoday = $crudcontroller->getDate();
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
		
		<link rel="stylesheet" href="assets/css/lightbox.min.css" />
		<script src="assets/js/lightbox-plus-jquery.min.js"></script>

	</head>
	<body>
		<section class="body">

			<?php include 'header.php' ?>

			<div class="inner-wrapper">
                <div id="sidebar" style="z-index:3px">
                    <?php include 'userSidebar.php'?>
                </div>

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Checklist</h2>
					
						<div class="right-wrapper pull-right">
							
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- Main Body select building phase area checklist-->
						
							<div class="col-md-12">
								<form method="POST" id="formGrade_visor" >
									<section class="panel" style="background-color:#ffffff">
										<header class="panel-heading" style="background-color:#128C7E;">
											<h2 class="panel-title"style="color:#ffffff">Pre-Audit</h2>
												<p class="panel-subtitle"style="color:#ffffff">
													View Pre-Audit Results
												</p>
										</header>
										
										<section class="panel">
											
											<header class="panel-heading">
												<h2 class="panel-title"style="text-align:center;background-color:#02695d;color:#ffff;margin-top:-18.5px;font-size:15px;"><?php echo $_POST['phasename'];?></h2> 
													<div class="panel-actions">
													
													</div>
													<!-- checklist name load -->
														<?php
													
														
															$pid = $_POST["pid"];
															$aid = $_POST["aid"];
															$bid = $_POST["Bid"];
															$aname = $_POST["areaname"];
															$count = 0;
														?>
													<!-- <h2 class="panel-title" style="text-align:center"><?php echo $_POST["areaname"]; ?></h2> -->
													<input type="hidden" value="<?php echo $pid?>" name="pid" id="pid"/> <!--input type pid-->
													<input type="hidden" value="<?php echo $bid?>" name="bid"/> <!--input type bid-->
											</header>
										

											<!-- Tab start body -->
											<div class="row">
												<div class="col-md-12">
													<div class="tabs">
														<!-- header -->
														<ul class="nav nav-tabs nav-justified">
															<li class="active">
                                                                <a href="#sanistru" data-toggle="tab" class="text-center"><i class="fa fa-star"></i> Pre - Audit Result</a>
															</li>
														</ul>

														<!-- tab body -->
														<div class="tab-content">
															<div id="sanistru" class="tab-pane active">
																<!-- <p>Data Here</p> -->
																<div class="panel-body">
																	<table class="table table-bordered table-striped table-condensed mb-none">
																		<thead>
																			<tr>
																				<th >Area Name</th>
																				<th>Remarks</th>
																				<th>Images</th>
																			
																			</tr>
																		</thead>
																		<tbody>
																				<tr>
																					
																					<?php

																	
																					foreach ($aid as & $value) {
																						$aname = $_POST["areaname"][$count];
																						$aidwithcount = $_POST["aid"][$count];
																						$remarks = $_POST["remarks"][$count];
																						// $im=$imagename[$count];
																					?>

																						<td><?php echo $aname?>
																						<input type="hidden" value="<?php echo $aidwithcount?>" name="aid[]"/> <!--input type checkname-->
                                                                                        </td> <!--areaname!-->
                                                                                    	<input type="hidden" value="<?php echo $aname?>" name="areaname[]"/> <!--input type checkname-->
																						<td><?php echo $remarks?>
                                                                                        <input type="hidden" value="<?php echo $remarks?>" name="remarks[]"/> <!--input type remarks equipment-->
                                                                                        </td>

                                                                                        <td class="gallery">
                                                                                         <!-- Show images  -->
                                                                                         <?php
                                                                                                $showarea = $conn->prepare("SELECT * FROM image_visor where Aid = :aid ORDER BY Aid ASC");
                                                                                                $showarea->execute(array(":aid"=>$aidwithcount));
                                                                                                if($showarea->rowCount() > 0){
                                                                                                while($rowshowarea = $showarea->fetch(PDO::FETCH_ASSOC)){
                                                                                                    $rowareaimage=$rowshowarea['imagename'];
                                                                                            ?>
                                                                                            
                                                                                            <?php
                                                                                             if(! empty($rowshowarea['imagename'])){
                                                                                                ?>
                                                                                                
                                                                                                    <a href="uploaded/<?php echo $rowshowarea['imagename'] ?>" data-lightbox="mygallery"
                                                                                                    data-title="
                                                                                                    <br><strong><label style='color:#f26f5a'>Location:  </label></strong><label style='color:#f3f3f3'><?php echo $aname ?></label>
                                                                                                    <br><strong><label style='color:##f26f5a'>Remarks:  </label></strong><label style='color:#f3f3f3'><?php echo $remarks ?></label>
                                                                                                    ">
                                                                                                    <img style="height:40px;width:55px;padding:0px;" src="uploaded/<?php echo $rowshowarea['imagename'] ?>"> </a>
                                                                                                
                                                                                                <?php
                                                                                                
                                                                                             }
                                                                                             ?>
                                                                                            <?php
                                                                                                        
                                                                                                }
                                                                                             }
                                                                                            ?>
																							</td>
																					
																				</tr>
																						<?php
																						$count++;
																					}
																					?>
                                                                                <tr>
                                                                                    <td colspan="3" >
                                                                                        <!-- <button type="submit" id="btnSubmit"></button> -->
                                                                                        <center><div><input type="submit" class="btn btn-success" value="Complete"></div></center>
                                                                                    </td>
                                                                                </tr>

																				
																		</tbody>
																	</table>
																</div>
															</div>

															
														</div>
											
													</div>													
												</div>
											</div>			

									</section>
									<?php include 'startChecklist/completeModal.php'?> <!--Modal-->
								</form>

							</div>
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
		<script src="startChecklist/startChecklist.js"></script>

		<!-- Examples -->
		<script src="assets/javascripts/tables/examples.datatables.ajax.js"></script>
		<script src="assets/javascripts/forms/examples.advanced.form.js" ></script>	
		
		<script src="assets/javascripts/ui-elements/examples.modals.js"></script>
		
	</body>
</html>

