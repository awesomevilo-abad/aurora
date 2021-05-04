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
						
							<center>
								<div id="loader">
								</div>
							</center>
							<div id="container" class="col-md-12">
								<form method="POST" id="formGrade" >
									<section class="panel" style="background-color:#ffffff">
										<header class="panel-heading" style="background-color:#128C7E;">
											<h2 class="panel-title"style="color:#ffffff">Grade</h2>
												<p class="panel-subtitle"style="color:#ffffff">
													Area Grade
												</p>
										</header>
										
										<section class="panel">
											
											<header class="panel-heading">
												<h2 class="panel-title"style="text-align:center;background-color:#02695d;color:#ffff;margin-top:-18.5px;font-size:15px;"><?php echo $_POST['phasename'];?></h2> 
													<div class="panel-actions">
													
													</div>
													<!-- checklist name load -->
														<?php
														if(isset($_POST["EID"])){
															$eid = $_POST["EID"];
														}
														else{
															
															$eid ="0";
														}
															$id = $_POST["ID"];
															$pid = $_POST["pid"];
															$aid = $_POST["globalaid"];
															$cid = $_POST["cid"];
															$bid = $_POST["Bid"];
															$aname = $_POST["areaname"];
															$count = 0;
															$countequip = 0;
														?>
													<h2 class="panel-title" style="text-align:center"><?php echo $_POST["areaname"]; ?></h2>
													<input type="hidden" value="<?php echo $aid?>" name="aid"/> <!--input type area-->
													<input type="hidden" value="<?php echo $pid?>" name="pid" id="pid"/> <!--input type pid-->
													<input type="hidden" value="<?php echo $bid?>" name="bid"/> <!--input type bid-->
											</header>
										

											<!-- Tab start body -->
											<div class="row">
												<div class="col-md-12">
													<div class="tabs">
														<!-- header -->
														
														<input type="hidden" name="pageType" id="pageType" value="<?php echo $_POST['pageType']?>"/> 
														<input type="hidden" name="from" id="from" value="<?php echo $_POST['from']?>"/> 
														<input type="hidden" name="to" id="to" value="<?php echo $_POST['to']?>"/> 

														<span style="background-color:#d2322d;margin:10px; padding:5px; border-radius:10px;color:#fff;font-size:10px;"><?php echo "Week " ?> <span style="font-size:20px;"><strong><?php echo $_POST['week'] ?></strong></span></span>
														<input type="hidden" name="week" id="week" value="<?php echo $_POST['week']?>"/> 
                                                   <span style="background-color:#d2322d; padding:5px; border-top-left-radius:10px; border-bottom-left-radius:10px;color:#fff;font-size:10px;"><strong><?php echo $_POST['month'] ?></strong></span>
                                                   <input type="hidden" name="month" id="month" value="<?php echo $_POST['month']?>"/>
                                                   <span style="background-color:#8d0703; margin-left:-5px;padding:5px; border-top-right-radius:10px;border-bottom-right-radius:10px;color:#fff;font-size:10px;"><strong><?php echo $_POST['year'] ?></strong></span>
                                                   <input type="hidden" name="year" id="year" value="<?php echo $_POST['year']?>"/>
														<ul class="nav nav-tabs nav-justified">
															<li class="active">
																<a href="#sanistru" data-toggle="tab" class="text-center"><i class="fa fa-star"></i> Sanitation and Structural</a>
															</li>
															<li>
																<a href="#equip" data-toggle="tab" class="text-center">Equipment</a>
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
																				<th >Checklist Name</th>
																				<th>Sanintation Grade</th>
																				<th>Structural Grade</th>
																			
																			</tr>
																		</thead>
																		<tbody>
																				<tr>
																					
																					<?php

																				

																					$percent = $_POST['percent'];
																					foreach ($id as & $value) {
																						$cname = $_POST["cname"][$count];
																						$cid = $_POST["cid"][$count];
																						$remarks = $_POST["remarks"][$count];
																						// $im=$imagename[$count];
																					?>

																						<td><?php echo $cname?>
																						<input type="hidden" value="<?php echo $cid?>" name="cid[]"/> <!--input type checkname-->
																						<input type="hidden" value="<?php echo $cname?>" name="checkname[]"/> <!--input type checkname-->
																						</td> <!--CheckName!-->

																						<?php
																						$sani = $_POST["Sani".$value];
																						foreach ($sani as & $result) {
																						?>
																						<td><?php echo $arraySani[] = $result?> %
																						<input type="hidden" value="<?php echo $arraySani[] = $result ?>" name="arraySani[]"/> <!--input type arraySanitation-->
																						</td><!--Sani Grade!-->
																						<?php
																						}
																						$str = $_POST["Str".$value];
																						foreach ($str as & $resultstr) {
																						$resultdesc = $resultstr;
																						if($resultstr == "Good"){
																						 $resultstr = 100;
																						}else if($resultstr == "1st Offense"){
																						 $resultstr = 75;	
																						}else if($resultstr == "No Structural"){
																						$resultstr = 0;	
																						}
																						else{
																						 $resultstr = 50;
																						}

																						?>
																						<td>
																						<?php 
																					
																						echo $arrayStr[]= $resultstr?> %
																					
																						<input type="hidden" value="<?php echo $arrayDesc[]= $resultdesc ?>" name="arraydesc[]"/> <!--input type arrayStructural-->
																						<input type="hidden" value="<?php echo $arrayStr[]= $resultstr ?>" name="arraystr[]"/> <!--input type arrayStructural-->
																						</td><!--Structure Grade!-->
																						<?php
																						}
																						?>
																					
																							
																							<input type="hidden" value="<?php echo $remarks?>" name="remarks[]"/> <!--input type remarks equipment-->
																						

																						
																							<!-- <input type="hidden" value="<?php echo $im?>" name="image[]"/> input type remarks equipment -->
																						
																						<?Php
																						
																					?>
																				</tr>
																						<?php
																						$count++;
																					}
																					?>

																					<tr style="background-color:#d0f0c0">
																						<td><strong>Total</strong></td>
																						<td>
																								<?php
																							
																								$average = array_sum($arraySani)/count($arraySani);
																								echo round($average* floatval($percent), 2);
																								?> %
																								<input type="hidden" value="<?php echo round($average* floatval($percent), 2)?>" name="totalsani"/> <!--input type checkname-->
																						</td>

																						<!-- structural -->
																						<td>
																						<?php
																						
																								$array = $arrayStr;
																								// $allNoStructural = count(array_keys($array, "0"))/2;

																								$average = array_sum($arrayStr)/(count($arrayStr)-count(array_keys($array, "0")));
																								echo round($average* floatval($percent), 2);
																								// echo count($arrayStr)/2;
																								

																								?> %
																								<input type="hidden" value="<?php echo round($average* floatval($percent), 2)?>" name="totalstru"/> <!--input type checkname-->

																							
																						</td>
																					</tr>
																				
																				
																		</tbody>
																	</table>
																</div>
															</div>

															<div id="equip" class="tab-pane">
																	<!-- <p>Data Here</p> -->
																	<div class="panel-body">
																		<table class="table table-bordered table-striped table-condensed mb-none">
																			<thead>
																				<tr>
																					<th>Equipment Name</th>
																					<th>Equipment Grade</th>
																					<th>Remarks</th>
																				
																				</tr>
																			</thead>
																			<tbody>
																				<?php
																				
																				
																				
																				if(isset($_POST["EID"])){
																				?>
																					<tr>
																						<?php
																						$percentageequip = $_POST['percentageequip'];
																						
																						foreach ($eid as & $valueequip) {
																							$ename = $_POST["ename"][$countequip];
																							$eid2 = $_POST["EID"][$countequip];
																							$remarksequip = $_POST["remarksequip"][$countequip];
																							// $imeq=$imagename[$countequip];
																							
																						?>

																							<td><?php echo $ename?>
																							<input type="hidden" value="<?php echo $eid2?>" name="eid2[]"/> <!--input type equipment name-->
																							<input type="hidden" value="<?php echo $ename?>" name="ename[]"/> <!--input type equipment name-->
																							</td> <!--EquipmentName!-->
																							
																							<?php
																							
																							$eone = $_POST["eone".$valueequip];
																							
																							$eonedesc=$eone;
																							if($eone == "Functional"){
																								$eone = 100;
																							}else if($eone == "1st Offense"){
																								$eone = 75;
																							}else if($eone == "Non-Functional"){
																								$eone = 50;
																							}else if($eone == "Not Onsight"){
																								$eone = 50;
																							}else{

																							}

																							$arreone = array($eone);
																							foreach ($arreone as & $resulteone) {
																							?>
																							<td><?php echo $arrayEgrade[] =$resulteone?>
																							<input type="hidden" value="<?php echo $arrayEgrade[] =$resulteone?>" name="egrade[]"/> <!--input type equipment grade-->
																							</td><!--EquipmentGrade!-->
																							<?php
																							}

																							$arreonedesc = array($eonedesc);
																							foreach ($arreonedesc as & $resulteonedesc) {
																							?>
																							<td><?php echo $resulteonedesc?>
																							<input type="hidden" value="<?php echo $resulteonedesc?>" name="edesc[]"/> <!--input type equipment grade-->
																							</td><!--EquipmentDesc!-->
																							<?php
																							}
																						
																							?>
																								<input type="hidden" value="<?php echo $remarksequip?>" name="remarksequip[]"/> <!--input type remarks equipment-->
																								
																								<!-- <input type="hidden" value="<?php echo $imeq?>" name="imageequip[]"/> input type image equipment -->
																							
																					</tr>
																							<?php
																							$countequip++;
																						}
																						?>

																						<tr style="background-color:#d0f0c0">
																							<td><strong>Total</strong></td>
																							<td>
																									<?php
																								
																									$average = array_sum($arrayEgrade)/count($arrayEgrade);
																									echo round($average* floatval($percentageequip), 2);
																									?> %
																									<input type="hidden" value="<?php echo (count($arrayEgrade))/2?>" name="eqty"/> <!--input type checkname-->
																									<input type="hidden" value="<?php echo round($average* floatval($percentageequip), 2)?>" name="totalequip"/> <!--input type checkname-->
																							</td>
																							<td></td>
																						</tr>
																					
																						<tr>
																							<td colspan="3" >
																								<!-- <button type="submit" id="btnSubmit"></button> -->
																								<center><div><input type="submit" id='btnNextArea' class="btn btn-success" value="Next Area"></div></center>
																							</td>
																						</tr>
																				<?php
																				}else{
																				?>
																				<input type="hidden" value="0000" name="eid2[]"/> <!--input type equipment name-->
																				<input type="hidden" value="No Equipment" name="ename[]"/> <!--input type equipment name-->
																				<input type="hidden" value="No Equipment" name="edesc[]"/> <!--input type equipment grade-->
																				<input type="hidden" value="0" name="egrade[]"/> <!--input type equipment grade-->
																				<input type="hidden" value="No Equipment" name="remarksequip[]"/> <!--input type remarks equipment-->
																				<input type="hidden" value="0" name="eqty"/> <!--input type checkname-->
																								<input type="hidden" value="No Equipment" name="imageequip[]"/> <!--input type image equipment-->
																				
																					<tr>
																						<td></td> <!--EquipmentName!-->
																						<td></td><!--EquipmentGrade!-->
																						<td></td><!--Remarks!-->
																					</tr>
																					<tr style="background-color:#d0f0c0">
																						<td>Total</td>
																						<td>0 %
																						<input type="hidden" value="0" name="totalequip"/> <!--input type checkname-->
																						</td>
																						<td>No Equipment</td>
																					</tr>
																				
																					<tr>
																						<td colspan="3" >
																							<!-- <button type="submit" id="btnSubmit"></button> -->
																							<center><div><input type="submit" class="btn btn-success" value="Next Area"></div></center>
																						</td>
																					</tr>
																				
																				<?php
																				}
																				?>
																					
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

