
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
            <a class="pull-right"  href="printAuditPhase.php?building=<?php echo $_POST['building'] ?>&start_auditreport=<?php echo $_POST['start_auditreport']?>&end_auditreport=<?php echo $_POST['end_auditreport']?>&auditee=<?php echo $_SESSION['AcName']?>&phase=<?php echo $_POST['phase']?>" style="border-top-left-radius:20px;border-top-right-radius:20px;height:30px;width:30px;background-color:#ff57229c;" ><img src="icons/pdf.png" style="height:20px; width:20px;margin:5px;" data-toggle="tooltip" title="Print / Save to PDF"></a>
                <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf"> 
                        <thead>
                                <?php   
                                        $building= $_POST['building'];
                                        $start_auditreport=$_POST['start_auditreport'];
                                        $end_auditreport=$_POST['end_auditreport'];
                                        $phase= $_POST['phase'];
                                        $table = $crudcontroller->filterreports_phase();
                                        if (! empty($table)) {
                                    foreach ($table as $k => $v);

                                ?>
                            <tr>
                                <th colspan="2" style="text-align:center;background-color:#34495ec2;color:#fdfdfd;border-top-left-radius:;">All</th>
                                <th colspan="6"  style="text-align:center;background-color:#34495ec2;color:#fdfdfd;border-top-right-radius:;">Score</th>
                            </tr>
                            
                        </thead>
                        <tbody>
                        
                            <tr>
                                <td style="background-color:#34495e42">Date Audited</td>
                                <td style="background-color:#34495e42"><?php echo $table[$k]['PName'];?></td>
                                <td style="background-color:#34495e42">%Distribution</td>
                                <td style="background-color:#34495e42">Sanitation</td>
                                <td style="background-color:#34495e42">Structural</td>
                                <td style="background-color:#34495e42">Equipment</td>
                                <td style="background-color:#34495e42">QA Staff</td>
                                <td style="background-color:#34495e42">Protech</td>
                            </tr>

                                 <?php
                                    $table2 = $crudcontroller->filterreports_phase();
                                    if (! empty($table2)) {
                                foreach ($table2 as $k => $v){
                                 ?>
                                        <tr>
                                            <td><?php echo $table2[$k]['Date_Checked'];?></td>
                                            <td><?php echo $table2[$k]['AName'];?></td>
                                            <td>
                                                <?php 
                                                     $getpercent = $conn->prepare("SELECT * FROM area
                                                     WHERE Aid ='".$table2[$k]['Aid']."'
                                                    --  Group By Aid
                                                     ORDER BY Aid ASC");
                                                     $getpercent->execute();
                                                     $rowgetpercent = $getpercent->fetch(PDO::FETCH_ASSOC);
                                                     echo $rowgetpercent['Percentage'] * 100;
                                                ?> %
                                            </td>
                                            <td style="background-color:#47a4474a"><?php echo $table2[$k]['totalsanigrade'];?> %</td>
                                            <td style="background-color:#5bc0de40"><?php echo $table2[$k]['totalstrugrade'];?> %</td>
                                            <td style="background-color:#ed9c2840"><?php echo $table2[$k]['totalequipgrade'];?> %</td>
                                            <td><?php echo $table2[$k]['qastaff'];?></td>
                                            <td>
                                            <?php
                                            $viewAcName = $conn->prepare("SELECT * FROM checklist_grade 
                                            left join phase on checklist_grade.Pid = phase.Pid 
                                            left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
                                            left join accounts on timedatephase.protect = accounts.Acid
                                            left join building on checklist_grade.Bid = building.id 
                                            Where checklist_grade.Date_Checked = '". $table2[$k]['date_checked']."' 
                                            and checklist_grade.Bid = '".$building."'
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
                                $arraygrades[] = $rowgetpercent['Percentage'];
                                  $total = (array_sum($arraygrades) * 100);

                                  
                                $totalsanig[] = $table2[$k]['totalsanigrade'];
                                 $totalsani = (array_sum($totalsanig));

                                
                                $totalstrug[] = $table2[$k]['totalstrugrade'];
                                  $totalstru = (array_sum($totalstrug));

                                  
                                $totalequipg[] = $table2[$k]['totalequipgrade'];
                                $totalequip = (array_sum($totalequipg));
                                }
                                
                                ?>
                                  <tr>
                                            <td></td>
                                            <td></td>
                                            <?php  ?>
                                            
                                            <td><?php  echo $total ?> %</td>
                                            <td><?php echo $totalsani;?> %</td>
                                            <td><?php echo $totalstru;?> %</td>
                                            <td><?php echo $totalequip;?> %</td>
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

