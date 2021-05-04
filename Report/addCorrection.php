<?php
include_once 'class.php';
$crudcontroller = new CrudController();
$dao = new Dao();
$conn = $dao->openConnection();
$Datetoday = $crudcontroller->getDate();

$RidCorrection= $_POST['RidCorrection'];
$GBPoints= $_POST['GBPointsCorrection'];
$Specific= $_POST['SpecificCorrection'];
$Correction= $_POST['Correction'];
$Date= $Datetoday;

    if($Correction == ""){
        echo "Enter Correction"."\n";
    }else if($Correction == ""){
         // Remarks
         $stmtequip = $conn->prepare("INSERT INTO remarkpoints_detailed_correction
         (Rid,CorrectionDetails,Date_Created)
         VALUES(:Rid,:Correction,:Date_Created)");
 
         $stmtequip->bindParam(":Rid", $RidCorrection);
         $stmtequip->bindParam(":Correction", $Correction);
         $stmtequip->bindParam(":Date_Created", $Date);
         $stmtequip->execute();
         echo "Added";
    }else{
        // Remarks
        $stmtequip = $conn->prepare("INSERT INTO remarkpoints_detailed_correction
        (Rid,CorrectionDetails,Date_Created)
        VALUES(:Rid,:Correction,:Date_Created)");

        $stmtequip->bindParam(":Rid", $RidCorrection);
        $stmtequip->bindParam(":Correction", $Correction);
        $stmtequip->bindParam(":Date_Created", $Date);
        $stmtequip->execute();
        echo "Added";
    }




?>

