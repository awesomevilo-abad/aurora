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
    //check kung tugma ang account na input sa database
    $sql = "SELECT * FROM accounts where Acid = :user and Password =:pass";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(":user"=>$user, ":pass"=>$pass));
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($stmt->rowCount() > 0) {
     
    echo "Verified";
    


    }else{
        echo "Incorrect Password";
    }
   
?>  
