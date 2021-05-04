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


$getPid = $conn->prepare("SELECT Distinct * FROM checklist_grade WHERE Bid=:Bid GROUP BY Pid ORDER BY Pid ASC ");
$getPid->execute(array(":Bid"=> $id));
while($rowgetPid = $getPid->fetch(PDO::FETCH_ASSOC)){
   echo $Pid = $rowgetPid['Pid'];
}

?>
                                

                                