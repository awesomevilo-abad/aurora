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
  $name = $csv[0];
  $image = $csv[1];
  $category = $csv[2];
  $color = $csv[3];
  $percentage = $csv[4];

  $stmt = $conn->prepare("INSERT INTO building(Name,Image,Category,Color,Percentage) VALUES(:name,:image,:category,:color,:percentage)");

  $stmt->bindparam(':name', $name);
  $stmt->bindparam(':image', $image);
  $stmt->bindparam(':category', $category);
  $stmt->bindparam(':color', $color);
  $stmt->bindparam(':percentage', $percentage);
  $stmt->execute();
 }
}

header('location:../BuildingManagement.php');
?>
