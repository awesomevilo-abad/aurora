<?php 
        include_once 'Class.php';
        $crudcontroller = new CrudController();
        $dao = new Dao();
        $conn = $dao->openConnection();

        $id = $_POST['id'];
        $phase = $conn->prepare("SELECT * FROM phase WHERE Pid=:pid");
        $phase->execute(array(":pid"=>$id));
        $rowPhase = $phase->fetch(PDO::FETCH_ASSOC);
        $bid =  $rowPhase['Bid'];

        $areaglobal = $conn->prepare("SELECT * FROM area WHERE Pid=:pid");
        $areaglobal->execute(array(":pid"=>$id));
        $rowAreaglobal = $areaglobal->fetch(PDO::FETCH_ASSOC);
        $phaseaid = $rowAreaglobal['Aid'];
        
        $getBuilding = $conn->prepare("SELECT * FROM Building WHERE id=:Bid");
        $getBuilding->execute(array(":Bid"=> $rowPhase['Bid']));
        $rowgetBuilding = $getBuilding->fetch(PDO::FETCH_ASSOC);
        $category =  $rowgetBuilding['Category'];
    ?>
    <input type="hidden" name="phaseaid" value="<?php echo $phaseaid ?>" />

<div class="row">
                 <a href="#" onclick="BacktoPhase(<?php echo $id ?>)" ><h5 style="text-decoration:none;text-align:center;color:#fff;background-color:#dfdfdf" class="mg-title text-bold">Back</h5></a>

						<div class="col-md-12">
                            <center><h2><?php echo $rowPhase['PName'];?></h2></center>
                            
							<div class="tabs">
								<ul class="nav nav-tabs nav-justified">
                                <li class="active">
										<a href="#popular10" data-toggle="tab" class="text-center">Sanitation</a>
                                    </li>
                                    <li>
										<a href="#popular11" data-toggle="tab" class="text-center">Structural</a>
									</li>
									<li>
										<a href="#recent10" data-toggle="tab" class="text-center">Equipment</a>
									</li>
                                </ul>

                             <form method="POST" id="formResults">
								<div class="tab-content">
									<div id="popular10" class="tab-pane active">
									    <div style="margin:10px;" id="result">
                                        <!-- Sanitation -->
                                        <input type="text" name="bid" id="bid" value="<?php echo $bid  ?>" /><!--important-->
                                        <input type="text" name="pid" id="pid" value="<?php echo $id  ?>" /><!--important-->
                                       
                                        
                                                        <table class="table table-bordered table-striped table-condensed mb-none">
                                                            <thead>
                                                                <tr>
                                                                    <th>Area Name</th>
                                                                    <th>Sanitation Grade</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                                $area = $conn->prepare("SELECT * FROM area WHERE Pid=:pid");
                                                                $area->execute(array(":pid"=>$id));
                                                                while( $rowArea = $area->fetch(PDO::FETCH_ASSOC)){
                                                                    ?>
                                                                    <tr>
                                                                       <td><?php echo $rowArea['AName'];  ?>
                                                                       <input type="text" name="aid[]" id="aid" value="<?php echo $rowArea['Aid']  ?>" /> <!--important-->
                                                                       <input type="text" name="cid[]" id="cid" value="0000" /> <!--important-->
                                                                       <input type="text" name="cname[]" id="cname" value="declined" /> <!--important-->
                                                                       </td>
                                                                       <td><?php echo $arraySum[] = floatval(50)* floatval($rowArea['Percentage']);?>
                                                                       <input type="text" value="<?php echo floatval(50)* floatval($rowArea['Percentage'])   ?>" name="arraySani[]"/> <!--input type arraySanitation-->
                                                                       </td>
                                                                       
                                                                    </tr>
                                                                    <?php   

                                                                }
                                                                
                                                            ?>
                                                            <tr style="background-color:#ccffcc">
                                                                <td><strong>Total</strong></td>
                                                                <td><?php
                                                                if(empty($arraySum)){
                                                                    echo "No Record";
                                                                }else{
                                                                $sum = array_sum($arraySum);
                                                                echo $totalsani = round($sum, 2);
                                                                }?>
                                                                 <input type="hidden" name="totalsani" id="totalsani" value="<?php echo $totalsani  ?>" /> <!--important-->
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
										</div>
                                    </div>
                                    
                                    <!-- Structural -->
                                    <div id="popular11" class="tab-pane">
									    <div style="margin:10px;" id="result2">
                                        <table class="table table-bordered table-striped table-condensed mb-none">
                                                <thead>
                                                    <tr>
                                                        <th>Area Name</th>
                                                        <th>Structural Grade</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                    $area = $conn->prepare("SELECT * FROM area WHERE Pid=:pid");
                                                    $area->execute(array(":pid"=>$id));
                                                    while( $rowArea = $area->fetch(PDO::FETCH_ASSOC)){
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $rowArea['AName'];  ?></td>
                                                            <td><?php echo $arraySumSt[] = floatval(50)* floatval($rowArea['Percentage']);?>
                                                            <input type="text" value="<?php echo floatval(50)* floatval($rowArea['Percentage'])   ?>" name="arrayStr[]"/> <!--input type arraySanitation-->
                                                            </td>
                                                        </tr>
                                                        <?php   

                                                    }
                                                    
                                                ?>
                                                <tr style="background-color:#ccffcc">
                                                    <td><strong>Total</strong></td>
                                                    <td><?php
                                                    if(empty($arraySumSt)){
                                                        echo "No Record";
                                                    }else{
                                                    $sumSt = array_sum($arraySumSt);
                                                    echo $totalstr = round($sumSt, 2);
                                                    }
                                                    ?>
                                                    <input type="text" name="totalstr" id="totalstr" value="<?php echo $totalstr  ?>" /> <!--important-->
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>                              

										</div>
                                    </div>

                                    
									<div id="recent10" class="tab-pane">
									    <div style="margin:10px;" id="result2">
                                        <table class="table table-bordered table-striped table-condensed mb-none">
                                                <thead>
                                                    <tr>
                                                        <th>Area Name</th>
                                                        <th>Equipment Grade</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                
                                                    $area = $conn->prepare("SELECT * FROM Area WHERE Pid=:pid");
                                                    $area->execute(array(":pid"=>$id));
                                                   if($area->rowCount() > 0){
                                                    $rowArea = $area->fetch(PDO::FETCH_ASSOC);
                                                         $equipment = $conn->prepare("SELECT equipment.EName,area.AName,area.percentageequip,area.Aid FROM Equipment inner join Area on equipment.Aid = Area.Aid WHERE area.Pid=:pid Group by area.Aid");
                                                         $equipment->execute(array(":pid"=>$rowArea['Pid']));
                                                        while($rowequipment = $equipment->fetch(PDO::FETCH_ASSOC)){
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $rowequipment['AName']?>
                                                        <input type="text" name="eaid[]" id="eaid" value="<?php echo $rowequipment['Aid']  ?>" /> <!--important-->                                                        </td>
                                                        <td><?php echo round($arraySumEq[] = floatval(50)* floatval($rowequipment['percentageequip']),2)?>
                                                        <input type="text" name="egrade[]" id="egrade" value="<?php echo floatval(50)* floatval($rowequipment['percentageequip'])  ?>" /> <!--important-->                                                        
                                                        </td>
                                                        
                                                    </tr>
                                                        
                                                    <?php   
                                                    }
                                                   }else{
                                                       echo "No Area in selected Phase";
                                                   }
                                                    
                                                ?>
                                                <tr style="background-color:#ccffcc">
                                                    <td><strong>Total</strong></td>
                                                    <td><?php
                                                    if(isset($arraySumEq)){
                                                        $average = array_sum($arraySumEq);
                                                        echo round($average, 2);
                                                    }else{
                                                        echo "No Equipment in this Phase";
                                                    }
                                                    	
                                                    ?>
                                                    <input type="text" name="totalegrade" id="totalegrade" value="<?php echo round($average, 2)  ?>" /> <!--important-->                                                        
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>  
										</div>
                                        
                                        <center><div><input onclick="completeDeclineModal('<?php echo $id; ?>','<?php echo $bid ?>','<?php echo $category ?>')" type="button" class="btn btn-success" value="Completed"></div></center>
                                        <button type="submit" id="btnAdd" class="btn btn-primary">Submit</button>
                                    </div>
								</div>
                                </form>
							</div>
						</div>

						
					</div>