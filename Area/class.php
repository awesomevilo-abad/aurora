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
            
            $sql = "SELECT area.Aid,phase.PName,building.Name,area.AName,area.Percentage,area.percentageequip,area.Image,accounts.AcName FROM area
            inner join phase 
            on area.Pid = phase.Pid
            inner join building
            on phase.Bid = building.id
            left join area_staff
            on area.aid = area_staff.aid
            left join accounts 
            on area_staff.sid = accounts.Acid
            GROUP BY area.Aid
            ORDER BY area.Aid DESC";
            
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
        $phase=$_POST['phase'];
        $Name=$_POST['Name'];
        $percentage=$_POST['percentage'];
        $percentageequip=$_POST['percentageequip'];
        $images=$_FILES['image']['name'];
        $tmp_dir=$_FILES['image']['tmp_name'];
        $imageSize=$_FILES['image']['size'];
    
        $stmtvalidate=$conn->prepare("SELECT * FROM area where AName=:aname");
        $stmtvalidate->execute(array(":aname" => $Name));
        if ($stmtvalidate->rowCount() > 0){
            return false;
        }else{
            $upload_dir='../uploads/';
            $imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
            $valid_extensions=array('jpeg', 'jpg', 'png', 'gif', 'pdf');
            $bldgpic=rand(1000, 1000000).".".$imgExt;
            move_uploaded_file($tmp_dir, $upload_dir.$bldgpic);
            $stmt=$conn->prepare('INSERT INTO area (Pid, AName, Image, Percentage,percentageequip) VALUES (:aid, :name, :image, :percentage,:percentageequip)');
            $stmt->bindParam(':aid', $phase);
            $stmt->bindParam(':name', $Name);
            $stmt->bindParam(':image', $bldgpic);
            $stmt->bindParam(':percentage', $percentage);
            $stmt->bindParam(':percentageequip', $percentageequip);
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
    public function assigningAreaStaff($formArray)
    { 
        $dao = new Dao();
        
        $conn = $dao->openConnection();
        $user=$_POST['user'];
        $aid=$_POST['arid'];
    
      
            $stmt=$conn->prepare('INSERT INTO area_staff (aid, sid) VALUES (:aid, :sid)');
            $stmt->bindParam(':aid', $aid);
            $stmt->bindParam(':sid', $user);
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
        $Name = $_POST['Name'];
        $phase = $_POST['phase'];
        $percentage = $_POST['percentage'];
        $percentageequip = $_POST['percentageequip'];
        
        $dao = new Dao();
        
        $conn = $dao->openConnection();
        
        $sql = "UPDATE Area SET Pid = '" . $phase . "'
        ,Aname = '" . $Name . "'
        ,Percentage = '" . $percentage . "'
        ,percentageequip = '" . $percentageequip . "'
        WHERE Aid=" . $id;
        
        $conn->query($sql);
        $dao->closeConnection();
    }

       /* Fetch Single Record by Id */
       public function readSingle($id)
       {
           try {
               
               $dao = new Dao();
               
               $conn = $dao->openConnection();
               
               $sql = "SELECT * FROM `Area` WHERE Aid=" . $id . " ORDER BY Aid DESC";
               
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

       /* Fetch Single Record by Id */
       public function showphaseUser()
       {
           $id=$_POST['id'];
           try {
               
               $dao = new Dao();
               
               $conn = $dao->openConnection();
               
               $sql = "SELECT * FROM `accounts` inner join area_staff on accounts.Acid = area_staff.sid inner join area on area_staff.aid = area.Aid where accounts.Position = 'protect' and area.Pid = '" . $id . "' ORDER BY accounts.Acid DESC";
               
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

       
       /* Assigning area and staff */
       public function updateAreaStaff($formArray)
       { 
           $dao = new Dao();
           
           $conn = $dao->openConnection();
           $user=$_POST['user'];
           $aid=$_POST['arid'];
       
         
               $stmt=$conn->prepare('UPDATE area_staff set sid = :sid where aid =:aid' );
               $stmt->bindParam(':sid', $user);
               $stmt->bindParam(':aid', $aid);
               if($stmt->execute())
               {
                   return true;
               }
               else{
                   return false;
               }
           
   
       }

       
    /* Delete a Record */
    public function delete($id)
    {
        $dao = new Dao();
        
        $conn = $dao->openConnection();
        
        $sql = "DELETE FROM `area` where Aid='$id'";
        
        $conn->query($sql);
        $dao->closeConnection();
    }
   

}

?>