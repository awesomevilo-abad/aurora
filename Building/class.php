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
            
            $sql = "SELECT * FROM `building` ORDER BY id DESC";
            
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
        $name=$_POST['buildingname'];
        $color=$_POST['colordiv'];
        $cat=$_POST['category'];
        $percentage=$_POST['percentage'];
        $images=$_FILES['image']['name'];
        $tmp_dir=$_FILES['image']['tmp_name'];
        $imageSize=$_FILES['image']['size'];
    
        $stmtvalidate=$conn->prepare("SELECT * FROM building where Name=:bname");
        $stmtvalidate->execute(array(":bname" => $name));
        if ($stmtvalidate->rowCount() > 0){
            return false;
        }else{
            $upload_dir='../uploads/';
            $imgExt=strtolower(pathinfo($images,PATHINFO_EXTENSION));
            $valid_extensions=array('jpeg', 'jpg', 'png', 'gif', 'pdf');
            $bldgpic=rand(1000, 1000000).".".$imgExt;
            move_uploaded_file($tmp_dir, $upload_dir.$bldgpic);
            $stmt=$conn->prepare('INSERT INTO building (Name, Image, Category, Color, Percentage) VALUES (:uname, :upic, :ucat, :ucolor, :upercent)');
            $stmt->bindParam(':uname', $name);
            $stmt->bindParam(':ucat', $cat);
            $stmt->bindParam(':ucolor', $color);
            $stmt->bindParam(':upic', $bldgpic);
            $stmt->bindParam(':upercent', $percentage);
            if($stmt->execute())
            {
                return true;
            }
            else{
                return false;
            }
        }

    }
    
    /* Edit a Record */
    public function edit($formArray)
    {
        $id = $_POST['id'];
        $bldgname = $_POST['buildingname'];
        $category = $_POST['category'];
        $colordiv = $_POST['colordiv'];
        $percentage = $_POST['percentage'];
        
        $dao = new Dao();
        
        $conn = $dao->openConnection();
        
        $sql = "UPDATE Building SET Name = '" . $bldgname . "'
        ,Category = '" . $category . "'
        ,Color = '" . $colordiv . "'
        ,Percentage = '" . $percentage . "'
        WHERE id=" . $id;
        
        $conn->query($sql);
        $dao->closeConnection();
    }

       /* Fetch Single Record by Id */
       public function readSingle($id)
       {
           try {
               
               $dao = new Dao();
               
               $conn = $dao->openConnection();
               
               $sql = "SELECT * FROM `building` WHERE id=" . $id . " ORDER BY id DESC";
               
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
        
        $sql = "DELETE FROM `building` where id='$id'";
        
        $conn->query($sql);
        $dao->closeConnection();
    }
   

}

?>