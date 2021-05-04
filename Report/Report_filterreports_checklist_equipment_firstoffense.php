
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
            <a class="pull-right"  href="printAuditEquipment1stOffense.php?phase=<?php echo $_POST['phase'] ?>&start_auditreport=<?php echo $_POST['start_auditreport']?>&end_auditreport=<?php echo $_POST['end_auditreport']?>&auditee=<?php echo $_SESSION['AcName']?>" style="border-top-left-radius:20px;border-top-right-radius:20px;height:30px;width:30px;background-color:#ff57229c;" ><img src="icons/pdf.png" style="height:20px; width:20px;margin:5px;" data-toggle="tooltip" title="Print / Save to PDF"></a>
                <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf"> 
                        <thead>
                        <?php   
                                
                               $start_auditreport = date('Y-m-d',strtotime($_POST['start_auditreport']));
                               $end_auditreport= date('Y-m-d',strtotime($_POST['end_auditreport']));
                                 $area= $_POST['area'];
                                $table = $crudcontroller->filterReports_checklist_equipment_firstoffense();
                                if (! empty($table)) {
                            foreach ($table as $k => $v);
                            
                        ?>
                            <tr>
                                
                                <th colspan="8"  style="text-align:center;background-color:#b4700d;border-bottom:#00476b;color:#fdfdfd;border-top-right-radius:;">Viewing of 1st Offense Equipment</th>
                            </tr>
                           
                            
                        </thead>
                        <tbody>
                        
                        <tr>
                             <?php
                            $table2 = $crudcontroller->filterReports_checklist_equipment_firstoffense();
                            if (! empty($table2)) {
                            ?><tr><?php
                            foreach ($table2 as $k => $v){
                                $Date= $table2[$k]['Date_Checked_equipment'];
                            ?>
                            <td colspan="8" style="text-align:center;background-color:#b4700db8;color:#fdfdfd"><strong><?php echo $table2[$k]['AName'];?></strong>
                            <?php 
                                    $getpercent = $conn->prepare("SELECT * FROM area
                                    WHERE Aid ='".$table2[$k]['Aid']."'
                                --  Group By Aid
                                    ORDER BY Aid ASC");
                                    $getpercent->execute();
                                    $rowgetpercent = $getpercent->fetch(PDO::FETCH_ASSOC);
                                    $percentage = $rowgetpercent['percentageequip'];
                            ?> %
                                <small>(<?php echo $rowgetpercent['percentageequip'] * 100; ?>)</small>
                            </td>
                                  
                                
                                <?php
                           
                            ?></tr>
                             <tr>
                            <td style="background-color:#b4700d30">Date Auditted</td>
                            <td style="background-color:#b4700d30">Equipment</td>
                            <td style="background-color:#b4700d30">Grade</td>
                            <td style="background-color:#b4700d30">Remarks</td>
                            <td style="background-color:#b4700d30">Status</td>
                            <td style="background-color:#b4700d30">Decline Reason</td>
                            <td style="background-color:#b4700d30">QA Staff</td>
                            <td style="background-color:#b4700d30">Protech/Supervisor</td>
                            </tr>
                            <?php
                                $phase= $_POST['phase'];
                                $area= $table2[$k]['Aid'];
                                $showAreas = $conn->prepare("SELECT * FROM equipment_grade 
                                left join area on equipment_grade.aid = area.Aid
                                left join phase on area.Pid = phase.Pid
                                left join timedatephase on area.Pid = timedatephase.Pid and equipment_grade.Date_Checked_equipment = timedatephase.Date_Checked 
                                left join accounts on timedatephase.protect = accounts.Acid
                                left join equipment on equipment_grade.eid = equipment.Eid
                                WHERE equipment_grade.egrade=75 and area.Pid = '".$phase."' and equipment_grade.aid = '".$area."'   and equipment_grade.Name != 'No Equipment' and equipment_grade.Date_Checked_equipment >='".$start_auditreport."' and equipment_grade.Date_Checked_equipment <='".$end_auditreport."' 
                                Group By equipment_grade.eid, equipment_grade.Date_Checked_equipment
                                ORDER BY area.Aid,equipment_grade.Date_Checked_equipment DESC");
                                $showAreas->execute();
                                WHILE($rowshowAreas = $showAreas->fetch(PDO::FETCH_ASSOC)){
                               
                            ?>
                            <tr>
                                <td><?php echo $rowshowAreas['Date_Checked_equipment'];?></td>
                                <td><?php echo $rowshowAreas['Name'];?> # <?php echo $rowshowAreas['Asset_Number'];?> </td>
                                <td><?php echo $rowshowAreas['egrade'];?> %</td>
                                <td><?php echo $rowshowAreas['remarksequip'];?></td>
                                <td><?php echo $rowshowAreas['targetGrade_status_equip'];?></td>
                                <td><?php echo $rowshowAreas['declineReason'];?></td>
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
                                <td style="background-color:#47a4472e"><?php echo $table2[$k]['totalequipgrade'];?> %</td>
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

