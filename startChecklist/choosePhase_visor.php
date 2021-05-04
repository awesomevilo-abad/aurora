<?php
session_start(); 
include_once 'Class.php';
$crudcontroller = new CrudController();
$dao = new Dao();
$conn = $dao->openConnection();
$Datetoday = $crudcontroller->getDate();

$AcPos=$_SESSION['position'];
$AcName=  $_SESSION['AcName'];
$pageType = $_POST['pageType'];
?>
	<section class="panel">	
        <div class="row mg-files" data-sort-destination data-sort-id="media-gallery">
            <div class="isotope-item document">

                <center><div style="background-color:#34495e;color:#ffffff;border-radius:10px;padding:.5px;margin-bottom:10px; width:60%"><h5>Choose to start Checklist </h5></div></center>
                       <?php
                            $id = $_POST['id2'];

                            
                                $getPhaseRecord = $conn->prepare("SELECT Distinct * FROM checklist_grade WHERE Bid=:Bid GROUP BY Pid ORDER BY Pid ASC ");
                                $getPhaseRecord->execute(array(":Bid"=> $id));
                                $rowgetPhaseRecord = $getPhaseRecord->fetch(PDO::FETCH_ASSOC);
                                $phaserecordPid = $rowgetPhaseRecord['Pid'];
                                $datecheckedsystem = $rowgetPhaseRecord['Date_Checked'];
                                // kung may laman ang checklist_grade 
                                  
                                        $getPhase = $conn->prepare("SELECT * FROM phase WHERE Bid=:Bid GROUP BY Pid ORDER BY PName ASC ");
                                        $getPhase->execute(array(":Bid"=> $id));
                                        while($rowgetPhase = $getPhase->fetch(PDO::FETCH_ASSOC)){
                                            $Pid = $rowgetPhase['Pid'];
                                            $PName = $rowgetPhase['PName'];
                                            $PImage = $rowgetPhase['Image'];
                                            ?>
                                            <!-- start load -->
                                            <div class="isotope-item document col-sm-6 col-md-4 col-lg-3">
                                            <a href="#" onclick="loadCat()" ><h5 style="text-decoration:none;text-align:center;color:#fff;background-color:#dfdfdf" class="mg-title text-bold">Back</h5></a>
                                                <div class="thumbnail" style="background-color:#34495e;border-radius:10%;">
                                                        <a class="thumb-image" onclick="ConfirmationModal('<?php echo $Pid?>','<?php echo $pageType?>')"  href="#" id="<?php echo $Pid?>">
                                                        <img   style="height:250px;border-radius:10%;"src="uploads/<?php echo $PImage?>" > </a>
                                                        <h5 style="text-align:center;color:#fff" class="mg-title text-semibold"><?php echo $PName; ?></h5>
                                                        <!-- <h5 style="text-align:center;color:#fff" class="mg-title text-semibold"><?php echo $Pid; ?></h5> -->
                                                    
                                                </div>
                                            </div> 
                                            <?php
                                        }
                                    
                                
                                

                                    
                                   ?>    
                        <!-- end load -->
           </div>
        </div>

    </section>
                                