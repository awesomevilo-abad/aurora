<?php
include_once 'Class.php';
$crudcontroller = new CrudController();
?>
	<section class="panel">			

        <div class="row mg-files" data-sort-destination data-sort-id="media-gallery">
            <div class="isotope-item document">
            
                       <?php
                            $id = $_POST['id2'];
                           $table = $crudcontroller->viewPhase2($id);
                            if (! empty($table)) {
                            foreach ($table as $k => $v) {
                                $Bid=$table[$k]['Bid'];
                                $Pid=$table[$k]['Pid'];
                            $PName=$table[$k]['PName'];  
                         ?>
                            <!-- start load -->
                            <div class="isotope-item document col-sm-6 col-md-4 col-lg-3">
                            <a href="#" onclick="loadData()" ><h5 style="text-decoration:none;text-align:center;color:#fff;background-color:#dfdfdf" class="mg-title text-bold">Back</h5></a>
                                <div class="thumbnail" style="background-color:#34495e;border-radius:10%;">
                                        <a class="thumb-image" onclick="ConfirmationModal('<?php echo $Pid?>')"  href="#" id="<?php echo $Pid?>">
                                        <img src="uploads/<?php echo $table[$k]["Image"]?>" style="width:250px;height:250px;border-radius:10%;"> </a>
                                        <h5 style="text-align:center;color:#fff" class="mg-title text-semibold"><?php echo $PName; ?></h5>
                                       
                                </div>
                            </div> 

                            <?php }}?>    
                        <!-- end load -->
           </div>
        </div>

    </section>
                                