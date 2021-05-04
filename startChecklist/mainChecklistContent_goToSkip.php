
    <?php 
        include_once 'Class.php';
        $crudcontroller = new CrudController();
        $dao = new Dao();
        $conn = $dao->openConnection();
        echo $id = $_POST['id'];

        // $Datetoday = $crudcontroller->getDate();
        $date = $conn->prepare("SELECT * FROM checklist_grade ORDER BY Aid DESC ");
        $date->execute(array());
        $rowdate= $date->fetch(PDO::FETCH_ASSOC);
        $Datetoday = $crudcontroller->getDate();
        $Aid = $_GET['aid']
    ?>
<?php
if (! empty($result)) {

?>
     
	<!-- justified -->
    <div class="row">
        <div class="col-md-12">
        <form method="POST" action="viewing_grade.php" id="saveImage" enctype="multipart/form-data">
     
            
                
                       <?php

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
                            $showArea = $conn->prepare("SELECT * FROM area WHERE Aid > :Aid ORDER BY Aid");
                            $showArea->execute(array(":Aid" => $rowgradesheader['Aid']));
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
                        else{
                            $showArea = $conn->prepare("SELECT * FROM area WHERE Pid=:Pid limit 1");
                            $showArea->execute(array(":Pid" => $id));
                            $rowareaheader = $showArea->fetch(PDO::FETCH_ASSOC);
                            // phase header
                            $phaseheader = $conn->prepare("SELECT * FROM phase WHERE Pid=:Pid ORDER BY Pid ASC LIMIT 1"); 
                            $phaseheader->execute(array(":Pid" => $rowareaheader['Pid']));
                            if($phaseheader->rowCount() > 0){
                            while($rowphaseheader = $phaseheader->fetch(PDO::FETCH_ASSOC)){
                                ?>  <h2 class="panel-title"style="text-align:center;background-color:#ca6f03;color:#ffff;margin-top:-11px;font-size:15px;"><?php echo $rowphaseheader['PName'];  echo $Aid ?> </h2> 
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
                                                    $stmtArea = $conn->prepare("SELECT * FROM area WHERE Aid > :Aid ORDER BY Aid ASC");
                                                    $stmtArea->execute(array(":Aid" => $rowGrades['Aid']));
                                                }
                                                else{
                                                    $stmtArea = $conn->prepare("SELECT * FROM area WHERE Pid=:Pid limit 1");
                                                     $stmtArea->execute(array(":Pid" => $id));
                                                }
                                                 $rowArea = $stmtArea->fetch(PDO::FETCH_ASSOC);
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
                                                            if(empty($rowskippedChecklist['Aid'])){
                                                                ?>
                                                                <th style="text-align:center;width:20px; background-color:#EF8B14;cursor:pointer;color:#ffffff;border-color:#ffffff;border-top-right-radius:10px;border-bottom-left-radius:10px;"><span>None</span></th>
                                                                <?php
                                                            }else{
                                                        ?>
                                                        <th style="text-align:center;width:20px; background-color:#EF8B14;cursor:pointer;color:#ffffff;border-color:#ffffff;border-top-right-radius:10px;border-bottom-left-radius:10px;"><span><?php echo substr($rowskippedChecklist['AName'], 0,2)?>
                                                        <?php echo $rowskippedChecklist['Aid']?>
                                                        </span></th>
                                                        <?php
                                                        }}
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
                                                        // echo $aid;
                                                            $checklist = $conn->prepare("SELECT * FROM checklist where Aid = :Aid ORDER BY Cid ASC");
                                                            $checklist->execute(array(":Aid"=>$aid));
                                                            if($checklist->rowCount() > 0){
                                                            while($rowCheck = $checklist->fetch(PDO::FETCH_ASSOC)){
                                                            $cid = $rowCheck['Cid'];
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
                                                                    ?>
                                                                        <td  colspan="2">
                                                                            <input type="radio" name="Str<?php echo $cid?>[]" value="1st Offense"  required/><?php echo $rowCheck['Stru_Two'] ?>
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
                                                            <td  colspan="2">
                                                            <input type="file" class="form-control"name="image[]" placeholder=""   />
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
                                                    $stmtArea = $conn->prepare("SELECT * FROM area WHERE Aid > :Aid ORDER BY Aid ASC");
                                                    $stmtArea->execute(array(":Aid" => $rowGrades['Aid']));
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
                                                        <button class="btn btn-success">Submit</button>
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