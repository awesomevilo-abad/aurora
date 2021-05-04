<?php  
 session_start(); 
 
 if(isset($_SESSION['username'])){
	echo "Please Wait";
  }else{
	header("location:index.php");  
  }
	 
 include_once 'startChecklist/class.php';
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
						<h2>Phase Result</h2>
					
						<div class="right-wrapper pull-right">
							
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- Main Body select building phase area checklist-->
						<div class="col-md-12">
								
									<section class="panel" style="background-color:#ffffff">
										<header class="panel-heading" style="background-color:#EC644B;" >
											<h2 class="panel-title" style="color:#ffffff">Decline</h2>
												<p class="panel-subtitle" style="color:#ffffff">
												  You declined this phase
												</p>
										</header>
										
										<div style="margin:10px;">
											<?php 
												include_once 'startchecklist/Class.php';
												$crudcontroller = new CrudController();
												$dao = new Dao();
												$conn = $dao->openConnection();

												$id = $_GET['Pid'];
												$phase = $conn->prepare("SELECT * FROM phase WHERE Pid=:pid");
												$phase->execute(array(":pid"=>$id));
												$rowPhase = $phase->fetch(PDO::FETCH_ASSOC);
												$bid =  $rowPhase['Bid'];

												$areaglobal = $conn->prepare("SELECT * FROM area WHERE Pid=:pid");
												$areaglobal->execute(array(":pid"=>$id));
												$rowAreaglobal = $areaglobal->fetch(PDO::FETCH_ASSOC);
												$phaseaid = $rowAreaglobal['Aid'];
												
												$getBuilding = $conn->prepare("SELECT * FROM Building WHERE id=:Bid");
												$getBuilding->execute(array(":Bid"=> $rowPhase['Bid']));
												$rowgetBuilding = $getBuilding->fetch(PDO::FETCH_ASSOC);
												$category =  $rowgetBuilding['Category'];

												$getStaff = $conn->prepare("SELECT * FROM accounts WHERE Username=:pid");
												$getStaff->execute(array(":pid"=> $_SESSION['username']));
												$rowgetStaff = $getStaff->fetch(PDO::FETCH_ASSOC);
												$staffname =  $rowgetStaff['AcName'];
												$staffpos =  $rowgetStaff['Position'];
												$week = $_GET['week'];
												
										?>
										<input type="hidden" name="phaseaid" value="<?php echo $phaseaid ?>" />

								<div class="row">
																<a href="#" onclick="BacktoPhase(<?php echo $id ?>)" ><h5 style="text-decoration:none;text-align:center;color:#fff;background-color:#dfdfdf" class="mg-title text-bold">Back</h5></a>
																
																	<div class="col-md-12">
																		<center><h2><?php echo $rowPhase['PName'];?></h2></center>
																		<div style="margin:10px;">
																		<span style="background-color:#d2322d;margin:0px; padding:5px; border-radius:10px;color:#fff;font-size:10px;"><?php echo "Week " ?> <span style="font-size:20px;"><strong><?php echo $week ?></strong></span></span>
																		<span style="background-color:#d2322d; padding:5px; border-top-left-radius:10px; border-bottom-left-radius:10px;color:#fff;font-size:10px;"><strong><?php echo $_GET['month'] ?></strong></span>
																		
																		<span style="background-color:#8d0703; margin-left:-5px;padding:5px; border-top-right-radius:10px;border-bottom-right-radius:10px;color:#fff;font-size:10px;"><strong><?php echo $_GET['year'] ?></strong></span>
																		
                                                   						
																		<label  class="pull-right" ><?php echo $staffpos ?></label><label class="pull-right" style="color:#ec644bab"><strong> Position: </strong></label> 
																		<label class="pull-right"><?php echo $staffname ?></label><label class="pull-right" style="color:#ec644bab"><strong>   Name: </strong></label>  
																		<input type="hidden"name="staffname" id="staffname" value="<?php echo $staffname ?>"/>
																		
																	</div>
																	
															<div class="tabs">
																<ul class="nav nav-tabs nav-justified">
																								<li class="active">
																		<a href="#popular10" data-toggle="tab" class="text-center">Sanitation</a>
																										</li>
																										<li>
																		<a href="#popular11" data-toggle="tab" class="text-center">Structural</a>
																	</li>
																	<li>
																		<a href="#recent10" data-toggle="tab" class="text-center">Equipment</a>
																	</li>
																								</ul>

																						<form method="POST" id="formResults">
																<div class="tab-content">
																	<div id="popular10" class="tab-pane active">
																			<div style="margin:10px;" id="result">
																											<input type="hidden" name="year" id="year" value="<?php echo $_GET['year']?>"/>
																											<input type="hidden" name="month" id="month" value="<?php echo $_GET['month']?>"/>
																											<input type="hidden" name="week" id="week" value="<?php echo $week?>"/>
																												<!-- Sanitation -->
																												<input type="hidden" name="bid" id="bid" value="<?php echo $bid  ?>" /><!--important-->
																												<input type="hidden" name="pid" id="pid" value="<?php echo $id  ?>" /><!--important-->
																											
																												
																																				<table class="table table-bordered table-striped table-condensed mb-none">
																																						<thead>
																																								<tr>
																																										<th>Area Name</th>
																																										<th>Sanitation Grade</th>
																																								</tr>
																																						</thead>
																																						<tbody>
																																						<?php
																																								$area = $conn->prepare("SELECT * FROM area WHERE Pid=:pid");
																																								$area->execute(array(":pid"=>$id));
																																								while( $rowArea = $area->fetch(PDO::FETCH_ASSOC)){
																																										?>
																																										<tr>
																																											<td><?php echo $rowArea['AName'];  ?>
																																											<input type="hidden" name="aid[]" id="aid" value="<?php echo $rowArea['Aid']  ?>" /> <!--important-->
																																											<input type="hidden" name="cid[]" id="cid" value="0000" /> <!--important-->
																																											<input type="hidden" name="cname[]" id="cname" value="declined" /> <!--important-->
																																											</td>
																																											<td><?php echo $arraySum[] = floatval(50)* floatval($rowArea['Percentage']);?>
																																											<input type="hidden" value="<?php echo floatval(50)* floatval($rowArea['Percentage'])   ?>" name="arraySani[]"/> <!--input type arraySanitation-->
																																											%</td>
																																											
																																										</tr>
																																										<?php   

																																								}
																																								
																																						?>
																																						<tr style="background-color:#ccffcc">
																																								<td><strong>Total</strong></td>
																																								<td><?php
																																								if(empty($arraySum)){
																																										echo "No Record";
																																								}else{
																																								$sum = array_sum($arraySum);
																																								echo $totalsani = round($sum, 2);
																																								}?>
																																								<input type="hidden" name="totalsani" id="totalsani" value="<?php echo $totalsani  ?>" /> <!--important-->
																																								%</td>
																																						</tr>
																																						</tbody>
																																				</table>
																		</div>
																										</div>
																										
																										<!-- Structural -->
																										<div id="popular11" class="tab-pane">
																			<div style="margin:10px;" id="result2">
																												<table class="table table-bordered table-striped table-condensed mb-none">
																																<thead>
																																		<tr>
																																				<th>Area Name</th>
																																				<th>Structural Grade</th>
																																		</tr>
																																</thead>
																																<tbody>
																																<?php
																																		$area = $conn->prepare("SELECT * FROM area WHERE Pid=:pid");
																																		$area->execute(array(":pid"=>$id));
																																		while( $rowArea = $area->fetch(PDO::FETCH_ASSOC)){
																																				?>
																																				<tr>
																																						<td><?php echo $rowArea['AName'];  ?></td>
																																						<td><?php echo $arraySumSt[] = floatval(50)* floatval($rowArea['Percentage']);?>
																																						<input type="hidden" value="<?php echo floatval(50)* floatval($rowArea['Percentage'])   ?>" name="arrayStr[]"/> <!--input type arraySanitation-->
																																						%</td>
																																				</tr>
																																				<?php   

																																		}
																																		
																																?>
																																<tr style="background-color:#ccffcc">
																																		<td><strong>Total</strong></td>
																																		<td><?php
																																		if(empty($arraySumSt)){
																																				echo "No Record";
																																		}else{
																																		$sumSt = array_sum($arraySumSt);
																																		echo $totalstru = round($sumSt, 2);
																																		}
																																		?>
																																		<input type="hidden" name="totalstr" id="totalstr" value="<?php echo $totalstr  ?>" /> <!--important-->
																																		%</td>
																																</tr>
																																</tbody>
																														</table>                              

																		</div>
																										</div>

																										<!-- equipment -->
																	<div id="recent10" class="tab-pane">
																			<div style="margin:10px;" id="result2">
																												<table class="table table-bordered table-striped table-condensed mb-none">
																																<thead>
																																		<tr>
																																				<th>Area Name</th>
																																				<th>Equipment Grade</th>
																																		</tr>
																																</thead>
																																<tbody>
																																<?php
																																
																																		$area = $conn->prepare("SELECT * FROM Area WHERE Pid=:pid");
																																		$area->execute(array(":pid"=>$id));
																																	if($area->rowCount() > 0){
																																		$rowArea = $area->fetch(PDO::FETCH_ASSOC);
																																				// $equipment = $conn->prepare("SELECT equipment.EName,area.AName,area.percentageequip,area.Aid FROM Equipment right join Area on equipment.Aid = Area.Aid WHERE area.Pid=:pid Group by area.Aid");
																																				$equipment = $conn->prepare("SELECT * FROM Area WHERE Pid = :pid AND percentageequip != 0 Group by Aid");
																																				$equipment->execute(array(":pid"=>$rowArea['Pid']));
																																				while($rowequipment = $equipment->fetch(PDO::FETCH_ASSOC)){
																																					// echo $rowequipment['Aid'];
																																		?>
																																		<tr>
																																				<td><?php echo $rowequipment['AName']?>
																																				<input type="hidden" name="eaid[]" id="eaid" value="<?php echo $rowequipment['Aid']  ?>" /> <!--important-->                                                        </td>
																																				<td><?php echo round($arraySumEq[] = floatval(50)* floatval($rowequipment['percentageequip']),2)?>
																																				<input type="hidden" name="egrade[]" id="egrade" value="<?php echo floatval(50)* floatval($rowequipment['percentageequip'])  ?>" /> <!--important-->                                      
																																				<input type="hidden" name="egrade2e[]" id="egrade2e" value="<?php echo floatval(50)* floatval($rowequipment['percentageequip'])  ?>" /> <!--important-->                                      
																																				<input type="hidden" name="ename[]" id="ename" value="declined" /> <!--important-->                                                        
																																				<input type="hidden" name="eid2[]" id="edi2" value="0000" /> <!--important-->                                                        
																																				%</td>
																																				
																																		</tr>
																																				
																																		<?php   
																																		}
																																				// $equipment = $conn->prepare("SELECT equipment.EName,area.AName,area.percentageequip,area.Aid FROM Equipment right join Area on equipment.Aid = Area.Aid WHERE area.Pid=:pid Group by area.Aid");
																																				$equipment2 = $conn->prepare("SELECT * FROM Area WHERE Pid = :pid AND percentageequip = 0 Group by Aid");
																																				$equipment2->execute(array(":pid"=>$rowArea['Pid']));
																																				while($rowequipment2 = $equipment2->fetch(PDO::FETCH_ASSOC)){
																																					// echo $rowequipment2['Aid'];
																																		?>
																																		<tr>
																																				<td><?php echo $rowequipment2['AName']?>
																																				<td><?php echo round($arraySumEq[] = floatval(0)* floatval($rowequipment2['percentageequip']),2)?>
																																				<input type="hidden" name="egrade[]" id="egrade" value="<?php echo floatval(0)* floatval($rowequipment2['percentageequip'])  ?>" /> <!--important-->                                                        
																																				<input type="hidden" name="ename[]" id="ename" value="declined" /> <!--important-->                                                        
																																				<input type="hidden" name="eid2[]" id="edi2" value="0000" /> <!--important-->                                                        
																																				%</td>
																																				
																																		</tr>
																																				
																																		<?php   
																																		}
																																	}else{
																																			echo "No Area in selected Phase";
																																	}
																																		
																																?>
																																<tr style="background-color:#ccffcc">
																																		<td><strong>Total</strong></td>
																																		<td><?php
																																		if(isset($arraySumEq)){
																																				$average = array_sum($arraySumEq);
																																				echo $totalequip= round($average, 2);
																																		}else{
																																				echo "No Equipment in this Phase";
																																		}
																																			
																																		?>
																																		<input type="hidden" name="totalegrade" id="totalegrade" value="<?php echo round($average, 2)  ?>" /> <!--important-->                                                        
																																		%</td>
																																</tr>
																																</tbody>
																														</table>  
																														<?php
																														
																														$datechecked= date("Y-m-d H:i:s");
																														date_default_timezone_set("America/New_York");
																														$modifieddatechecked= date("Y-m-d H:i:s");
																														
																																		// echo date("F",strtotime($Datetoday));
																														?>
																		</div>
																		<input type="hidden" name="Datetoday" id="Datetoday" value="<?php echo $Datetoday ?>"/>
																		<input type="hidden" name="staffname" id="staffname" value="<?php echo $staffname ?>"/>
																		<input type="hidden" name="totalsani" id="totalsani" value="<?php echo $totalsani ?>"/>
																		<input type="hidden" name="totalstru" id="totalstru" value="<?php echo $totalstru ?>"/>
																		<input type="hidden" name="totalequip" id="totalequip" value="<?php echo $totalequip ?>"/>

																		<center><div><input onclick="completeDeclineModal('<?php echo $id; ?>','<?php echo $bid ?>','<?php echo $category ?>','<?php echo $Datetoday ?>','<?php echo $Datetoday ?>','<?php echo $staffname ?>','<?php echo $totalsani ?>','<?php echo $totalstru ?>','<?php echo $totalequip ?>')" type="button" class="btn btn-success" value="Complete"></div></center>
																		<center><div><input id="buttonCompleteDeclineModalConfirmation" onclick="completeDeclineModalConfirmation('<?php echo $id; ?>','<?php echo $bid ?>','<?php echo $category ?>','<?php echo $Datetoday ?>','<?php echo $Datetoday ?>','<?php echo $staffname ?>','<?php echo $totalsani ?>','<?php echo $totalstru ?>','<?php echo $totalequip ?>')" type="button" class="btn btn-success" value="Complete Decline"></div></center>
																		<button type="submit" id="btnAdd" class="btn btn-primary">Submit</button>
																		<button type="submit" id="autoBack" onclick="BacktoPhase(<?php echo $id ?>)" class="btn btn-primary">back</button>
																</div>
						</div>
																								</form>
															</div>

															<div  style="color:#666;height:20px;">
														
												
														<!-- <label><small>Date Submitted: <?php echo date("F j, Y, g:i a",strtotime($modifieddatechecked));?></small></label></br> -->
														<!-- <strong><label style="color:#d2322d;weight:10px;margin:15px;"><small><strong>Date Reset: <?php echo date("F j, Y, g:i a",strtotime($modifieddatechecked));?></small></strong></label></strong> -->
														<input type="hidden" id="bidd" value="<?php echo $bidd?>"/>
														<input type="hidden" id="datechecked" value="<?php echo $datechecked?>"/>
														<input type="hidden" id="modifieddatechecked" value="<?php echo $modifieddatechecked?>"/>
														
														</div>
														</div>

														
													</div>
										</div>
									</section>

									<?php include 'startChecklist/confirmationModal.php'?> <!--Modal-->
									<?php include 'startChecklist/completeDeclineModal.php'?> <!--Modal-->
									<?php include 'startChecklist/completeDeclineModalConfirmation.php'?> <!--Modal-->
								
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

