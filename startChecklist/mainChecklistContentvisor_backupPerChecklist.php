
    <?php 
        include_once 'Class.php';
        $crudcontroller = new CrudController();
        $dao = new Dao();
        $conn = $dao->openConnection();
        $id = $_POST['id'];
        
         $selectedaidfromSkippedArea = $_POST['aid'];
        $Datetoday = $crudcontroller->getDate();
    ?>
<?php
if (! empty($result)) {

?>
     
    <!-- justified -->
    

    <div class="row">
        <div class="col-md-12">
        <form method="POST" action="viewing_grade.php" id="saveImage" enctype="multipart/form-data">
     
            
                
                       <?php
                        // check kung may grade ang checklist ngayong araw sa isang phase
                        $gradesheader = $conn->prepare("SELECT * FROM checklist_grade WHERE Pid = :Pid AND Date_Checked = :datetoday ORDER BY Aid DESC ");
                        $gradesheader->execute(array(":Pid"=> $id,":datetoday"=> $Datetoday));
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
                        if($gradesheader->rowCount() > 0){
                            if(trim($selectedaidfromSkippedArea)=="none"){
                                $showArea = $conn->prepare("SELECT * FROM area WHERE Aid > :Aid ORDER BY Aid");
                                $showArea->execute(array(":Aid" => $rowgradesheader['Aid']));
                                $rowareaheader = $showArea->fetch(PDO::FETCH_ASSOC);
                            }else{
                                $showArea = $conn->prepare("SELECT * FROM area WHERE Aid = :Aid ORDER BY Aid");
                                $showArea->execute(array(":Aid" => trim($selectedaidfromSkippedArea)));
                                $rowareaheader = $showArea->fetch(PDO::FETCH_ASSOC);
                                // echo $rowareaheader['AName'];
                            }
                            // check kung may skipped area ang phase
                          
                            // end skipped area

                           
                            // phase header
                            $phaseheader = $conn->prepare("SELECT * FROM phase WHERE Pid=:Pid ORDER BY Pid ASC LIMIT 1"); 
                            $phaseheader->execute(array(":Pid" => $rowareaheader['Pid']));
                            if($phaseheader->rowCount() > 0){
                           $rowphaseheader = $phaseheader->fetch(PDO::FETCH_ASSOC);
                                ?>  <h2 class="panel-title"style="text-align:center;background-color:#ca6f03;color:#ffff;margin-top:-11px;font-size:15px;"><?php echo $rowphaseheader['PName'];?></h2> 
                                    <input type="hidden" name="phasename" value="<?php echo $rowphaseheader['PName'];?>"/> <?php
                            
                            }
                            // phase header
                            
                            ?>
                                <a href="#" onclick="completebuildingModal('<?php echo $BldgCat ?>','<?php echo $rowggetBuildingId['Bid']; ?>')" ><h5 style="text-decoration:none;text-align:center;color:#fff;background-color:#dfdfdf" class="mg-title text-bold">Back</h5></a>
                            <?php
                        }
                        else{
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
                            <a href="#" onclick="completebuildingModal('<?php echo $BldgCat ?>','<?php echo $rowggetBuildingId['Bid']; ?>')" ><h5 style="text-decoration:none;text-align:center;color:#fff;background-color:#dfdfdf" class="mg-title text-bold">Back</h5></a>
                        <?php
                        }
                       

                  
                        if($showArea->rowCount() > 0){
                            // while($rowareaheader = $showArea->fetch(PDO::FETCH_ASSOC)){
                                ?>  <h2 class="panel-title"style="text-align:center"><?php echo $rowareaheader['AName'];?></h2> 
                                    <input type="hidden" name="areaname" value="<?php echo $rowareaheader['AName'];?>"/> 
                                    <input type="hidden" name="globalaid" value="<?php echo $rowareaheader['Aid'];?>"/> <?php
                                    
                            // }
                        }
                    
                      
                    ?>

                 
                                 <section class="panel">
                                        <header class="panel-heading">
                                            <div class="panel-actions">
                                                <a href="#" class="fa fa-caret-down"></a>
                                                <a href="#" class="fa fa-times"></a>
                                            </div>
                                            <?php
                                            // echo $Datetoday;
                                                $grades = $conn->prepare("SELECT * FROM checklist_grade WHERE Pid=:Pid AND Date_Checked = :datetoday ORDER BY Aid DESC ");
                                                $grades->execute(array(":Pid"=> $id,":datetoday"=> $Datetoday));
                                                $rowGrades = $gradesheader->fetch(PDO::FETCH_ASSOC);
                                                // echo $rowGrades['Date_Checked'];
                                             
                                                if($grades->rowCount() > 0){
                                                    // $stmtArea = $conn->prepare("SELECT * FROM area WHERE Aid > :Aid ORDER BY Aid ASC");
                                                    // $stmtArea->execute(array(":Aid" => $rowGrades['Aid']));

                                                    if(trim($selectedaidfromSkippedArea)=="none"){
                                                        $stmtArea = $conn->prepare("SELECT * FROM area WHERE Aid > :Aid ORDER BY Aid ASC");
                                                        $stmtArea->execute(array(":Aid" => $rowgradesheader['Aid']));
                                                        
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
                                                //  echo $rowArea['Aid'];
                                                ?>
                                            
                                                <?php $aid = $rowArea['Aid']; ?>
                                                <input style=""type="hidden" name="pid" id="pid" value=<?php echo $id?>> <!--- id array ng mga phase -->
                                                <input style="background-color:blue" type="hidden" name="aid" id="aid" value=<?php echo $aid?>> <!--- id array ng mga checklist -->
                                                <table>
                                                    <thead>
                                                    <label style="color:#EF8B14">Skipped Area:</label>
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
                                                            <td style="text-align:center" colspan="4">Sanitation and Structural</td>
                                                        </tr>
                                                       
                                                        
                                                        <tr>
                                                        <td >
                                                            <div style="background-color:#ef6c0026;border:1px solid #ef6c006e;cursor:pointer;border-radius:10px;" onclick="addmoreImg('<?php echo $rowCheck['CName']?>','<?php echo $rowCheck['Cid']?>','<?php echo $rowCheck['Aid']?>','<?php echo $Datetoday?>')" ><img onclick="addmoreImg('<?php echo $rowCheck['CName']?>','<?php echo $rowCheck['Cid']?>','<?php echo $rowCheck['Aid']?>','<?php echo $Datetoday?>')" src="uploaded/addimg.png" style="height:30px;width:auto;cursor:pointer;" />Open to view/add Image</div>
                                                        </td>
                                                        <td  colspan="3">
                                                            <input type="text" class="form-control" name="remarks[]" placeholder="Enter Remarks *Optional"/>
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
                                    
                                    <!-- modal equipment -->


                                    <section>

                                        <?php
                                                $grades = $conn->prepare("SELECT * FROM checklist_grade WHERE Pid=:Pid  AND Date_Checked = :datetoday ORDER BY Aid DESC ");
                                                $grades->execute(array(":Pid"=> $id, ":datetoday"=> $Datetoday));
                                                $rowGrades = $gradesheader->fetch(PDO::FETCH_ASSOC);
                                             
                                                if($grades->rowCount() > 0){
                                                    if(trim($selectedaidfromSkippedArea)=="none"){
                                                        $stmtArea = $conn->prepare("SELECT * FROM area WHERE Aid > :Aid ORDER BY Aid ASC");
                                                        $stmtArea->execute(array(":Aid" => $rowgradesheader['Aid']));
                                                        
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
                                                        $equip = $conn->prepare("SELECT * FROM equipment where Aid = ".$aidequip." and status = 'ACTIVE'");
                                                        $equip->execute(array(":Aid"=>$aid));
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
                                                    <label><?php echo $rowequip['EName']?>  <?php echo $rowequip['Asset_Number']?>
                                                    <input type="hidden" name="ename[]" value="<?php echo $rowequip['EName']?>"/></label>
                                                    </td>
                                                   
                                                </tr>


                                                <tr>
                                                    <td  colspan="1">
                                                        <input type="text" class="form-control" name="remarksequip[]" placeholder="Enter Remarks *Optional"/>
                                                        </td>
                                                        <td  colspan="5">
                                                        <input type="file" class="form-control"name="imageequip[]"  placeholder=""   />
                                                    </td>
                                                    </tr>

                                                <?php
                                                    }
                                                }
                                            
                                                
                                                ?>
                                                 
                                                
                                                    <tr>
                                                    <center>
                                                        <td  colspan="6">
                                                        <button onclick="skipAreaButton('<?php echo $rowareaheader['Aid'];?>')" class="btn btn-danger">Skip</button>
                                                        <?php  if(trim($selectedaidfromSkippedArea)=="none"){
                                                            ?>
                                                                <button style="display:none" onclick="updateSkipArea()" id="updateSkipAreaButton" class="btn btn-info">Update</button>
                                                                <button class="btn btn-success">Submit</button>
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <button  onclick="updateSkipArea()" id="updateSkipAreaButton" class="btn btn-info">Update</button>
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
        <script>
            
        
        </script>    