<?php
include_once 'Report/class.php';
$crudcontroller = new CrudController();
$dao = new Dao();
$conn = $dao->openConnection();
$Datetoday = $crudcontroller->getDate();
?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />

    <title>Aurora</title>

    <link rel='stylesheet' type='text/css' href='EditableInvoice/css/style.css' />
    <link rel='stylesheet' type='text/css' href='EditableInvoice/css/print.css' media="print" />
    <script type='text/javascript' src='EditableInvoice/js/jquery-1.3.2.min.js'></script>
    <script type='text/javascript' src='EditableInvoice/js/example.js'></script>
    <meta http-equiv="refresh" content="5; URL=Report_filterreports.php?phase=<?php echo $_GET['phase'] ?>&start_auditreport=<?php echo $_GET['start_auditreport']?>&end_auditreport=<?php echo $_GET['end_auditreport']?>&auditee=<?php echo $_SESSION['AcName']?>">
    <style>
    thead { display: table-row-group;}
  tfoot { display: table-row-group; }
  tr { page-break-inside: avoid ;}

  </style>
  <script src="Report/history.js"></script>
</head>
<body onload="window.print(); window.close();" >

<section class="panel col-sm-12">
        <div class="panel-body">
        <img src="icons/rdflogo.jpg" style="float:right;height:50px;">
            <img src="icons/logo.jpg" style="float:left;height:50px;">
            <br><br><br>
            <div class="table-responsive">
                <table class="table table-bordered table-striped mb-none" id="datatable-tabletools" data-swf-path="assets/vendor/jquery-datatables/extras/TableTools/swf/copy_csv_xls_pdf.swf"> 
                        <thead>
                        <?php   
                                    $phase= $_GET['phase'];
                                    $start_auditreport = date('Y-m-d',strtotime($_GET['start_auditreport']));
                                    $end_auditreport= date('Y-m-d',strtotime($_GET['end_auditreport']));
                                      $showBuilding = $conn->prepare("SELECT * FROM equipment_grade 
                                      left join area on equipment_grade.aid = area.Aid
                                      left join phase on equipment_grade.pid = phase.Pid
                                      left join timedatephase on equipment_grade.pid = timedatephase.pid and equipment_grade.Date_Checked_equipment = timedatephase.date_checked 
                                      left join accounts on timedatephase.protect = accounts.Acid
                                      WHERE equipment_grade.egrade = 75 and equipment_grade.pid = '".$phase."' and equipment_grade.Name != 'No Equipment' and equipment_grade.Date_Checked_equipment >='".$start_auditreport."' and equipment_grade.Date_Checked_equipment <='".$end_auditreport."' 
                                      Group By equipment_grade.aid, equipment_grade.Date_Checked_equipment
                                      ORDER BY equipment_grade.aid,equipment_grade.Date_Checked_equipment DESC");
                                      $showBuilding->execute();
                                      $rowshowBuilding = $showBuilding->fetch(PDO::FETCH_ASSOC);
              
                            ?>
                            <tr>
                                
                                <th colspan="8"  style="text-align:center;background-color:#b4700d;border-bottom:#00476b;border-top-right-radius:;">Equipment</th>
                            </tr>
                           
                            
                        </thead>
                        <tbody>
                        
                        <tr>
                        <?php   
                                    $phase= $_GET['phase'];
                                    $start_auditreport = date('Y-m-d',strtotime($_GET['start_auditreport']));
                                    $end_auditreport= date('Y-m-d',strtotime($_GET['end_auditreport']));
                                      $showBuilding = $conn->prepare("SELECT * FROM equipment_grade 
                                      left join area on equipment_grade.aid = area.Aid
                                      left join phase on equipment_grade.pid = phase.Pid
                                      left join timedatephase on equipment_grade.pid = timedatephase.pid and equipment_grade.Date_Checked_equipment = timedatephase.date_checked 
                                      left join accounts on timedatephase.protect = accounts.Acid
                                      WHERE equipment_grade.egrade = 75 and equipment_grade.pid = '".$phase."' and equipment_grade.Name != 'No Equipment' and equipment_grade.Date_Checked_equipment >='".$start_auditreport."' and equipment_grade.Date_Checked_equipment <='".$end_auditreport."' 
                                      Group By equipment_grade.aid, equipment_grade.Date_Checked_equipment
                                      ORDER BY equipment_grade.aid,equipment_grade.Date_Checked_equipment DESC");
                                      $showBuilding->execute();
                                      $rowshowBuilding = $showBuilding->fetch(PDO::FETCH_ASSOC);
                                      $Date= $rowshowBuilding['Date_Checked_equipment'];
              
                            ?>
                            <td colspan="8" style="text-align:center;background-color:#b4700db8;"><strong><?php echo $rowshowBuilding['AName'];?></strong>
                            <?php 
                                    $getpercent = $conn->prepare("SELECT * FROM area
                                    WHERE Aid ='".$rowshowBuilding['Aid']."'
                                --  Group By Aid
                                    ORDER BY Aid ASC");
                                    $getpercent->execute();
                                    $rowgetpercent = $getpercent->fetch(PDO::FETCH_ASSOC);
                                    $percentage = $rowgetpercent['percentageequip'];
                            ?> %
                                <small>(<?php echo $rowgetpercent['percentageequip'] * 100; ?>)</small>
                            </td>
                                  
                                
                                <?php
                           
                            ?></tr>
                             <tr>
                            <td style="background-color:#b4700d30">Date Auditted</td>
                            <td style="background-color:#b4700d30">Equipment</td>
                            <td style="background-color:#b4700d30">Grade</td>
                            <td style="background-color:#b4700d30">Remarks</td>
                            <td style="background-color:#b4700d30">Status</td>
                            <td style="background-color:#b4700d30">Decline Reason</td>
                            <td style="background-color:#b4700d30">QA Staff</td>
                            <td style="background-color:#b4700d30">Protech/Supervisor</td>
                            </tr>
                            <?php
                                $phase= $_GET['phase'];
                                $area= $rowshowBuilding['Aid'];
                                $showAreas = $conn->prepare("SELECT equipment_grade.Date_Checked_equipment
                                ,equipment_grade.Name,equipment.Asset_Number,equipment_grade.egrade,equipment_grade.remarksequip
                                ,timedatephase.targetGrade_status_equip,timedatephase.declineReason
                                ,timedatephase.qastaff,Accounts.AcName FROM equipment_grade 
                                left join area on equipment_grade.aid = area.Aid
                                left join phase on area.Pid = phase.Pid
                                left join timedatephase on area.Pid = timedatephase.Pid and equipment_grade.Date_Checked_equipment = timedatephase.Date_Checked 
                                left join accounts on timedatephase.protect = accounts.Acid
                                left join equipment on equipment_grade.eid = equipment.Eid
                                WHERE equipment_grade.egrade = 75 and area.Pid = '".$phase."' and equipment_grade.aid = '".$area."'   and equipment_grade.Name != 'No Equipment' and equipment_grade.Date_Checked_equipment >='".$start_auditreport."' and equipment_grade.Date_Checked_equipment <='".$end_auditreport."' 
                                Group By equipment_grade.eid, equipment_grade.Date_Checked_equipment
                                ORDER BY area.Aid,equipment_grade.Date_Checked_equipment DESC");
                                $showAreas->execute();
                                WHILE($rowshowAreas = $showAreas->fetch(PDO::FETCH_ASSOC)){
                               
                            ?>
                            <tr>
                                <td><?php echo $rowshowAreas['Date_Checked_equipment'];?></td>
                                <td><?php echo $rowshowAreas['Name'];?> # <?php echo $rowshowAreas['Asset_Number'];?> </td>
                                <td><?php echo $rowshowAreas['egrade'];?> %</td>
                                <td><?php echo $rowshowAreas['remarksequip'];?></td>
                                <td><?php echo $rowshowAreas['targetGrade_status_equip'];?></td>
                                <td><?php echo $rowshowAreas['declineReason'];?></td>
                                <td><?php echo $rowshowAreas['qastaff'];?></td>
                                <td>
                                    <?php
                                    $viewAcName = $conn->prepare("SELECT * FROM checklist_grade 
                                    left join phase on checklist_grade.Pid = phase.Pid 
                                    left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
                                    left join accounts on timedatephase.protect = accounts.Acid
                                    left join building on checklist_grade.Bid = building.id 
                                    Where checklist_grade.Date_Checked = '". $rowshowBuilding['date_checked']."' 
                                    and checklist_grade.Pid = '".$rowshowBuilding['Pid']."'
                                    and timedatephase.qastaff = '".$rowshowBuilding['qastaff']."'
                                    Group By accounts.AcName , checklist_grade.Date_checked
                                    ORDER BY checklist_grade.Pid ASC");
                                    $viewAcName->execute(array());
                                    while($rowviewAcName = $viewAcName->fetch(PDO::FETCH_ASSOC)){
                                        echo " - ".$rowviewAcName['AcName'];
                                        
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                
                           
                            
                             
                            // print_r($arraygrades);

                            }
                            
                        ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td style="background-color:#47a4472e"><?php echo $rowshowBuilding['totalequipgrade'];?> %</td>
                            </tr>

                        <?php
                        
                        
                            ?>
                                            </tr>
                              

                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                                <br>
                        
                        </tbody>
                 </table>
                 <br>
                 <br>
                 <br>
                 <br>
                 
                 <hr style="width:30%">
                            <?php
                            echo "Prepared By : ".$_GET['auditee'];?><br><?php
                            echo "Date Auditted: ".$Datetoday;
                             ?>
            </div>
     </section>
        
        <!-- Gallery -->
        <!-- <?php include_once 'history_pic.php'; ?> -->

<!-- Examples -->
<script src="assets/javascripts/tables/examples.datatables.ajax.js"></script>
<script src="assets/javascripts/forms/examples.advanced.form.js" ></script>	    
<script src="assets/javascripts/tables/examples.datatables.default.js"></script>
<script src="assets/javascripts/tables/examples.datatables.tabletools.js"></script>
<!-- <script src="assets/javascripts/ui-elements/examples.modals.js"></script> -->




</body>

</html>

