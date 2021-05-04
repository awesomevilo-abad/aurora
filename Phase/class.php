<?php
include_once 'Conn.php';
class CrudController
{ 
    
    /* Fetch All */
    public function readData()
    {
        try {
            
            $dao = new Dao();
            
            $conn = $dao->openConnection();
            
            $sql = "SELECT * FROM phase
            inner join building 
            on phase.Bid = building.id
            left join phase_staff
            on phase.Pid = phase_staff.pid
            left join Accounts
            on phase_staff.sid = accounts.Acid
            ORDER BY phase.Pid DESC";
            
            $resource = $conn->query($sql);
            
            $result = $resource->fetchAll(PDO::FETCH_ASSOC);
            
            $dao->closeConnection();
        } catch (PDOException $e) {
            
            echo "There is some problem in connection: " . $e->getMessage();
        }
        if (! empty($result)) {
            return $result;
        }
    }

    /* Add New Record */
    public function add($formArray)
    { 
        $dao = new Dao();
        
        $conn = $dao->openConnection();
        $name=$_POST['Name'];
        $pidcounter=$_POST['idcounter'];
        $bid=$_POST['building'];
        $percentage=$_POST['percentage'];
        $images=$_FILES['image']['name'];
        $tmp_dir=$_FILES['image']['tmp_name'];
        $imageSize=$_FILES['image']['size'];
    
        $stmtvalidate=$conn->prepare("SELECT * FROM phase where PName=:pname");
        $stmtvalidate->execute(array(":pname" => $name));
        if ($stmtvalidate->rowCount() > 0){
            return false;
        }else{
            $upload_dir='../uploads/';
            $imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
            $valid_extensions=array('jpeg', 'jpg', 'png', 'gif', 'pdf');
            $bldgpic=rand(1000, 1000000).".".$imgExt;
            move_uploaded_file($tmp_dir, $upload_dir.$bldgpic);
            $stmt=$conn->prepare('INSERT INTO phase (PidCounter,Bid, PName, Image, Percentage) VALUES (:pidcounter,:bid, :name, :image, :percentage)');
            $stmt->bindParam(':pidcounter', $pidcounter);
            $stmt->bindParam(':bid', $bid);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':image', $bldgpic);
            $stmt->bindParam(':percentage', $percentage);
            if($stmt->execute())
            {
                return true;
            }
            else{
                return false;
            }
        }

    }

     /* Assigning area and staff */
     public function assigningPhaseStaff($formArray)
     { 
         $dao = new Dao();
         
         $conn = $dao->openConnection();
         $user=$_POST['user'];
         $pid=$_POST['phid'];
     
       
             $stmt=$conn->prepare('INSERT INTO phase_staff (pid, sid) VALUES (:pid, :sid)');
             $stmt->bindParam(':pid', $pid);
             $stmt->bindParam(':sid', $user);
             if($stmt->execute())
             {
                 return true;
             }
             else{
                 return false;
             }
         
 
     }

      
       /* Assigning area and staff */
       public function updatePhaseStaff($formArray)
       { 
           $dao = new Dao();
           
           $conn = $dao->openConnection();
           $user=$_POST['user'];
           $pid=$_POST['phid'];
       
         
               $stmt=$conn->prepare('UPDATE phase_staff set sid = :sid where pid =:pid' );
               $stmt->bindParam(':sid', $user);
               $stmt->bindParam(':pid', $pid);
               if($stmt->execute())
               {
                   return true;
               }
               else{
                   return false;
               }
           
   
       }
    
    /* Edit a Record */
    public function edit($formArray)
    {
        $id = $_POST['id'];
        $Pname = $_POST['Name'];
        $Bid = $_POST['building'];
        $percentage = $_POST['percentage'];
        
        $dao = new Dao();
        
        $conn = $dao->openConnection();
        
        $sql = "UPDATE Phase SET PName = '" . $Pname . "'
        ,Bid = '" . $Bid . "'
        ,percentage = '" . $percentage . "'
        WHERE Pid=" . $id;
        
        $conn->query($sql);
        $dao->closeConnection();
    }

       /* Fetch Single Record by Id */
       public function readSingle($id)
       {
           try {
               
               $dao = new Dao();
               
               $conn = $dao->openConnection();
               
               $sql = "SELECT * FROM `Phase` WHERE Pid=" . $id . " ORDER BY Pid DESC";
               
               $resource = $conn->query($sql);
               
               $result = $resource->fetchAll(PDO::FETCH_ASSOC);
         
          
   
               $dao->closeConnection();
           } catch (PDOException $e) {
               
               echo "There is some problem in connection: " . $e->getMessage();
           }
           if (! empty($result)) {
               return $result;
           }
       }

        /* Fetch Single Record by Id */
        public function showUser()
        {
            try {
                
                $dao = new Dao();
                
                $conn = $dao->openConnection();
                
                $sql = "SELECT * FROM `accounts` where Position = 'protect' ORDER BY Acid DESC";
                
                $resource = $conn->query($sql);
                
                $result = $resource->fetchAll(PDO::FETCH_ASSOC);
          
           
    
                $dao->closeConnection();
            } catch (PDOException $e) {
                
                echo "There is some problem in connection: " . $e->getMessage();
            }
            if (! empty($result)) {
                return $result;
            }
        }

       
    /* Delete a Record */
    public function delete($id)
    {
        $dao = new Dao();
        
        $conn = $dao->openConnection();
        
        $sql = "DELETE FROM `phase` where Pid='$id'";
        
        $conn->query($sql);
        $dao->closeConnection();
    }
   

}

?>