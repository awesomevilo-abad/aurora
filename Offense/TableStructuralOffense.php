<?php
include_once 'class.php';
$crudcontroller = new CrudController();
if (! empty($result)) {

?>
	<section class="panel col-sm-12">
							
							<div class="panel-body">
								<div class="table-responsive">

                                   
                              
                                <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
                                    <thead>
										<tr>
                                        <th>Code</th>
                                        <th>Structural Name</th>
                                        <th>Location</th>
                                        <th>Grade</th>
                                        <th>Remarks</th>
                                        <th>Week</th>
                                        <th>Date Audit</th>
                                    </tr>
									</thead>
                                    <tbody>
                                            <?php
                                                $table = $crudcontroller->viewOffenseStructural($_POST['year'],$_POST['month'],$_POST['week'],$_POST['offense']);
                                                        if (! empty($table)) {
                                                    foreach ($table as $k => $v) {
                                                ?>
                                                     <tr style="text-align:;">
                                                        <td><?php echo trim($table[$k]["id"]); ?></td>
                                                        <td><?php echo trim($table[$k]["CName"]); ?></td>
                                                        <td>
                                                        
                                                        <label style="color:#ed4328"><small><strong><?php echo trim($table[$k]["Name"]); ?></strong></small></label>
                                                        <label style="color:#ed9e28c2"><small><strong><?php echo trim($table[$k]["PName"]); ?></strong></small></label>
                                                        <label style="color:#666"><small><strong><?php echo trim($table[$k]["AName"]); ?></strong></small></label>
                                                        
                                                        </td>
                                                        <td><?php echo trim($table[$k]["Str_Grade"]); ?></td>
                                                        <td><?php echo trim($table[$k]["remarks"]); ?></td>
                                                        <td><?php echo trim($table[$k]["week"]); ?></td>
                                                        <td><?php echo trim($table[$k]["Date_Checked"]); ?></td>
                                                      
                                                        
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