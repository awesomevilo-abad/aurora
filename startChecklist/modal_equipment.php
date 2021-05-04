<a class="modal-with-form btn btn-default" href="#openModalEq" id="openStaff" style="display:;">Open</a>
    <div id="openModalEq" class="modal-block modal-block-primary mfp-hide">
        <section class="panel">
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
                                                        <button class="btn btn-success">Submit</button>
                                                        </td>
                                                   </center>
                                                    </tr>    
                                                    
                                            </tbody>
                                            
                                        </table>  
        </section>
    </div>