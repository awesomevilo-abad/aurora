<?php

/*
Developer: Ehtesham Mehmood
Site:      PHPCodify.com
Script:    Import Excel to MySQL using PHP and Bootstrap
File:      import.php
*/

// Including database connections

include_once 'Class.php';
$crudcontroller = new CrudController();
$dao = new Dao();
$conn = $dao->openConnection();

if(isset($_POST["submit_file"]))
{
 $file = $_FILES["file"]["tmp_name"];
 $file_open = fopen($file,"r");
 while(($csv = fgetcsv($file_open, 1000, ",")) !== false)
 {
  $aid = $csv[0];
  $ename = $csv[1];
  $Asset_Tag = $csv[2];
  $Asset_Number = $csv[3];
  $status = $csv[4];


  $stmt = $conn->prepare("INSERT INTO equipment(Aid,EName,Asset_Tag,Asset_Number,status) 
  VALUES(:aid,:ename,:Asset_Tag,:Asset_Number,:status)");

  $stmt->bindparam(':aid', $aid);
  $stmt->bindparam(':ename', $ename);
  $stmt->bindparam(':Asset_Tag', $Asset_Tag);
  $stmt->bindparam(':Asset_Number', $Asset_Number);
  $stmt->bindparam(':status', $status);
  $stmt->execute();
 }
}

header('location:../EquipmentManagement.php');
?>
