<?php


	include_once 'Class.php';
	$crudcontroller = new CrudController();
	$dao = new Dao();
	$conn = $dao->openConnection();

                // $phase =;
                
                $month = $_POST['month'] ;
                $qaname = $_POST['qaname'] ;
                $phase = $_POST['phase'] ;
          

                
				$buildingdata =[];
                $grades = $conn->prepare("SELECT timedatephase.week,phase.PName,qaduration.qastaff,MINUTE(qaduration.qatime) as timetotal,phase.PName from qaduration left join phase
                on qaduration.pid = phase.pid
                left join timedatephase on qaduration.pid = timedatephase.pid
                where phase.PName = '".$phase."' and DATE_FORMAT(qaduration.date_checked_qa, '%M') ='".$month."' and qaduration.qastaff='".$qaname."'
                group by timedatephase.week,qaduration.qid order by qaduration.qid ASC
                ");
				$grades->execute();
				while($rowGrades = $grades->fetch(PDO::FETCH_ASSOC)){
                    $timetotalperqa = $rowGrades['timetotal'];
                    $PName = $rowGrades['PName'];
                    $week = $rowGrades['week'];
                    
                    array_push($buildingdata,
                    [ 
                        "name"=>$PName,
                        "week"=>$week,
                         "y"=>floatval($timetotalperqa)
                        
                    ]);
				  
                }

$jsonOBject =  array("categoriesdata" => $buildingdata
);
echo json_encode($jsonOBject);
?>

