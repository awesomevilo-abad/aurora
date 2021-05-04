
                        <section class="panel">
                           
							
                        <?php
                        session_start(); 
                        $AcPos=$_SESSION['position'];
                        $AcName=  $_SESSION['AcName'];
                        $page=  "Spot Audit";
                        if(isset($_SESSION['username'])){
                            echo "Please Wait";
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
                        <div class="panel-body">
								<div class="table-responsive">
                                <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
                                           <thead>
                                            <tr>
                                               <th>Record Code</th>
                                               <th>Title</th>
                                               <th>Prepared By</th>
                                               <th>Building Name</th>
                                               <th>Phase Name</th>
                                               <th>Week</th>
                                               <th>Month and Year</th>
                                               <th>Edit</th>
                                               <th>Add Remarks</th>
                                               <th>View Report</th>
                                           </tr>
                                           </thead>
                                           <tbody>
                                                   <?php
                                                          $table = $crudcontroller->loadCreateRecordData($AcName);
                                                          if (! empty($table)) {
                                                           foreach ($table as $k => $v) {
                                                               $title =$table[$k]['Title'];
                                                               $bid =$table[$k]['Bid'];
                                                                $pid =$table[$k]['Pid'];
                                                                $fid =$table[$k]['Fid'];
                                                                $week =$table[$k]['Week'];
                                                                $month =$table[$k]['Month'].' '.$table[$k]['Year'];
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
                                                               <td><?php echo $rowbuilding["Name"]; ?></td>
                                                               <td><?php echo $rowphase["PName"]; ?></td>
                                                               <td><?php echo $week; ?></td>
                                                               <td><?php echo $month; ?></td>
                                                               <td><button type="button" id="<?php echo $fid?>" class="bn-edit mb-xs mt-xs mr-xs btn btn-default"><img src="icons/edit.png" style="height:25px; width:25px;float:right" data-toggle="tooltip" title="Edit and Update Data"></button></td>
                                                               <td><button type="button" id="Points" onclick="viewmanagepoints('<?php echo  $pid ?>','<?php echo  $fid ?>','<?php echo $date; ?>','<?php echo $rowphase['PName'] ?>')" name="Points" class="mb-xs mt-xs mr-xs btn btn-default" ><img src="icons/checklist.png" style="height:25px; width:25px;float:right" data-toggle="tooltip" title="Manage Good or Bad Points"></button></td>
                                                               <td><button type="button" id="ViewPoints" onclick="viewreport('<?php echo  $pid ?>','<?php echo  $fid ?>','<?php echo $date; ?>','<?php echo $title; ?>')" name="ViewPoints" class="mb-xs mt-xs mr-xs btn btn-default" ><img src="icons/viewreport2.png" style="height:25px; width:25px;float:right" data-toggle="tooltip" title="View Report Table"></button></td>
                                                               
                                                           </tr>                  
                                                   <?php }}?>     
                                            </tbody>            
                                        </table>
								</div>
							</div>
						</section>


		<!-- Examples -->
		<script src="assets/javascripts/tables/examples.datatables.default.js"></script>
		<script src="assets/javascripts/tables/examples.datatables.row.with.details.js"></script>
		<script src="assets/javascripts/tables/examples.datatables.tabletools.js"></script>
   