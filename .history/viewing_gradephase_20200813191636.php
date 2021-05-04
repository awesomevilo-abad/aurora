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

  $Datetodayminusfive = date('Y-m-d', strtotime($Datetoday. ' - 4 days'));
 $pid=$_GET['id'];
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
							<div class="col-md-12">
								<form method="POST" id="formGrade" >
									<section class="panel" style="background-color:#ffffff">
										<header class="panel-heading" style="background-color:#0088cc;">
											<h2 class="panel-title"style="color:#ffffff">Grade</h2>
												<p class="panel-subtitle"style="color:#ffffff">
													Phase Grade
												</p>
										</header>
										
									<section class="panel"></section>
										<header class="panel-heading">

											<?php
											$gradesall = $conn->prepare("SELECT * FROM phase WHERE Pid=:Pid");
											$gradesall->execute(array(":Pid"=> $pid));
											$rowgradesall = $gradesall->fetch(PDO::FETCH_ASSOC);
											$bidd=$rowgradesall['Bid'];

											$getBuilding = $conn->prepare("SELECT * FROM Building WHERE id=:Bid");
											$getBuilding->execute(array(":Bid"=> $rowgradesall['Bid']));
											$rowgetBuilding = $getBuilding->fetch(PDO::FETCH_ASSOC);
											$category =  $rowgetBuilding['Category'];

											$getStaff = $conn->prepare("SELECT * FROM accounts WHERE Username=:pid");
											$getStaff->execute(array(":pid"=> $_SESSION['username']));
											$rowgetStaff = $getStaff->fetch(PDO::FETCH_ASSOC);
											$staffname =  $rowgetStaff['AcName'];
											$staffpos =  $rowgetStaff['Position'];


												?>
											<h2 class="panel-title"style="text-align:center;background-color:#0e608a;color:#ffff;margin-top:-39.5px;font-size:15px;"><?php echo $rowgradesall['PName'] ?></h2> 
											<!-- <input type="hidden" name="phaseid" id="phaseid" value=""/> -->
												<div class="panel-actions">
												<label style="color:#0e608a8a"><strong>Position: </strong></label> <?php echo $staffpos ?>
												<label style="color:#0e608a8a"><strong>   Name: </strong></label> <?php echo $staffname ?>
												<input type="hidden"name="staffname" id="staffname" value="<?php echo $staffname ?>"/>
												</div>
										</header>
										<div class="row">
												<div class="col-md-12">
													<div class="tabs">
														<!-- header -->
														<span style="background-color:#d2322d;margin:10px; padding:5px; border-radius:10px;color:#fff;font-size:10px;"><?php echo "Week " ?> <span style="font-size:20px;"><strong><?php echo $_GET['week'] ?></strong></span></span>
														<input type="hidden" name="week" id="week" value="<?php echo $_GET['week']?>"/>
														<span style="background-color:#d2322d; padding:5px; border-top-left-radius:10px; border-bottom-left-radius:10px;color:#fff;font-size:10px;"><strong><?php echo $_GET['month'] ?></strong></span>
														<input type="hidden" name="month" id="month" value="<?php echo $_GET['month']?>"/>
														<span style="background-color:#8d0703; margin-left:-5px;padding:5px; border-top-right-radius:10px;border-bottom-right-radius:10px;color:#fff;font-size:10px;"><strong><?php echo $_GET['year'] ?></strong></span>
														<input type="hidden" name="year" id="year" value="<?php echo $_GET['year']?>"/>
														<ul class="nav nav-tabs nav-justified">
														<li class="active">
																<a href="#sani" data-toggle="tab" class="text-center">Sanitation</a>
															</li>
															<li >
																<a href="#stru" data-toggle="tab" class="text-center">Structural</a>
															</li>
															<li>
																<a href="#equip" data-toggle="tab" class="text-center">Equipment</a>
															</li>
														</ul>

														<!-- tab body -->
														<div class="tab-content">
															<div id="sani" class="tab-pane active">
																<!-- <p>Data Here</p> -->
																<div class="panel-body">
																	<table class="table table-bordered table-striped table-condensed mb-none">
																		<thead>
																			<tr>
																				<center>
																				<th >Area Name</th>
																				<th>Sanitation Grade</th>
																				</center>
																			</tr>
																		</thead>
																		<tbody>
																			<?php
																				$gradessanitation = $conn->prepare("SELECT * FROM checklist_grade inner join area on checklist_grade.Aid = area.Aid WHERE checklist_grade.Pid=:Pid and (checklist_grade.Date_Checked >= '$Datetodayminusfive' AND checklist_grade.Date_Checked <= '$Datetoday') GROUP BY checklist_grade.Aid ORDER BY checklist_grade.Aid ASC ");
																				$gradessanitation->execute(array(":Pid"=> $pid));
																				while($rowgradessanitation = $gradessanitation->fetch(PDO::FETCH_ASSOC)){
																					?>
																					<tr>
																						<td> <?php echo $rowgradessanitation['AName'];  ?> </td>
																						<td> <?php echo $arraysani[] = $rowgradessanitation['totalsanigrade'];  ?> %</td>
																					</tr>
																					<?php
																				}
																				?>
																					<tr style="background-color:#0088cc5c">
																						<td> <strong>Total</strong> </td>
																						<td> <?php $average = array_sum($arraysani);
																								echo $totalsani = round($average, 2);  ?> %</td>
																					</tr>
																				
																				<?php
																					$getTargetGrade = $conn->prepare("SELECT * FROM phase where Pid = '".$pid."' ");
																					$getTargetGrade->execute(array(":Pid"=> $pid,":datechecked"=> $Datetoday));
																					$rowgetTargetGrade = $getTargetGrade->fetch(PDO::FETCH_ASSOC);
																					$totalsani;
																					$target = $rowgetTargetGrade['targetGrade_Phase'];

																					if($totalsani > $target){
																						?><div style="Background-color:#2b942b;color:#fdfdfd;height:55px;border-radius:10px;margin:10px; text-align:center;"><img style="height:35px" src="icons/excellent.gif" ><br>Exceeds Expectations
																						<input type="hidden" name="targetgradestatus_sani"id="targetgradestatus_sani" value="Exceeds Expectations"/>
																						</div><?php
																					}else if($totalsani == $target){
																						?><div style="Background-color:#ed9c28;color:#fdfdfd;height:55px;border-radius:10px;margin:10px; text-align:center;"><img style="height:35px" src="icons/fair1.gif" ><br>Meets Expectations
																						<input type="hidden"name="targetgradestatus_sani"id="targetgradestatus_sani" value="Meets Expectations"/>
																						</div>
																						
																						<?php
																					}else if($totalsani < $target){
																						?><div style="Background-color:#a43939;color:#fdfdfd;height:55px;border-radius:10px;margin:10px; text-align:center;"><img style="height:35px" src="icons/poor.gif" ><br>Needs Improvement
																						<input type="hidden"name="targetgradestatus_sani"id="targetgradestatus_sani" value="Needs Improvement"/>
																						</div>
																						
																						<?php
																					}

																				?>
																					<label style="color:#2b942b"><strong> Exceeds Expectations </strong> </label><small> Above <?php echo $target?>  </small>
																					<label style="color:#ed9c28"><strong> Meets Expectations </strong> </label><small> Equal to <?php echo $target?>  </small>
																					<label style="color:#a43939"><strong> Needs Improvement </strong> </label><small> Below <?php echo $target?>  </small>
																		</tbody>
																	</table>
																</div>
															</div>

															<div id="stru" class="tab-pane">
																<!-- <p>Data Here</p> -->
																<div class="panel-body">
																	<table class="table table-bordered table-striped table-condensed mb-none">
																		<thead>
																			<tr>
																				<center>	
																				<th >Area Name</th>
																				<th>Structural Grade</th>
																				</center>
																			</tr>
																		</thead>
																		<tbody>
																		<?php
																				$gradesstructural = $conn->prepare("SELECT * FROM checklist_grade inner join area on checklist_grade.Aid = area.Aid WHERE checklist_grade.Pid=:Pid and (checklist_grade.Date_Checked >= '$Datetodayminusfive' AND checklist_grade.Date_Checked <= '$Datetoday')  GROUP BY checklist_grade.Aid ORDER BY checklist_grade.Aid ASC ");
																				$gradesstructural->execute(array(":Pid"=> $pid));
																				while($rowgradesstructural = $gradesstructural->fetch(PDO::FETCH_ASSOC)){
																					?>
																					<tr>
																						<td> <?php echo $rowgradesstructural['AName'];  ?> </td>
																						<td> <?php echo $arraystru[] = $rowgradesstructural['totalstrugrade'];  ?> %</td>
																					</tr>
																					<?php
																				}
																				?>
																					<tr style="background-color:#0088cc5c">
																						<td> <strong>Total</strong> </td>
																						<td> <?php $averagest = array_sum($arraystru);
																								echo $totalstru = round($averagest, 2);  ?> %</td>
																					</tr>
																					<?php
																					$getTargetGradestr = $conn->prepare("SELECT * FROM phase where Pid = '".$pid."' ");
																					$getTargetGradestr->execute(array(":Pid"=> $pid,":datechecked"=> $Datetoday));
																					$rowgetTargetGradestr = $getTargetGradestr->fetch(PDO::FETCH_ASSOC);
																					$totalstru;
																					$targetstr = $rowgetTargetGradestr['targetGrade_Phase'];

																					if($totalstru > $targetstr){
																						?><div style="Background-color:#2b942b;color:#fdfdfd;height:55px;border-radius:10px;margin:10px; text-align:center;"><img style="height:35px" src="icons/excellent.gif" ><br>Exceeds Expectations
																						<input type="hidden" name="targetgradestatus_str"id="targetgradestatus_str" value="Exceeds Expectations"/>
																						</div><?php
																					}else if($totalstru == $targetstr){
																						?><div style="Background-color:#ed9c28;color:#fdfdfd;height:55px;border-radius:10px;margin:10px; text-align:center;"><img style="height:35px" src="icons/fair1.gif" ><br>Meets Expectations
																						<input type="hidden"name="targetgradestatus_str"id="targetgradestatus_str" value="Meets Expectations"/>
																						</div>
																						
																						<?php
																					}else if($totalstru < $targetstr){
																						?><div style="Background-color:#a43939;color:#fdfdfd;height:55px;border-radius:10px;margin:10px; text-align:center;"><img style="height:35px" src="icons/poor.gif" ><br>Needs Improvement
																						<input type="hidden"name="targetgradestatus_str"id="targetgradestatus_str" value="Needs Improvement	"/>
																						</div>
																						
																						<?php
																					}

																				?>
																				<label style="color:#2b942b"><strong> Exceeds Expectations </strong> </label><small> Above <?php echo $target?>  </small>
																				<label style="color:#ed9c28"><strong> Meets Expectations </strong> </label><small> Equal to <?php echo $target?>  </small>
																				<label style="color:#a43939"><strong> Needs Improvement </strong> </label><small> Below <?php echo $target?>  </small>
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
																					<center>
																					<th >Area Name</th>
																					<th>Equipment Grade</th>
																					</center>
																				</tr>
																				</thead>
																			<tbody>
																			<?php
																				$gradesequip = $conn->prepare("SELECT * FROM equipment_grade inner join area on equipment_grade.aid = area.Aid WHERE area.Pid=:Pid  and equipment_grade.Date_Checked_equipment =:datechecked  GROUP BY equipment_grade.Aid ORDER BY equipment_grade.Aid ASC ");
																				$gradesequip->execute(array(":Pid"=> $pid,":datechecked"=> $Datetoday));
																				while($rowgradesequip = $gradesequip->fetch(PDO::FETCH_ASSOC)){
																					?>
																					<tr>
																					<td> <?php echo $rowgradesequip['AName'];  ?> </td>
																					<!-- <td> <?php echo $rowgradesequip['Name'];  ?> </td> -->
																						<td> <?php echo $arrayequip[] = $rowgradesequip['totalequipgrade'];  ?> %</td>
																					</tr>
																					<?php
																				}
																				?>
																					<tr style="background-color:#0088cc5c">
																						<td> <strong>Total</strong> </td>
																						<?php
																						if(isset($arrayequip)){
																							$arrayequip=$arrayequip;
																							?>
																							<td> <?php $averageeq = array_sum($arrayequip);
																								echo $totalequip = $totalequip =round($averageeq, 2);  ?> %</td>
																							<?php
																						}else{
																							$arrayequip=0;
																							?>
																							<td> <?php $averageeq =0;
																								echo $totalequip = round($averageeq, 2);  ?> %</td>
																							<?php
																						}
																						?>
																						
																					</tr>

																					<?php
																					$getTargetGradeequip = $conn->prepare("SELECT * FROM phase where Pid = '".$pid."' ");
																					$getTargetGradeequip->execute(array(":Pid"=> $pid,":datechecked"=> $Datetoday));
																					$rowgetgetTargetGradeequip = $getTargetGradeequip->fetch(PDO::FETCH_ASSOC);
																					$totalequip;
																					$targetequip = $rowgetgetTargetGradeequip['targetGrade_Phase'];
																					
																					if($totalequip == 0){
																						echo "No Equipment in this Area";
																						?><br><input type="hidden" name="targetgradestatus_equip"id="targetgradestatus_equip" value="No Equipment in this Area"/><?php
																					}

																					else if($totalequip > $targetequip){
																						?><div style="Background-color:#2b942b;color:#fdfdfd;height:55px;border-radius:10px;margin:10px; text-align:center;"><img style="height:35px" src="icons/excellent.gif" ><br>Exceeds Expectations
																						<input type="hidden" name="targetgradestatus_equip"id="targetgradestatus_equip" value="Exceeds Expectations"/>
																						</div><?php
																					}else if($totalequip == $targetequip){
																						?><div style="Background-color:#ed9c28;color:#fdfdfd;height:55px;border-radius:10px;margin:10px; text-align:center;"><img style="height:35px" src="icons/fair1.gif" ><br>Meets Expectations
																						<input type="hidden"name="targetgradestatus_equip"id="targetgradestatus_equip" value="Meets Expectations"/>
																						</div>
																						
																						<?php
																					}else if($totalequip < $targetequip){
																						?><div style="Background-color:#a43939;color:#fdfdfd;height:55px;border-radius:10px;margin:10px; text-align:center;"><img style="height:35px" src="icons/poor.gif" ><br>Needs Improvement
																						<input type="hidden"name="targetgradestatus_equip"id="targetgradestatus_equip" value="Needs Improvement	"/>
																						</div>
																						
																						<?php
																					}

																				?>
																					
																					<label style="color:#2b942b"><strong> Exceeds Expectations </strong> </label><small> Above <?php echo $target?>  </small>
																					<label style="color:#ed9c28"><strong> Meets Expectations </strong> </label><small> Equal to <?php echo $target?>  </small>
																					<label style="color:#a43939"><strong> Needs Improvement </strong> </label><small> Below <?php echo $target?>  </small>
																			</tbody>
																		</table>
																		<?php
																			$getdatetime = $conn->prepare("SELECT * FROM checklist_grade where Pid = '". $pid."' ORDER BY Aid DESC ");
																			$getdatetime->execute(array(":Pid"=> $pid));
																			$rowggetdatetime = $getdatetime->fetch(PDO::FETCH_ASSOC);
																			$datechecked= $rowggetdatetime['Date_Checked'];

																			$getdatetimeadd5 = $conn->prepare("SELECT DATE_ADD('".$datechecked."', INTERVAL 1 HOUR) AS datet FROM checklist_grade where Pid = '". $pid."' ORDER BY Aid DESC ");
																			$getdatetimeadd5->execute();
																			$rowggetdatetimeadd5 = $getdatetimeadd5->fetch(PDO::FETCH_ASSOC);
																			$modifieddatechecked= $rowggetdatetimeadd5['datet'];
																			

																			?>
																	</div>
															</div>
															
															<center><div><input onclick="completeModal('<?php echo $pid; ?>','<?php echo $rowgetBuilding['Category']; ?>','<?php echo $rowgetBuilding['id']; ?>','<?php echo $Datetoday ?>','<?php echo $Datetoday ?>','<?php echo $staffname ?>','<?php echo $totalsani ?>','<?php echo $totalstru ?>','<?php echo $totalequip ?>')" type="button" class="btn btn-success" value="Complete Phase"></div></center>
														</div>
														<div  style="color:#666;height:20px;">
														
						
														<!-- <label><small>Date Submitted: <?php echo date("F j, Y, g:i a",strtotime($rowggetdatetime['Date_Checked']));?></small></label></br> -->
														<!-- <strong><label style="color:#d2322d;weight:10px;margin:15px;"><small><strong>Date Reset: <?php echo date("F j, Y, g:i a",strtotime($modifieddatechecked));?></small></strong></label></strong> -->
														<input type="hidden" id="bidd" value="<?php echo $bidd?>"/>
														<input type="hidden" id="datechecked" value="<?php echo $datechecked?>"/>
														<input type="hidden" id="modifieddatechecked" value="<?php echo $modifieddatechecked?>"/>
														
														</div>
													</div>													
												</div>
											</div>			



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

