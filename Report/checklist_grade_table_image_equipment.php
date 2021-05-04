
		<link rel="stylesheet" href="../assets/css/lightbox.min.css" />
		<script src="../assets/js/lightbox-plus-jquery.min.js"></script>

<div class="col-md-12">
													<div class="tabs">

														<!-- header -->
													

														<!-- start tab -->
														<div class="tab-content">
															<div id="sanistru" class="tab-pane active">
																<!-- <p>Data Here</p> -->
																<div class="panel-body">
                                                                    <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf"> 
                                                                        
                                                                        <thead>
                                                                            <td>
                                                                                Images
                                                                            </td>
                                                                           
                                                                        </thead>
                                                                        <tbody>
                                                                             <?php
                                                                                $table = $crudcontroller->showCheckGrade_image_equipment($_POST['date']);
                                                                                if (! empty($table)) {
                                                                                    ?>
                                                                                    <tr class="">
                                                                                     <td>
                                                                                       <?php 
                                                                                    foreach ($table as $k => $v) {
                                                                                   
                                                                                            if(! empty($table[$k]['imagename'])){
                                                                                                ?>
                                                                                                    <a href="uploaded/<?php echo $table[$k]['imagename'] ?>" data-lightbox="mygallery" 
                                                                                                    data-title="
                                                                                                    <br><strong><label style='color:#f3f3f3'><?php echo $table[$k]['AName'] ?></label>"> 
                                                                                                    <img style="height:100px;width:85px;padding:10px;background-color:#374e6059;border-radius:10px;" src="uploaded/<?php echo $table[$k]['imagename'] ?>"> </a>
                                                                                                  
                                                                                                <?php
                                                                                                
                                                                                             }else{
                                                                                                 ?> <td class="no-image-b"> <?php echo "No Image";?> </td> <?php
                                                                                             }
                                                                                    }
                                                                                    ?>
                                                                                    </td>
                                                                                </tr>
                                                                                <?php
                                                                                 }
                                                                                 ?>      
                                                                                     
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
							
											