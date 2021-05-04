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
            
            $sql = "SELECT * FROM accounts
            left join user_phase on
            accounts.Acid = user_phase.sid
            left join phase
            on user_phase.pid = phase.Pid
            Group by  accounts.Acid
            ORDER BY accounts.Acid DESC";
            
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
   public function showPhase()
   {
       try {
           
           $dao = new Dao();
           
           $conn = $dao->openConnection();
           
           $sql = "SELECT * FROM `phase`";
           
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
       
        $Name=$_POST['Name'];
        $pos=$_POST['pos'];
        $department=$_POST['department'];
        $user=$_POST['user'];
        $password=$_POST['password'];

        $dao = new Dao();
        
        $conn = $dao->openConnection();
        
        $sql = "INSERT INTO accounts (AcName, Position, Username, Password, Department)
             VALUES ('" . $Name . "','" . $pos . "','" . $user . "','" . $password . "','" . $department . "')";
        $conn->query($sql);
        $dao->closeConnection();

    }

    /* Assigning area and staff */
    public function assigningPhaseStaff($formArray)
    { 
        $dao = new Dao();
        
        $conn = $dao->openConnection();
        $user=$_POST['userid'];
        $pid=$_POST['phase'];
    
      
            $stmt=$conn->prepare('INSERT INTO user_phase (sid, pid) VALUES (:sid, :pid)');
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
        $AcName = $_POST['Name'];
        $pos = $_POST['pos'];
        $department = $_POST['department'];
        $user = $_POST['user'];
        $password = $_POST['password'];
        
        
        
        $dao = new Dao();
        
        $conn = $dao->openConnection();
        
        $sql = "UPDATE accounts SET AcName = '" . $AcName . "'
        ,Position = '" . $pos . "'
        ,Username = '" . $user . "'
        ,Password = '" . $password . "'
        ,Department	 = '" . $department . "'
        WHERE Acid=" . $id;
        
        $conn->query($sql);
        $dao->closeConnection();
    }

       /* Fetch Single Record by Id */
       public function readSingle($id)
       {
           try {
               
               $dao = new Dao();
               
               $conn = $dao->openConnection();
               
               $sql = "SELECT * FROM `accounts` WHERE Acid=" . $id . " ORDER BY Acid DESC";
               
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
        
        $sql = "DELETE FROM `accounts` where Acid='$id'";
        
        $conn->query($sql);
        $dao->closeConnection();
    }

     /* Delete a Record */
     public function remove($id)
     {
         $dao = new Dao();
         
         $conn = $dao->openConnection();
         
         $sql = "DELETE FROM `user_phase` where upid='$id'";
         
         $conn->query($sql);
         $dao->closeConnection();
     }
   

}

?>