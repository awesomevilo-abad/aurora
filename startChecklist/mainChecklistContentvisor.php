
    <?php 
        include_once 'Class.php';
        $crudcontroller = new CrudController();
        $dao = new Dao();
        $conn = $dao->openConnection();
        $id = $_POST['id'];
        $AcName = $_POST['AcName'];
       $pid=$id ;
         $selectedaidfromSkippedArea = $_POST['aid'];
        $Datetoday = $crudcontroller->getDate();
    ?>
<?php
if (! empty($result)) {

?>
     
    <!-- justified -->
    

    <div class="row">
        <div class="col-md-12">
        <form method="POST" action="viewing_grade_visor.php" id="saveImage" enctype="multipart/form-data">
     
            
                
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
                                <a href="#" onclick="completebuildingModal_visor('<?php echo $BldgCat ?>','<?php echo $rowggetBuildingId['Bid']; ?>')" ><h5 style="text-decoration:none;text-align:center;color:#fff;background-color:#dfdfdf" class="mg-title text-bold">Back</h5></a>
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
                            <a href="#" onclick="completebuildingModal_visor('<?php echo $BldgCat ?>','<?php echo $rowggetBuildingId['Bid']; ?>')" ><h5 style="text-decoration:none;text-align:center;color:#fff;background-color:#dfdfdf" class="mg-title text-bold">Back</h5></a>
                        <?php
                        }
                       

                  
                        if($showArea->rowCount() > 0){
                            // while($rowareaheader = $showArea->fetch(PDO::FETCH_ASSOC)){
                                ?>  
                                    
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
                                                                    Spot Audit
                                                                </th>
                                                            </tr>

                                                            <tr>
                                                                <th colspan="6" style="text-align:center; background-color:#ca6f03;color:#ffffff"></th>
                                                            </tr>
                                                        <tr>
                                                        <?php
                                                      
                                                            $showarea = $conn->prepare("SELECT * FROM Area where Pid = :Pid ORDER BY Aid ASC");
                                                            $showarea->execute(array(":Pid"=>$id));
                                                            if($showarea->rowCount() > 0){
                                                            while($rowshowarea = $showarea->fetch(PDO::FETCH_ASSOC)){
                                                                $ANames = $rowshowarea['AName'];
                                                            // echo $cid;
                                                        ?>
                                                        
                                                            <th colspan="4" style="text-align:center; background-color:#34495e8a;color:#ffffff">
                                                            <?php echo strtoupper($rowshowarea['AName'])?></th>
                                                            <input type="hidden" name="areaname[]" value="<?php echo $rowshowarea['AName'];?>"/> 
                                                            
                                                            <input style="background-color:red" type="hidden" name="aid[]"  value="<?php echo $rowshowarea['Aid']?>" /> <!--- id array ng mga checklist -->
                                                            <input style="background-color:green"type="hidden" name="pid" id="pid" value=<?php echo $id?>> <!--- id array ng mga phase -->
                                                        </tr>
                                                    </thead>
                                                    
                                                    <tbody>
                                                       
                                                        <tr>
                                                            <center>
                                                            <td style="text=align:center">Compliance
                                                                <div style="height:100px;background-color:#ef6c0026;border:1px solid #ef6c006e;cursor:pointer;border-radius:10px;" onclick="addmoreImgVisor('<?php echo $rowshowarea['Aid']?>','<?php echo $Datetoday?>','<?php echo $ANames?>','<?php echo $id?>')"
                                                                 ><img  src="icons/camera.png" style="height:80px;width:auto;cursor:pointer;" />Open to view/add Compliance Image</div>
                                                            </td>
                                                            <td style="text=align:center" >Non-Compliance
                                                                <div style="height:100px;background-color:#ef6c0026;border:1px solid #ef6c006e;cursor:pointer;border-radius:10px;" onclick="addmoreImgVisor_noncompliance('<?php echo $rowshowarea['Aid']?>','<?php echo $Datetoday?>','<?php echo $ANames?>','<?php echo $id?>','<?php echo $Bldgid?>')"
                                                                 ><img  src="icons/camera.png" style="height:80px;width:auto;cursor:pointer;" />Open to view/add Non-Compliance Image</div>
                                                            </td>
                                                            </center>
                                                        </tr>
                                                        
                                                        <?php
                                                                }
                                                            }
                                                        ?>     

                                                        <tr>
                                                        <center>
                                                            <td  colspan="6">
                                                            <input type="hidden" value="<?php echo $AcName ?>"name="qastaff" id="qastaff"/>
                                                            <button onclick="BacktoPhaseVisor()" type="button" style="float: right;"class="btn btn-warning">Done</button>
                                                            <!-- <button onclick="skipAreaButton('<?php echo $rowareaheader['Aid'];?>')" class="btn btn-danger">Skip</button>
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
                                                                
                                                            ?> -->

                                                        
                                                            
                                                            </td>
                                                    </center>
                                                        </tr>   

                                                    </tbody>
                                                </table>
                                            </div>
                                        </section>
                                    
                                    <?php
                                        }

                                    ?>
                                    
                                    
                                    
                                </section> 
                            </div>
                         </div>                  
                    </div>
                    
                </form>


            </div>
        </div>
        <script>
            
        
        </script>    