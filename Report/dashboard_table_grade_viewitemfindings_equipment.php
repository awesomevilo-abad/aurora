
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
                                $table = $crudcontroller->changedata_viewitemfindings_equipment($_POST["area"]);
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
                                    $grades = $conn->prepare("SELECT * FROM equipment_grade 
                                    left join area on equipment_grade.aid = area.Aid
                                    WHERE equipment_grade.aid = '".$area."' and equipment_grade.Name != 'No Equipment'
                                    Group By equipment_grade.eid, equipment_grade.Date_Checked_equipment
                                    ORDER BY equipment_grade.Date_Checked_equipment ASC");
                                    $grades->execute();
                                    while($rowGrades = $grades->fetch(PDO::FETCH_ASSOC)){
                                 ?>
                                        <tr>
                                            <td><?php echo $rowGrades['Name'];?></td>
                                            <td><?php echo $rowGrades['egrade'];?></td>
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

