
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

                                                                                            if(! empty($table[$k]['image'])){
                                                                                                ?>
                                                                                                <td class="gallery">
                                                                                                    <a href="uploaded/<?php echo $table[$k]['image'] ?>" data-lightbox="mygallery" 
                                                                                                    data-title="
                                                                                                    <br><strong><label style='color:#f26f5a'>Location:  </label></strong><label style='color:#f3f3f3'><?php echo $table[$k]['Name'] ?></label>
                                                                                                    /<label style='color:#f3f3f3'><?php echo $table[$k]['PName'] ?></label>
                                                                                                    /<label style='color:#f3f3f3'><?php echo $table[$k]['AName'] ?></label>
                                                                                                   
                                                                                                    <br><strong><label style='color:#f26f5a'>Image Name:  </label></strong><label style='color:#f3f3f3'><?php echo $table[$k]['image'] ?></label>
                                                                                                    <br><strong><label style='color:##f26f5a'>Remarks:  </label></strong><label style='color:#f3f3f3'><?php echo $table[$k]['remarks'] ?></label>
                                                                                                    "> <img style="height:40px;width:55px;padding:0px;" src="uploaded/<?php echo $table[$k]['image'] ?>"> </a>
                                                                                                    </td>
                                                                                                <?php
                                                                                                
                                                                                             }else{
                                                                                                 ?> <td class="no-image-b"> <?php echo "No Image";?> </td> <?php
                                                                                             }
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
                                                                                <tr>
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

                                                                                            if(! empty($table[$k]['imageequip'])){
                                                                                                if($table[$k]['imageequip'] == "decline"){
                                                                                                    ?> <td> declined  </td> <?php
                                                                                                }
                                                                                                else{
                                                                                                    ?>
                                                                                                    <td class="gallery">
                                                                                                        <a href="uploaded/<?php echo $table[$k]['imageequip'] ?>" data-lightbox="mygallery" 
                                                                                                        data-title="
                                                                                                        <br><strong><label style='color:#f26f5a'>Location:  </label></strong><label style='color:#f3f3f3'><?php echo $table[$k]['Name'] ?></label>
                                                                                                        /<label style='color:#f3f3f3'><?php echo $table[$k]['PName'] ?></label>
                                                                                                        /<label style='color:#f3f3f3'><?php echo $table[$k]['AName'] ?></label>
                                                                                                       
                                                                                                        <br><strong><label style='color:#f26f5a'>Image Name:  </label></strong><label style='color:#f3f3f3'><?php echo $table[$k]['imageequip'] ?></label>
                                                                                                        <br><strong><label style='color:##f26f5a'>Remarks:  </label></strong><label style='color:#f3f3f3'><?php echo $table[$k]['remarksequip'] ?></label>
                                                                                                        "> <img style="height:40px;width:55px;padding:0px;" src="uploaded/<?php echo $table[$k]['imageequip'] ?>"> </a>
                                                                                                        </td>
                                                                                                    <?php
                                                                                                }
                                                                                               
                                                                                                
                                                                                             }else{
                                                                                                 ?> <td class="no-image-b"> <?php echo "No Image";?> </td>
                                                                                                 <td></td>
                                                                                                 <td></td> <?php
                                                                                             }
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
							
											