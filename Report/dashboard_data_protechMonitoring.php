<?php


	include_once 'Class.php';
	$crudcontroller = new CrudController();
	$dao = new Dao();
	$conn = $dao->openConnection();

                // $phase =;
                
                $type = $_POST['type'] ;
                $month = $_POST['month'] ;
                $year = $_POST['year'] ;
          
                
                    
                if($type == 'Sanitation'){
                     
                    $buildingdata =[];
                    $grades = $conn->prepare("SELECT month,AcName,protect_sani_grade 
                    FROM `timedatephase` 
                    left join accounts on timedatephase.protect = accounts.Acid 
                    where timedatephase.month = '".$month."' and timedatephase.year = '".$year."' 
                    group by protect,month");
                    $grades->execute();
                    while($rowGrades = $grades->fetch(PDO::FETCH_ASSOC)){
                        $timetotalperprotech = $rowGrades['protect_sani_grade'];
                        $protect = $rowGrades['AcName'];
                        
                        array_push($buildingdata,
                        [ 
                            "name"=>$protect,
                            'type' => 'line',
                            "y"=>floatval($timetotalperprotech)
                            
                        ]);
                    
                    }

                }
                else if($type == 'Structural'){
                                    
                    $buildingdata =[];
                    $grades = $conn->prepare("SELECT month,AcName,protect_stru_grade 
                    FROM `timedatephase` 
                    left join accounts on timedatephase.protect = accounts.Acid 
                    where timedatephase.month = '".$month."' and timedatephase.year = '".$year."' 
                    group by protect,month");
                    $grades->execute();
                    while($rowGrades = $grades->fetch(PDO::FETCH_ASSOC)){
                        $protect = $rowGrades['AcName'];
                        
                        array_push($buildingdata,
                        [ 
                            "name"=>$protect,
                            'type' => 'line',
                            "y"=>floatval($rowGrades['protect_stru_grade'])
                            
                        ]);
                    
                    }

                }
                else if($type == 'Equipment'){
                    $buildingdata =[];
                    $grades = $conn->prepare("SELECT month,AcName,AVG(protect_equip_grade) as protect_equip 
                    FROM `timedatephase` 
                    left join accounts on timedatephase.protect = accounts.Acid 
                    where timedatephase.month = '".$month."' and timedatephase.year = '".$year."'  and protect_equip_grade <> 0
                    group by protect,month");
                    $grades->execute();
                    while($rowGrades = $grades->fetch(PDO::FETCH_ASSOC)){
                        $timetotalperprotech = $rowGrades['protect_equip'];
                        $protect = $rowGrades['AcName'];
                        
                        array_push($buildingdata,
                        [ 
                            "name"=>$protect,
                            'type' => 'line',
                            "y"=>floatval($timetotalperprotech)
                            
                        ]);
                    
                    }

                }
               

$jsonOBject =  array("categoriesdata" => $buildingdata
);
echo json_encode($jsonOBject);
?>

