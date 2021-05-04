<?php


	include_once 'Class.php';
	$crudcontroller = new CrudController();
	$dao = new Dao();
	$conn = $dao->openConnection();

                
                $year = $_POST['year'] ;
                $qa = $_POST['qa'];

				$buildingdata =[];
                $grades = $conn->prepare("SELECT qaduration.date_checked_qa,DATE_FORMAT(qaduration.date_checked_qa, '%M'),SUM(MINUTE(qatime)) as qasumtime,PName,qastaff 
                FROM `qaduration` 
                left join phase on qaduration.pid = phase.Pid 
                where qaduration.qastaff = '".$qa."' and DATE_FORMAT(qaduration.date_checked_qa, '%Y') = '".$year."' 
                group by qastaff,DATE_FORMAT(qaduration.date_checked_qa, '%M')");
				$grades->execute();
				while($rowGrades = $grades->fetch(PDO::FETCH_ASSOC)){
                    $timetotalperqa = $rowGrades['qasumtime'];
                    $Date_Checked_qa = $rowGrades['date_checked_qa'];
                    $PName = $rowGrades['PName'];
                    $month=date("F",strtotime($Date_Checked_qa));
                    $Day=date("d",strtotime($Date_Checked_qa));
                    $Year=date("Y",strtotime($Date_Checked_qa));
                    $qaname = $rowGrades['qastaff'];
                    
                    array_push($buildingdata,
                    [ 
                        "name"=>$month,
                        "qaname"=>$qaname,
                        "Phase"=>$PName,
                        'type' => 'line',
                         "y"=>floatval($timetotalperqa)
                        
                    ]);
				  
                }

$jsonOBject =  array("categoriesdata" => $buildingdata
);
echo json_encode($jsonOBject);
?>

