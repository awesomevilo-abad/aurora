
							
                        <?php
                            include_once 'class.php';
                            $crudcontroller = new CrudController();
                            $dao = new Dao();
                            $conn = $dao->openConnection();
                        ?>    
<section class="panel">
    <div class="panel-body">
         <div class="table-responsive">
            <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
                    <thead>
                    <tr>
                        <th>Record Code</th>
                        <th>Phase</th>
                        <th>Concern</th>
                        <th>Remarks</th>
                        <!-- <th>Date Action</th> -->
                        <!-- <th colspan="3" style="text-align:center">Actions</th> -->
                    </tr>
                    </thead>
                    <tbody>
                            <?php
                                    $fidrem=$_POST['fid'];
                                    $table = $crudcontroller->loadremarksresultcompliance($_POST['fid']);
                                    if (! empty($table)) {
                                    foreach ($table as $k => $v) {
                                            $rid =$table[$k]['Rid'];
                                            $pid =$table[$k]['Pid'];
                                            $compliance_concern =$table[$k]['compliance_concern'];
                                            $date =$table[$k]['Date_Created'];
                                            echo $Complianceremarks = $table[$k]['Complianceremarks'];
                                ?>
                                    <tr style="text-align:center;">
                                        <td><?php echo $rid; ?></td>
                                        <?php
                                        $phase = $conn->prepare("SELECT * FROM Phase WHERE Pid = :id");
                                        $phase->execute(array(":id"=> $pid));
                                        $rowphase = $phase->fetch(PDO::FETCH_ASSOC);
                                        ?>
                                        <td><?php echo $rowphase["PName"]; ?></td>
                                        <td><?php echo $compliance_concern; ?></td>
                                        
                                        <td >
                                        <?php
                                        if($Complianceremarks==""){
                                            ?>
                                            <button onclick="addRemarks('<?php echo $rid ?>','<?php echo $date ?>','<?php echo $compliance_concern ?>')" type="button" class="btn-xs btn btn-success">Add Remarks</button>
                                            <?php
                                        }else{
                                            $phase = $conn->prepare("SELECT * FROM remarkpoints_detailed_complianceremarks WHERE complianceid = :rid");
                                            $phase->execute(array(":rid"=> $rid));
                                            while($rowphase = $phase->fetch(PDO::FETCH_ASSOC)){
                                               ?><strong>*</strong> <?php echo $rowphase['Complianceremarks']; ?><br> <?php ?> 
                                                <?php  
                                            }
                                            ?> 
                                            <button onclick="addRemarks('<?php echo $rid ?>','<?php echo $date ?>','<?php echo $compliance_concern ?>')" type="button" class="btn-xs btn btn-warning" >Edit </button> 
                                            <?php
                                        }
                                        ?>
                                        </td>

                                            
                                        <!-- <td><?php echo $date; ?></td> -->
                                        <!-- <td><button type="button" id="<?php echo $rid?>" class="bn-deleteremarks btn-xs btn btn-default"><img src="icons/remove.png" style="height:25px; width:25px;float:right" data-toggle="tooltip" title="Remove Data"></button></td> -->
                                        <!-- <td onclick="addImg_managepoints('<?php echo $type ?>','<?php echo $rid ?>','<?php echo $date ?>')"><button type="button" class="btn btn-xs btn-default"><img src="icons/camera.png" style="height:25px; width:25px;float:right" data-toggle="tooltip" title="Tag Images"></button></td> -->
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
       