<?php  
 session_start();  
 
 $host = "localhost";  
 $username = "root";  
 $password = "";  
 $database = "aurora";  
 $message = "";  
 try  
 {  
      $connect = new PDO("mysql:host=$host; dbname=$database", $username, $password);  
      $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
      
      if(isset($_POST["login"]))  
      {  
           if(empty($_POST["username"]) || empty($_POST["password"]))  
           {  
                $message = '<label>All fields are required</label>';  
           }  
           else  
           {  
                $query = "SELECT * FROM accounts WHERE Username = :username AND Password = :password";  
                $statement = $connect->prepare($query);  
                $statement->execute(array(':username'=>$_POST["username"],':password'=>$_POST["password"]));  
                $rowstatement = $statement->fetch(PDO::FETCH_ASSOC);
                $Position=$rowstatement['Position'];
                $count = $statement->rowCount();  
                if($count > 0)  
                {  
                     if($Position == 'ADMIN'){
						$_SESSION["username"] = $_POST["username"];  
						$_SESSION["AcName"] = $_POST["AcName"];  
                              $_SESSION["name"] = $count['AcName'];  
                              $_SESSION["position"] = $_POST["position"];
                         header("location:BuildingManagement.php");  
                    }elseif($Position == 'QA Staff'){
                         $_SESSION["username"] = $_POST["username"];
                         $_SESSION["position"] = $_POST["position"];

                        header("location:userStartChecklistCat.php");  

                     
                     }elseif($Position == 'QA Supervisor'){
                         $_SESSION["username"] = $_POST["username"]; 
                         $_SESSION["AcName"] = $_POST["AcName"];   
                         $_SESSION["position"] = $_POST["position"];
                         header("location:dashboard.php");  

                     }
                     elseif($Position == 'Supervisor'){
                         $_SESSION["username"] = $_POST["username"];  
                         $_SESSION["AcName"] = $_POST["AcName"];  
                         $_SESSION["position"] = $_POST["position"];
                         header("location:dashboard-supervisor.php");  

                     }
                     elseif($Position == 'Manager'){
                         $_SESSION["username"] = $_POST["username"];
                         $_SESSION["AcName"] = $_POST["AcName"];    
                         $_SESSION["position"] = $_POST["position"];
                         header("location:dashboard.php");  

                     } 
                     elseif($Position == 'QA Manager'){
                         $_SESSION["username"] = $_POST["username"];
                         $_SESSION["AcName"] = $_POST["AcName"];    
                         $_SESSION["position"] = $_POST["position"];
                         header("location:dashboard.php");  

                     } 
                     elseif($Position == 'Protect' or $Position == 'protect'){
                         $_SESSION["username"] = $_POST["username"];  
                         $_SESSION["AcName"] = $_POST["AcName"];  
                         $_SESSION["position"] = $_POST["position"];
                         header("location:dashboard-protect.php");  

                     }
                     elseif($Position == 'Fixed Asset Specialist' or $Position == 'Fixed Asset Specialist'){
                         $_SESSION["username"] = $_POST["username"];  
                         $_SESSION["AcName"] = $_POST["AcName"];  
                         $_SESSION["position"] = $_POST["position"];
                         header("location:viewing_equipment.php");  

                     }else{
                          
                         $message = '<label>Wrong Position</label>';  
                     }
               }  
               else  
               {  
                    
                    header("location:index.php");  
               }  
                }  
           }  
      }  
 
 catch(PDOException $error)  
 {  
      $message = $error->getMessage();  
 }  
 ?>  