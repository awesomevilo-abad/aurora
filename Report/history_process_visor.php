<?php  
 session_start(); 
	include_once 'class.php';
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
                                <th>Date Checked</th>
                                <th>Building </th>
                                <th>Phase</th>
                                <th>Area</th>
                                <th>Compliance</th>
                                <th>Non-Compliance</th>
                                <th>Auditted By</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                                $table = $crudcontroller->showHistory_visor($_POST['date']);
                                if (! empty($table)) {
                            foreach ($table as $k => $v) {

                        ?>
                            <tr class="">
                                <td class="center"><?php echo $table[$k]['Date_Checked'];?></td>
                                <td><?php echo $table[$k]['Name'];?></td>
                                <td><?php echo $table[$k]['PName'];?></td>
                                <td><?php echo $table[$k]['AName'];?></td>
                                <td style="background-color:#99ce901f" class="gallery">
                                    <!-- Show images  -->
                                    <?php
                                        $showarea = $conn->prepare("SELECT * FROM image_visor where Aid = :aid and type='compliance' ORDER BY Aid ASC");
                                        $showarea->execute(array(":aid"=>$table[$k]['Aid']));
                                        if($showarea->rowCount() > 0){
                                        while($rowshowarea = $showarea->fetch(PDO::FETCH_ASSOC)){
                                            $rowareaimage=$rowshowarea['imagename'];
                                    ?>
                                    
                                    <?php
                                        if(! empty($rowshowarea['imagename'])){
                                        ?>
                                        
                                            <a href="uploaded/<?php echo $rowareaimage ?>" data-lightbox="mygallery"
                                            data-title="
                                            <br><strong><label style='color:#f26f5a'>Location:  </label></strong><label style='color:#f3f3f3'><?php echo $table[$k]['AName'] ?></label>
                                            ">
                                            <img style="height:40px;width:55px;padding:0px;" src="uploaded/<?php echo $rowareaimage ?>"> </a>
                                        
                                        <?php
                                        
                                        }
                                        ?>
                                    <?php
                                                
                                        }
                                        }
                                    ?>
                                </td>

                                <td style="background-color:#ce9b9057" class="gallery">
                                    <!-- Show images  -->
                                    <?php
                                        $showarea = $conn->prepare("SELECT * FROM image_visor where Aid = :aid and type='noncompliance' ORDER BY Aid ASC");
                                        $showarea->execute(array(":aid"=>$table[$k]['Aid']));
                                        if($showarea->rowCount() > 0){
                                        while($rowshowarea = $showarea->fetch(PDO::FETCH_ASSOC)){
                                            $rowareaimage=$rowshowarea['imagename'];
                                    ?>
                                    
                                    <?php
                                        if(! empty($rowshowarea['imagename'])){
                                        ?>
                                        
                                            <a href="uploaded/<?php echo $rowareaimage ?>" data-lightbox="mygallery"
                                            data-title="
                                            <br><strong><label style='color:#f26f5a'>Location:  </label></strong><label style='color:#f3f3f3'><?php echo $table[$k]['AName'] ?></label>
                                            ">
                                            <img style="height:40px;width:55px;padding:0px;" src="uploaded/<?php echo $rowareaimage ?>"> </a>
                                        
                                        <?php
                                        
                                        }
                                        ?>
                                    <?php
                                                
                                        }
                                        }
                                    ?>
                                </td>

                                <td class="center"><?php echo $table[$k]['qastaff'];?></td>
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

