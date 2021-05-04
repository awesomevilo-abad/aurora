<?php
session_start(); 
include_once 'Class.php';
$crudcontroller = new CrudController();
$dao = new Dao();
$conn = $dao->openConnection();
$Datetoday = $crudcontroller->getDate();
$Datetodayminusfive = date('Y-m-d', strtotime($Datetoday. ' - 4 days'));
$AcPos=$_SESSION['position'];
$AcName=  $_SESSION['AcName'];
$bid = $_POST['id'];

$getPidStatus = $conn->prepare("SELECT Pid FROM checklist_grade WHERE Bid = '$bid'   AND (Date_Checked >= '$Datetodayminusfive' AND Date_Checked <= '$Datetoday') GROUP BY Pid ORDER BY Aid ASC");
$getPidStatus->execute(array(":Bid"=> $_POST['id']));
while($rowgetPidStatus = $getPidStatus->fetch(PDO::FETCH_ASSOC)){

    $audittedPid = $rowgetPidStatus['Pid'];
    
    $getOnGoingPid = $conn->prepare("SELECT * 
        FROM checklist_grade 
        WHERE Bid = '$bid'  AND Pid NOT IN (SELECT Pid FROM checklist_grade WHERE status ='Phase Completed'  AND (Date_Checked >= '$Datetodayminusfive' AND Date_Checked <= '$Datetoday') GROUP BY Pid ORDER BY Aid ASC) AND (Date_Checked >= '$Datetodayminusfive' AND Date_Checked <= '$Datetoday') GROUP BY Pid ORDER BY Aid ASC");
    $getOnGoingPid->execute(array(":Bid"=> $_POST['id']));
    while($rowgetOnGoingPid = $getOnGoingPid->fetch(PDO::FETCH_ASSOC)){
        $onGoingPid = $rowgetOnGoingPid['Pid'];
        if($audittedPid == $onGoingPid){
            $pid50[]= $onGoingPid;
        }else{
            $pid50[]= '';
        }

    }
}
    $cleanpid50=$pid50;
    $sizeOfPid50 = sizeof($cleanpid50);
    for($i=0;$i<$sizeOfPid50;$i++){
        $toBeExpirePid =  $cleanpid50[$i];

        $getAreasOfExpiredPid = $conn->prepare("SELECT Pid,Aid,(SELECT Date_Checked FROM `checklist_grade` WHERE Pid ='$toBeExpirePid' AND (Date_Checked >= '$Datetodayminusfive' AND Date_Checked <= '$Datetoday') Group By Date_Checked ORDER BY Date_Checked ASC LIMIT 1) as Date_Checked FROM area WHERE Pid ='$toBeExpirePid' AND Aid NOT IN (SELECT Aid FROM `checklist_grade` WHERE Pid ='$toBeExpirePid' AND (Date_Checked >= '$Datetodayminusfive' AND Date_Checked <= '$Datetoday') Group By Aid ORDER BY Date_Checked ASC)");

        $getAreasOfExpiredPid->execute();
        while($rowgetAreasOfExpiredPid = $getAreasOfExpiredPid->fetch(PDO::FETCH_ASSOC)){
            $startingAudit = $rowgetAreasOfExpiredPid['Date_Checked'];
            $ExpirationAudit = date('Y-m-d', strtotime($startingAudit. ' + 4 days'));
            $ExpiredAid = $rowgetAreasOfExpiredPid['Aid'];
            $ExpiredPid = $rowgetAreasOfExpiredPid['Pid'];
            

            if($ExpirationAudit == ){
                echo $ExpiredPid.'_Expired';
            }else{

            }

        }
    }
// print_r($cleanpid50);
    // SELECT Aid
    // FROM area
    // WHERE Pid ='1202' AND Aid NOT IN
    // (SELECT Aid FROM `checklist_grade` WHERE Pid ='1202' AND (Date_Checked >= '2020-08-12' AND Date_Checked <= '2020-08-16') Group By Aid)




?>
                                

     