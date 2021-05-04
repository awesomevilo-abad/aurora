<?php  
      //export.php  
        include_once 'class.php';
        $crudcontroller = new CrudController();
        $dao = new Dao();
        $conn = $dao->openConnection();
        $Datetoday = $crudcontroller->getDate();
  
 if(isset($_POST["export"]))  
 {  
    
    $DB_host = "localhost";
    $DB_user = "root";
    $DB_pass = "";
    $DB_name = "aurora";

    try
    {
        $db_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
        $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
        echo "ERROR : ".$e->getMessage();
    }

    $year =$_POST['year'];
    $month =$_POST['month'];
    $week =$_POST['week'];
    $offense =$_POST['offense'];
    // Code here for Export
      $stmt=$db_con->prepare("SELECT checklist_grade.id,
      checklist_grade.CName,building.Name,phase.PName,area.AName,checklist_grade.Str_Grade,checklist_grade.remarks
      ,checklist_grade.week,checklist_grade.Date_Checked 
      FROM `checklist_grade` 
      LEFT JOIN building on checklist_grade.Bid = building.id
      LEFT JOIN phase on checklist_grade.Pid = phase.Pid
      LEFT JOIN area on checklist_grade.Aid = area.Aid
      WHERE `year`='$year' and `week`=$week and `month` = '$month' and Str_Grade = $offense and Str_Grade!=0
      ORDER BY Str_Grade DESC");
      
      $stmt->execute();

      $columnHeader = "Structural Code"."\t"."Structural Name"."\t"."Building"."\t"."Phase"."\t"."Area"."\t"."Grade"."\t"."Remarks"."\t"."Week"."\t"."Date Audit"."\t";
      $setData='';

      while($rec =$stmt->FETCH(PDO::FETCH_ASSOC))
      {
        $rowData = '';
        foreach($rec as $value)
        {
          $value = '"' . $value . '"' . "\t";   
          $rowData .= $value;
        }
        $setData .= trim($rowData)."\n";
      }

      header("Content-type: application/octet-stream");
      header("Content-Disposition: attachment; filename=".$Datetoday." STRUCTURAL: ".$month."-".$year." Week ".$week."~Offense: ".$offense.basename($Datetoday).".xls");
      header("Pragma: no-cache");
      header("Expires: 0");
      
      echo ucwords($columnHeader)."\n".$setData."\n";

 }  
 ?>  