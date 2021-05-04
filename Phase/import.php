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
  $Bid = $csv[0];
  $Pname = $csv[1];
  $image = $csv[2];

  $stmt = $conn->prepare("INSERT INTO phase(Bid,PName,Image) VALUES(:bid,:pname,:image)");

  $stmt->bindparam(':bid', $Bid);
  $stmt->bindparam(':pname', $Pname);
  $stmt->bindparam(':image', $image);
  $stmt->execute();
 }
}

header('location:../PhaseManagement.php');
?>
