    <?php 
        include_once 'Class.php';
        $crudcontroller = new CrudController();
        $dao = new Dao();
        $conn = $dao->openConnection();

        $id = $_POST['id'];
        
    ?>

<div class="row">
						<div class="col-md-12">
							<div class="tabs">
								<ul class="nav nav-tabs nav-justified">
									<li class="active">
										<a href="#popular10" data-toggle="tab" class="text-center">Sanitation and Structural</a>
									</li>
									<li>
										<a href="#recent10" data-toggle="tab" class="text-center">Equipment</a>
									</li>
								</ul>
								<div class="tab-content">
									<div id="popular10" class="tab-pane active">
									    <div style="margin:10px;" id="result">
                                        <!-- Sanitation -->
                                        <a href="#" onclick="BacktoPhase(<?php echo $id ?>)" ><h5 style="text-decoration:none;text-align:center;color:#fff;background-color:#dfdfdf" class="mg-title text-bold">Back</h5></a>
                                            <form method="POST" id="formResult">
                                                <section class="panel">
                                                    <header class="panel-heading">
                                                        <div class="panel-actions">
                                                            <a href="#" class="fa fa-caret-down"></a>
                                                            <a href="#" class="fa fa-times"></a>
                                                        </div>
                                                        <?php
                                                            $grades = $conn->prepare("SELECT  Aid FROM checklist_grade GROUP BY Aid");
                                                            $grades->execute();
                                                            if($grades->rowCount() > 0){
                                                                $rowGrades = $grades->fetch(PDO::FETCH_ASSOC);
                                                                $area = $conn->prepare("SELECT * FROM area WHERE Pid=:Pid AND Aid != :Aid ORDER BY Aid ASC LIMIT 1");
                                                                $area->execute(array(":Pid" => $id, ":Aid" => $rowGrades['Aid']));
                                                            }
                                                            else{
                                                                $area = $conn->prepare("SELECT * FROM area WHERE Pid=:Pid ORDER BY Aid ASC LIMIT 1");
                                                                $area->execute(array(":Pid" => $id));
                                                            }

                                                    
                                                        while($rowArea = $area->fetch(PDO::FETCH_ASSOC)){
                                                            ?>
                                                            <h2 class="panel-title"style="text-align:center"><?php echo $rowArea['AName'];?></h2> 
                                                            <?php $aid = $rowArea['Aid']; ?>
                                                            <input style="background-color:green"type="hidden" name="pid" id="pid" value=<?php echo $id?>> <!--- id array ng mga phase -->
                                                            <input style="background-color:blue" type="hidden" name="aid" id="aid" value=<?php echo $aid?>> <!--- id array ng mga checklist -->
                                                    </header>
                                                    <div class="panel-body">
                                                        <table class="table table-bordered table-striped table-condensed mb-none">
                                                            <thead>
                                                                <tr>
                                                                <?php
                                                                // echo $aid;
                                                                    $checklist = $conn->prepare("SELECT * FROM checklist where Aid = ".$aid." ");
                                                                    $checklist->execute();
                                                                    if($checklist->rowCount() > 0){
                                                                    while($rowCheck = $checklist->fetch(PDO::FETCH_ASSOC)){
                                                                    $cid = $rowCheck['Cid'];
                                                                    // echo $cid;
                                                                ?>
                                                                
                                                                    <th colspan="4" style="text-align:center">
                                                                    <input style="background-color:red" type="hidden" name="cid[]" id="cid" value=<?php echo $cid?>> <!--- id array ng mga checklist -->
                                                                    <input style="background-color:red" type="hidden" name="cname[]" id="cname" value=<?php echo  $rowCheck['CName']?>> <!--- id array ng mga checklist -->
                                                                    <?php echo $rowCheck['CName']?></th>
                                                                    
                                                                    
                                                                    <input style="background-color:green"type="hidden" name="pid" id="pid" value=<?php echo $id?>> <!--- id array ng mga phase -->
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td  colspan="2">
                                                                    <label>Sanitation Grade</label>
                                                                    </td>
                                                                    <td  colspan="2">
                                                                    <input type="text" name="SaniGrade<?php echo $cid;?>" value="50" class="form-control" disabled/>
                                                                    </td>
                                                                </tr>
                                                            
                                                                <tr>
                                                                    <td  colspan="2">
                                                                    <label>Structural Grade</label>
                                                                    </td>
                                                                    <td  colspan="2">
                                                                    <input type="text" name="StruGrade<?php echo $cid;?>" value="50" class="form-control" disabled/>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                    }
                                                                }
                                                            }
                                                                
                                                                ?>
                                                                <tr>
                                                                    <td  colspan="2">
                                                                    <button class="btn btn-success">Submit</button>
                                                                    </td>
                                                                </tr>
                                                                
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    
                                                </section>
                                            </form>
                                            

										</div>
									</div>
									<div id="recent10" class="tab-pane">
									    <div style="margin:10px;" id="result2">
                                        <!-- Equipment -->
                                        <a href="#" onclick="BacktoPhase(<?php echo $id ?>)" ><h5 style="text-decoration:none;text-align:center;color:#fff;background-color:#dfdfdf" class="mg-title text-bold">Back</h5></a>
                                            <form method="POST" id="formResult">
                                                <section class="panel">
                                                    <header class="panel-heading">
                                                        <div class="panel-actions">
                                                            <a href="#" class="fa fa-caret-down"></a>
                                                            <a href="#" class="fa fa-times"></a>
                                                        </div>
                                                        <?php
                                                            $grades = $conn->prepare("SELECT  aid FROM equipment_grade GROUP BY aid");
                                                            $grades->execute();
                                                            if($grades->rowCount() > 0){
                                                                $rowGrades = $grades->fetch(PDO::FETCH_ASSOC);
                                                                $area = $conn->prepare("SELECT * FROM area WHERE Pid=:Pid AND Aid != :Aid ORDER BY Aid ASC LIMIT 1");
                                                                $area->execute(array(":Pid" => $id, ":Aid" => $rowGrades['Aid']));
                                                            }
                                                            else{
                                                                $area = $conn->prepare("SELECT * FROM area WHERE Pid=:Pid ORDER BY Aid ASC LIMIT 1");
                                                                $area->execute(array(":Pid" => $id));
                                                            }

                                                    
                                                        while($rowArea = $area->fetch(PDO::FETCH_ASSOC)){
                                                            ?>
                                                            <h2 class="panel-title"style="text-align:center"><?php echo $rowArea['AName'];?></h2> 
                                                            <?php $aid = $rowArea['Aid']; ?>
                                                            <input style="background-color:green"type="hidden" name="pid" id="pid" value=<?php echo $id?>> <!--- id array ng mga phase -->
                                                            <input style="background-color:blue" type="hidden" name="aid" id="aid" value=<?php echo $aid?>> <!--- id array ng mga checklist -->
                                                    </header>
                                                    <div class="panel-body">
                                                        <table class="table table-bordered table-striped table-condensed mb-none">
                                                            <thead>
                                                                <tr>
                                                                <?php
                                                                // echo $aid;
                                                                    $equip = $conn->prepare("SELECT * FROM equipment where Aid = ".$aid." ");
                                                                    $equip->execute();
                                                                    if($equip->rowCount() > 0){
                                                                    while($rowequip = $equip->fetch(PDO::FETCH_ASSOC)){
                                                                    $cid = $rowequip['Eid'];
                                                                    // echo $cid;
                                                                ?>
                                                                
                                                                    <th colspan="4" style="text-align:center">
                                                                    <input style="background-color:red" type="hidden" name="cid[]" id="cid" value=<?php echo $cid?>> <!--- id array ng mga checklist -->
                                                                    <input style="background-color:red" type="hidden" name="cname[]" id="cname" value=<?php echo  $rowCheck['CName']?>> <!--- id array ng mga checklist -->
                                                                    <?php echo $rowCheck['CName']?></th>
                                                                    
                                                                    
                                                                    <input style="background-color:green"type="hidden" name="pid" id="pid" value=<?php echo $id?>> <!--- id array ng mga phase -->
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td  colspan="2">
                                                                    <label><?php echo $rowequip['EName'];?></label>
                                                                    </td>
                                                                    <td  colspan="2">
                                                                    <input type="text" name="SaniGrade<?php echo $cid;?>" value="50" class="form-control" disabled/>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                    }
                                                                }
                                                            }
                                                                
                                                                ?>
                                                                <tr>
                                                                    <td  colspan="2">
                                                                    <button class="btn btn-success">Submit</button>
                                                                    </td>
                                                                </tr>
                                                                
                                                                
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    
                                                </section>
                                            </form>

										</div>
									</div>
								</div>
							</div>
						</div>

						
					</div>