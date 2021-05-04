<?php


	include_once 'Class.php';
	$crudcontroller = new CrudController();
	$dao = new Dao();
	$conn = $dao->openConnection();

                // $phase =;
                
                $month = $_POST['month'] ;
                $EquipmentCategory = $_POST['Category'] ;
                $Building = $_POST['Building'] ;

				$phasedata =[];
                $grades = $conn->prepare("SELECT building.Name,PName,edesc,COUNT(edesc) as functionalcount FROM `equipment_grade`
                left join building on equipment_grade.bid = building.id 
                left join phase on equipment_grade.pid = phase.Pid
                WHERE building.Name = '".$Building."' and edesc = '".$EquipmentCategory."'and edesc !='No Equipment' and DATE_FORMAT(equipment_grade.Date_Checked_equipment, '%M') ='".$month."' GROUP by phase.Pid order by phase.PName ASC");
                
				$grades->execute();
				while($rowGrades = $grades->fetch(PDO::FETCH_ASSOC)){
                    $PhaseFunctionalPercentage = $rowGrades['functionalcount'];
                    $Description = $rowGrades['edesc'];
                    $PhaseName = $rowGrades['PName'];
                    
                    array_push($phasedata,
                    [ 
                        "name"=>$PhaseName,
                        "description"=>$Description,
                         "y"=>floatval($PhaseFunctionalPercentage)
                        
                    ]);
				  
                }

$jsonOBject =  array("categoriesdata" => $phasedata
);
echo json_encode($jsonOBject);
?>

