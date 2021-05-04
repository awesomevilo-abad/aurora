<?php
session_start(); 
include_once 'Class.php';
$crudcontroller = new CrudController();
$dao = new Dao();
$conn = $dao->openConnection();
 $Datetoday = $crudcontroller->getDate();
 
 $getName = $conn->prepare("SELECT * FROM accounts WHERE Username=:pid");
$getName->execute(array(":pid"=>$_SESSION['username']));
$rowgetName = $getName->fetch(PDO::FETCH_ASSOC);
$qastaff =  $rowgetName['AcName'];

                                
//  PINALITAN ANG $Datetodayminusfive  FROM -4 TO -5 PARA MAQUERY YUNG LATEST AUDIT NI QA WITHIN 5 DAYS AS A RESULT NA DAGDAGAN NG 1 DAY DISABILITY YUNG NA AUDITED PHASED
 $Datetodayminusfive = date('Y-m-d', strtotime($Datetoday. ' - 5 days'));



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
                                        
                                        $getWeekMonthYear = $conn->prepare("SELECT  week,month,year FROM checklist_grade WHERE Pid=:Pid GROUP BY week,month,year ORDER BY Date_Checked DESC LIMIT 1 ");
                                        $getWeekMonthYear->execute(array(":Pid"=> $pidd));
                                        $rowgetWeekMonthYear = $getWeekMonthYear->fetch(PDO::FETCH_ASSOC);
                                        $week=$rowgetWeekMonthYear['week'];
                                        $month=$rowgetWeekMonthYear['month'];
                                        $year=$rowgetWeekMonthYear['year'];
                                        

                                        $getPhase2 = $conn->prepare("SELECT Pid,PName,Image
                                        FROM phase  
                                        WHERE Pid = '".$pidd."' AND Pid NOT IN (Select Pid from checklist_grade where status = 'Phase Completed' AND (Date_Checked >= '$Datetodayminusfive' AND Date_Checked <= '$Datetoday')) 
                                        ORDER BY PName ASC ");
                                        $getPhase2->execute();
                                        $rowgetPhase2 = $getPhase2->fetch(PDO::FETCH_ASSOC);


                                            $Pid = $rowgetPhase2['Pid'];
                                            $PName = $rowgetPhase2['PName'];
                                            $PImage = $rowgetPhase2['Image'];
                                            $getDateChecked = $conn->prepare("SELECT DISTINCT Date_Checked, Aid from checklist_grade where Pid ='$pidd' AND status = 'Phase On Going' and week = '$week' and month = '$month' and year = '$year' ORDER BY Date_Checked ASC LIMIT 1 ");
                                            $getDateChecked->execute();
                                            $rowdatechecked = $getDateChecked->fetch(PDO::FETCH_ASSOC);
                                            $datechecked = date('M d Y (D)',strtotime($rowdatechecked['Date_Checked']));
                                            // Additional Code 08052020 For 5 days Cutoff
                                            $AuditCutoff = date('M d Y (D)', strtotime($rowdatechecked['Date_Checked']. ' + 4 days'));
                                            $datecheckedTarget = date('Y-m-d', strtotime($rowdatechecked['Date_Checked']. ' + 4 days'));
                                            // End Additional
                                                                                        
                                            $origin = date_create($rowdatechecked['Date_Checked']);
                                            $target = date_create($datecheckedTarget);
                                            $diff=date_diff($origin,$target);

                                            
                                            $originOnGoing = date_create($rowdatechecked['Date_Checked']);
                                            $targetOnGoing = date_create($Datetoday);
                                            $diffOnGoing=date_diff($originOnGoing,$targetOnGoing);
                                            $noOfDays=$diff->format("%a");
                                            $onGoing=$diffOnGoing->format("%a");
                                            $RemainingDaysMinus4= $noOfDays-$onGoing;


                                            if($RemainingDaysMinus4 <= '0'){
                                                $expirationDayNo = "Expire Tomorrow";
                                            }else{
                                                $expirationDayNo = "Expire in ".($RemainingDaysMinus4)." day/s";
                                            }
                                            
                                            if(isset($Pid)){
                                                ?>
                                                <!-- start load -->
                                                <div class="isotope-item document col-sm-6 col-md-4 col-lg-3">
                                                <a href="#" onclick="loadCat()" ><h5 style="text-decoration:none;text-align:center;color:#fff;background-color:#dfdfdf" class="mg-title text-bold">Back</h5></a>
                                                    <div class="thumbnail" style="background-color:#34495e;border-radius:10%;height:400;">
                                                            <a class="thumb-image" onclick="ConfirmationModal('<?php echo $Pid?>','<?php echo $pageType?>','<?php echo $rowdatechecked['Date_Checked']?>', '<?php echo $datecheckedTarget?>')"  href="#" id="<?php echo $Pid?>">
                                                            <img style="height:250px;border-radius:10%;" src="uploads/<?php echo $PImage?>" > </a>
                                                            <h5 style="text-align:center;color:#fff" class="mg-title text-semibold">
                                                            <?php echo $PName;
                                                            
                                                            

                                                            
                                                            $getAuditAreaPerPhase = $conn->prepare("SELECT Pid,
                                                            COUNT(DISTINCT Aid) as countallaid, 
                                                            (SELECT COUNT(countAid) as countAid FROM (SELECT Aid countAid from checklist_grade where Pid ='$Pid' AND status = 'Phase On Going' and (Date_Checked >= '$Datetodayminusfive' AND Date_Checked <= '$Datetoday') GROUP BY Aid ORDER BY Aid DESC) as aidTable) as countAid 
                                                            from area 
                                                            where Pid ='$Pid' 
                                                            ORDER BY Aid DESC 
                                                            LIMIT 1
                                                            ");
                                                            $getAuditAreaPerPhase->execute();
                                                            $rowgetAuditAreaPerPhase = $getAuditAreaPerPhase->fetch(PDO::FETCH_ASSOC);
                                                            ?>
                                                            <p  style="color:#04182d;margin-top:10px;">
                                                            
                                                            <?php
                                                            
                                                            $AuditCutoffFormat = date('Y-m-d', strtotime($rowdatechecked['Date_Checked']. ' + 4 days'));
                                                             $DatetodayMinus1 =  date('Y-m-d', strtotime($Datetoday. ' - 1 days'));



                                                            if(($rowgetAuditAreaPerPhase['countAid'] != 0) && ($AuditCutoffFormat == $DatetodayMinus1)){
                                                                $getAreaForDecline = $conn->prepare("SELECT Aid,Percentage 
                                                                FROM area 
                                                                WHERE Pid = '$Pid' AND Aid NOT IN (
                                                                    SELECT Aid 
                                                                    FROM checklist_grade 
                                                                    WHERE Pid = '$Pid' AND status = 'Phase On Going' AND (Date_Checked >= '$Datetodayminusfive' AND Date_Checked <= '$Datetoday') AND Aid IN (SELECT Aid from area where Pid = '$Pid') GROUP BY Aid)
                                                                ");
                                                                $getAreaForDecline->execute();
                                                                while($rowgetAreaForDecline = $getAreaForDecline->fetch(PDO::FETCH_ASSOC)){
                                                                    $areaforChecklistDecline =$rowgetAreaForDecline['Aid'];
                                                                    $areaDecline[] = $rowgetAreaForDecline['Aid'];
                                                                    $sanitationGradeDecline[] =floatval(50);
                                                                    $totalsaniGradeDecline[] = (floatval(50)* floatval($rowgetAreaForDecline['Percentage']));
                                                                }
                                                                    
                                                                    $buildingDecline = $id;
                                                                    $phaseDecline = $Pid;
                                                                    $status = "Phase Completed";
                                                                   
                                                                    $count = $getAreaForDecline->rowCount();

                                                                    for($i=0;$i<$count;$i++){
                                                                       $in_aid = $areaDecline[$i];
                                                                       $in_sangrade = $sanitationGradeDecline[$i];
                                                                       $in_strgrade = $sanitationGradeDecline[$i];
                                                                       $in_totalsaniGradeDecline = $totalsaniGradeDecline[$i];

                                                        
                                                                       $getCheckForDecline = $conn->prepare("SELECT *
                                                                       FROM checklist 
                                                                       WHERE Aid = '$areaDecline[$i]'");
                                                                       $getCheckForDecline->execute();
                                                                       while($rowgetCheckForDecline = $getCheckForDecline->fetch(PDO::FETCH_ASSOC)){
                                                                   
                                                                             $cidDecline = $rowgetCheckForDecline['Cid'];
                                                                             $cnameDecline = $rowgetCheckForDecline['CName'];
                                                                        
                                                                       
                                                                        $stmt = $conn->prepare("INSERT INTO checklist_grade
                                                                        (Bid,Pid,PidCounter,Aid,Cid,CName,San_Grade,Str_Grade,totalsanigrade,totalstrugrade,status,Date_Checked,week,month,year)
                                                                        VALUES(:bid,:pid,:pid,:aid,:cid,:in_cname,:in_sangrade,:in_strgrade,:totalsanigrade,:totalstrgrade,:status,:datechecked,:week,:month,:year)");
                                                                        $stmt->bindParam(":bid", $buildingDecline);
                                                                        $stmt->bindParam(":pid", $phaseDecline);
                                                                        $stmt->bindParam(":aid", $in_aid);
                                                                        $stmt->bindParam(":cid", $cidDecline);
                                                                        $stmt->bindParam(":in_cname", $cnameDecline);
                                                                        $stmt->bindParam(":in_sangrade", $in_sangrade);
                                                                        $stmt->bindParam(":in_strgrade", $in_strgrade);
                                                                        $stmt->bindParam(":totalsanigrade", $in_totalsaniGradeDecline);
                                                                        $stmt->bindParam(":totalstrgrade", $in_totalsaniGradeDecline);
                                                                        $stmt->bindParam(":status", $status);
                                                                        $stmt->bindParam(":datechecked", $Datetoday);
                                                                        $stmt->bindParam(":week", $week);
                                                                        $stmt->bindParam(":month", $month);
                                                                        $stmt->bindParam(":year", $year);
                                                                        $stmt->execute();
                                                                       }

                                                                    

                                                                       $getEquipForDecline = $conn->prepare("SELECT *
                                                                       FROM equipment 
                                                                       WHERE Aid = '$areaDecline[$i]' AND `status` LIKE 'Active'");
                                                                       $getEquipForDecline->execute();
                                                                       while($rowgetEquipForDecline = $getEquipForDecline->fetch(PDO::FETCH_ASSOC)){

                                                                            $getEquipPercentageForDecline = $conn->prepare("SELECT percentageequip 
                                                                            FROM area WHERE Aid = '$areaDecline[$i]'
                                                                            ");
                                                                            $getEquipPercentageForDecline->execute();
                                                                            $rowgetEquipPercentageForDecline = $getEquipPercentageForDecline->fetch(PDO::FETCH_ASSOC);
                                                                                
                                                                                 $egrade =floatval(50);
                                                                                 $totalequipgrade = (floatval(50)* floatval($rowgetEquipPercentageForDecline['percentageequip']));
                                                                            
                                                                   
                                                                             $eidDecline = $rowgetEquipForDecline['Eid'];
                                                                             $enameDecline = $rowgetEquipForDecline['EName'];
                                                                             $eqty =0; //array
                                                                             $estatus = "Phase Completed"; //array
                                                                       
                                                                             $stmtequip = $conn->prepare("INSERT INTO equipment_grade(eid,bid,pid,aid,eqty,egrade,totalequipgrade,Name,statusequip,Date_Checked_equipment,week,month,year)
                                                                             VALUES(:eid,:bid,:pid,:aid,:eqty,:egrade,:totalequipgrade,:Name,:statusequip,:datecheckedeq,:week,:month,:year)");
                                                                             $stmtequip->bindParam(":bid", $buildingDecline);
                                                                             $stmtequip->bindParam(":pid", $phaseDecline);
                                                                             $stmtequip->bindParam(":eid", $eidDecline);
                                                                             $stmtequip->bindParam(":aid", $in_aid);
                                                                             $stmtequip->bindParam(":eqty", $eqty);
                                                                             $stmtequip->bindParam(":egrade", $egrade);
                                                                             $stmtequip->bindParam(":totalequipgrade", $totalequipgrade);
                                                                             $stmtequip->bindParam(":Name", $enameDecline);
                                                                             $stmtequip->bindParam(":statusequip", $estatus);
                                                                             $stmtequip->bindParam(":datecheckedeq", $Datetoday);
                                                                             $stmtequip->bindParam(":week", $week);
                                                                             $stmtequip->bindParam(":month", $month);
                                                                             $stmtequip->bindParam(":year", $year);
                                                                             $stmtequip->execute();
                                                                       }

                                                                      
                                                                       
                                                                    }
                                                                    $gettotalsanigrade = $conn->prepare("SELECT SUM(totalsanigrade) as gettotalsanigrade FROM (SELECT totalsanigrade  FROM `checklist_grade` WHERE `Pid` LIKE '$phaseDecline' AND `week` LIKE '$week' AND `month` LIKE '$month' AND `year` LIKE '$year' GROUP BY Aid) as gettotalsanigradetable");
                                                                    $gettotalsanigrade->execute();
                                                                    $rowgettotalsanigrade = $gettotalsanigrade->fetch(PDO::FETCH_ASSOC);
                                                                    $totalsanidecline = $rowgettotalsanigrade['gettotalsanigrade'];

                                                                    
                                                                    $gettotalstrugrade = $conn->prepare("SELECT SUM(totalstrugrade) as gettotalstrugrade FROM (SELECT totalstrugrade  FROM `checklist_grade` WHERE `Pid` LIKE '$phaseDecline' AND `week` LIKE '$week' AND `month` LIKE '$month' AND `year` LIKE '$year' GROUP BY Aid) as gettotalstrugradetable");
                                                                    $gettotalstrugrade->execute();
                                                                    $rowgettotalstrugrade = $gettotalstrugrade->fetch(PDO::FETCH_ASSOC);
                                                                    $totalstrudecline = $rowgettotalstrugrade['gettotalstrugrade'];

                                                                    
                                                                    $gettotalequipgrade = $conn->prepare("SELECT SUM(totalequipgrade) as gettotalequipgrade FROM (SELECT totalequipgrade  FROM `equipment_grade` WHERE `pid` LIKE '$phaseDecline' AND `week` LIKE '$week' AND `month` LIKE '$month' AND `year` LIKE '$year' GROUP BY aid) as gettotalequipgradetable");
                                                                    $gettotalequipgrade->execute();
                                                                    $rowgettotalequipgrade = $gettotalequipgrade->fetch(PDO::FETCH_ASSOC);
                                                                    $totalequipdecline = $rowgettotalequipgrade['gettotalequipgrade'];
                                                                    
                                                                 $user ='Incomplete';
                                                                 $targetgradestatus_sani = 'Incomplete';
                                                                 $targetgradestatus_str = 'Incomplete';
                                                                 $targetgradestatus_equip = 'Incomplete';
                                                                 $reason = 'Incomplete';
                                                                    $staff = $conn->prepare("INSERT INTO timedatephase (Bid,qastaff,protect,protect_sani_grade,protect_stru_grade,protect_equip_grade,week,month,year,declineReason,targetGrade_status_sani,targetGrade_status_str,targetGrade_status_equip,date_checked,date_reset,pid) 
                                                                     VALUES(:bid,:qastaff,:protect,:protect_sani_grade,:protect_stru_grade,:protect_equip_grade,:week,:month,:year,:declineReason,:targetsani,:targetstr,:targeteq,:date_checked,:date_reset,:pid)");
                                                                     $staff->bindParam(":bid", $buildingDecline);
                                                                     $staff->bindParam(":qastaff", $qastaff);
                                                                     $staff->bindParam(":protect", $user);
                                                                     $staff->bindParam(":protect_sani_grade", $totalsanidecline);
                                                                     $staff->bindParam(":protect_stru_grade", $totalstrudecline);
                                                                     $staff->bindParam(":protect_equip_grade", $totalequipdecline);
                                                                     $staff->bindParam(":week", $week);
                                                                     $staff->bindParam(":month", $month);
                                                                     $staff->bindParam(":year", $year);
                                                                     $staff->bindParam(":targetsani", $targetgradestatus_sani);
                                                                     $staff->bindParam(":targetstr", $targetgradestatus_str);
                                                                     $staff->bindParam(":targeteq", $targetgradestatus_equip);
                                                                     $staff->bindParam(":declineReason", $reason);
                                                                     $staff->bindParam(":date_checked", $Datetoday);
                                                                     $staff->bindParam(":date_reset", $Datetoday);
                                                                     $staff->bindParam(":pid", $phaseDecline);
                                                                     $staff->execute();
                                                    
                                                                    
                                                                
                                                            }else{
                                                             
                                                            }

                                                            if(($rowgetAuditAreaPerPhase['countAid'] != 0)){
                                                            

                                                                $getDateCheckedWhenDone = $conn->prepare("SELECT Date_Checked FROM checklist_grade WHERE Pid=:Pid AND  week = '$week' and month = '$month' and year = '$year' ORDER BY Date_Checked ASC LIMIT 1 ");
                                                                $getDateCheckedWhenDone->execute(array(":Pid"=> $rowgetAuditAreaPerPhase['Pid']));
                                                                $rowgetDateCheckedWhenDone = $getDateCheckedWhenDone->fetch(PDO::FETCH_ASSOC);

                                                                
                                                                $datecheckedDone = date('M d Y (D)',strtotime($rowgetDateCheckedWhenDone['Date_Checked']));   
                                                                $AuditCutoffDone = date('M d Y (D)', strtotime($rowgetDateCheckedWhenDone['Date_Checked']. ' + 5 days'));  

                                                                ?>
                                                                
                                                            
                                                            <p style="text-align:center;color:#fff;font-size:10px;" class="mg-title text-small"><?php echo 'Last Audit: '.$datecheckedDone; ?></p>
                                                            <p style="text-align:center;color:#fff;font-size:10px;" class="mg-title text-small"><?php echo 'Available Since: '.$AuditCutoffDone; ?></p>
                                                                <?php
                                                            }else{
                                                                echo  'Audit: '.$rowgetAuditAreaPerPhase['countAid'].' out of '.$rowgetAuditAreaPerPhase['countallaid'];
                                                                
                                                                $AuditCutoffDone = date('M d Y (D)', strtotime($rowdatechecked['Date_Checked']. ' +5 days'));
                                                                
                                                                ?>
                                                                
                                                                    <div style="margin:20;"> <p><small style="color:#fff;background-color:#f26969;padding:7px;border-radius:10px;"> <?php echo $expirationDayNo ?></small> </p> </div>
                                                                
                                                                    <p style="text-align:center;color:#fff;font-size:10px;" class="mg-title text-small"><?php echo 'Audit Start: '.$datechecked; ?></p>
                                                                    <p style="text-align:center;color:#fff;font-size:10px;" class="mg-title text-small"><?php echo 'Expire on: '.$AuditCutoffDone; ?></p>
                                                                
                                                                <?php
                                                            }
                                                        
                                                            ?>
                                                            </p>
                                                            </h5>
                                                        
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
                                            $datechecked = date('M d Y (D)',strtotime($rowdatechecked['Date_Checked']));
                                            // Additional Code 08052020 For 5 days Cutoff
                                            $AuditCutoff = date('M d Y (D)', strtotime($rowdatechecked['Date_Checked']. ' + 5 days'));
                                            // End Additional
                                            
                                            
                              

                                         
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
                                