<?php


	include_once 'Class.php';
	$crudcontroller = new CrudController();
	$dao = new Dao();
	$conn = $dao->openConnection();

                // $phase =;
                
                $month = $_POST['month'] ;
                $EquipmentCategory = $_POST['Category'] ;
                $Phase = $_POST['Phase'] ;

				$areadata =[];
                $grades = $conn->prepare("SELECT building.Name,PName,AName,edesc,COUNT(edesc) as functionalcount FROM `equipment_grade` 
                left join building on equipment_grade.bid = building.id 
                left join phase on equipment_grade.pid = phase.Pid 
                LEFT join area on equipment_grade.aid =area.Aid
                WHERE PName='".$Phase."' and edesc = '".$EquipmentCategory."'and edesc !='No Equipment' and DATE_FORMAT(equipment_grade.Date_Checked_equipment, '%M') ='".$month."' 
                GROUP by area.Aid order by building.Name ASC");
                
				$grades->execute();
				while($rowGrades = $grades->fetch(PDO::FETCH_ASSOC)){
                    $AreaFunctionalPercentage = $rowGrades['functionalcount'];
                    $Description = $rowGrades['edesc'];
                    $areaName = $rowGrades['AName'];
                    
                    array_push($areadata,
                    [ 
                        "name"=>$areaName,
                        "description"=>$Description,
                         "y"=>floatval($AreaFunctionalPercentage)
                        
                    ]);
				  
                }

$jsonOBject =  array("categoriesdata" => $areadata
);
echo json_encode($jsonOBject);
?>

