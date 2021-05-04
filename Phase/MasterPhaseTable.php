<?php
if (! empty($result)) {

?>
                        <section class="panel">
							
							<div class="panel-body">
								<div class="table-responsive">
                                    <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf"> 
                                        <thead>
                                            <tr>
                                            <th>Phase Code</th>
                                            <th>Building Name</th>
                                            <th>Phase Name</th>
                                            <th>Phase Icon</th>
                                            <th style="text-align:center;">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                                <?php
                                                    $table = $crudcontroller->readData();
                                                            if (! empty($table)) {
                                                        foreach ($table as $k => $v) {
                                                            $Pid = $table[$k]["Pid"];
                                                    ?>
                                                        <tr style="text-align:center;">
                                                            <td><?php echo $table[$k]["Pid"]; ?></td>
                                                            <td><?php echo $table[$k]["Name"]; ?></td>
                                                            <td><?php echo $table[$k]["PName"]; ?></td>
                                                            
                                                            <td>
                                                                <img style ="height:30px;width:35px" src="uploads/<?php echo $table[$k]["Image"]?>">
                                                            </td>
                                                            <td>
                                                            <button id="<?php echo $table[$k]["Pid"]; ?>" class="bn-edit mb-xs mt-xs mr-xs btn btn-default"><img src="icons/edit.png" style="height:25px; width:25px"></button>
                                                            <button id="<?php echo $table[$k]["Pid"]; ?>" class="bn-delete mb-xs mt-xs mr-xs btn btn-default"><img src="icons/delete.png" style="height:25px; width:25px"></button>
                                                          
                                                        
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
        
        function Modal(Pid){
                $.ajax({
                    url: 'Phase/modal_content.php',
                    type: 'POST',
                    data:{id:Pid},
                    success:function(response){
                        $("#sample").click();
                        $("#phid").val(Pid);
                        $("#user").html(response);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status);
                        alert(thrownError);
                    }
                });

            }

            
            function ModalChange(Pid){
                $.ajax({
                    url: 'Phase/modal_content.php',
                    type: 'POST',
                    data:{id:Pid},
                    success:function(response){
                        $("#change").click();
                        $("#phid").val(Pid);
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