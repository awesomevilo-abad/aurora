<?php

include_once 'Class.php';
$crudcontroller = new CrudController();
$dao = new Dao();
$conn = $dao->openConnection();
?>
		<link rel="stylesheet" href="../assets/css/lightbox.min.css" />
		<script src="../assets/js/lightbox-plus-jquery.min.js"></script>

<div class="col-md-12">
													<div class="tabs">

														<!-- header -->
														<ul class="nav nav-tabs nav-justified">
															<li class="active">
																<a href="#sanistru" data-toggle="tab" class="text-center">Sanitation and Structural</a>
															</li>
															<li>
																<a href="#equip" data-toggle="tab" class="text-center">Equipment</a>
															</li>
														</ul>

														<!-- start tab -->
														<div class="tab-content">
															<div id="sanistru" class="tab-pane active">
																<!-- <p>Data Here</p> -->
																<div class="panel-body">
                                                                    <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf"> 
                                                                        
                                                                        <thead>
                                                                            <tr>
                                                                                <th colspan="6" class="center" >  Sanitation and Structural </th>
                                                                            </tr>
                                                                            <tr style="font-size:10px;">
                                                                                <th  class="center">Area</th>
                                                                                <th  class="center">Checklist Name</th>
                                                                                <th  class="center">Sanitation Grade</th>
                                                                                <th  class="center">Structural Grade</th>
                                                                                <th  class="center">Remarks</th>
                                                                                <th  class="center">Image</th>
                                                                                
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                                <?php
                                                                                $table = $crudcontroller->showCheckGrade($_POST['date']);
                                                                                if (! empty($table)) {
                                                                                    foreach ($table as $k => $v) {
                                                                                    ?>
                                                                                    <tr class="">
                                                                                        <td  style="font-size:13px;" class="center"><?php echo $table[$k]['AName'];?></td>
                                                                                        <td  style="font-size:13px;" class="center"><?php echo $table[$k]['CName'];?></td>
                                                                                        <td  style="font-size:13px;" class="center"><?php echo $table[$k]['San_Grade'];?> %</td>
                                                                                        <td  style="font-size:13px;" class="center"><?php echo $table[$k]['Str_Grade'];?> %</td>

                                                                                       <?php 
                                                                                            if(! empty($table[$k]['remarks'])){
                                                                                               ?> <td > <?php echo $table[$k]['remarks']; ?> </td> <?php
                                                                                            }else{
                                                                                                ?> <td class="no-remarks-a"> <?php echo "No Remarks";?> </td> <?php
                                                                                            }
                                                                                                ?>
                                                                                                
                                                                                                    <?php
                                                                                                      $showImage = $conn->prepare("SELECT * FROM image WHERE Cid = :Cid AND Date_Checked = :dateimage ORDER BY Aid DESC ");
                                                                                                      $showImage->execute(array(":Cid"=> $table[$k]['Cid'],":dateimage"=> $table[$k]['Date_Checked']));
                                                                                                    //   $rowshowImage = $showImage->fetch(PDO::FETCH_ASSOC);
                                                                                                     
                                                                                                        if($showImage->rowCount() > 0){
                                                                                                            ?>
                                                                                                            <td style="" onclick="switchtomodalviewhistorygrade_image('<?php echo $table[$k]['Cid'];?>','<?php echo $table[$k]['CName'];?>','<?php echo $table[$k]['Date_Checked'];?>')">
                                                                                                            <button type="button" class="btn-xs btn btn-warning">View</button>
                                                                                                            </td>
                                                                                                            <?php
                                                                                                        }else{
                                                                                                            ?>
                                                                                                            <td class="no-remarks-a"> <?php echo "No Image";?> </td>
                                                                                                            <?php
                                                                                                        }
                                                                                                    ?>
                                                                                                    
                                                                                                <?php
                                                                                        ?>
                                                                                    </tr>
                                                                                    <?php
                                                                                    }
                                                                                 }
                                                                                     ?>       
                                                                                     <tr style="background-color:#fcc1366b" >
                                                                                        <td style="font-size:13px;" class="center">Total</td>
                                                                                        <td></td>
                                                                                        <td style="font-size:13px;" class="center"><?php echo $table[$k]['totalsanigrade'];?> %</td>
                                                                                        <td style="font-size:13px;" class="center"><?php echo $table[$k]['totalstrugrade'];?> %</td>
                                                                                        
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                    </tr>  
                                                                         </tbody>
                                                                    </table>
																</div>
															</div>

															<div id="equip" class="tab-pane">
																	<!-- <p>Data Here</p> -->
																	<div class="panel-body">
                                                                    <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf"> 
                                                                            
                                                                            <thead>
                                                                                <tr>
                                                                                    <th colspan="6" class="center" > Equipment </th>
                                                                                </tr>
                                                                                <tr style="font-size:10px;">
                                                                                    <th class="center">Area</th>
                                                                                    <th class="center">Equipment Name</th>
                                                                                    <th class="center">Equipment Grade</th>
                                                                                    <th class="center">Remarks</th>
                                                                                    <th class="center">Image</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                    <?php
                                                                                    $table = $crudcontroller->showEquipGrade($_POST['date']);
                                                                                    if (! empty($table)) {
                                                                                        foreach ($table as $k => $v) {
                                                                                        ?>
                                                                                        <tr class="">
                                                                                            <td style="font-size:13px;" class="center"><?php echo $table[$k]['AName'];?></td>
                                                                                            <td style="font-size:13px;" class="center"><?php echo $table[$k]['EName'];?></td>
                                                                                            <td style="font-size:13px;" class="center"><?php echo $table[$k]['egrade'];?> %</td>
                                                                                            <?php 
                                                                                            if(! empty($table[$k]['remarksequip'])){
                                                                                               ?> <td > <?php echo $table[$k]['remarksequip']; ?> </td> <?php
                                                                                            }else{
                                                                                                ?> <td class="no-remarks-a"> <?php echo "No Remarks";?> </td> <?php
                                                                                            }

                                                                                            ?>
                                                                                                   <?php
                                                                                                      $showImage = $conn->prepare("SELECT * FROM image WHERE Eid = :Eid AND Date_Checked = :dateimage ORDER BY Aid DESC ");
                                                                                                      $showImage->execute(array(":Eid"=> $table[$k]['eid'],":dateimage"=> $table[$k]['Date_Checked_equipment']));
                                                                                                    //   $rowshowImage = $showImage->fetch(PDO::FETCH_ASSOC);
                                                                                                     
                                                                                                        if($showImage->rowCount() > 0){
                                                                                                            if($table[$k]['edesc'] != 'No Equipment'){
                                                                                                            ?>
                                                                                                            <td onclick="switchtomodalviewhistorygrade_image_equipment('<?php echo $table[$k]['eid'];?>','<?php echo $table[$k]['Name'];?>','<?php echo $table[$k]['Date_Checked_equipment'];?>')">
                                                                                                                <button type="button" class="btn-xs btn btn-warning">View</button>
                                                                                                            </td>
                                                                                                            <?php
                                                                                                            }else{
                                                                                                                ?>
                                                                                                                <td class="no-remarks-a"> <?php echo "No Equipment";?> </td>
                                                                                                                <?php
                                                                                                            }
                                                                                                        }else{
                                                                                                            ?>
                                                                                                            <td class="no-remarks-a"> <?php echo "No Image";?> </td>
                                                                                                            <?php
                                                                                                        }
                                                                                                    ?>
                                                                                            <?php
                                                                                         
                                                                                        ?>
                                                                                        </tr>
                                                                                        <?php
                                                                                        }
                                                                                    }
                                                                                        ?>       
                                                                                        <tr style="background-color:#fcc1366b" >
                                                                                            <td style="font-size:13px;" class="center">Total</td>
                                                                                            <td></td>
                                                                                            <td style="font-size:13px;" class="center"><?php echo $table[$k]['totalequipgrade'];?> %</td>
                                                                                        <td></td>
                                                                                        <td></td>
                                                                                        </tr>  
                                                                            </tbody>
                                                                        </table>
																	</div>
															</div>
														</div>
													</div>
												</div>		

  

      



<!-- Examples -->
<!-- <script src="assets/javascripts/tables/examples.datatables.ajax.js"></script>
<script src="assets/javascripts/forms/examples.advanced.form.js" ></script>	    
 <script src="assets/javascripts/tables/examples.datatables.default.js"></script> 
<script src="assets/javascripts/tables/examples.datatables.tabletools.js"></script> -->


	<!-- Tab -->
							
											