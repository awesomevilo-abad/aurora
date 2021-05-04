<?php
if (! empty($result)) {

?>
    
                      <section class="panel col-sm-12">
							
							<div class="panel-body">
								<div class="table-responsive">
                                <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
                                        <thead>
                                            <tr>
                                            <th >Building Code</th>
                                            <th>Building Name</th>
                                            <th>Building Category</th>
                                            <th>Building Color</th>
                                            <th>Building Date Created</th>
                                            <th>Building Icon</th>
                                            <th style="text-align:center;">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                                <?php
                                                    $table = $crudcontroller->readData();
                                                            if (! empty($table)) {
                                                        foreach ($table as $k => $v) {
                                                    ?>
                                                            <tr style="text-align:center;">
                                                            <td><?php echo $table[$k]["id"]; ?></td>
                                                            <td><?php echo $table[$k]["Name"]; ?></td>
                                                            <td><?php echo $table[$k]["Category"]; ?></td>
                                                            <td><?php echo $table[$k]["Color"]; ?></td>
                                                            <td><?php echo $table[$k]["Date Created"]; ?></td>
                                                            
                                                            <td>
                                                                <img style ="height:30px;width:35px" src="uploads/<?php echo $table[$k]["Image"]?>">
                                                            </td>
                                                            <td>
                                                            <button id="<?php echo $table[$k]["id"]; ?>" class="bn-edit mb-xs mt-xs mr-xs btn btn-default"><img src="icons/edit.png" style="height:25px; width:25px"></button>
                                                            <button id="<?php echo $table[$k]["id"]; ?>" class="bn-delete mb-xs mt-xs mr-xs btn btn-default"><img src="icons/delete.png" style="height:25px; width:25px"></button>
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
      
   
<?php
    }

?>