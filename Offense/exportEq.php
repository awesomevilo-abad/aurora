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
      $stmt=$db_con->prepare("SELECT equipment_grade.id,equipment.Asset_Tag,
      equipment.Asset_Number,equipment.EName,building.Name,phase.PName,area.AName
       ,equipment_grade.egrade,equipment_grade.remarksequip,equipment_grade.week,equipment_grade.Date_Checked_equipment
      FROM `equipment_grade` 
      LEFT JOIN equipment on equipment_grade.eid = equipment.Eid
      LEFT JOIN building on equipment_grade.bid = building.id
      LEFT JOIN phase on equipment_grade.pid = phase.Pid
      LEFT JOIN area on equipment_grade.aid = area.Aid
      WHERE `year`='$year' and `week`=$week and `month` = '$month' and edesc = '$offense' and egrade!=0
      ORDER BY egrade DESC");
      
      $stmt->execute();

      $columnHeader = "Equipment Code"."\t"."Asset Tag"."\t"."Asset Number"."\t"."Equipment Name"."\t"."Building"."\t"."Phase"."\t"."Area"."\t"."Grade"."\t"."Remarks"."\t"."Week"."\t"."Date Audit"."\t";
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
      header("Content-Disposition: attachment; filename= EQUIPMENT: ".$month."-".$year." Week ".$week."~Offense: ".$offense.basename($Datetoday).".xls");
      header("Pragma: no-cache");
      header("Expires: 0");
      
      echo ucwords($columnHeader)."\n".$setData."\n";

 }  
 ?>  