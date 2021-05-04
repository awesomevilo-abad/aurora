
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
                                            <th>Correction</th>
                                            <th>Date</th>
                                            <th colspan="3" style="text-align:center">Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                                <?php
                                                        $Rid=$_POST['rid'];
                                                       
                                                       $table = $crudcontroller->loadCreateRecordCorrectiveData($Rid);
                                                       if (! empty($table)) {
                                                        foreach ($table as $k => $v) {
                                                             $rid =$table[$k]['Crid'];
                                                             $Correction =$table[$k]['CorrectionDetails'];
                                                             $date =$table[$k]['Date_Created'];
                                                    ?>
                                                        <tr style="text-align:center;">
                                                            <td><?php echo $rid; ?></td>
                                                            <td><?php echo $Correction; ?></td>
                                                            <td><?php echo $date; ?></td>
                                                            
                                                            <td><button type="button" id="<?php echo $rid?>" class="bn-deletecorrection mb-xs mt-xs mr-xs btn btn-default"><img src="icons/remove.png" style="height:25px; width:25px;float:right" data-toggle="tooltip" title="Remove Data"></button></td>
                                                            
                                                            <td style="width:100px;">
                                                                <button type="button" id="tagImage" onclick="AddtagImageCorrection('<?php echo $rid ?>','<?php echo $Rid?>',<?php echo $Datetoday?>);" class="btn-xs btn btn-default"><img src="icons/tag3.png" style="height:25px; width:25px;float:right" data-toggle="tooltip" title="Tag this photo"></button>
                                                            </td>

                                                            <td id="showTagImages_<?php echo $rid?>">
                                                            <?php 
                                                                $showcorrection = $conn->prepare("SELECT * FROM image_points_correction WHERE Fid = :rid and Crid =:crid and Date_Created =:date");
                                                                $showcorrection->execute(array(":rid"=> $Rid,":crid"=> $rid,":date"=> $Datetoday));
                                                                while($rowshowcorrection = $showcorrection->fetch(PDO::FETCH_ASSOC)){
                                                                    $imagename = $rowshowcorrection['CorrectionImage'];
                                                                    ?> 
                                                                    <img src='uploaded/<?php echo $imagename ?>' style="border-radius:10px;box-shadow: 2px 1px #666;height:50; width:50;margin:10px;">
                                                                    <?php
                                                                
                                                                    
                                                                    
                                                                }?> 
                                                            
                                                                    <input type="hidden" id="recordIdTextbox" value="<?php echo $rid?>"/>
                                                                
                                                                <button type="button" id="viewtagImage" onclick="loadTagImage('<?php echo $rid?>','<?php echo $pid?>','<?php echo $Datetoday?>');" class="btn-xs btn btn-default"><img src="icons/allimage.png" style="height:25px; width:25px;float:right" data-toggle="tooltip" title="View All photo"></button>
                                                            </td>
                                                            
                                                        </tr>                  
                                                <?php }
                                            
                                            
                                            
                                            }?>     
                                                </tbody>            
                                     </table>
								</div>
							</div>
						</section>
                        <?php
                        if(empty($table)){
                           ?>
                           <footer class="panel-footer">
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button class="btn btn-warning" id="btnAddCorrection" onclick="AddCorrection()" > Submit</button>
                                        <button type="button" onclick ="correctiveMode()" class="btn btn-default">Back</button>
                                    </div>
                                </div>
                            </footer>
                           <?php
                        }
                        else{
                            ?>
                            <footer class="panel-footer">
                                 <div class="row">
                                     <div class="col-md-12 text-right">
                                         <button type="button" onclick ="correctiveMode()" class="btn btn-default">Back</button>
                                     </div>
                                 </div>
                             </footer>
                            <?php
                        }
                        ?>

              

                        

                        


		<!-- Examples -->
		<script src="assets/javascripts/tables/examples.datatables.default.js"></script>
		<script src="assets/javascripts/tables/examples.datatables.row.with.details.js"></script>
		<script src="assets/javascripts/tables/examples.datatables.tabletools.js"></script>
   