
    
	<section class="panel col-sm-12">
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf"> 
                        <thead>
                            <tr>
                                <th>Building</th>
                                <th>Phase</th>
                                <th>Area</th>
                                <th>QA Staff</th>
                                <th>Protech</th>
                                <th>Sanitation</th>
                                <th>Structural</th>
                                <th>Equipment</th>
                                <th>Date Checked</th>
                                <th>View Area Checklist</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                                $table = $crudcontroller->filterreportave();
                                if (! empty($table)) {
                            foreach ($table as $k => $v) {

                        ?>
                            <tr class="">
                                <td><?php echo $table[$k]['Name'];?></td>
                                <td><?php echo $table[$k]['PName'];?></td>
                                <td><?php echo $table[$k]['AName'];?></td>
                            

                                <?php
                                if(! empty( $table[$k]['qastaff'])){
                                ?> <td> <?php   echo $table[$k]['qastaff']; ?> </td> <?php  
                                }else{
                                ?> <td style="background-color:#0088cc2b"> <?php   echo "On Going"; ?> </td> <?php  
                                }
                                ?>


                                <?php
                                if(! empty( $table[$k]['AcName'])){
                                ?> <td> <?php   echo $table[$k]['AcName']; ?> </td> <?php  
                                }else{
                                ?> <td style="background-color:#0088cc2b"> <?php   echo "On Going"; ?> </td> <?php  
                                }
                                ?>
                                
                                <!-- <td><?php echo $table[$k]['AcName'];?></td> -->
                                <td style="background-color:#99ce901f"><?php echo $table[$k]['totalsanigrade'];?></td>
                                <td style="background-color:#ce99901f"><?php echo $table[$k]['totalstrugrade'];?></td>
                                <td style="background-color:#cecd901f"><?php echo $table[$k]['totalequipgrade'];?></td>
                                <td class="center"><?php echo $table[$k]['Date_Checked'];?></td>
                                <td class="center"><a href="#"  onclick="ViewHistory('<?php echo $table[$k]['Aid']; ?>','<?php echo $table[$k]['AName']; ?>','<?php echo $table[$k]['Date_Checked']; ?>','<?php echo $table[$k]['PName']; ?>')" ><i class="fa fa-eye" aria-hidden="true"></i></a></td>
                            </tr>
                        <?php
                            }
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

