
    <?php 
        session_start(); 
        include_once 'Class.php';
        $crudcontroller = new CrudController();
        $dao = new Dao();
        $conn = $dao->openConnection();
    ?>
    
	<section class="panel col-sm-12">
        <div class="panel-body">
            <div class="table-responsive">
            <a class="pull-right"  href="printAuditSanitationRemarks.php?phase=<?php echo $_POST['phase'] ?>&start_auditreport=<?php echo $_POST['start_auditreport']?>&end_auditreport=<?php echo $_POST['end_auditreport']?>&auditee=<?php echo $_SESSION['AcName']?>" style="border-top-left-radius:20px;border-top-right-radius:20px;height:30px;width:30px;background-color:#ff57229c;" ><img src="icons/pdf.png" style="height:20px; width:20px;margin:5px;" data-toggle="tooltip" title="Print / Save to PDF"></a>
                <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf"> 
                        <thead>
                        <?php   
                                
                              $start_auditreport = date('Y-m-d',strtotime($_POST['start_auditreport']));
                              $end_auditreport= date('Y-m-d',strtotime($_POST['end_auditreport']));
                                 $area= $_POST['area'];
                                $table = $crudcontroller->filterReports_checklist();
                                if (! empty($table)) {
                            foreach ($table as $k => $v);
                            
                        ?>
                            <tr>
                                <b>Note:</b> <span style="background-color:#da8d6221">Red Background</span> remarks were inputted by QA staff
                                <th colspan="8"  style="text-align:center;background-color:#47a447;border-bottom:;color:#fdfdfd;border-top-right-radius:;">Sanitation</th>
                            </tr>
                           
                            
                        </thead>
                        <tbody>
                        
                        <tr>
                             <?php
                            $table2 = $crudcontroller->filterReports_checklist();
                            if (! empty($table2)) {
                            ?><tr><?php
                            foreach ($table2 as $k => $v){
                             $Date= $table2[$k]['Date_Checked'];
                            ?>
                            <td colspan="8" style="text-align:center;background-color:#47a4477a;color:#fdfdfd"><strong><?php echo $table2[$k]['AName'];?></strong>
                            <?php 
                                    $getpercent = $conn->prepare("SELECT * FROM area
                                    WHERE Aid ='".$table2[$k]['Aid']."'
                                --  Group By Aid
                                    ORDER BY Aid ASC");
                                    $getpercent->execute();
                                    $rowgetpercent = $getpercent->fetch(PDO::FETCH_ASSOC);
                                    $percentage = $rowgetpercent['Percentage'];
                            ?> %
                                <small>(<?php echo $rowgetpercent['Percentage'] * 100; ?>)</small>
                            </td>
                                  
                                
                                <?php
                           
                            ?></tr>
                            <tr>
                            <td style="background-color:#47a44733">Date Auditted</td>
                            <td style="background-color:#47a44733">Sanitation Remarks</td>
                            <td style="background-color:#47a44733">Grade</td>
                            <td style="background-color:#47a44733">Remarks</td>
                            <td style="background-color:#47a44733">Status</td>
                            <td style="background-color:#47a44733">QA Staff</td>
                            <td style="background-color:#47a44733">Protech/Supervisor</td>
                            </tr>
                            <?php
                                $showAreas = $conn->prepare("SELECT checklist_grade.Date_Checked,
                                checklist_grade.CName,checklist_grade.San_Grade,checklist_grade.remarks
                                ,timedatephase.targetGrade_status_sani,timedatephase.declineReason,timedatephase.qastaff
                                ,checklist.Sani_One,checklist.Sani_Two FROM checklist_grade 
                                left join area on checklist_grade.Aid = area.Aid 
                                left join phase on checklist_grade.Pid = phase.Pid 
                                left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
                                left join accounts on timedatephase.protect = accounts.Acid
                                left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
                                left join building on checklist_grade.Bid = building.id 
                                left join checklist on checklist_grade.Aid = checklist.Aid
                                WHERE checklist_grade.Aid ='".$table2[$k]['Aid']."' and checklist_grade.Date_Checked = '".$Date."'
                                Group By checklist_grade.Cid,checklist_grade.Date_Checked
                                ORDER BY area.Aid DESC");
                                $showAreas->execute();
                                WHILE($rowshowAreas = $showAreas->fetch(PDO::FETCH_ASSOC)){
                                
                            ?>
                            <tr>
                                <td><?php echo $rowshowAreas['Date_Checked'];?></td>
                                <td><?php echo $rowshowAreas['CName'];?></td>
                                <td><?php echo $rowshowAreas['San_Grade'];?> %</td>
                                
                                <?php
                                if($rowshowAreas['remarks']==""){
                                   if($rowshowAreas['San_Grade'] == 100){
                                    ?> <td></td> <?php
                                   }
                                   else if($rowshowAreas['San_Grade'] == 75){
                                    ?> <td><?php echo $rowshowAreas['Sani_Two'];?></td> <?php
                                   }
                                   else if($rowshowAreas['San_Grade'] == 50){
                                    ?> <td><?php echo $rowshowAreas['Sani_One'];?></td> <?php
                                   }
                                }else{
                                   ?> <td style="background-color:#da8d6221"><?php echo $rowshowAreas['remarks'];?></td> <?php
                                }
                                ?>

                               


                                <td><?php echo $rowshowAreas['targetGrade_status_sani'];?></td>
                                <td><?php echo $rowshowAreas['qastaff'];?></td>
                                <td>
                                    <?php
                                    $viewAcName = $conn->prepare("SELECT * FROM checklist_grade 
                                    left join phase on checklist_grade.Pid = phase.Pid 
                                    left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
                                    left join accounts on timedatephase.protect = accounts.Acid
                                    left join building on checklist_grade.Bid = building.id 
                                    Where checklist_grade.Date_Checked = '". $table2[$k]['date_checked']."' 
                                    and checklist_grade.Pid = '".$table2[$k]['Pid']."'
                                    and timedatephase.qastaff = '".$table2[$k]['qastaff']."'
                                    Group By accounts.AcName , checklist_grade.Date_checked
                                    ORDER BY checklist_grade.Pid ASC");
                                    $viewAcName->execute(array());
                                    while($rowviewAcName = $viewAcName->fetch(PDO::FETCH_ASSOC)){
                                        echo " - ".$rowviewAcName['AcName'];
                                        
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                
                           
                            
                             
                            // print_r($arraygrades);

                            }
                            
                        ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td style="background-color:#47a4472e"><?php echo $table2[$k]['totalsanigrade'];?> %</td>
                            </tr>

                        <?php
                        
                        }
                            ?>
                        </tr>
                                        
                               
                            <?php
                            
                        }
                         }
                        ?>
                        
                        </tbody>
                 </table>
            </div>
        </div>
     </section>
        
        <!-- Gallery -->
        <!-- <?php include_once 'history_pic.php'; ?> -->

<!-- Examples -->
<script src="assets/javascripts/tables/examples.datatables.ajax.js"></script>
<script src="assets/javascripts/forms/examples.advanced.form.js" ></script>	    
<script src="assets/javascripts/tables/examples.datatables.default.js"></script>
<script src="assets/javascripts/tables/examples.datatables.tabletools.js"></script>
<!-- <script src="assets/javascripts/ui-elements/examples.modals.js"></script> -->

