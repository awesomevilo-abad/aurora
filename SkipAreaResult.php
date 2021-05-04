<?php  
 session_start(); 
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
						<h2>Area Result</h2>
					
						<div class="right-wrapper pull-right">
							
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- Main Body select building phase area checklist-->
						<div class="col-md-12">
								
									<section class="panel" style="background-color:#ffffff">
										<header class="panel-heading" style="background-color:#196a92;" >
											<h2 class="panel-title" style="color:#ffffff">Skip Area</h2>
												<p class="panel-subtitle" style="color:#ffffff">
												  You skipped this area
												</p>
										</header>
										
										<div style="margin:10px;">
											<?php 
												include_once 'startchecklist/Class.php';
												$crudcontroller = new CrudController();
												$dao = new Dao();
												$conn = $dao->openConnection();

												$id = $_GET['Aid'];
											

												$areaglobal = $conn->prepare("SELECT * FROM area WHERE Aid=:Aid");
												$areaglobal->execute(array(":Aid"=>$id));
												$rowAreaglobal = $areaglobal->fetch(PDO::FETCH_ASSOC);
                                                $AreaId = $rowAreaglobal['Aid'];
                                                $AreaName = $rowAreaglobal['AName'];
												?>
													

													<!-- Get BUilding Id -->
													<?php
														$phase = $conn->prepare("SELECT * FROM phase WHERE Pid=:pid");
														$phase->execute(array(":pid"=>$rowAreaglobal['Pid']));
														$rowPhase = $phase->fetch(PDO::FETCH_ASSOC);
														$bid =  $rowPhase['Bid'];
													?>
													<!-- end -->
													
												<?php
												$getStaff = $conn->prepare("SELECT * FROM accounts WHERE Username=:pid");
												$getStaff->execute(array(":pid"=> $_SESSION['username']));
												$rowgetStaff = $getStaff->fetch(PDO::FETCH_ASSOC);
												$staffname =  $rowgetStaff['AcName'];
												$staffpos =  $rowgetStaff['Position'];
	
												
										?>
										<input type="hidden" name="AreaId" value="<?php echo $AreaId ?>" />

								<div class="row">
									<a href="#" onclick="BacktoPhase(<?php echo $id ?>)" ><h5 style="text-decoration:none;text-align:center;color:#fff;background-color:#dfdfdf" class="mg-title text-bold">Back</h5></a>
										<div class="col-md-12">
                                            <center><h2><?php echo $AreaName?></h2></center>
                                            <div class="panel-actions">
                                            <label style="color:#196a92"><strong>Position: </strong></label> <?php echo $staffpos ?>
                                            <label style="color:#196a92"><strong>   Name: </strong></label> <?php echo $staffname ?>
                                            <input type="hidden"name="staffname" id="staffname" value="<?php echo $staffname ?>"/>
                                        </div>
										<div class="tabs">
                                             <ul class="nav nav-tabs nav-justified">
                                                    <li class="active">
                                                        <a href="#popular10" data-toggle="tab" class="text-center">Sanitation and Structural</a>
                                                    </li>
                                                        
                                                    <li>
                                                        <a href="#recent10" data-toggle="tab" class="text-center">Equipment</a>
                                                    </li>
                                             </ul>
                                            
                                            <form method="POST" id="formSkipAreaResult">
                                                 <div class="tab-content">
                                                    <div id="popular10" class="tab-pane active">
                                                        <div style="margin:10px;" id="result">
                                                            <!-- Sanitation -->
                                                                <table class="table table-bordered table-striped table-condensed mb-none">
                                                                    <thead>
                                                                            <tr>
                                                                                    <th>Checklist Name</th>
                                                                                    <th>Sanitation Grade</th>
                                                                                    <th>Structural Grade</th>
                                                                            </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php
                                                                            $getChecklist = $conn->prepare("SELECT * FROM Checklist WHERE Aid=:Aid");
                                                                            $getChecklist->execute(array(":Aid"=>$id));
                                                                            while( $rowgetChecklist = $getChecklist->fetch(PDO::FETCH_ASSOC)){
                                                                                    ?>
                                                                                    <tr>
                                                                                        <td><?php echo $rowgetChecklist['CName'];  ?>
                                                                                        <input type="hidden" name="aid" id="aid" value="<?php echo $rowgetChecklist['Aid']  ?>" /> <!--important-->
                                                                                        <input type="hidden" name="cid[]" id="cid" value="<?php echo $rowgetChecklist['Cid']  ?>" /> <!--important-->
                                                                                        <input type="hidden" name="cname[]" id="cname" value="<?php echo $rowgetChecklist['CName']  ?>" /> <!--important-->
                                                                                        </td>
                                                                                        <td><?php echo "Skipped";?>
                                                                                        <input type="hidden" value="Skipped" name="arraySani[]"/> <!--input type arraySanitation-->
                                                                                        </td>
                                                                                        <td><?php echo "Skipped";?>
                                                                                        <input type="hidden" value="Skipped" name="arrayStr[]"/> <!--input type arraySanitation-->
                                                                                        </td>
                                                                                        
                                                                                    </tr>
                                                                                    <?php   

                                                                            }
                                                                            
                                                                    ?>
                                                                    <tr style="background-color:#ccffcc">
                                                                            <td><strong>Total</strong></td>
                                                                            <td><?php
                                                                            if(empty($arraySum)){
                                                                                    echo "Skipped";
                                                                            }else{
                                                                            $sum = array_sum($arraySum);
                                                                            echo $totalsani = "Skipped";
                                                                            }?>
                                                                            <input type="hidden" name="totalsani" id="totalsani" value="<?php echo $totalsani  ?>" /> <!--important-->
                                                                            </td> 
                                                                            <td><?php
                                                                            if(empty($arraySum)){
                                                                                    echo "Skipped";
                                                                            }else{
                                                                            $sum = array_sum($arraySum);
                                                                            echo $totalstru = "Skipped";
                                                                            }?>
                                                                            <input type="hidden" name="totalstru" id="totalstru" value="<?php echo $totalstru  ?>" /> <!--important-->
                                                                            </td>
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
                                                                    
                                                                            $area = $conn->prepare("SELECT * FROM Area WHERE Aid=:Aid");
                                                                            $area->execute(array(":Aid"=>$id));
                                                                        if($area->rowCount() > 0){
                                                                            $rowArea = $area->fetch(PDO::FETCH_ASSOC);
                                                                                    // $equipment = $conn->prepare("SELECT equipment.EName,area.AName,area.percentageequip,area.Aid FROM Equipment right join Area on equipment.Aid = Area.Aid WHERE area.Pid=:pid Group by area.Aid");
                                                                                    $equipment = $conn->prepare("SELECT * FROM Equipment WHERE Aid = :Aid ");
                                                                                    $equipment->execute(array(":Aid"=>$rowArea['Aid']));
                                                                                    while($rowequipment = $equipment->fetch(PDO::FETCH_ASSOC)){
                                                                                        // echo $rowequipment['Aid'];
                                                                            ?>
                                                                            <tr>
                                                                                    <td><?php echo $rowequipment['EName']?>
                                                                                    <input type="hidden" name="eaid[]" id="eaid" value="<?php echo $rowequipment['Aid']  ?>" /> <!--important-->                                                        </td>
                                                                                    <td><?php echo $arraySumEq = "Skipped"?>
                                                                                    <input type="hidden" name="egrade[]" id="egrade" value="Skipped" /> <!--important-->                                      
                                                                                    <input type="hidden" name="ename[]" id="ename" value="<?php echo $rowequipment['EName']?>" /> <!--important-->                                                        
                                                                                    <input type="hidden" name="eid2[]" id="eid2" value="<?php echo $rowequipment['Eid']?>" /> <!--important-->                                                        
                                                                                    </td>
                                                                                    
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
                                                                                    echo "Skipped";
                                                                            }else{
                                                                                    echo "No Equipment in this Area";
                                                                            }
                                                                                
                                                                            ?>
                                                                            <input type="hidden" name="totalegrade" id="totalegrade" value="<?php echo round($average, 2)  ?>" /> <!--important-->                                                        
                                                                            </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>  
                                                                                                                        
                                                         </div>
                                                                                <input type="hidden" name="Datetoday" id="Datetoday" value="<?php echo $Datetoday ?>"/>
                                                                                <input type="hidden" name="staffname" id="staffname" value="<?php echo $staffname ?>"/>
                                                                                <input type="hidden" name="totalsani" id="totalsani" value="<?php echo $totalsani ?>"/>
                                                                                <input type="hidden" name="totalstru" id="totalstru" value="<?php echo $totalstru ?>"/>
                                                                                <input type="hidden" name="totalequip" id="totalequip" value="Skipped"/>
																				<input type="hidden" name="pid" id="pid" value="<?php echo $rowAreaglobal['Pid'];  ?>" /><!--important-->
																				<input type="hidden" name="bid" id="bid" value="<?php echo $bid  ?>" /><!--important-->
                                                                               
                                                    </div>
                                                    <center><div><button type="submit" id="btnAddSkippedArea" class="btn btn-primary">Submit</button></div></center>
													
					        	                </div>
											</form>
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

