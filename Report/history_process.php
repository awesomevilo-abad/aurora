
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
                                $table = $crudcontroller->showHistory();
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
                                ?>
                                <td>
                                    <?php
                                    $viewAcName = $conn->prepare("SELECT * FROM checklist_grade 
                                    left join phase on checklist_grade.Pid = phase.Pid 
                                    left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
                                    left join accounts on timedatephase.protect = accounts.Acid
                                    left join building on checklist_grade.Bid = building.id 
                                    Where checklist_grade.Date_Checked = '". $table[$k]['Date_Checked']."' 
                                    and checklist_grade.Pid = '".$table[$k]['Pid']."'
                                    and timedatephase.qastaff = '".$table[$k]['qastaff']."'
                                    Group By accounts.AcName , checklist_grade.Date_checked
                                    ORDER BY checklist_grade.Pid DESC");
                                    $viewAcName->execute(array());
                                    while($rowviewAcName = $viewAcName->fetch(PDO::FETCH_ASSOC)){
                                        echo " - ".$rowviewAcName['AcName'];
                                        
                                    }
                                    ?>
                                </td> 
                                 <?php  
                                }else{
                                ?> <td style="background-color:#0088cc2b"> <?php   echo "On Going"; ?> </td> <?php  
                                }
                                ?>
                                
                                <!-- <td><?php echo $table[$k]['AcName'];?></td> -->
                                <td style="background-color:#99ce901f"><?php echo $table[$k]['totalsanigrade'];?></td>
                                <td style="background-color:#ce99901f"><?php echo $table[$k]['totalstrugrade'];?></td>
                                <td style="background-color:#cecd901f"><?php echo $table[$k]['totalequipgrade'];?></td>
                                <td class="center"><?php echo $table[$k]['Date_Checked'];?></td>
                                
                                
                                <?php
                                    $showImage = $conn->prepare("SELECT * FROM image 
                                    left join area on  image.Aid = area.Aid  WHERE area.Aid = :Aid AND image.Date_Checked = :dateimage ORDER BY image.Aid DESC ");
                                    $showImage->execute(array(":Aid"=> $table[$k]['Aid'],":dateimage"=> $table[$k]['Date_Checked']));
                                //   $rowshowImage = $showImage->fetch(PDO::FETCH_ASSOC);
                                    
                                    if($showImage->rowCount() > 0){
                                        ?>
                                        <td  style="background-color:#99ce901f;size:10px;" class="center"><a href="#"  onclick="ViewHistory('<?php echo $table[$k]['Aid']; ?>','<?php echo $table[$k]['AName']; ?>','<?php echo $table[$k]['Date_Checked']; ?>','<?php echo $table[$k]['PName']; ?>')" ><i class="fa fa-eye" aria-hidden="true"></i></a>
                                          <label>With Image </label>  
                                        </td>
                                        <?php
                                    }else{
                                        ?>
                                        <td style="background-color:#f4eeed;size:10px;" class="center"><a href="#"  onclick="ViewHistory('<?php echo $table[$k]['Aid']; ?>','<?php echo $table[$k]['AName']; ?>','<?php echo $table[$k]['Date_Checked']; ?>','<?php echo $table[$k]['PName']; ?>')" ><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        <label> No Image Available</label>  
                                        </td>
                                        <?php
                                    }
                                ?>
                                
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

