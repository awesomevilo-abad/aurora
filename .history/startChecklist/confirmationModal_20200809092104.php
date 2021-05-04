<a style="display:none;" id="confirmModal" class="mb-xs mt-xs mr-xs modal-basic btn btn-primary" href="#modalHeaderColorPrimary">Primary</a>
<div id="modalHeaderColorPrimary" class="modal-block modal-header-color modal-block-primary mfp-hide">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Decline Phase</h2>
                    <div >
                        <h2><a style="height:10px;width:10px;border-radius:50%;color:#dfdfdf;text-decoration:none;right:30px;position: absolute;
	                    top: 15px;" href="#" class="modal-dismiss fa fa-times"></a></h2>
                    </div>

        </header>
                   <?php
                //    session_start(); 
                    $getStaff = $conn->prepare("SELECT * FROM accounts WHERE Username=:pid");
                    $getStaff->execute(array(":pid"=> $_SESSION['username']));
                    $rowgetStaff = $getStaff->fetch(PDO::FETCH_ASSOC);
                    
                    $staffname =  $rowgetStaff['AcName'];
                    $staffpos =  $rowgetStaff['Position'];

                    $substring = substr($staffname, 0, strpos($staffname, ' '));
                    
                    $Datetoday = $crudcontroller->getDate();
                    $currentMonth = date("F",strtotime($Datetoday));
                    ?>

        <div class="panel-body">
            <div class="modal-wrapper">
                <div class="modal-icon">
                    <i class="fa fa-question-circle"></i>
                </div>
                <div class="modal-text">
                   <center> <h4>
                    <p style="color:#0088cc"><strong><?php echo $substring?></strong></p><p> Do you want to Inspect this phase <br> <strong>if decline, Sanitation, Structural and Equipment Grade will be 50%</strong></p></center></h4>
                   <div  class="col-4  text-center">
                    <center><strong><label>Week: </label></strong></center>
                    <select  style="text-align:center;border:none" class="form-control" name="week" id="week" onchange="changeWeek_showYearIfDecember5thWeek(this.value)">
                        <option value=" " selected> </option>
                        <option value="1">1st Week</option>
                        <option value="2">2nd Week</option>
                        <option value="3">3rd Week</option>
                        <option value="4">4th Week</option>
                        <option value="5">5th Week</option>
                    </select>
                    </div>
                    <br>
                    <div  class="col-4  text-center">
                    <center><strong><label> Month: </label></strong></center>
                    <select  style="text-align:center;border:none" class="form-control" name="month" id="month" onchange="changeMonth_showYearIfDecember5thWeek(this.value)"required>
                        <option value="<?php echo $currentMonth?>" selected><?php echo $currentMonth?> </option>
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                    </select>
                    </div>
                    <div  class="col-4 text-center" id="divyear">
                    <center><strong><label> Year: </label></strong></center>
                    <select  style="text-align:center;border:none" class="form-control" name="year" id="year" required>
                    <?php
                    for($i=0;$i<6;$i++){
                        $year = date("Y",strtotime($Datetoday))+$i;
                        ?>
                        <option value="<?php echo $year ?>"><?php echo $year ?></option>
                        <?php

                    }
                    ?>
                    </select>
                    </div>
                </div>
            </div>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <input type="hidden" id="passID"/> <!--id na isasama sa ajax-->
                    <input type="hidden" id="pageType"/> <!--id na isasama sa ajax-->
                   
                    <button onclick="getID('<?php echo $staffpos ?>')" type="button"class="btn btn-primary" > Continue</button>
                    <button onclick="declinephase()" type="button"class="btn btn-danger">Decline Phase</button>
                </div>
            </div>
        </footer>
    </section>
</div>