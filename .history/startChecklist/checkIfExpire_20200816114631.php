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


$getPidStatus = $conn->prepare("SELECT * FROM checklist_grade WHERE Bid = '$_POST['id']'   AND (Date_Checked >= '$Datetodayminusfive' AND Date_Checked <= '$Datetoday') GROUP BY Pid ORDER BY Aid ASC");
$getPidStatus->execute(array(":Bid"=> $_POST['id']));
while($rowgetPidStatus = $getPidStatus->fetch(PDO::FETCH_ASSOC)){

    echo $rowgetPidStatus['Pid'];

}

?>
                                

                                