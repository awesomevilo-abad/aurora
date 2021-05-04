<?php
if (! empty($result)) {

?>
	                    <section class="panel">
							
							<div class="panel-body">
								<div class="table-responsive">
                                    <table class="table table-bordered table-striped table-condensed mb-none">
                                        <thead>
                                            <tr>
                                            <th>Area Code</th>
                                            <th>Building Name</th>
                                            <th>Phase Name</th>
                                            <th>Area Name</th>
                                            <th>Percentage</th>
                                            <th>Date Created</th>
                                            <th>Icon</th>
                                            <th style="text-align:center;">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                                <?php
                                                    $table = $crudcontroller->readData();
                                                            if (! empty($table)) {
                                                        foreach ($table as $k => $v) {
                                                    ?>
                                                        <tr style="text-align:center;">
                                                            <td><?php echo $table[$k]["Aid"]; ?></td>
                                                            <td><?php echo $table[$k]["Name"]; ?></td>
                                                            <td><?php echo $table[$k]["PName"]; ?></td>
                                                            <td><?php echo $table[$k]["AName"]; ?></td>
                                                            <td><?php echo $table[$k]["Percentage"]; ?></td>
                                                            <td><?php echo $table[$k]["Date_Created"]; ?></td>
                                                            
                                                            <td>
                                                                <img style ="height:30px;width:35px" src="uploads/<?php echo $table[$k]["Image"]?>">
                                                            </td>
                                                            <td>
                                                            <button id="<?php echo $table[$k]["Aid"]; ?>" class="bn-edit mb-xs mt-xs mr-xs btn btn-warning fa fa-edit"></button>
                                                            <button id="<?php echo $table[$k]["Aid"]; ?>"class="bn-delete mb-xs mt-xs mr-xs btn btn-danger fa fa-trash-o"></button>
                                                            </td>
                                                        </tr>                  
                                                <?php }}?>     
                                                </tbody>
                                         </table>
								</div>
							</div>
						</section>
						
                     
   
<?php
    }

?>