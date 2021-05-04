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
				$grades = $conn->prepare("SELECT week,pid,id,Name,PName, AVG(protect_stru_grade) as newWeekGrade 
                FROM(SELECT timedatephase.week,timedatephase.protect_stru_grade, timedatephase.pid,building.id, building.Name,phase.PName 
                FROM timedatephase 
                left join phase on timedatephase.pid = phase.Pid 
                left join building on phase.Bid = building.id 
                Where timedatephase.month = '".$month."' and timedatephase.year = '".$year."' and building.Name = '".$buildingname_var."' 
                GROUP BY timedatephase.pid,timedatephase.week ORDER by timedatephase.protect_stru_grade DESC) as newWeek 
                group by week order by week ASC");
				$grades->execute();
				while($rowGrades = $grades->fetch(PDO::FETCH_ASSOC)){
                    $BuildingName ="Week ".$rowGrades['week']." (". $rowGrades['Name'].")";
                    $BuildingCode = $rowGrades['id'];
					
					array_push($building, [
                        'name'   => $BuildingName,
                        'type' => 'column',
                        'y' => floatval($rowGrades['newWeekGrade']),
                        'drilldown' => $BuildingCode
					  ]);
				  
                }
             

             
                
			

$jsonOBject =  array("data" => $building);
echo json_encode($jsonOBject);
?>

