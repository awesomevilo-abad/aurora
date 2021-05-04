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
    <meta http-equiv="refresh" content="5; URL=Report_filterreports.php?building=<?php echo $_GET['building'] ?>&start_auditreport=<?php echo $_GET['start_auditreport']?>&end_auditreport=<?php echo $_GET['end_auditreport']?>&auditee=<?php echo $_GET['AcName']?>">
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
                                    $building= $_GET['building'];
                                    $phase= $_GET['phase'];
                                    $start_auditreport = date('Y-m-d',strtotime($_GET['start_auditreport']));
                                    $end_auditreport= date('Y-m-d',strtotime($_GET['end_auditreport']));
                                      $showBuilding = $conn->prepare("SELECT * FROM checklist_grade 
                                      left join area on checklist_grade.Aid = area.Aid 
                                      left join phase on checklist_grade.Pid = phase.Pid 
                                      left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
                                      left join accounts on timedatephase.protect = accounts.Acid
                                      left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
                                      left join building on checklist_grade.Bid = building.id 
                                      where Accounts.AcName != '' and  checklist_grade.Pid LIKE '".$phase."' AND checklist_grade.Date_Checked >= '".$start_auditreport."'  and checklist_grade.Date_Checked <= '".$end_auditreport."'
                                      Group By checklist_grade.Aid, checklist_grade.Date_checked
                                      ORDER BY checklist_grade.Aid ASC ");
                                      $showBuilding->execute();
                                      $rowshowBuilding = $showBuilding->fetch(PDO::FETCH_ASSOC);
              
                            ?>
                            <tr>
                                <th colspan="2" style="text-align:center;background-color:#34495ec2;color:#fdfdfd;border-top-left-radius:;">All</th>
                                <th colspan="6"  style="text-align:center;background-color:#34495ec2;color:#fdfdfd;border-top-right-radius:;">Score</th>
                            </tr>
                            
                        </thead>
                        <tbody>
                        
                            <tr>
                                <td style="background-color:#34495e42">Date Audited</td>
                                <td style="background-color:#34495e42"><?php echo $rowshowBuilding['PName'];?></td>
                                <td style="background-color:#34495e42">%Distribution</td>
                                <td style="background-color:#34495e42">Sanitation</td>
                                <td style="background-color:#34495e42">Structural</td>
                                <td style="background-color:#34495e42">Equipment</td>
                                <td style="background-color:#34495e42">QA Staff</td>
                                <td style="background-color:#34495e42">Protech</td>
                            </tr>

                                 <?php
                                     $showgrade = $conn->prepare("SELECT * FROM checklist_grade 
                                     left join area on checklist_grade.Aid = area.Aid 
                                     left join phase on checklist_grade.Pid = phase.Pid 
                                     left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
                                     left join accounts on timedatephase.protect = accounts.Acid
                                     left join equipment_grade on area.Aid = equipment_grade.Aid and checklist_grade.Date_Checked = equipment_grade.Date_Checked_equipment
                                     left join building on checklist_grade.Bid = building.id 
                                     where Accounts.AcName != '' and  checklist_grade.Pid LIKE '".$phase."' AND checklist_grade.Date_Checked >= '".$start_auditreport."'  and checklist_grade.Date_Checked <= '".$end_auditreport."'
                                     Group By checklist_grade.Aid, checklist_grade.Date_checked
                                     ORDER BY checklist_grade.Aid ASC ");
                                     $showgrade->execute();
                                     WHile($rowshowgrade = $showgrade->fetch(PDO::FETCH_ASSOC)){
                                 ?>
                                        <tr>
                                            <td><?php echo $rowshowgrade['Date_Checked'];?></td>
                                            <td><?php echo $rowshowgrade['AName'];?></td>
                                            <td>
                                                <?php 
                                                     $getpercent = $conn->prepare("SELECT * FROM area
                                                     WHERE Aid ='".$rowshowgrade['Aid']."'
                                                    --  Group By Aid
                                                     ORDER BY Aid ASC");
                                                     $getpercent->execute();
                                                     $rowgetpercent = $getpercent->fetch(PDO::FETCH_ASSOC);
                                                     echo $rowgetpercent['Percentage'] * 100;
                                                ?> %
                                            </td>
                                            <td style="background-color:#47a4474a"><?php echo $rowshowgrade['totalsanigrade'];?> %</td>
                                            <td style="background-color:#5bc0de40"><?php echo $rowshowgrade['totalstrugrade'];?> %</td>
                                            <td style="background-color:#ed9c2840"><?php echo $rowshowgrade['totalequipgrade'];?> %</td>
                                            <td><?php echo $rowshowgrade['qastaff'];?></td>
                                            <td>
                                            <?php
                                            $viewAcName = $conn->prepare("SELECT * FROM checklist_grade 
                                            left join phase on checklist_grade.Pid = phase.Pid 
                                            left join timedatephase on checklist_grade.Pid = timedatephase.Pid and checklist_grade.Date_Checked = timedatephase.Date_Checked 
                                            left join accounts on timedatephase.protect = accounts.Acid
                                            left join building on checklist_grade.Bid = building.id 
                                            Where checklist_grade.Date_Checked = '". $rowshowgrade['date_checked']."' 
                                            and checklist_grade.Bid = '".$building."'
                                            and checklist_grade.Pid = '".$rowshowgrade['Pid']."'
                                            and timedatephase.qastaff = '".$rowshowgrade['qastaff']."'
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
                                $arraygrades[] = $rowgetpercent['Percentage'];
                                  $total = (array_sum($arraygrades) * 100);

                                  
                                $totalsanig[] = $rowshowgrade['totalsanigrade'];
                                 $totalsani = (array_sum($totalsanig));

                                
                                $totalstrug[] = $rowshowgrade['totalstrugrade'];
                                  $totalstru = (array_sum($totalstrug));

                                  
                                $totalequipg[] = $rowshowgrade['totalequipgrade'];
                                $totalequip = (array_sum($totalequipg));
                                }
                                
                                ?>
                                  <tr>
                                            <td></td>
                                            <td></td>
                                            <?php  ?>
                                            
                                            <td><?php  echo $total ?> %</td>
                                            <td><?php echo $totalsani;?> %</td>
                                            <td><?php echo $totalstru;?> %</td>
                                            <td><?php echo $totalequip;?> %</td>
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

