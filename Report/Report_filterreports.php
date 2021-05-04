
    <?php 
        session_start(); 
        include_once 'Class.php';
        $crudcontroller = new CrudController();
        $dao = new Dao();
        $conn = $dao->openConnection();
        $_SESSION['AcName'];
    ?>
    
	<section class="panel col-sm-12">
        <div class="panel-body">
            <div class="table-responsive">
           <a class="pull-right"  href="printAudit.php?building=<?php echo $_POST['building'] ?>&start_auditreport=<?php echo $_POST['start_auditreport']?>&end_auditreport=<?php echo $_POST['end_auditreport']?>&auditee=<?php echo $_SESSION['AcName']?>" style="border-top-left-radius:20px;border-top-right-radius:20px;height:30px;width:30px;background-color:#ff57229c;" ><img src="icons/pdf.png" style="height:20px; width:20px;margin:5px;" data-toggle="tooltip" title="Print / Save to PDF"></a>
                <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf"> 
                        <thead>
                            <?php   
                                    $building= $_POST['building'];
                                     $start_auditreport=$_POST['start_auditreport'];
                                     $end_auditreport=$_POST['end_auditreport'];
                                    $table = $crudcontroller->filterreports();
                                    if (! empty($table)) {
                                foreach ($table as $k => $v);
                            ?>
                            <tr>
                                <th colspan="3" style="text-align:center;background-color:#34495ec2;color:#fdfdfd;border-top-left-radius:;"><strong>All</strong></th>
                                <th colspan="5"  style="text-align:center;background-color:#34495ec2;color:#fdfdfd;border-top-right-radius:;">Score</th>
                            </tr>
                            
                        </thead>
                        <tbody>
            
                            <tr>
                                <td style="background-color:#34495e42">Date</td>
                                <td style="background-color:#34495e42"><?php echo $table[$k]['Name'];?></td>
                                <td style="background-color:#34495e42">Sanitation</td>
                                <td style="background-color:#34495e42">Structural</td>
                                <td style="background-color:#34495e42">Equipment</td>
                                <td style="background-color:#34495e42">QA Staff</td>
                                <td style="background-color:#34495e42">Protect</td>
                                
                            </tr>

                                 <?php
                                    $table2 = $crudcontroller->filterreports();
                                    if (! empty($table2)) {
                                foreach ($table2 as $k => $v){
                                 ?>
                                        <tr>
                                            <td><?php echo $table2[$k]['date_checked'];?></td>
                                            <td><?php echo $table2[$k]['PName'];?></td>
                                            <td><?php echo $table2[$k]['protect_sani_grade'];?> %</td>
                                            <td><?php echo $table2[$k]['protect_stru_grade'];?> %</td>
                                            <td><?php echo $table2[$k]['protect_equip_grade'];?> %</td>
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
                                }
                                ?>
                            <?php
                            
                        }}
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

