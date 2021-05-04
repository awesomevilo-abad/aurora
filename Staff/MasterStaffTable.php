<?php
if (! empty($result)) {

?>
	<section class="panel">
							
							<div class="panel-body">
								<div class="table-responsive">
                                <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
                                    <thead>
										<tr>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Department</th>
                                        <th>Username</th>
                                        <th>Phase</th>
                                        
                                        <th style="text-align:center;">Action</th>
                                        <th style="text-align:center;">Phase Management</th>
                                    </tr>
									</thead>
                                    <tbody>
                                            <?php
                                                $table = $crudcontroller->readData();
                                                        if (! empty($table)) {
                                                    foreach ($table as $k => $v) {
                                                        $userid = $table[$k]["Acid"];
                                                ?>
                                                     <tr style="text-align:center;">
                                                        <td><?php echo $table[$k]["Acid"]; ?></td>
                                                        <td><?php echo $table[$k]["AcName"]; ?></td>
                                                        <td><?php echo $table[$k]["Position"]; ?></td>
                                                        <td><?php echo $table[$k]["Department"]; ?></td>
                                                        <td><?php echo $table[$k]["Username"]; ?></td>
                                                        <td><?php echo $table[$k]["PName"]; ?></td>
                                                       
                                                        <td>
                                                            <button id="<?php echo $table[$k]["Acid"]; ?>" class="bn-edit mb-xs mt-xs mr-xs btn btn-default"><img src="icons/edit.png" style="height:25px; width:25px"></button>
                                                            <button id="<?php echo $table[$k]["Acid"]; ?>" class="bn-delete mb-xs mt-xs mr-xs btn btn-default"><img src="icons/delete.png" style="height:25px; width:25px"></button>
                                                        </td>
                                                        <td>
                                                        <a href="#" class=" mb-xs mt-xs mr-xs btn btn-default" onclick="Modal(<?php echo $userid ?>)" ><img src="icons/staff2.png" style="height:25px; width:25px">Assign</a>
                                                        <a href="#" class=" mb-xs mt-xs mr-xs btn btn-default" onclick="ModalAddPhase(<?php echo $userid ?>)" ><img src="icons/view.png" style="height:25px; width:25px">View</a>
                                                        </td>
                                                    </tr>                  
                                            <?php }}?>     
                                            </tbody>
									</table>
								</div>
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
		<script src="assets/vendor/select2/select2.js"></script>
		<script src="assets/vendor/jquery-datatables/media/js/jquery.dataTables.js"></script>
		<script src="assets/vendor/jquery-datatables/extras/TableTools/js/dataTables.tableTools.min.js"></script>
		<script src="assets/vendor/jquery-datatables-bs3/assets/js/datatables.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>


		<!-- Examples -->
		<script src="assets/javascripts/tables/examples.datatables.default.js"></script>
		<script src="assets/javascripts/tables/examples.datatables.row.with.details.js"></script>
        <script src="assets/javascripts/tables/examples.datatables.tabletools.js"></script>
        <script src="assets/javascripts/ui-elements/examples.modals.js"></script>
<?php
    }

?>
