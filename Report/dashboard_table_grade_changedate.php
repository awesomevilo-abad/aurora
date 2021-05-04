
    <?php 
        include_once 'Class.php';
        $crudcontroller = new CrudController();
        $dao = new Dao();
        $conn = $dao->openConnection();
    ?>
    
	<section class="panel col-sm-12">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf"> 
                        <thead>
                                <?php   
                                        $phase= $_POST['phase'];
                                        $table = $crudcontroller->changedate($_POST["date"]);
                                        if (! empty($table)) {
                                    foreach ($table as $k => $v);

                                ?>
                            <tr>
                                <th colspan="2" style="text-align:center;background-color:#34495ec2;color:#fdfdfd;border-top-left-radius:;"><strong><?php echo $table[$k]['Date_Checked'];?></strong></th>
                                <th colspan="3"  style="text-align:center;background-color:#34495ec2;color:#fdfdfd;border-top-right-radius:;">Score</th>
                            </tr>
                            
                        </thead>
                        <tbody>
                     
                            <tr>
                                <td style="background-color:#34495e42"><?php echo $table[$k]['PName'];?></td>
                                <td style="background-color:#34495e42">%Distribution</td>
                                <td style="background-color:#34495e42">Sanitation</td>
                                <td style="background-color:#34495e42">Structural</td>
                                <td style="background-color:#34495e42">Equipment</td>
                            </tr>

                                 <?php
                                    $grades = $conn->prepare("SELECT * FROM checklist_grade 
                                    left join area on checklist_grade.Aid = area.Aid 
                                    left join phase on checklist_grade.Pid = phase.Pid 
                                    left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
                                    left join accounts on timedatephase.protect = accounts.Acid
                                    left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
                                    left join building on checklist_grade.Bid = building.id 
                                    WHERE checklist_grade.Pid ='".$phase."' and checklist_grade.Date_checked = '".$_POST['date']."'
                                    Group By checklist_grade.Aid, checklist_grade.Date_checked
                                    ORDER BY area.Aid ASC");
                                    $grades->execute();
                                    while($rowGrades = $grades->fetch(PDO::FETCH_ASSOC)){
                                 ?>
                                        <tr>
                                            <td><?php echo $rowGrades['AName'];?></td>
                                            <td><?php echo $rowGrades['Percentage'];?></td>
                                            <td><?php echo $rowGrades['totalsanigrade'];?></td>
                                            <td><?php echo $rowGrades['totalstrugrade'];?></td>
                                            <td><?php echo $rowGrades['totalequipgrade'];?></td>
                                        </tr>
                                <?php
                                }
                                ?>
                            <?php
                            
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

