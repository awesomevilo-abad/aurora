<?php


	include_once 'Class.php';
	$crudcontroller = new CrudController();
	$dao = new Dao();
	$conn = $dao->openConnection();

                
                $year = $_POST['year'] ;
                $qa = $_POST['qa'];
                $month = $_POST['month'];

				$buildingdata =[];
                $grades = $conn->prepare("SELECT qaduration.date_checked_qa,DATE_FORMAT(qaduration.date_checked_qa, '%M'),SUM(MINUTE(qatime)) as qasumtime,phase.PName,qastaff 
                FROM `qaduration` 
                left join phase on qaduration.pid = phase.Pid 
                where qaduration.qastaff = '".$qa."' and DATE_FORMAT(qaduration.date_checked_qa, '%Y') = '".$year."'  and DATE_FORMAT(qaduration.date_checked_qa, '%M') = '".$month."' 
                group by qastaff,date_checked_qa,qaduration.pid");
				$grades->execute();
				while($rowGrades = $grades->fetch(PDO::FETCH_ASSOC)){
                    $timetotalperqa = $rowGrades['qasumtime'];
                    $Date_Checked_qa = $rowGrades['date_checked_qa'];
                    $PName = $rowGrades['PName'];
                    $month=date("F",strtotime($Date_Checked_qa));
                    $Day=date("d",strtotime($Date_Checked_qa));
                    $Year=date("Y",strtotime($Date_Checked_qa));
                    $phasename = $rowGrades['PName'];
                    $fulldate = $month.' '.$Day.' '.$Year;
                    
                    array_push($buildingdata,
                    [ 
                        "name"=>$phasename,
                        "Phase"=>$PName,
                        "FullDate"=>$fulldate,
                        'type' => 'line',
                        "y"=>floatval($timetotalperqa),
                        "value"=>floatval($timetotalperqa)
                        
                    ]);
				  
                }

$jsonOBject =  array("categoriesdata" => $buildingdata
);
echo json_encode($jsonOBject);
?>

