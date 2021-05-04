
							
                           <?php
                           session_start(); 
                           $AcPos=$_SESSION['position'];
                           $AcName=  $_SESSION['AcName'];
                           $page=  "Spot Audit";
                           if(isset($_SESSION['username'])){
                               }else{
                                   header("location:index.php");  
                               }
                               include_once 'class.php';
                               $crudcontroller = new CrudController();
                               $dao = new Dao();
                               $conn = $dao->openConnection();
                           ?>    
                           
                           <header class="panel-heading" >
                               <h6 class="panel-title" >List of reports</h6>
                           </header>
                        <section class="panel">
							<div class="panel-body">
								    <div class="table-responsive">
                                        <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
                                           <thead>
                                            <tr>
                                                <center>
                                               <th>Record Code</th>
                                               <th>Title</th>
                                               <th>Prepared By</th>
                                               <th>Week</th>
                                               <th>Month</th>
                                               <th style="text-align:center;">View Report</th>
                                               </center>
                                           </tr>
                                           </thead>
                                           <tbody>
                                                   <?php
                                                          $table = $crudcontroller->loadCreateRecordData_Manager();
                                                          if (! empty($table)) {
                                                           foreach ($table as $k => $v) {
                                                               $title =$table[$k]['Title'];
                                                               $bid =$table[$k]['Bid'];
                                                                $pid =$table[$k]['Pid'];
                                                                $fid =$table[$k]['Fid'];
                                                                $week =$table[$k]['Week'];
                                                                $month =$table[$k]['Month'];
                                                                $qa =$table[$k]['qastaff'];
                                                                $date =$table[$k]['Date_Created'];
                                                       ?>
                                                           <tr style="text-align:center;">
                                                               <td><?php echo $fid; ?></td>
                                                               <td><?php echo $title; ?></td>
                                                               <td><?php echo $qa; ?></td>
                                                               <?php
                                                               $building = $conn->prepare("SELECT * FROM Building WHERE id = :id");
                                                               $building->execute(array(":id"=> $bid));
                                                               $rowbuilding = $building->fetch(PDO::FETCH_ASSOC);
                                                               ?>
                                                               <?php
                                                               $phase = $conn->prepare("SELECT * FROM Phase WHERE Pid = :id");
                                                               $phase->execute(array(":id"=> $pid));
                                                               $rowphase = $phase->fetch(PDO::FETCH_ASSOC);
                                                               ?>
                                                               <td><?php echo $week; ?></td>
                                                               <td><?php echo $month; ?></td>
                                                               <td><button type="button" id="ViewPoints" onclick="viewreport('<?php echo  $pid ?>','<?php echo  $fid ?>','<?php echo $date; ?>','<?php echo $title; ?>')" name="ViewPoints" class="mb-xs mt-xs mr-xs btn btn-default" ><img src="icons/viewreport2.png" style="height:25px; width:25px;float:right" data-toggle="tooltip" title="View Report Table"></button></td>
                                                               
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
      