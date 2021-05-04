<?php
include_once 'class.php';
$crudcontroller = new CrudController();
$dao = new Dao();
$conn = $dao->openConnection();
$Datetoday = $crudcontroller->getDate();

$PidCorrective= $_POST['PidCorrective'];
$FidCorrective= $_POST['FidCorrective'];
$GBPoints= $_POST['GBPoints'];
$Specific= $_POST['Specific'];
$Corrective= $_POST['Corrective'];
$recommendation= $_POST['recommendation'];
$Date= $_POST['Date'];
$type= $_POST['type'];

    if($GBPoints == ""){
        echo "Enter Remarks"."\n";
    }else if($Corrective == ""){
        $Corrective =  "No Corrective";
          // Remarks
          $stmtequip = $conn->prepare("INSERT INTO remarkpoints_detailed
          (Fid,Pid,Date,type,MainRemarks,SpecificRemarks,CorrectiveAction,recommendation,Date_Created)
          VALUES(:Fid,:Pid,:Date,:type,:MainRemarks,:SpecificRemarks,:CorrectiveAction,:recommendation,:Date_Created)");
  
          $stmtequip->bindParam(":Fid", $FidCorrective);
          $stmtequip->bindParam(":Pid", $PidCorrective);
          $stmtequip->bindParam(":Date", $Date);
          $stmtequip->bindParam(":type", $type);
          $stmtequip->bindParam(":MainRemarks", $GBPoints);
          $stmtequip->bindParam(":SpecificRemarks", $Specific);
          $stmtequip->bindParam(":CorrectiveAction", $Corrective);
          $stmtequip->bindParam(":recommendation", $recommendation);
          $stmtequip->bindParam(":Date_Created", $Datetoday);
          $stmtequip->execute();
  
  
          echo "Added";
    }else{
        // Remarks
        $stmtequip = $conn->prepare("INSERT INTO remarkpoints_detailed
        (Fid,Pid,Date,type,MainRemarks,SpecificRemarks,CorrectiveAction,recommendation,Date_Created)
        VALUES(:Fid,:Pid,:Date,:type,:MainRemarks,:SpecificRemarks,:CorrectiveAction,:recommendation,:Date_Created)");

        $stmtequip->bindParam(":Fid", $FidCorrective);
        $stmtequip->bindParam(":Pid", $PidCorrective);
        $stmtequip->bindParam(":Date", $Date);
        $stmtequip->bindParam(":type", $type);
        $stmtequip->bindParam(":MainRemarks", $GBPoints);
        $stmtequip->bindParam(":SpecificRemarks", $Specific);
        $stmtequip->bindParam(":CorrectiveAction", $Corrective);
        $stmtequip->bindParam(":recommendation", $recommendation);
        $stmtequip->bindParam(":Date_Created", $Datetoday);
        $stmtequip->execute();


        echo "Added";
    }




?>

