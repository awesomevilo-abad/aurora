<?php


	include_once 'Class.php';
	$crudcontroller = new CrudController();
	$dao = new Dao();
	$conn = $dao->openConnection();

                // $phase =;
                
                $year = $_POST['year'];
				$building = [];
				$grades = $conn->prepare("SELECT tid,month,week,pid,id,Name,PName, AVG(newBuildingGrade) as newMonthGrade 
                FROM(SELECT tid,month,week,pid,id,Name,PName, AVG(newWeekGrade) as newBuildingGrade 
                FROM(SELECT tid,month,week,pid,id,Name,PName, AVG(protect_sani_grade) as newWeekGrade 
                FROM (SELECT timedatephase.tid,timedatephase.month,timedatephase.week,timedatephase.protect_sani_grade, timedatephase.pid,building.id, building.Name,phase.PName 
                FROM timedatephase 
                left join phase on timedatephase.pid = phase.Pid 
                left join building on phase.Bid = building.id 
                Where phase.PName LIKE'%Warehouse%' and timedatephase.year = '".$year."' 
                GROUP BY timedatephase.month,timedatephase.pid,timedatephase.week,timedatephase.Bid 
                ORDER by timedatephase.protect_sani_grade DESC)as newWeekGrade 
                group by week,id,month order by week ASC) as newBuilding 
                group by id,month order by Name ASC) as newMonth 
                group by month order by tid ASC");
				$grades->execute();
				while($rowGrades = $grades->fetch(PDO::FETCH_ASSOC)){
                    $monthdepot = $rowGrades['month'];
					
					array_push($building, [
                        'name'   => $monthdepot,
                        'type' => 'column',
                        'y' => floatval($rowGrades['newMonthGrade']),
                        'color'=> '#0088cc'
					  ]);
				  
                }
             

             
                
			

$jsonOBject =  array("data" => $building);
echo json_encode($jsonOBject);
?>

