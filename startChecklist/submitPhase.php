<?php 
    include_once 'class.php';
    $crudcontroller = new CrudController();
    $dao = new Dao();
    $conn = $dao->openConnection();

 $pid = $_POST['pid'];
 $aid = $_POST['aid'];
 $cname = $_POST['cname'];

 $cid = $_POST['cid'];
 $count = sizeof($cid);

 
 for($i=0;$i<$count;$i++){
    $cidarr = $_POST['cid'][$i];
    $sanitation = $_POST['SaniGrade'.$cidarr];
    $structural = $_POST['StruGrade'.$cidarr];
    $checklistarr= $cName[$i];
  
    $stmt = $conn->prepare("INSERT INTO checklist_grade 
    (Pid,Aid,Cid,CName,San_Grade,Str_Grade) 
    VALUES 
    (:Pid,:Aid,:Cid,:Cname,:Sanitation,:Structural)");
    $stmt->bindparam(":Pid",$pid);
    $stmt->bindparam(":Aid",$aid);
    $stmt->bindparam(":Cid",$cidarr);
    $stmt->bindparam(":Cname",$checklistarr);
    $stmt->bindparam(":Sanitation",$sanitation);
    $stmt->bindparam(":Structural",$structural);
    $stmt->execute();
   
 }
 echo  $Aid ;


    
?>