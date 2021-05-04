
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
                                
                                $area= $_POST['area'];
                                $date= $_POST['date'];
                                $table = $crudcontroller->changedata_viewitemfindings($_POST["area"]);
                                if (! empty($table)) {
                            foreach ($table as $k => $v);
                        ?>
                            <tr>
                                <th  style="text-align:center;background-color:#34495ec2;color:#fdfdfd;border-top-left-radius:;"><strong><?php echo $table[$k]['AName'];?></strong></th>
                                <th  style="text-align:center;background-color:#34495ec2;color:#fdfdfd;border-top-right-radius:;">Score</th>
                            </tr>
                            
                        </thead>
                        <tbody>
                                 <?php
                                    $grades = $conn->prepare("SELECT * FROM checklist_grade 
                                    left join area on checklist_grade.Aid = area.Aid 
                                    left join phase on checklist_grade.Pid = phase.Pid 
                                    left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
                                    left join accounts on timedatephase.protect = accounts.Acid
                                    left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
                                    left join building on checklist_grade.Bid = building.id 
                                    WHERE checklist_grade.Aid = '".$area."' and checklist_grade.Date_checked = '".$date."'
                                    Group By checklist_grade.Cid, checklist_grade.Date_checked
                                    ORDER BY area.Aid ASC");
                                    $grades->execute();
                                    while($rowGrades = $grades->fetch(PDO::FETCH_ASSOC)){
                                 ?>
                                        <tr>
                                            <td><?php echo $rowGrades['CName'];?></td>
                                            <td><?php echo $rowGrades['Str_Grade'];?></td>
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

