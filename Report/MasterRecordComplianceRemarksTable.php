
                        <section class="panel">
							
                        <?php
                            include_once 'class.php';
                            $crudcontroller = new CrudController();
                            $dao = new Dao();
                            $conn = $dao->openConnection();
                            $Datetoday = $crudcontroller->getDate();
                        ?>    
                        <div class="panel-body">
								<div class="table-responsive">
                                    <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf"> 
                                        <thead>
                                            <tr>
                                            <th>Record Code</th>
                                            <th>Remarks</th>
                                            <th>Date</th>
                                            <th colspan="3" style="text-align:center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                                <?php
                                                     
                                                         $complianceid=$_POST['complianceid'];
                                                         $date=$_POST['date'];
                                                        $table = $crudcontroller->loadremarksresultcomplianceremarks($_POST['complianceid']);
                                                       
                                                        if (! empty($table)) {
                                                        foreach ($table as $k => $v) {
                                                             $rid =$table[$k]['Crid'];
                                                             $Complianceremarks =$table[$k]['Complianceremarks'];
                                                             $date =$table[$k]['Date_Created'];
                                                    ?>
                                                        <tr style="text-align:center;">
                                                            <td><?php echo $rid; ?></td>
                                                            <td><?php echo $Complianceremarks; ?></td>
                                                            <td><?php echo $date; ?></td>
                                                         
                                                            <td><button type="button" id="<?php echo $rid?>" class="bn-deletecomplianceremarks mb-xs mt-xs mr-xs btn btn-default"><img src="icons/remove.png" style="height:25px; width:25px;float:right" data-toggle="tooltip" title="Remove Data"></button></td>
                                                            
                                                        </tr>                  
                                                <?php }
                                            
                                            
                                            
                                            }?>     
                                                </tbody>            
                                     </table>
								</div>
							</div>
						</section>
                        <?php
                           ?>
                           <footer class="panel-footer">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button class="btn btn-warning" id="btnAddCorrection" onclick="AddCorrection()" > Submit</button>
                                        <button type="button" onclick ="closecompliancecorrection()" class="btn btn-default">Back</button>
                                    </div>
                                </div>
                            </footer>
                           <?php
                       
                        ?>

              

                        

                        


		<!-- Examples -->
		<script src="assets/javascripts/tables/examples.datatables.default.js"></script>
		<script src="assets/javascripts/tables/examples.datatables.row.with.details.js"></script>
		<script src="assets/javascripts/tables/examples.datatables.tabletools.js"></script>
   