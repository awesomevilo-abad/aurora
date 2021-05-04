	<!-- start: sidebar -->
	<?php

	?>
				<aside id="sidebar-left" class="sidebar-left">
				
					<div class="sidebar-header">
						<div class="sidebar-title">
							Navigation
						</div>
						<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
							<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
						</div>
					</div>
				
					<div class="nano">
						<div class="nano-content">
							<nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-main">
									
									<?php
									$showaccountdetails = $conn->prepare("SELECT * FROM Accounts where Username = :user ORDER BY Acid ASC");
									$showaccountdetails->execute(array(":user"=>$_SESSION['username']));
									if($showaccountdetails->rowCount() > 0){
										while($rowshowaccountdetails = $showaccountdetails->fetch(PDO::FETCH_ASSOC)){
											$position= $rowshowaccountdetails['Position'];
											$AcName= $rowshowaccountdetails['AcName'];
											if($rowshowaccountdetails['Position']=="QA Staff"){
												?>
												<li class="">
													<a href="dashboard-qastaff.php">
													<?php $_SESSION['position']=$position?>
														<img src="icons/dashboard1.png" style="height:35px; width:35px">
														<span>Dashboard</span>
													</a>
												</li>
														
												<li class="">
													<a href="GenerateReport.php">
													<?php $_SESSION['position']=$position?>
														<img src="icons/report2.png" style="height:35px; width:35px">
														<span>Generate Report</span>
													</a>
												</li>
									
												<li class="">
													<a href="history.php">
														<?php $_SESSION['position']=$position?>
														<img src="icons/history2.png" style="height:35px; width:35px">
														<span>History</span>
													</a>
												</li>
												<li class="nav-parent">
													<a>
													<?php $_SESSION['position']=$position?>
														<img src="icons/viewequipment.png" style="height:35px; width:35px">
														<span>Viewing</span>
													</a>
													<ul class="nav nav-children">	
														<li class="">
															<a href="viewing_checklist.php">
															<?php $_SESSION['position']=$position?>
																<img src="icons/viewcheck.png" style="height:35px; width:35px">
																<span>Viewing of Checklist</span>
															</a>
														</li>				
																	
														<li class="">
															<a href="viewing_equipment.php">
															<?php $_SESSION['position']=$position?>
																<img src="icons/eq.png" style="height:35px; width:35px">
																<span>Viewing of Equipment</span>
															</a>
														</li>
													</ul>
												</li>
												<li >
													<a href="userStartChecklistCat.php">
														<?php $_SESSION['position']=$position?>
														<?php $_SESSION['AcName']=$AcName?>
														<img src="icons/startcheck.png" style="height:35px; width:35px">
														<span>Checklist </span>
													</a>
												</li>
												<?php
											} else if($rowshowaccountdetails['Position']=="QA Supervisor"){
												?>
												<li class="">
													<a href="dashboard.php">
													<?php $_SESSION['position']=$position?>
														<img src="icons/dashboard1.png" style="height:35px; width:35px">
														<span>Dashboard</span>
													</a>
												</li>	
												<li >
													<a href="userStartChecklistCat_Visor.php">
														<?php $_SESSION['position']=$position?>
														<?php $_SESSION['AcName']=$AcName?>
														<img src="icons/camera.png" style="height:35px; width:35px">
														<span>Spot Audit</span>
													</a>
												</li>

												<li class="">
													<a href="userStartChecklistCat.php">
														<?php $_SESSION['position']=$position?>
														<?php $_SESSION['AcName']=$AcName?>
														<img src="icons/startcheck.png" style="height:35px; width:35px">
														<span>Checklist </span>
													</a>
												</li>
												<li class="nav-parent">
													<a>
													<?php $_SESSION['position']=$position?>
														<img src="icons/history2.png" style="height:35px; width:35px">
														<span>History</span>
													</a>
													<ul class="nav nav-children">	
														<li class="">
															<a href="history_visor.php">
																<?php $_SESSION['position']=$position?>
																<?php $_SESSION['AcName']=$AcName?>
																<img src="icons/history.png" style="height:35px; width:35px">
																<span>Spot Audit</span>
															</a>
														</li>						
																	
														<li class="">
															<a href="history.php">
																<?php $_SESSION['position']=$position?>
																<img src="icons/history.png" style="height:35px; width:35px">
																<span>Audit</span>
															</a>
														</li>
													</ul>
												</li>

												<li class="nav-parent">
													<a>
													<?php $_SESSION['position']=$position?>
														<img src="icons/viewequipment.png" style="height:35px; width:35px">
														<span>Viewing</span>
													</a>
													<ul class="nav nav-children">	
														<li class="">
															<a href="viewing_checklist.php">
															<?php $_SESSION['position']=$position?>
																<img src="icons/viewcheck.png" style="height:35px; width:35px">
																<span>Viewing of Checklist</span>
															</a>
														</li>				
																	
														<li class="">
															<a href="viewing_equipment.php">
															<?php $_SESSION['position']=$position?>
																<img src="icons/eq.png" style="height:35px; width:35px">
																<span>Viewing of Equipment</span>
															</a>
														</li>
														<li class="">
															<a href="viewing_equipmentOffense.php">
															<?php $_SESSION['position']=$position?>
																<img src="icons/equipment.png" style="height:35px; width:35px">
																<span>Equipment Offense</span>
															</a>
														</li>				
																	
														<li class="">
															<a href="viewing_structuralOffense.php">
															<?php $_SESSION['position']=$position?>
																<img src="icons/eq3.png" style="height:35px; width:35px">
																<span>Structural Offense</span>
															</a>
														</li>
																
														<li class="">
															<a href="viewing_sanitationOffense.php">
															<?php $_SESSION['position']=$position?>
																<img src="icons/icons8-housekeeping-48.png" style="height:35px; width:35px">
																<span>Sanitation Offense</span>
															</a>
														</li>
													</ul>
												</li>

												<li >
													<a href="createRecord.php">
														<?php $_SESSION['position']=$position?>
														<img src="icons/report.png" style="height:35px; width:35px">
														<span>Create Report </span>
													</a>
												</li>
												<li class="">
													<a href="GenerateReport.php">
													<?php $_SESSION['position']=$position?>
														<img src="icons/report2.png" style="height:35px; width:35px">
														<span>Generate Report</span>
													</a>
												</li>
									
												<?php
											}
											else if($rowshowaccountdetails['Position']=="Manager"){
												?>
												<li class="">
													<a href="dashboard.php">
													<?php $_SESSION['position']=$position?>
														<img src="icons/dashboard1.png" style="height:35px; width:35px">
														<span>Dashboard</span>
													</a>
												</li>						
															
												<!-- <li class="">
													<a href="GenerateReport.php">
													<?php $_SESSION['position']=$position?>
														<img src="icons/report2.png" style="height:35px; width:35px">
														<span>Generate Report</span>
													</a>
												</li>			 -->
												<li class="nav-parent">
													<a>
													<?php $_SESSION['position']=$position?>
														<img src="icons/viewequipment.png" style="height:35px; width:35px">
														<span>Viewing</span>
													</a>
													<ul class="nav nav-children">	
														<li class="">
															<a href="viewing_checklist.php">
															<?php $_SESSION['position']=$position?>
																<img src="icons/viewcheck.png" style="height:35px; width:35px">
																<span>Viewing of Checklist</span>
															</a>
														</li>				
																	
														<li class="">
															<a href="viewing_equipment.php">
															<?php $_SESSION['position']=$position?>
																<img src="icons/eq.png" style="height:35px; width:35px">
																<span>Viewing of Equipment</span>
															</a>
														</li>
													</ul>
												</li>	
													
														<li class="">
															<a href="viewing_equipmentOffense.php">
															<?php $_SESSION['position']=$position?>
																<img src="icons/equipment.png" style="height:35px; width:35px">
																<span>Equipment</span>
															</a>
														</li>				
																	
														<li class="">
															<a href="viewing_structuralOffense.php">
															<?php $_SESSION['position']=$position?>
																<img src="icons/eq3.png" style="height:35px; width:35px">
																<span>Structural</span>
															</a>
														</li>
														
														<li class="">
															<a href="viewing_sanitationOffense.php">
															<?php $_SESSION['position']=$position?>
																<img src="icons/icons8-housekeeping-48.png" style="height:35px; width:35px">
																<span>Sanitation</span>
															</a>
														</li>
													
												<?php
											}
											else if($rowshowaccountdetails['Position']=="QA Manager"){
												?>
												<li class="">
													<a href="dashboard.php">
													<?php $_SESSION['position']=$position?>
														<img src="icons/dashboard1.png" style="height:35px; width:35px">
														<span>Dashboard</span>
													</a>
												</li>						
															
															
												<li class="">
													<a href="viewRecord_QAManager.php">
													<?php $_SESSION['position']=$position?>
														<img src="icons/report.png" style="height:35px; width:35px">
														<span>View Report</span>
													</a>
												</li>

												<li class="nav-parent">
													<a>
													<?php $_SESSION['position']=$position?>
														<img src="icons/viewequipment.png" style="height:35px; width:35px">
														<span>Viewing</span>
													</a>
													<ul class="nav nav-children">	
														<li class="">
															<a href="viewing_checklist.php">
															<?php $_SESSION['position']=$position?>
																<img src="icons/viewcheck.png" style="height:35px; width:35px">
																<span>Viewing of Checklist</span>
															</a>
														</li>				
																	
														<li class="">
															<a href="viewing_equipment.php">
															<?php $_SESSION['position']=$position?>
																<img src="icons/eq.png" style="height:35px; width:35px">
																<span>Viewing of Equipment</span>
															</a>
														</li>
														<li class="">
															<a href="viewing_equipmentOffense.php">
															<?php $_SESSION['position']=$position?>
																<img src="icons/equipment.png" style="height:35px; width:35px">
																<span>Equipment Offense</span>
															</a>
														</li>				
																	
														<li class="">
															<a href="viewing_structuralOffense.php">
															<?php $_SESSION['position']=$position?>
																<img src="icons/eq3.png" style="height:35px; width:35px">
																<span>Structural Offense</span>
															</a>
														</li>
																
														<li class="">
															<a href="viewing_sanitationOffense.php">
															<?php $_SESSION['position']=$position?>
																<img src="icons/icons8-housekeeping-48.png" style="height:35px; width:35px">
																<span>Sanitation Offense</span>
															</a>
														</li>
													</ul>
												</li>
													
												<?php
											}else if($rowshowaccountdetails['Position']=="Protect" || $rowshowaccountdetails['Position']=="protect" ){
												?>
												<li class="">
													<a href="dashboard-protect.php">
													<?php $_SESSION['position']=$position?>
														<img src="icons/dashboard1.png" style="height:35px; width:35px">
														<span>Dashboard</span>
													</a>
												</li>	
		
												<li class="nav-parent">
													<a>
													<?php $_SESSION['position']=$position?>
														<img src="icons/history2.png" style="height:35px; width:35px">
														<span>History</span>
													</a>
													<ul class="nav nav-children">	
														<li class="">
															<a href="history_visor.php">
																<?php $_SESSION['position']=$position?>
																<?php $_SESSION['AcName']=$AcName?>
																<img src="icons/history.png" style="height:35px; width:35px">
																<span>Spot Audit</span>
															</a>
														</li>						
																	
														<li class="">
															<a href="history.php">
																<?php $_SESSION['position']=$position?>
																<img src="icons/history.png" style="height:35px; width:35px">
																<span>Audit</span>
															</a>
														</li>
													</ul>
												</li>
												<li class="nav-parent">
													<a>
													<?php $_SESSION['position']=$position?>
														<img src="icons/viewequipment.png" style="height:35px; width:35px">
														<span>Viewing</span>
													</a>
													<ul class="nav nav-children">	
														<li class="">
															<a href="viewing_checklist.php">
															<?php $_SESSION['position']=$position?>
																<img src="icons/viewcheck.png" style="height:35px; width:35px">
																<span>Viewing of Checklist</span>
															</a>
														</li>				
																	
														<li class="">
															<a href="viewing_equipment.php">
															<?php $_SESSION['position']=$position?>
																<img src="icons/eq.png" style="height:35px; width:35px">
																<span>Viewing of Equipment</span>
															</a>
														</li>
													</ul>
												</li>
												<li class="">
													<a href="GenerateReport.php">
													<?php $_SESSION['position']=$position?>
														<img src="icons/report2.png" style="height:35px; width:35px">
														<span>Generate Report</span>
													</a>
												</li>
												<?php
											}else if($rowshowaccountdetails['Position']=="Supervisor" || $rowshowaccountdetails['Position']=="supervisor" ){
												?>
												<li class="">
													<a href="dashboard-protect.php">
													<?php $_SESSION['position']=$position?>
														<img src="icons/dashboard1.png" style="height:35px; width:35px">
														<span>Dashboard</span>
													</a>
												</li>	
		
												<li class="nav-parent">
													<a>
													<?php $_SESSION['position']=$position?>
														<img src="icons/history2.png" style="height:35px; width:35px">
														<span>History</span>
													</a>
													<ul class="nav nav-children">	
														<li class="">
															<a href="history_visor.php">
																<?php $_SESSION['position']=$position?>
																<?php $_SESSION['AcName']=$AcName?>
																<img src="icons/history.png" style="height:35px; width:35px">
																<span>Spot Audit</span>
															</a>
														</li>						
																	
														<li class="">
															<a href="history.php">
																<?php $_SESSION['position']=$position?>
																<img src="icons/history.png" style="height:35px; width:35px">
																<span>Audit</span>
															</a>
														</li>
													</ul>
												</li>
												<li class="nav-parent">
													<a>
													<?php $_SESSION['position']=$position?>
														<img src="icons/viewequipment.png" style="height:35px; width:35px">
														<span>Viewing</span>
													</a>
													<ul class="nav nav-children">	
														<li class="">
															<a href="viewing_checklist.php">
															<?php $_SESSION['position']=$position?>
																<img src="icons/viewcheck.png" style="height:35px; width:35px">
																<span>Viewing of Checklist</span>
															</a>
														</li>				
																	
														<li class="">
															<a href="viewing_equipment.php">
															<?php $_SESSION['position']=$position?>
																<img src="icons/eq.png" style="height:35px; width:35px">
																<span>Viewing of Equipment</span>
															</a>
														</li>
														<li class="">
															<a href="viewing_equipmentOffense.php">
															<?php $_SESSION['position']=$position?>
																<img src="icons/equipment.png" style="height:35px; width:35px">
																<span>Equipment Offense</span>
															</a>
														</li>				
																	
														<li class="">
															<a href="viewing_structuralOffense.php">
															<?php $_SESSION['position']=$position?>
																<img src="icons/eq3.png" style="height:35px; width:35px">
																<span>Structural Offense</span>
															</a>
														</li>
																
														<li class="">
															<a href="viewing_sanitationOffense.php">
															<?php $_SESSION['position']=$position?>
																<img src="icons/icons8-housekeeping-48.png" style="height:35px; width:35px">
																<span>Sanitation Offense</span>
															</a>
														</li>
													</ul>
												</li>
												<?php
											}else if($rowshowaccountdetails['Position']=="ADMIN"){
												?>
												<li class="">
													<a href="dashboard.php">
													<?php $_SESSION['position']=$position?>
														<img src="icons/dashboard1.png" style="height:35px; width:35px">
														<span>Dashboard</span>
													</a>
												</li>				
												<li class="">
													<a href="GenerateReport.php">
													<?php $_SESSION['position']=$position?>
														<img src="icons/report2.png" style="height:35px; width:35px">
														<span>Generate Report</span>
													</a>
												</li>
									
												<li class="nav-parent">
													<a>
													<?php $_SESSION['position']=$position?>
														<img src="icons/dmanagement.png" style="height:35px; width:35px">
														<span>Area Management</span>
													</a>
													<ul class="nav nav-children">	
														<li>
															<a href="BuildingManagement.php">
															<?php $_SESSION['position']=$position?>
															<img src="icons/building.png" style="height:25px; width:25px">
																Building 
															</a>
														</li>
														<li>
															<a href="PhaseManagement.php">
															<?php $_SESSION['position']=$position?>
															<img src="icons/phase.png" style="height:25px; width:25px">
																Phase 
															</a>
														</li>
														
														<li>
															<a href="AreaManagement.php">
															<?php $_SESSION['position']=$position?>
															<img src="icons/area.png" style="height:25px; width:25px">
																Area 
															</a>
														</li>
														
														<li>

															<a href="ChecklistManagement.php">
															<?php $_SESSION['position']=$position?>
															<img src="icons/checklist.png" style="height:25px; width:25px">
																Checklist 
															</a>
														</li>
														
														<!-- <li>

															<a href="QRManagement.php">
															<?php $_SESSION['position']=$position?>
															<img src="icons/qr1.png" style="height:25px; width:25px">
																Generate QR  
															</a>
														</li> -->
													</ul>
												</li>
												
												<li class="nav-parent">
													<a>
													<?php $_SESSION['position']=$position?>
														<img src="icons/viewequipment.png" style="height:35px; width:35px">
														<span>Viewing</span>
													</a>
													<ul class="nav nav-children">	
														<li class="">
															<a href="viewing_checklist.php">
															<?php $_SESSION['position']=$position?>
																<img src="icons/viewcheck.png" style="height:35px; width:35px">
																<span>Viewing of Checklist</span>
															</a>
														</li>				
																	
														<li class="">
															<a href="viewing_equipment.php">
															<?php $_SESSION['position']=$position?>
																<img src="icons/eq.png" style="height:35px; width:35px">
																<span>Viewing of Equipment</span>
															</a>
														</li>
													</ul>
												</li>

												<li class="">
													<a href="StaffManagement.php">
													<?php $_SESSION['position']=$position?>
													<img src="icons/staff1.png" style="height:35px; width:35px">
														<span>Staff Management</span>
													</a>
												</li>

												
												<li class="">
													<a href="EquipmentManagement.php">
													<?php $_SESSION['position']=$position?>
														<img src="icons/equipment.png" style="height:35px; width:35px">
														<span>Equipment Management</span>
													</a>
												</li>

												<li class="">
													<a href="userStartChecklistCat.php">
													<?php $_SESSION['position']=$position?>
														<?php $_SESSION['AcName']=$AcName?>
													<img src="icons/startcheck.png" style="height:35px; width:35px">
														<span>Checklist</span>
													</a>
												</li>

												<li class="">
													<a href="history.php">
													<?php $_SESSION['position']=$position?>
														<img src="icons/history2.png" style="height:35px; width:35px">
														<span>History</span>
													</a>
												</li>

												<?php
											}else if($rowshowaccountdetails['Position']=="Fixed Asset Specialist" || $rowshowaccountdetails['Position']=="Fixed Asset Specialist" ){
												?>
												<li class="">
													<a href="dashboard-fa.php">
													<?php $_SESSION['position']=$position?>
														<img src="icons/dashboard1.png" style="height:35px; width:35px">
														<span>Dashboard</span>
													</a>
												</li>			
																	
												<li class="">
													<a href="viewing_equipment.php">
													<?php $_SESSION['position']=$position?>
														<img src="icons/eq.png" style="height:35px; width:35px">
														<span>Viewing of Equipment</span>
													</a>
												</li>
												<li class="">
															<a href="viewing_equipmentOffense.php">
															<?php $_SESSION['position']=$position?>
																<img src="icons/equipment.png" style="height:35px; width:35px">
																<span>Equipment Offense</span>
															</a>
														</li>				
																	
														<li class="">
															<a href="viewing_structuralOffense.php">
															<?php $_SESSION['position']=$position?>
																<img src="icons/eq3.png" style="height:35px; width:35px">
																<span>Structural Offense</span>
															</a>
														</li>	

														<li class="">
															<a href="viewing_sanitationOffense.php">
															<?php $_SESSION['position']=$position?>
																<img src="icons/icons8-housekeeping-48.png" style="height:35px; width:35px">
																<span>Sanitation Offense</span>
															</a>
														</li>
												<?php
											}
										}
									}
									?>
							
								
						
								</ul>
							</nav>
						</div>
					</div>
				
					
				</aside>
				<!-- end: sidebar -->