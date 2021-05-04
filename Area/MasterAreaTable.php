
<?php
if (! empty($result)) {

?>
	<section class="panel">
        <div class="panel-body">
            <div class="table-responsive">
            <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf">
                    <thead>
                        <tr>
                        <th>Area Code</th>
                        <th>Phase Name</th>
                        <th>Area Name</th>
                        <th>Sanitation & Structural</th>
                        <th>Equipment</th>
                        <!-- <th>Staff</th> -->
                        <th style="text-align:center;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            $table = $crudcontroller->readData();
                                    if (! empty($table)) {
                                foreach ($table as $k => $v) {
                                    $Aid = $table[$k]["Aid"];
                            ?>
                                    <tr style="text-align:center;">
                                        <td><?php echo $table[$k]["Aid"]; ?></td>
                                        <td><?php echo $table[$k]["PName"]; ?>
                                        <label style="color:#e34126"> <small><strong><?php echo $table[$k]["Name"]; ?></strong></small></label></td>
                                        <td><?php echo $table[$k]["AName"]; ?></td>
                                        <td><?php echo $table[$k]["Percentage"]; ?></td>
                                        <?php
                                        if($table[$k]["percentageequip"] == 0){
                                            ?><td style="background-color:#e824241a">No Grade</td><?php
                                        }else{
                                            ?><td><?php echo $table[$k]["percentageequip"]; ?></td><?php
                                        }
                                        ?>
                                        <td>
                                            <button id="<?php echo $table[$k]["Aid"]; ?>" class="bn-edit mb-xs mt-xs mr-xs btn btn-default"><img src="icons/edit.png" style="height:25px; width:25px"></button>
                                            <button id="<?php echo $table[$k]["Aid"]; ?>" class="bn-delete mb-xs mt-xs mr-xs btn btn-default"><img src="icons/delete.png" style="height:25px; width:25px"></button>
                                            <!-- <?php 
                                            if(empty($table[$k]['AcName'])){
                                                ?>
                                                <a href="#" class="btn btn-xs btn-info" onclick="Modal('<?php echo $Aid?>')" >Assign</a>
                                                <?php
                                            }
                                            else{
                                                ?>
                                                <a href="#" class="btn btn-xs btn-success" onclick="ModalChange('<?php echo $Aid?>')" >Change</a>
                                                <?php
                                            }
                                            ?> -->
                                           
                                        </td>
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
       
       
        <script>
        
        function Modal(Aid){
                $.ajax({
                    url: 'Area/modal_content.php',
                    type: 'POST',
                    data:{id:Aid},
                    success:function(response){
                        $("#sample").click();
                        $("#arid").val(Aid);
                        $("#user").html(response);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status);
                        alert(thrownError);
                    }
                });

            }

            
            function ModalChange(Aid){
                $.ajax({
                    url: 'Area/modal_content.php',
                    type: 'POST',
                    data:{id:Aid},
                    success:function(response){
                        $("#change").click();
                        $("#arid").val(Aid);
                        $("#user").html(response);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status);
                        alert(thrownError);
                    }
                });

            }
        </script>

<?php
    }

?>