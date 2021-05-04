
							
                        <?php
                            include_once 'class.php';
                            $crudcontroller = new CrudController();
                            $dao = new Dao();
                            $conn = $dao->openConnection();
                            $Datetoday = $crudcontroller->getDate();
                        ?>    
<section class="panel">
    <div class="panel-body">
         <div class="table-responsive">
            <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
                    <thead>
                    <tr>
                        <th>Record Code</th>
                        <th>Phase</th>
                        <th>Type</th>
                        <th>Remarks</th>
                        <th>Specific</th>
                        <th>Corrective Action</th>
                        <th>Correction (Quick Solution)</th>
                        <th>Recommendation</th>
                        <!-- <th>Date Action</th> -->
                        <th colspan="3" style="text-align:center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                            <?php
                                    $fidrem=$_POST['fid'];
                                    $table = $crudcontroller->loadCreateRecordRemarksData($fidrem);
                                    if (! empty($table)) {
                                    foreach ($table as $k => $v) {
                                            $rid =$table[$k]['Rid'];
                                            $pid =$table[$k]['Pid'];
                                            $type =$table[$k]['type'];
                                            $MainRemarks =$table[$k]['MainRemarks'];
                                            $SpecificRemarks =$table[$k]['SpecificRemarks'];
                                            $CorrectiveAction =$table[$k]['CorrectiveAction'];
                                            $recommendation =$table[$k]['recommendation'];
                                            // $Correction =$table[$k]['Correction'];
                                            $date =$table[$k]['Date_Created'];
                                ?>
                                    <tr style="text-align:center;">
                                        <td><?php echo $rid; ?></td>
                                        <?php
                                        $phase = $conn->prepare("SELECT * FROM Phase WHERE Pid = :id");
                                        $phase->execute(array(":id"=> $pid));
                                        $rowphase = $phase->fetch(PDO::FETCH_ASSOC);
                                        ?>
                                        <td><?php echo $rowphase["PName"]; ?></td>
                                        <td><?php echo $type; ?></td>
                                        <td><?php echo $MainRemarks; ?></td>
                                        <td><?php echo $SpecificRemarks; ?></td>
                                        <td><?php echo $CorrectiveAction; ?></td>
                                        <?php 
                                            $showcorrection = $conn->prepare("SELECT * FROM remarkpoints_detailed_correction WHERE Rid = :rid");
                                            $showcorrection->execute(array(":rid"=> $rid));
                                            $rowshowcorrection = $showcorrection->fetch(PDO::FETCH_ASSOC);
                                            $Correction = $rowshowcorrection['CorrectionDetails'];
                                            if($Correction ==""){
                                                 ?> <td onclick="correctionMode('<?php echo $type ?>','<?php echo $rid ?>','<?php echo $date ?>','<?php echo $MainRemarks ?>','<?php echo $SpecificRemarks ?>','<?php echo $CorrectiveAction ?>')">
                                                 <button type="button" class="btn-xs btn btn-success">Add Correction</button>
                                                 </td> <?php
                                                }
                                            else{
                                               ?><td onclick="correctionMode('<?php echo $type ?>','<?php echo $rid ?>','<?php echo $date ?>','<?php echo $MainRemarks ?>','<?php echo $SpecificRemarks ?>','<?php echo $CorrectiveAction ?>')" >
                                               <?php echo $Correction; ?>  <button type="button" class="btn-xs btn btn-warning" >Edit <?php  
                                            } ?></button>
                                            </td>
                                        <td><?php echo $recommendation; ?></td>
                                      
                                        <td>
                                            <button type="button" id="<?php echo $rid?>" class="bn-editremarks btn-xs btn btn-default"><img src="icons/edit.png" style="height:25px; width:25px;float:right" data-toggle="tooltip" title="Edit and Update Data"></button></td>
                                        <td style="width:100px;">
                                             <button type="button" id="tagImage" onclick="AddtagImage('<?php echo $type ?>','<?php echo $rid?>',<?php echo $pid?>);" class="btn-xs btn btn-default"><img src="icons/tag3.png" style="height:25px; width:25px;float:right" data-toggle="tooltip" title="Tag this photo"></button>
                                        </td>

                                        <td id="showTagImages_<?php echo $rid?>">
                                        <?php 
                                            $showcorrection = $conn->prepare("SELECT * FROM image_points WHERE Fid = :rid and Pid =:pid");
                                            $showcorrection->execute(array(":rid"=> $rid,":pid"=> $pid));
                                            while($rowshowcorrection = $showcorrection->fetch(PDO::FETCH_ASSOC)){
                                                $imagename = $rowshowcorrection['imagename'];
                                                ?> 
                                                <img src='uploaded/<?php echo $imagename ?>' style="border-radius:10px;box-shadow: 2px 1px #666;height:50px; width:50px;margin:10px;">
                                                <?php
                                             
                                                 
                                                 
                                            }?> 
                                           
                                                <input type="hidden" id="recordIdTextbox" value="<?php echo $rid?>"/>
                                            
                                             <button type="button" id="viewtagImage" onclick="loadTagImage('<?php echo $rid?>','<?php echo $pid?>','<?php echo $Datetoday?>');" class="btn-xs btn btn-default"><img src="icons/allimage.png" style="height:25px; width:25px;float:right" data-toggle="tooltip" title="View All photo"></button>
                                        </td>
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
       