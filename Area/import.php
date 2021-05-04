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
  $pid = $csv[0];
  $name = $csv[1];
  $image = $csv[2];
  $percentage = $csv[3];
  $percentageequip = $csv[4];

  $stmt = $conn->prepare("INSERT INTO area(Pid,AName,Image,Percentage,percentageequip) VALUES(:pid,:name,:image,:percentage,:percentageequip)");

  $stmt->bindparam(':pid', $pid);
  $stmt->bindparam(':name', $name);
  $stmt->bindparam(':image', $image);
  $stmt->bindparam(':percentage', $percentage);
  $stmt->bindparam(':percentageequip', $percentageequip);
  $stmt->execute();
 }
}

header('location:../AreaManagement.php');
?>
