<?php


	include_once 'Class.php';
	$crudcontroller = new CrudController();
	$dao = new Dao();
	$conn = $dao->openConnection();

                // $phase =;
                
                $month = $_POST['month'] ;
                $year = $_POST['year'] ;

                if(isset($buildingname_var)){
                $buildingname_var="Building 1";
                }else{
                $buildingname_var = $_POST['building'] ;
                }

				$building = [];
				$grades = $conn->prepare("SELECT timedatephase.week,AVG(timedatephase.protect_equip_grade) as BuildingGrade, timedatephase.pid,building.id, building.Name
                FROM timedatephase left join phase on timedatephase.pid = phase.Pid 
                left join building on phase.Bid = building.id 
                Where phase.PName LIKE'%Warehouse%' and timedatephase.month = '".$month."' and timedatephase.year = '".$year."' and building.Name = '".$buildingname_var."'
                
                GROUP BY building.id,timedatephase.week ORDER by building.id,BuildingGrade ASC  ");
				$grades->execute();
				while($rowGrades = $grades->fetch(PDO::FETCH_ASSOC)){
                    $BuildingName ="Week ".$rowGrades['week']." (". $rowGrades['Name'].")";
                    $BuildingCode = $rowGrades['id'];
					
					array_push($building, [
                        'name'   => $BuildingName,
                        'type' => 'column',
                        'y' => floatval($rowGrades['BuildingGrade']),
                        'drilldown' => $BuildingCode
					  ]);
				  
                }
             

             
                
			

$jsonOBject =  array("data" => $building);
echo json_encode($jsonOBject);
?>

