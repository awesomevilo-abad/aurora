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
                $query = "SELECT * FROM accounts WHERE Username = :username AND Password = :password AND Position = :position";  
                $statement = $connect->prepare($query);  
                $statement->execute(array(':username'=>$_POST["username"],':password'=>$_POST["password"],':position'=>$_POST["position"]));  
                $count = $statement->rowCount();  
                if($count > 0)  
                {  
                     if($_POST['position'] == 'Admin'){
                         $_SESSION["username"] = $_POST["username"];  
                         $_SESSION["Position"] = $_POST["Position"];  
                         header("location:../Building/BuildingManagement.php");  
                     }elseif($_POST['position'] == 'QA Staff'){
                         $_SESSION["username"] = $_POST["username"];  
                         $_SESSION["Position"] = $_POST["Position"];  
                         header("location:../userStartChecklistCat.php");  

                     }else{
                         $message = '<label>Wrong Position</label>';  
                     }
               }  
               else  
               {  
                    $message = '<label>Invalid Data Check Username or Password</label>';  
               }  
                }  
           }  
      }  
 
 catch(PDOException $error)  
 {  
      $message = $error->getMessage();  
 }  
 ?>  