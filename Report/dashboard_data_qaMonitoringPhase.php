<?php


	include_once 'Class.php';
	$crudcontroller = new CrudController();
	$dao = new Dao();
	$conn = $dao->openConnection();

                // $phase =;
                
                $month = $_POST['month'] ;
                $qaname = $_POST['qaname'] ;
          

                
				$buildingdata =[];
                $grades = $conn->prepare("SELECT phase.PName,qaduration.qastaff,qaduration.qatime,SUM(MINUTE(qaduration.qatime)) as timetotal,phase.PName from qaduration left join phase
                on qaduration.pid = phase.pid
                where DATE_FORMAT(qaduration.date_checked_qa, '%M') ='".$month."' and qaduration.qastaff='".$qaname."'
                group by qaduration.pid order by qaduration.qid ASC
                ");
				$grades->execute();
				while($rowGrades = $grades->fetch(PDO::FETCH_ASSOC)){
                    $timetotalperqa = $rowGrades['timetotal'];
                    $PName = $rowGrades['PName'];
                    
                    array_push($buildingdata,
                    [ 
                        "name"=>$PName,
                        'type' => 'line',
                         "y"=>floatval($timetotalperqa)
                        
                    ]);
				  
                }

$jsonOBject =  array("categoriesdata" => $buildingdata
);
echo json_encode($jsonOBject);
?>

