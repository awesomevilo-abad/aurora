<?php

if (! empty($result)) {
?>
	<section class="panel">			

        <div class="row mg-files" data-sort-destination data-sort-id="media-gallery">
            <div class="isotope-item document">
                <?php
                if($_POST['id'] != 'VEHICLES'){
                   
                    ?><center><div style="background-color:#34495e;color:#ffffff;border-radius:10px;padding:.5px;margin-bottom:10px; width:60%"><h5>Choose Building</h5></div></center><?php

                }else{
                    
                    ?><center><div style="background-color:#34495e;color:#ffffff;border-radius:10px;padding:.5px;margin-bottom:10px; width:60%"><h5>Choose Vehicle</h5></div></center><?php
                }
                ?>
                
                <?php
                $cat = $_POST['id'];
                $pageType=$_POST['pageType'];
                
                           $table = $crudcontroller->viewBuilding($cat);
                            if (! empty($table)) {
                            foreach ($table as $k => $v) {
                            $Bid=$table[$k]['id'];
                            $Bname=$table[$k]['Name'];
                    ?>
                            <!-- start load -->
                            <div class="isotope-item document col-sm-6 col-md-4 col-lg-3">
                                <div class="thumbnail" style="background-color:#34495e;border-radius:10%;">
                                        <a class="thumb-image" onclick="viewPhase('<?php echo $Bid?>','<?php echo $pageType?>')" href="#" id="<?php echo $Bid?>">
                                        <img src="uploads/<?php echo $table[$k]["Image"]?>"style="height:250px;border-radius:10%;" > </a>
                                        <h5 style="text-align:center;color:#fff" class="mg-title text-semibold"><?php echo $Bname; ?></h5>
                                       
                                </div>
                            </div> 

                            <?php }}?>    
                        <!-- end load -->
           </div>
        </div>

    </section>
<?php
    }

?>