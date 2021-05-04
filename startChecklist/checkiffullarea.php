<?php
 include_once 'class.php';
 $crudcontroller = new CrudController();
 $dao = new Dao();
 $conn = $dao->openConnection();
 
    $user=$_POST['user'];
    $phase=$_POST['phseid'];
    $pass=$_POST['pass'];

    $pdo = new PDO('mysql:host=localhost;dbname=aurora', 'root', '');

        
        //kunin ang last area id from checklist grade(updated record ng mga na submit na checklist per area )
        $gradesheader = $conn->prepare("SELECT * FROM checklist_grade WHERE Pid=:Pid ORDER BY Aid DESC ");
        $gradesheader->execute(array(":Pid"=> $phase));
        $rowgradesheader = $gradesheader->fetch(PDO::FETCH_ASSOC);

        //if para malaman kkung may laman na ang checklist doon sa area na iyon

        if($gradesheader->rowCount() > 0){
            $showArea = $conn->prepare("SELECT * FROM area WHERE Aid > :Aid and Pid = :Pid ORDER BY Aid DESC");
            $showArea->execute(array(":Aid" => $rowgradesheader['Aid'], ":Pid" => $phase));
            $rowareaheader = $showArea->fetch(PDO::FETCH_ASSOC);
           
            if($rowareaheader['Aid'] == $rowgradesheader['Aid']){
                echo $rowgradesheader['Aid'];
                echo $rowareaheader['Aid'];
            }
            else{
                echo $rowgradesheader['Aid'];
                echo $rowareaheader['Aid'];
            }
    
        }
        else{
            echo"Verified";
        }


        

?>  
