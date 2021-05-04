<?php
session_start(); 
include_once 'Class.php';
$crudcontroller = new CrudController();
$dao = new Dao();
$conn = $dao->openConnection();
 $Datetoday = $crudcontroller->getDate();
 $Datetodayminusfive = date('Y-m-d', strtotime($Datetoday. ' - 4 days'));


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
                                    if(isset($rowgetPhaseRecord['Pid'])){
                                      
                                        $getPhaseRecord2 = $conn->prepare("SELECT Distinct Pid FROM checklist_grade WHERE Bid=:Bid GROUP BY Pid ORDER BY Pid ASC ");
                                        $getPhaseRecord2->execute(array(":Bid"=> $id));
                                        while($rowgetPhaseRecord2 = $getPhaseRecord2->fetch(PDO::FETCH_ASSOC)){
                                        $pidd=$rowgetPhaseRecord2['Pid'];
                                        // echo $pidd;
                                        
                                        $getPhase2 = $conn->prepare("SELECT Pid,PName,Image
                                        FROM phase  
                                        WHERE Pid = '".$pidd."' AND Pid NOT IN (Select Pid from checklist_grade where status = 'Phase Completed' AND (Date_Checked >= '$Datetodayminusfive' AND Date_Checked <= '$Datetoday')) 
                                        ORDER BY PName ASC ");
                                        $getPhase2->execute();
                                     
                                       $rowgetPhase2 = $getPhase2->fetch(PDO::FETCH_ASSOC);


                                            $Pid = $rowgetPhase2['Pid'];
                                            $PName = $rowgetPhase2['PName'];
                                            $PImage = $rowgetPhase2['Image'];
                                            $getDateChecked = $conn->prepare("SELECT DISTINCT Date_Checked from checklist_grade where Pid ='$pidd' AND status = 'Phase Completed' ORDER BY Date_Checked DESC LIMIT 1 ");
                                            $getDateChecked->execute();
                                            $rowdatechecked = $getDateChecked->fetch(PDO::FETCH_ASSOC);
                                            $datechecked = date('M d (l)',strtotime($rowdatechecked['Date_Checked']));
                                            // Additional Code 08052020 For 5 days Cutoff
                                            $AuditCutoff = date('M d (l)', strtotime($rowdatechecked['Date_Checked']. ' + 5 days'));
                                            // End Additional
                                            
                                            if(isset($Pid)){
                                                ?>
                                                <!-- start load -->
                                                <div class="isotope-item document col-sm-6 col-md-4 col-lg-3">
                                                <a href="#" onclick="loadCat()" ><h5 style="text-decoration:none;text-align:center;color:#fff;background-color:#dfdfdf" class="mg-title text-bold">Back</h5></a>
                                                    <div class="thumbnail" style="background-color:#34495e;border-radius:10%;">
                                                            <a class="thumb-image" onclick="ConfirmationModal('<?php echo $Pid?>','<?php echo $pageType?>')"  href="#" id="<?php echo $Pid?>">
                                                            <img style="height:250px;border-radius:10%;" src="uploads/<?php echo $PImage?>" > </a>
                                                            <h5 style="text-align:center;color:#fff" class="mg-title text-semibold">
                                                            <?php echo $PName.'_'.$Pid?>
                                                            
                                                            </h5>
                                                            
                                                            <p style="text-align:center;color:#fff" class="mg-title text-small"><?php echo 'Last Audit: '.$datechecked; ?></p>
                                                            <p style="text-align:center;color:#fff" class="mg-title text-small"><?php echo 'Available Since: '.$AuditCutoff; ?></p>
                                                            <!-- <h5 style="text-align:center;color:#fff" class="mg-title text-semibold"><?php echo $Pid; ?></h5> -->
                                                        
                                                    </div>
                                                </div> 
                                                <?php
                                            }else{

                                            }
                                           
                                    }
                                    $getPhaseRecord3 = $conn->prepare("SELECT Distinct Pid FROM checklist_grade WHERE Bid=:Bid GROUP BY Pid ORDER BY Pid ASC ");
                                        $getPhaseRecord3->execute(array(":Bid"=> $id));
                                        while($rowgetPhaseRecord3 = $getPhaseRecord3->fetch(PDO::FETCH_ASSOC)){
                                        $pidd=$rowgetPhaseRecord3['Pid'];
                                        // echo $pidd;
                                        
                                        $getPhase3 = $conn->prepare("SELECT Pid,PName,Image
                                        FROM phase  
                                        WHERE Pid = '".$pidd."' AND Pid  IN (Select Pid from checklist_grade where status = 'Phase Completed' AND (Date_Checked >= '$Datetodayminusfive' AND Date_Checked <= '$Datetoday')) 
                                        ORDER BY PName ASC ");
                                        $getPhase3->execute();
                                     
                                       $rowgetPhase3 = $getPhase3->fetch(PDO::FETCH_ASSOC);


                                            $Pid = $rowgetPhase3['Pid'];
                                            $PName = $rowgetPhase3['PName'];
                                            $PImage = $rowgetPhase3['Image'];
                                            $getDateChecked = $conn->prepare("SELECT DISTINCT Date_Checked from checklist_grade where Pid ='$pidd' AND status = 'Phase Completed' ORDER BY Date_Checked DESC LIMIT 1 ");
                                            $getDateChecked->execute();
                                            $rowdatechecked = $getDateChecked->fetch(PDO::FETCH_ASSOC);
                                            $datechecked = date('M d (l)',strtotime($rowdatechecked['Date_Checked']));
                                            // Additional Code 08052020 For 5 days Cutoff
                                            $AuditCutoff = date('M d (l)', strtotime($rowdatechecked['Date_Checked']. ' + 5 days'));
                                            // End Additional
                                            
                                            
                                            if(isset($Pid)){
                                                ?>
                                                <!-- start load -->
                                                <div class="isotope-item document col-sm-6 col-md-4 col-lg-3">
                                                <a href="#" onclick="loadCat()" ><h5 style="text-decoration:none;text-align:center;color:#fff;background-color:#dfdfdf" class="mg-title text-bold">Back</h5></a>
                                                    <div class="thumbnail" style="background-color:#ce392b;border-radius:10%;">
                                                            <a class="thumb-image" onclick="completed('<?php echo $Pid?>')"  id="<?php echo $Pid?>">
                                                            <img  style="height:250px;border-radius:10%;" src="uploads/<?php echo $PImage?>" > </a>
                                                            <h5 style="text-align:center;color:#fff" class="mg-title text-semibold"><?php echo $PName.'_'.$Pid ?></h5>
                                                            <p style="text-align:center;color:#ffcbc3" class="mg-title text-semibold"><?php echo 'Last Audit: '.$datechecked; ?></p>
                                                            <p style="text-align:center;color:#ffcbc3" class="mg-title text-semibold"><?php echo 'Available On: '.$AuditCutoff; ?></p>
                                                            <!-- <h5 style="text-align:center;color:#fff" class="mg-title text-semibold"><?php echo $Pid; ?></h5> -->
                                                        
                                                    </div>
                                                </div> 
                                                <?php
                                            }else{

                                            }

                                         
                                    }
                                        
                                    }else{
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
                                    }
                                
                                

                                    
                                   ?>    
                        <!-- end load -->
           </div>
        </div>

    </section>
                                