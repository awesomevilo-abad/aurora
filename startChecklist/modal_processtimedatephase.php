<?php
 include_once 'class.php';
 $crudcontroller = new CrudController();
 
    $user=$_POST['user'];
    $pass=$_POST['pass'];
    $phase=$_POST['phseid'];
    $datechecked=$_POST['datechecked'];
    $datereset=$_POST['datechecked'];
    $qastaff=$_POST['qastaff'];
    $totalsani=$_POST['totalsani'];
    $totalstru=$_POST['totalstru'];
    $totalequip=$_POST['totalequip'];
    
    $pdo = new PDO('mysql:host=localhost;dbname=aurora', 'root', '');

// for insert qa staff and pro tech

        $staff = $pdo->prepare("INSERT INTO timedatephase (qastaff,protect,protect_sani_grade,protect_stru_grade,protect_equip_grade,date_checked,date_reset,pid) 
        VALUES(:qastaff,:protect,:protect_sani_grade,:protect_stru_grade,:protect_equip_grade,:date_checked,:date_reset,:pid)");
        $staff->bindParam(":qastaff", $qastaff);
        $staff->bindParam(":protect", $user);
        $staff->bindParam(":protect_sani_grade", $totalsani);
        $staff->bindParam(":protect_stru_grade", $totalstru);
        $staff->bindParam(":protect_equip_grade", $totalequip);
        $staff->bindParam(":date_checked", $datechecked);
        $staff->bindParam(":date_reset", $datereset);
        $staff->bindParam(":pid", $phase);
        $staff->execute();

?>  
