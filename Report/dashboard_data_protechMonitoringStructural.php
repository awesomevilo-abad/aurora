<?php


	include_once 'Class.php';
	$crudcontroller = new CrudController();
	$dao = new Dao();
	$conn = $dao->openConnection();

                // $phase =;
                
                $month = $_POST['month'] ;
          

                
				$buildingdata =[];
                $grades = $conn->prepare("SELECT accounts.AcName,avg(protect_stru_grade)as grade
                from timedatephase 
                left join accounts on timedatephase.protect = accounts.Acid
                where timedatephase.month = '".$month."' 
                GROUP BY accounts.AcName order by grade");
				$grades->execute();
				while($rowGrades = $grades->fetch(PDO::FETCH_ASSOC)){
                    $timetotalperprotech = $rowGrades['grade'];
                    $protect = $rowGrades['AcName'];
                    
                    array_push($buildingdata,
                    [ 
                        "name"=>$protect,
                        'type' => 'line',
                         "y"=>floatval($timetotalperprotech)
                        
                    ]);
				  
                }

$jsonOBject =  array("categoriesdata" => $buildingdata
);
echo json_encode($jsonOBject);
?>

