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
        WHERE Bid = '$bid'  AND Pid IN (SELECT Pid FROM checklist_grade WHERE status ='Phase On Going'  AND (Date_Checked >= '$Datetodayminusfive' AND Date_Checked <= '$Datetoday') GROUP BY Pid ORDER BY Aid ASC) AND (Date_Checked >= '$Datetodayminusfive' AND Date_Checked <= '$Datetoday') GROUP BY Pid ORDER BY Aid ASC");
    $getOnGoingPid->execute(array(":Bid"=> $_POST['id']));
    while($rowgetOnGoingPid = $getOnGoingPid->fetch(PDO::FETCH_ASSOC)){
        $onGoingPid = $rowgetOnGoingPid['Pid'];
        
        if($audittedPid == $onGoingPid){
            $pid50= $onGoingPid;
        }else{
            $pid50= '';
        }
    }
    

}

?>
                                

     