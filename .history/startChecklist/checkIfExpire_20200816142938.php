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

    $pid50=array_filter($pid50);
    $sizeOfPid50 = sizeof($pid50);
    for($i=0;$i<sizeOfPid50;$i++){
        echo  $pid50[$i];
    }

    // SELECT Aid
    // FROM area
    // WHERE Pid ='1202' AND Aid NOT IN
    // (SELECT Aid FROM `checklist_grade` WHERE Pid ='1202' AND (Date_Checked >= '2020-08-12' AND Date_Checked <= '2020-08-16') Group By Aid)


}

?>
                                

     