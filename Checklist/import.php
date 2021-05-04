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
  $bid = $csv[0];
  $pid = $csv[1];
  $aid = $csv[2];
  $cname = $csv[3];
  $sanione = $csv[4];
  $sanitwo = $csv[5];
  $sanithree = $csv[6];
  $struone = $csv[7];
  $strutwo = $csv[8];
  $struthree = $csv[9];

  $stmt = $conn->prepare("INSERT INTO checklist(Bid,Pid,Aid,CName,Sani_One,Sani_Two,Sani_Three,Stru_One,Stru_Two,Stru_Three) 
  VALUES(:bid,:pid,:aid,:cname,:sanione,:sanitwo,:sanithree,:struone,:strutwo,:struthree)");

$stmt->bindparam(':bid', $bid);
$stmt->bindparam(':pid', $pid);
  $stmt->bindparam(':aid', $aid);
  $stmt->bindparam(':cname', $cname);
  $stmt->bindparam(':sanione', $sanione);
  $stmt->bindparam(':sanitwo', $sanitwo);
  $stmt->bindparam(':sanithree', $sanithree);
  $stmt->bindparam(':struone', $struone);
  $stmt->bindparam(':strutwo', $strutwo);
  $stmt->bindparam(':struthree', $struthree);
  $stmt->execute();
 }
}

header('location:../ChecklistManagement.php');
?>
