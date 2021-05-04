
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
                                     $building= $_POST['building'];
                                    $table = $crudcontroller->changedata_building_viewscores($_POST["building"]);
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
                                <td style="background-color:#34495e42">%Distribution</td>
                                <td style="background-color:#34495e42">Sanitation</td>
                                <td style="background-color:#34495e42">Structural</td>
                                <td style="background-color:#34495e42">Equipment</td>
                                <td style="background-color:#34495e42">QA Staff</td>
                                <td style="background-color:#34495e42">Protect</td>
                                
                            </tr>

                                 <?php
                                    $grades = $conn->prepare("SELECT * FROM checklist_grade 
                                    left join area on checklist_grade.Aid = area.Aid 
                                    left join phase on checklist_grade.Pid = phase.Pid 
                                    left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
                                    left join accounts on timedatephase.protect = accounts.Acid
                                    left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
                                    left join building on checklist_grade.Bid = building.id 
                                    WHERE checklist_grade.Bid ='".$building."' and timedatephase.protect_sani_grade != ''
                                    Group By checklist_grade.Bid, checklist_grade.Date_checked, checklist_grade.Pid
                                    ORDER BY checklist_grade.Date_checked DESC");
                                    $grades->execute();
                                    while($rowGrades = $grades->fetch(PDO::FETCH_ASSOC)){
                                 ?>
                                        <tr>
                                            <td><?php echo $rowGrades['date_checked'];?></td>
                                            <td><?php echo $rowGrades['PName'];?></td>
                                            <td><?php echo $rowGrades['Percentage'];?> %</td>
                                            <td><?php echo $rowGrades['protect_sani_grade'];?> %</td>
                                            <td><?php echo $rowGrades['protect_stru_grade'];?> %</td>
                                            <td><?php echo $rowGrades['protect_equip_grade'];?> %</td>
                                            <td><?php echo $rowGrades['qastaff'];?></td>
                                            <td><?php echo $rowGrades['AcName'];?></td>
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

