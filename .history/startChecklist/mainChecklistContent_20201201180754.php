
    <?php 
        include_once 'Class.php';
        $crudcontroller = new CrudController();
        $dao = new Dao();
        $conn = $dao->openConnection();
        $id = $_POST['id'];
        $pageType = $_POST['pageType'];
        $week = $_POST['week'];
        $month = $_POST['month'];
        $year = $_POST['year'];
        $areaselected = $_POST['areaselected'];
        $from = $_POST['from'];
        $to = $_POST['to'];


         $selectedaidfromSkippedArea = $_POST['aid'];
        $Datetoday = $crudcontroller->getDate();
        $Datetodayminusfive = date('Y-m-d', strtotime($Datetoday. ' - 4 days'));
        $currentYear = date('Y',strtotime($Datetoday));
    ?>
<?php
if (! empty($result)) {

?>
     
    <!-- justified -->
    

    <div class="row">
    <center>
    <div id="loader">
    </div>
    </center>
    <div id="checklist" class="col-md-12">
        <form method="POST" action="viewing_grade.php" id="saveImage" enctype="multipart/form-data">
     
                        
                        <input type="hidden" name="pageType" id="pageType" value="<?php echo $pageType;?>"/> 
                        <input type="hidden" id="from" name="from"  value="<?php echo $from;?>"/> 
                        <input type="hidden" id="to" name="to" value="<?php echo $to;?>"/> 
                       <?php
                        // check kung may grade ang checklist ngayong araw sa isang phase
                        $gradesheader = $conn->prepare("SELECT * FROM checklist_grade WHERE Pid = :Pid AND (Date_Checked >= :from AND Date_Checked <= :to) ORDER BY Aid DESC ");
                        $gradesheader->execute(array(":Pid"=> $id,":from"=> $Datetodayminusfive,":to"=> $Datetoday));
                        $rowgradesheader = $gradesheader->fetch(PDO::FETCH_ASSOC);
                        
                        $getBuildingId = $conn->prepare("SELECT * FROM Phase WHERE Pid=:Pid ORDER BY Bid DESC ");
                        $getBuildingId->execute(array(":Pid"=> $id));
                        $rowggetBuildingId = $getBuildingId->fetch(PDO::FETCH_ASSOC);
                        $Bldgid = $rowggetBuildingId['Bid'];

                        $getBuildingCat = $conn->prepare("SELECT * FROM Building WHERE id=:Bid ORDER BY id DESC ");
                        $getBuildingCat->execute(array(":Bid"=> $Bldgid));
                        $rowgetBuildingCat = $getBuildingCat->fetch(PDO::FETCH_ASSOC);
                        $BldgCat = $rowgetBuildingCat['Category'];

                        ?>
                        <input type="hidden"name="Bid" value="<?php echo $Bldgid; ?>"/>
                        <?php

                        //#################################################
                        // ################# HEADER########################
                        // ################################################

                      
                            $showArea = $conn->prepare("SELECT * FROM area WHERE Pid=:Pid limit 1");
                            $showArea->execute(array(":Pid" => $id));
                            $rowareaheader = $showArea->fetch(PDO::FETCH_ASSOC);
                            // phase header
                            $phaseheader = $conn->prepare("SELECT * FROM phase WHERE Pid=:Pid ORDER BY Pid ASC LIMIT 1"); 
                            $phaseheader->execute(array(":Pid" => $rowareaheader['Pid']));
                            if($phaseheader->rowCount() > 0){
                            while($rowphaseheader = $phaseheader->fetch(PDO::FETCH_ASSOC)){
                                ?>  <h2 class="panel-title"style="text-align:center;background-color:#ca6f03;color:#ffff;margin-top:-11px;font-size:15px;"><?php echo $rowphaseheader['PName'];?></h2> 
                                    <input type="hidden" name="phasename" value="<?php echo $rowphaseheader['PName'];?>"/> <?php
                            }
                            }
                            // phase header
                            ?>
                            <a href="#" onclick="completebuildingModal('<?php echo $BldgCat ?>','<?php echo $rowggetBuildingId['Bid']; ?>','<?php echo $pageType ?>')" ><h5 style="text-decoration:none;text-align:center;color:#fff;background-color:#dfdfdf" class="mg-title text-bold">Back</h5></a>
                        <?php
                        
                       
                        if($showArea->rowCount() > 0){
                                ?>  <h2 class="panel-title"style="text-align:center"><?php echo $rowareaheader['AName'];?></h2> 
                                    <input type="hidden" name="areaname" value="<?php echo $rowareaheader['AName'];?>"/> 
                                    <input type="hidden" name="globalaid" value="<?php echo $rowareaheader['Aid'];?>"/> <?php
                        }
                    ?>
                        <section class="panel">
                            <header class="panel-heading">
                                <div class="panel-actions">
                                </div>
                                <?php
                                    $grades = $conn->prepare("SELECT * FROM checklist_grade WHERE Pid=:Pid AND (Date_Checked >= :from AND Date_Checked <= :to) ORDER BY Aid DESC ");
                                    $grades->execute(array(":Pid"=> $id,":from"=> $Datetodayminusfive,":to"=> $Datetoday));
                                    $rowGrades = $gradesheader->fetch(PDO::FETCH_ASSOC);


                                    //#################################################
                                    // ################# CHECKLIST#####################
                                    // ################################################


                                 
                                        $stmtArea = $conn->prepare("SELECT * FROM area WHERE Pid=:Pid limit 1");
                                            $stmtArea->execute(array(":Pid" => $id));
                                    
                                        $rowArea = $stmtArea->fetch(PDO::FETCH_ASSOC);
                                    //  echo $rowArea['Aid'];
                                    ?>
                                
                                    <?php $aid = $rowArea['Aid']; ?>
                                    <input style=""type="hidden" name="pid" id="pid" value=<?php echo $id?>> <!--- id array ng mga phase -->
                                    <input style="background-color:blue" type="hidden" name="aid" id="aid" value=<?php echo $aid?>> <!--- id array ng mga checklist -->
                                    <table>
                                        <thead>
                                        <div class="row">
                                            <div class="col">
                                            
                                            <select data-plugin-selectTwo style="background-color:#dfdfdf;margin-right:15px;margin-left:15px;"  name="selectArea" id="selectArea" class="col-sm-3" >
                                                <option value="">Change Area</option>
                                                <?php
                                                    $getAid = $conn->prepare("SELECT AName, Aid from area where Pid = :Pid and Aid NOT IN (SELECT Aid FROM checklist_grade WHERE Pid = :Pid AND (Date_Checked >= :from AND Date_Checked <= :to) Group By Aid)");
                                                    $getAid->execute(array(":Pid"=> $id,":from"=> $Datetodayminusfive,":to"=> $Datetoday));
                                                    while($rowgetAid = $getAid->fetch(PDO::FETCH_ASSOC)){
                                                    ?>
                                                            <option value="<?=$rowgetAid['Aid']?>"><?=$rowgetAid['AName']?></option>
                                                    <?php 
                                                    }
                                                ?>
                                                
                                            </select>
                                            </div>
                                            
                                            <span style="background-color:#d2322d;margin:0px; padding:5px; border-radius:10px;color:#fff;font-size:10px;"><?php echo "Week " ?> <span style="font-size:20px;"><strong><?php echo $week ?></strong></span></span>
                                            <input type="hidden" name="week" id="week" value="<?php echo $week?>"/>
                                            <span style="background-color:#d2322d; margin:0px; padding:5px; border-top-left-radius:10px; border-bottom-left-radius:10px;color:#fff;font-size:10px;"><strong><?php echo $month ?></strong></span>
                                            <input type="hidden" name="month" id="month" value="<?php echo $month?>"/>
                                            <span style="background-color:#8d0703;margin:0px;  padding:5px; border-top-right-radius:10px;; border-bottom-right-radius:10px;color:#fff;font-size:10px;"><strong><?php echo $year ?></strong></span>
                                            <input type="hidden" name="year" id="year" value="<?php echo $year?>"/>
                                        
                                        </div>
                                        

                                        <!-- <label style="color:#EF8B14">Skipped Area:</label> -->
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <!-- header skipped -->
                                                <?php
                                                $skippedChecklist = $conn->prepare("SELECT * FROM checklist_grade left join area on checklist_grade.Aid = area.Aid where checklist_grade.status = 'Skipped' and checklist_grade.Pid=:Pid Group by checklist_grade.Aid ORDER BY checklist_grade.Aid ASC");
                                                $skippedChecklist->execute(array(":Pid"=>$id));
                                                while($rowskippedChecklist = $skippedChecklist->fetch(PDO::FETCH_ASSOC)){
                                                if($rowskippedChecklist['Aid'] == trim($selectedaidfromSkippedArea)){
                                                    ?>
                                                    <th onclick="goToSkipArea('<?php echo $rowskippedChecklist['Aid'] ?>','<?php echo $rowskippedChecklist['Pid'] ?>')" style="text-align:center;width:30px; background-color:#ca1f03;cursor:pointer;color:#ffffff;border-color:#ffffff;border-top-right-radius:10px;border-bottom-left-radius:10px;"><span><?php echo substr($rowskippedChecklist['AName'], 0,4)?>
                                                    <!-- <?php echo $rowskippedChecklist['Aid'] ?> -->
                                                    
                                                    
                                                    <?php
                                                }else{
                                                    ?>
                                                    <th onclick="goToSkipArea('<?php echo $rowskippedChecklist['Aid'] ?>','<?php echo $rowskippedChecklist['Pid'] ?>')" style="text-align:center;width:30px; background-color:#EF8B14;cursor:pointer;color:#ffffff;border-color:#ffffff;border-top-right-radius:10px;border-bottom-left-radius:10px;"><span><?php echo substr($rowskippedChecklist['AName'], 0,4)?>
                                                    <!-- <?php echo $rowskippedChecklist['Aid']?> -->
                                                    </span></th>
                                                    <?php
                                                }
                                                }
                                                    ?>
                                            <!-- end header skipped -->
                                            </tr>
                                        </tbody>
                                    </table>
                                    
                            </header>
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped table-condensed mb-none" id="tablecheck">
                                        <thead>
                                                <tr>
                                                    <th colspan="6" style="text-align:center; background-color:#EF8B14;color:#ffffff;border-color:#EF8B14">
                                                        Sanitation and Structural
                                                    </th>
                                                </tr>

                                                <tr>
                                                    <th colspan="6" style="text-align:center; background-color:#ca6f03;color:#ffffff"></th>
                                                </tr>
                                            <tr>
                                            <?php
                                                $aid;
                                                $checklist = $conn->prepare("SELECT * FROM checklist where Aid = :Aid ORDER BY Cid ASC");
                                                $checklist->execute(array(":Aid"=>$aid));
                                                if($checklist->rowCount() > 0){
                                                while($rowCheck = $checklist->fetch(PDO::FETCH_ASSOC)){
                                                    $cid = $rowCheck['Cid'];
                                                    $cname = $rowCheck['CName'];
                                                // echo $cid;
                                            ?>
                                            
                                                <th colspan="4" style="text-align:center; background-color:#34495e8a;color:#ffffff">
                                                <input style="background-color:red" type="hidden" name="cid[]" id="cid" value="<?php echo $cid?>"/> <!--- id array ng mga checklist -->
                                                <input style="background-color:red" type="hidden" name="cname[]" id="cname" value="<?php echo $rowCheck['CName']?>" /> <!--- id array ng mga checklist -->
                                                <input style="background-color:red" type="hidden" name="percent"  value="<?php echo $rowArea['Percentage']?>" /> <!--- id array ng mga checklist -->
                                                <input style="background-color:red" type="hidden" name="percentageequip"  value="<?php echo $rowArea['percentageequip']?>" /> <!--- id array ng mga checklist -->
                                                <?php echo $rowCheck['CName']?></th>
                                                
                                                
                                                <input style="background-color:green"type="hidden" name="pid" id="pid" value=<?php echo $id?>> <!--- id array ng mga phase -->
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <input type="hidden" name="ID[]" value="<?php echo $cid?>"/>
                                            <tr>
                                                <td style="text-align:center" colspan="2">Sanitation</td>
                                                <td style="text-align:center" colspan="2">Structural</td>
                                            </tr>
                                            
                                            <tr>
                                                <td  colspan="2">
                                                <input type="radio" name="Sani<?php echo $cid?>[]" class="radio" value="100" required/><?php echo $rowCheck['Sani_Three'] ?>
                                                </td>
                                                <?php
                                                    if(! empty($rowCheck['Stru_Three'])){
                                                        ?>
                                                            <td  colspan="2">
                                                                <input type="radio" name="Str<?php echo $cid?>[]" value="Good"  required/><?php echo $rowCheck['Stru_Three'] ?>
                                                            </td>
                                                        <?php
                                                    }else{
                                                        ?>
                                                        <td style="background-color:#ed47240d;" colspan="2" rowspan="3">
                                                            <h5 style="margin:5px;"><input type="hidden" name="Str<?php echo $cid?>[]" value="No Structural"  required/><img src="uploads/structural.png" style="opacity:0.1;  display: block;margin-left: auto;margin-right: auto; width:auto;" /><br><center>No Structural</center></h5>
                                                        </td>
                                                    <?php 
                                                    }
                                                ?>
                                            


                                            </tr>
                                            <tr>
                                                <td  colspan="2">
                                                <input type="radio" name="Sani<?php echo $cid?>[]" class="radio" value="75" required/><?php echo $rowCheck['Sani_Two'] ?>
                                                </td>
                                                <?php
                                                    if(! empty($rowCheck['Stru_Three'])){
                                                            $numericCurrentMonth=date("n",strtotime($month));
                                                            $numericCurrentMonth=$numericCurrentMonth-1;
                                                            $dateObj   = DateTime::createFromFormat('!m', $numericCurrentMonth);
                                                            $PreviousMonth = $dateObj->format('F'); 
                                                            $PreviousYear = $year -1;
                                                            
                                                            if($year != $currentYear){
                                                                $enableDisable1stOffenseY1 = $conn->prepare("SELECT 
                                                                (SELECT count(Cid) as numberofWeeks from checklist_grade where Date_Checked > (SELECT Date_Checked from checklist_grade where Str_Grade = '100' and Cid = :Cid order by Date_Checked DESC LIMIT 1) and Cid = :Cid) as noofweeks
                                                                ,checklist_grade.Date_Checked,qastaff FROM checklist_grade left join timedatephase 
                                                                on checklist_grade.week = timedatephase.week
                                                                and checklist_grade.month = timedatephase.month
                                                                and checklist_grade.year = timedatephase.year
                                                                and checklist_grade.Pid = timedatephase.pid
                                                                WHERE 
                                                                Cid = :Cid AND 
                                                                checklist_grade.month = :month AND 
                                                                checklist_grade.week = (SELECT max(week) from checklist_grade where month = :month and year = :year and week != 'undefined') AND
                                                                checklist_grade.year = :year AND 
                                                                Str_Grade != '100' ORDER BY checklist_grade.Aid DESC ");
                                                                $enableDisable1stOffenseY1->execute(array(
                                                                ":Cid"=> $cid,
                                                                ":month"=> $PreviousMonth, // previous month dahil 1st week ito need macheck if may 1st offense sa last week.
                                                                ":year"=> $PreviousYear,
                                                                ));
                                                                
                                                                if($enableDisable1stOffenseY1->rowCount() > 0){
                                                                    $enableDisable1stOffenseRowY1 = $enableDisable1stOffenseY1->fetch(PDO::FETCH_ASSOC);
                                                                    ?>
                                                                        <td  colspan="2" class="" style="background-color:#dfdfdf;cursor:no-drop"> 
                                                                            <strong style="color:#d2322d;">x</strong><small> 1st Offense: <strong style="color:#d2322d;"><?php echo $enableDisable1stOffenseRowY1['noofweeks'] ?> Week/s Ago</strong></small>  <small><strong style="color:#908b91;"> </strong></small> | <small><strong style="color:#d2322d;"><?php echo $enableDisable1stOffenseRowY1['qastaff'] ?></strong></small>
                                                                        </td>
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                    <td  colspan="2"> 
                                                                        <input type="radio" name="Str<?php echo $cid?>[]" value="1st Offense"  required/><?php echo $rowCheck['Stru_Two'] ?>
                                                                    </td>
                                                                    <?php
                                                                }
                                                            
                                                            }else if($week == 1){
                                                                $enableDisable1stOffenseW1 = $conn->prepare("SELECT 
                                                                (SELECT count(Cid) as numberofWeeks from checklist_grade where Date_Checked > (SELECT Date_Checked from checklist_grade where Str_Grade = '100' and Cid = :Cid order by Date_Checked DESC LIMIT 1) and Cid = :Cid) as noofweeks
                                                                ,checklist_grade.Date_Checked,qastaff FROM checklist_grade left join timedatephase 
                                                                on checklist_grade.week = timedatephase.week
                                                                and checklist_grade.month = timedatephase.month
                                                                and checklist_grade.year = timedatephase.year
                                                                and checklist_grade.Pid = timedatephase.pid
                                                                WHERE Cid = :Cid AND checklist_grade.month = :month AND checklist_grade.week = 
                                                                (SELECT max(week) from checklist_grade where month = :month and year = :year and week != 'undefined')
                                                                AND checklist_grade.year = :year AND Str_Grade != '100' ORDER BY checklist_grade.Aid DESC ");
                                                                $enableDisable1stOffenseW1->execute(array(
                                                                ":Cid"=> $cid,
                                                                ":month"=> $PreviousMonth, // previous month dahil 1st week ito need macheck if may 1st offense sa last week.
                                                                ":year"=> $year,
                                                                ));
                                                                
                                                                if($enableDisable1stOffenseW1->rowCount() > 0){
                                                                    $enableDisable1stOffenseRowW1 = $enableDisable1stOffenseW1->fetch(PDO::FETCH_ASSOC);
                                                                    ?>
                                                                        <td  colspan="2" class="" style="background-color:#dfdfdf;cursor:no-drop"> 
                                                                        <strong style="color:#d2322d;">x</strong><small> 1st Offense: <strong style="color:#d2322d;"><?php echo $enableDisable1stOffenseRowW1['noofweeks'] ?> Week/s Ago</strong></small>  <small><strong style="color:#908b91;"> </strong></small> | <small><strong style="color:#d2322d;"><?php echo $enableDisable1stOffenseRowW1['qastaff'] ?></strong></small>
                                                                            
                                                                        </td>
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                    <td  colspan="2"> 
                                                                        <input type="radio" name="Str<?php echo $cid?>[]" value="1st Offense"  required/><?php echo $rowCheck['Stru_Two'] ?>
                                                                    </td>
                                                                    <?php
                                                                }
                                                            
                                                            }else{
                                                                $newWeek = $week - 1;
                                                                
                                                                $enableDisable1stOffense = $conn->prepare("SELECT 
                                                                (SELECT count(Cid) as numberofWeeks from checklist_grade where Date_Checked > (SELECT Date_Checked from checklist_grade where Str_Grade = '100' and Cid = :Cid order by Date_Checked DESC LIMIT 1) and Cid = :Cid) as noofweeks
                                                                ,checklist_grade.Date_Checked,qastaff FROM checklist_grade left join timedatephase 
                                                                on checklist_grade.week = timedatephase.week
                                                                and checklist_grade.month = timedatephase.month
                                                                and checklist_grade.year = timedatephase.year
                                                                and checklist_grade.Pid = timedatephase.pid
                                                                WHERE checklist_grade.Cid = :Cid AND checklist_grade.month = :month AND checklist_grade.week = :week AND checklist_grade.year = :year AND Str_Grade != '100' ORDER BY checklist_grade.Aid DESC ");
                                                                $enableDisable1stOffense->execute(array(
                                                                ":Cid"=> $cid,
                                                                ":week"=> $newWeek,
                                                                ":month"=> $month,
                                                                ":year"=> $year,
                                                                ));
                                                                
                                                                if($enableDisable1stOffense->rowCount() > 0){
                                                                $enableDisable1stOffenseRow = $enableDisable1stOffense->fetch(PDO::FETCH_ASSOC);
                                                                ?>
                                                                    <td  colspan="2" class="" style="background-color:#dfdfdf;cursor:no-drop"> 
                                                                        <strong style="color:#d2322d;">x</strong><small> 1st Offense: <strong style="color:#d2322d;"><?php echo $enableDisable1stOffenseRow['noofweeks'] ?> Week/s Ago</strong></small> | <small><strong style="color:#908b91;"></strong></small><small><strong style="color:#d2322d;"><?php echo $enableDisable1stOffenseRow['qastaff'] ?></strong></small>
                                                                        
                                                                    </td>
                                                                <?php
                                                                }else{
                                                                    ?>
                                                                    <td  colspan="2"> 
                                                                    <input type="radio" name="Str<?php echo $cid?>[]" value="1st Offense"  required/><?php echo $rowCheck['Stru_Two'] ?>
                                                                    </td>
                                                                    <?php
                                                                }

                                                        }  
                                                    }else{
                                                        ?>
                                                        <!-- <input type="hidden" name="Str<?php echo $cid?>[]" value="No Structural"  required/> -->
                                                        
                                                    <?php 
                                                    }
                                                ?>
                                            </tr>
                                            <tr>
                                                <td  colspan="2">   
                                                <input type="radio" name="Sani<?php echo $cid?>[]" class="radio" value="50" required/><?php echo $rowCheck['Sani_One'] ?>
                                                </td>
                                                <?php
                                                    if(! empty($rowCheck['Stru_Three'])){
                                                        ?>
                                                            <td  colspan="2">
                                                                <input type="radio" name="Str<?php echo $cid?>[]" value="Damaged"  required/><?php echo $rowCheck['Stru_One'] ?>
                                                            </td>
                                                        <?php
                                                    }else{
                                                        ?>
                                                        <!-- <input type="hidden" name="Str<?php echo $cid?>[]" value="No Structural"  required/> -->
                                                        
                                                    <?php 
                                                    }
                                                ?>
                                            </tr>
                                            <tr>
                                            <td  colspan="2">
                                                <input type="text" class="form-control" name="remarks[]" placeholder="Enter Remarks *Optional"/>
                                            </td>
                                            <td colspan="2">
                                                <div style="background-color:#ef6c0026;border:1px solid #ef6c006e;cursor:pointer;border-radius:10px;" onclick="addmoreImg('<?php echo $rowCheck['CName']?>','<?php echo $rowCheck['Cid']?>','<?php echo $rowCheck['Aid']?>','<?php echo $Datetoday?>')" ><img onclick="addmoreImg('<?php echo $rowCheck['CName']?>','<?php echo $rowCheck['Cid']?>','<?php echo $rowCheck['Aid']?>','<?php echo $Datetoday?>')" src="uploaded/addimg.png" style="height:30px;width:auto;cursor:pointer;" />Open to view/add Image</div>
                                            </td>
                                            </tr>
                                            <?php
                                                    }
                                                }
                                            ?>                                                        
                                        </tbody>
                                    </table>
                                </div>
                        </section>
<?php
}
?>
                        <section>

                            <?php
                                    $grades = $conn->prepare("SELECT * FROM checklist_grade WHERE Pid=:Pid  AND (Date_Checked >= :from AND Date_Checked <= :to) ORDER BY Aid DESC ");
                                    $grades->execute(array(":Pid"=> $id, ":from"=> $from, ":to"=> $to));
                                    $rowGrades = $gradesheader->fetch(PDO::FETCH_ASSOC);
                                    
                                    if($grades->rowCount() > 0){

                                    //#################################################
                                    // ################# EQUIPMENT#####################
                                    // ################################################
                                        if($areaselected != 'None'){
                                            $stmtArea = $conn->prepare("SELECT * FROM area WHERE Aid = :Aid ORDER BY Aid ASC");
                                            $stmtArea->execute(array(":Aid" => trim($areaselected)));
                                        }
                                        else if(trim($selectedaidfromSkippedArea)=="none"){
                                            
                                            $stmtArea = $conn->prepare("SELECT * FROM area WHERE Pid = :Pid AND 
                                            Aid NOT IN (SELECT Aid FROM checklist_grade WHERE Pid=:Pid  AND (Date_Checked >= :from AND Date_Checked <= :to))
                                            ORDER BY Aid ASC");
                                            $stmtArea->execute(array(":Aid" => $rowgradesheader['Aid'],":Pid"=> $id,":from"=> $Datetodayminusfive,":to"=> $Datetoday));
                                            
                                        }else{
                                            $stmtArea = $conn->prepare("SELECT * FROM area WHERE Aid = :Aid ORDER BY Aid ASC");
                                            $stmtArea->execute(array(":Aid" => trim($selectedaidfromSkippedArea)));
                                            
                                            // echo $rowareaheader['AName'];
                                        }
                                    }
                                    else{
                                        $stmtArea = $conn->prepare("SELECT * FROM area WHERE Pid=:Pid limit 1");
                                            $stmtArea->execute(array(":Pid" => $id));
                                    }
                                        $rowArea = $stmtArea->fetch(PDO::FETCH_ASSOC);
                                ?>
                                
                                    <?php $aidequip = $rowArea['Aid'];?>
                                    <input style="background-color:green"type="hidden" name="pid" id="pid" value=<?php echo $id?>> <!--- id array ng mga phase -->
                                    <input style="background-color:blue" type="hidden" name="aid" id="aid" value=<?php echo $aid?>> <!--- id array ng mga checklist -->
                        
                            <a name="equipment"></a> 
                            
                            <table class="table table-bordered table-striped table-condensed mb-none">
                                <thead>
                                        <tr>
                                        <th colspan="6" style="text-align:center; background-color:#EF8B14;color:#ffffff;border-color:#EF8B14">
                                            Equipment
                                        </th>
                                    </tr>
                                    <tr>
                                    <th colspan="6" style="text-align:center; background-color:#ca6f03;color:#ffffff"></th>
                                    </tr>
                                        <?php
                                        // echo $aid;
                                            $equip = $conn->prepare("SELECT * FROM equipment where Aid = :Aid and status = 'ACTIVE'");
                                            $equip->execute(array(":Aid"=>$aidequip));
                                            if($equip->rowCount() > 0){
                                            while($rowequip = $equip->fetch(PDO::FETCH_ASSOC)){
                                            $eid = $rowequip['Eid'];
                                            // echo $cid;
                                        ?>
                                        
                                            <input style="background-color:red" type="hidden" name="percent"  value="<?php echo $rowArea['Percentage']?>" /> <!--- id array ng mga checklist -->
                                            <input style="background-color:green"type="hidden" name="pid" id="pid" value=<?php echo $id?>> <!--- id array ng mga phase -->
                                        
                                </thead>
                                <tbody>
                                    <tr>
                                        <input type="hidden" name="EID[]" value="<?php echo $eid?>"/>
                                        <td  colspan="2">
                                        <label><?php echo $rowequip['EName']?> #  <?php echo $rowequip['Asset_Number']?>
                                        <input type="hidden" name="ename[]" value="<?php echo $rowequip['EName']?>"/></label>
                                        </td>
                                        <td style="text-align:center">
                                        <input type="radio" name="eone<?php echo $eid?>" id="eone" value="Functional" required/>Functional
                                        </td>
                                        <td style="text-align:center">
                                        <input type="radio" name="eone<?php echo $eid?>" id="eone" value="1st Offense" required/>1st Offense
                                        </td>
                                        <td style="text-align:center">
                                        <input type="radio" name="eone<?php echo $eid?>" id="eone" value="Non-Functional" required/>Non-Functional
                                        </td>
                                        <td style="text-align:center">
                                        <input type="radio" name="eone<?php echo $eid?>" id="eone" value="Not Onsight" required/>Not On Site
                                        </td>
                                    </tr>


                                    <tr>
                                        <td  colspan="4">
                                            <input type="text" class="form-control" name="remarksequip[]" placeholder="Enter Remarks *Optional"/>
                                        </td>
                                        <td colspan="2">
                                            <div style="background-color:#ef6c0026;border:1px solid #ef6c006e;cursor:pointer;border-radius:10px;" onclick="addmoreImgEquip('<?php echo $rowequip['EName']?>','<?php echo $rowequip['Eid']?>','<?php echo $rowequip['Aid']?>','<?php echo $Datetoday?>')" ><img src="uploaded/addimg.png" style="height:30px;width:auto;cursor:pointer;" />Open to view/add Image</div>
                                        </td>
                                    </tr>

                                    <?php
                                        }
                                    }
                                
                                    
                                    ?>
                                        
                                    
                                        <tr>
                                        <center>
                                            <td  colspan="6">
                                            <!-- <button onclick="skipAreaButton('<?php echo $rowareaheader['Aid'];?>')" class="btn btn-danger">Skip</button> -->
                                            <?php  if(trim($selectedaidfromSkippedArea)=="none"){
                                                ?>
                                                    <!-- <button style="display:none" onclick="updateSkipArea()" id="updateSkipAreaButton" class="btn btn-info">Update</button> -->
                                                    <button class="btn btn-success">Submit</button>
                                                <?php
                                            }else{
                                                ?>
                                                <!-- <button  onclick="updateSkipArea()" id="updateSkipAreaButton" class="btn btn-info">Update</button> -->
                                                <button style="display:none"class="btn btn-success">Submit</button>
                                                    <?php
                                            }
                                                
                                            ?>

                                            
                                            
                                            </td>
                                        </center>
                                        </tr>    
                                        
                                </tbody>
                                
                            </table>  
                                
                        </section>
                                    
                                </section> 
                            </div>
                         </div>                  
                    </div>
                    
                </form>


            </div>
        </div>
        <input type="hidden" id="getid" value="<?php echo $id;?>"/> 
        <input type="hidden" id="getpageType" value="<?php echo $pageType;?>"/> 
        <input type="hidden" id="getweek" value="<?php echo $week;?>"/> 
        <input type="hidden" id="getmonth" value="<?php echo $month;?>"/> 
        <input type="hidden" id="getyear" value="<?php echo $year;?>"/> 
        <script>
            var id = $('#getid').val()
            var pageType = $('#getpageType').val()
            var week = $('#getweek').val()
            var month = $('#getmonth').val()
            var year = $('#getyear').val()
            var from = $('#from').val()
            var to = $('#to').val()
        $("#selectArea").change(function () {
            
            var area =this.value
            window.location.assign('MainChecklist.php?id=' + id + "&pageType=" + pageType + "&week=" + week + "&month=" + month + "&year=" + year + "&areaselected=" + area + "&from=" + from + "&to=" + to);
           
        });
        
        </script>    