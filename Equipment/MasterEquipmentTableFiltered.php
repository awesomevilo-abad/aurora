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
                                        <th>Equipment</th>
                                        <th>Area Name</th>
                                        <th>Asset Tag</th>
                                        <th>Asset No</th>
                                        <th>Status</th>
                                        <th>Date Created</th>
                                        
                                    </tr>
									</thead>
                                    <tbody>
                                            <?php
                                                $table = $crudcontroller->filteredreadData();
                                                        if (! empty($table)) {
                                                    foreach ($table as $k => $v) {
                                                ?>
                                                     <tr style="text-align:center;">
                                                        <td><?php echo $table[$k]["Eid"]; ?></td>
                                                        <td><?php echo $table[$k]["EName"]; ?></td>
                                                        <td>
                                                           <label style="color:red"><small> <?php echo $table[$k]["PName"]; ?></small></label>
                                                            <?php echo $table[$k]["AName"]; ?>
                                                        </td>
                                                        <td><?php echo $table[$k]["Asset_Tag"]; ?></td>
                                                        <td><?php echo $table[$k]["Asset_Number"]; ?></td>
                                                        <td><?php echo $table[$k]["status"]; ?></td>
                                                        <td><?php echo $table[$k]["Date_Created"]; ?></td>
                                                       
                                                      
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
<?php
    }

?>