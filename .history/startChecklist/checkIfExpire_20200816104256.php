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
$pageType = $_POST['pageType'];
?>
	<section class="panel">	
     

    </section>
                                