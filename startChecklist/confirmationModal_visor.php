<a style="display:none;" id="confirmModal" class="mb-xs mt-xs mr-xs modal-basic btn btn-primary" href="#modalHeaderColorPrimary">Primary</a>
<div id="modalHeaderColorPrimary" class="modal-block modal-full-color modal-block-primary mfp-hide">
    <section class="panel">
        <header class="panel-heading">
            <h2 class="panel-title">Spot Audit</h2>
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
                    
                    ?>

        <div class="panel-body">
            <div class="modal-wrapper">
                <div class="modal-icon">
                    <i class="fa fa-question-circle"></i>
                </div>
                <div class="modal-text">
                   <center> <h4>
                    <p style="color:#fff"><strong><?php echo $substring?></strong></p><p> Do you want to Inspect this phase <br> <strong>Once Save this phase is available within the day.</strong></p></center></h4>
                </div>
            </div>
        </div>
        <footer class="panel-footer">
            <div class="row">
                <div class="col-md-12 text-right">
                    <input type="hidden" id="passID"/> <!--id na isasama sa ajax-->
                    <input type="hidden" id="pageType"/> <!--id na isasama sa ajax-->
                   
                    <button onclick="getID('<?php echo $staffpos ?>')" class="btn btn-primary" > Continue</button>
                    <button  class="btn btn-danger modal-dismiss">Close</button>
                </div>
            </div>
        </footer>
    </section>
</div>