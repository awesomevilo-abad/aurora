
    <?php 
        session_start(); 
        $_SESSION['AcName'];
        include_once 'Class.php';
        $crudcontroller = new CrudController();
        $dao = new Dao();
        $conn = $dao->openConnection();
    ?>
    
	<section class="panel col-sm-12">
        <div class="panel-body">
            <div class="table-responsive">
            <a class="pull-right"  href="printAuditStructural.php?phase=<?php echo $_POST['phase'] ?>&start_auditreport=<?php echo $_POST['start_auditreport']?>&end_auditreport=<?php echo $_POST['end_auditreport']?>&auditee=<?php echo $_SESSION['AcName']?>" style="border-top-left-radius:20px;border-top-right-radius:20px;height:30px;width:30px;background-color:#ff57229c;" ><img src="icons/pdf.png" style="height:20px; width:20px;margin:5px;" data-toggle="tooltip" title="Print / Save to PDF"></a>
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
                                
                                <th colspan="8"  style="text-align:center;background-color:#00476b;border-bottom:#00476b;color:#fdfdfd;border-top-right-radius:;">Structural </th> <!--<?php echo $table[$k]['protect_stru_grade'] ?> % -->
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
                            <td colspan="8" style="text-align:center;background-color:#0088cc;color:#fdfdfd"><strong><?php echo $table2[$k]['AName'];?></strong>
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
                            <td style="background-color:#0088cc26">Date Auditted</td>
                            <td style="background-color:#0088cc26">Equipment</td>
                            <td style="background-color:#0088cc26">Grade</td>
                            <td style="background-color:#0088cc26">Remarks</td>
                            <td style="background-color:#0088cc26">Status</td>
                            <td style="background-color:#0088cc26">Decline Reason</td>
                            <td style="background-color:#0088cc26">QA Staff</td>
                            <td style="background-color:#0088cc26">Protech/Supervisor</td>
                            </tr>
                            <?php
                                $showAreas = $conn->prepare("SELECT * FROM checklist_grade 
                                left join area on checklist_grade.Aid = area.Aid 
                                left join phase on checklist_grade.Pid = phase.Pid 
                                left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
                                left join accounts on timedatephase.protect = accounts.Acid
                                left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
                                left join building on checklist_grade.Bid = building.id 
                                WHERE checklist_grade.Aid ='".$table2[$k]['Aid']."' and checklist_grade.Date_Checked = '".$Date."'
                                Group By checklist_grade.Cid,checklist_grade.Date_Checked
                                ORDER BY area.Aid DESC");
                                $showAreas->execute();
                                WHILE($rowshowAreas = $showAreas->fetch(PDO::FETCH_ASSOC)){
                               
                            ?>
                            <tr>
                                <td><?php echo $rowshowAreas['Date_Checked'];?></td>
                                <td><?php echo $rowshowAreas['CName'];?></td>
                                <td><?php echo $rowshowAreas['Str_Grade'];?> %</td>
                                <td><?php echo $rowshowAreas['remarks'];?></td>
                                <td><?php echo $rowshowAreas['targetGrade_status_str'];?></td>
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
                                <td style="background-color:#47a4472e"><?php echo $table2[$k]['totalstrugrade'];?> %</td>
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

