<?php  
 session_start(); 
	// include_once 'startChecklist/Class.php';
	$crudcontroller = new CrudController();
	$dao = new Dao();
	$conn = $dao->openConnection();
	echo $Datetoday = $crudcontroller->getDate();
	
?>
