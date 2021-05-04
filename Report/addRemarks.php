<?php
include_once 'class.php';
$crudcontroller = new CrudController();
$dao = new Dao();
$conn = $dao->openConnection();
$Datetoday = $crudcontroller->getDate();

$building= $_POST['BuildingRecord'];
$title= $_POST['Title'];
$phase= $_POST['phase'];
$monthYr= $_POST['monthYr'];
$week= $_POST['Week'];
$month= $_POST['month'];
$year= $_POST['year'];
$qa= $_POST['QA'];

    if($building == ""){
        echo "Select Phase"."\n";
    }else if($monthYr == ""){
        echo "Enter Header";
    }else if($week == "0"){
        echo "Select Week";
    }else{
        // Remarks
        $stmtequip = $conn->prepare("INSERT INTO remarkpoints(Bid,Pid,qastaff,Title,Week,Month,Year,Date_Created)
        VALUES(:Bid,:Pid,:qa,:title,:Week,:Month,:Year,:datecreated)");

        $stmtequip->bindParam(":Bid", $building);
        $stmtequip->bindParam(":Pid", $phase);
        $stmtequip->bindParam(":qa", $qa);
        $stmtequip->bindParam(":title", $title);
        $stmtequip->bindParam(":Week", $week);
        $stmtequip->bindParam(":Month", $month);
        $stmtequip->bindParam(":Year", $year);
        $stmtequip->bindParam(":datecreated", $Datetoday);
        $stmtequip->execute();


        echo "Added";
    }




?>

