<?php
 include_once '../startchecklist/Class.php';
 $crudcontroller = new CrudController();
 $dao = new Dao();
 $conn = $dao->openConnection();

?>


                            <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf"> 
									<thead>
										<tr>
											<th>Area</th>
											<th>Phase</th>
											<th>Building</th>
											<th>Date Checked</th>
										</tr>
									</thead>
									<tbody>
                                    <?php
                                        $checklist = $conn->prepare("SELECT * FROM checklist_grade left join area on checklist_grade.Aid = area.Aid left join phase on checklist_grade.Pid = phase.Pid left join building on checklist_grade.Bid = building.id where checklist_grade.status = 'Phase Completed' ORDER BY checklist_grade.Date_Checked ASC ");
                                        $checklist->execute(array());
                                        while($getChecklistgrade= $checklist->fetch(PDO::FETCH_ASSOC)){

                                    ?>
										<tr class="">
											<td><?php echo $getChecklistgrade['AName'];?></td>
											<td><?php echo $getChecklistgrade['PName'];?></td>
											<td><?php echo $getChecklistgrade['Name'];?></td>
											<td class="center"><?php echo $getChecklistgrade['Date_Checked'];?></td>
										</tr>
                                    <?php
                                       }
                                    ?>
									
									</tbody>
								</table>
                        
                        
		<!-- Examples -->
		<script src="assets/javascripts/tables/examples.datatables.ajax.js"></script>
		<script src="assets/javascripts/forms/examples.advanced.form.js" ></script>	    
		<script src="assets/javascripts/tables/examples.datatables.default.js"></script>
		<script src="assets/javascripts/tables/examples.datatables.tabletools.js"></script>
		<script src="assets/javascripts/ui-elements/examples.modals.js"></script>
		