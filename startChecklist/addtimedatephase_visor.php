<?php 
    include_once 'class.php';
    $crudcontroller = new CrudController();
    $dao = new Dao();
    $conn = $dao->openConnection();
    $Datetoday = $crudcontroller->getDate();

   
        $qastaff = $_POST['qastaff']; //array
        $pid = $_POST['pid'];

        

        



            $stmt = $conn->prepare("INSERT INTO timedatephase_visor(qastaff,date_checked,pid)
            VALUES(:qastaff,:date_checked,:pid)");
            $stmt->bindParam(":qastaff", $qastaff);
            $stmt->bindParam(":date_checked", $Datetoday);
            $stmt->bindParam(":pid", $pid);
            $stmt->execute();
        
          
      
          echo "Added to Library";
      


    
?>