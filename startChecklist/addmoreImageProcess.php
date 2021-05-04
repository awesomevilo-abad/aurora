
    <?php
    if(isset($_FILES['addmoreImg'])){
        $imagename = $_FILES['addmoreImg']['name'];
        $imagetmpname = $_FILES['addmoreImg']['tmp_name'];
        $imagetype = $_FILES['addmoreImg']['type'];
        $imagesize = $_FILES['addmoreImg']['size'];
        $imageerror = $_FILES['addmoreImg']['error'];
    }else{
        $imagename="";
    }
    for($i=0; $i<count($imagetmpname);$i++){
        if(move_uploaded_file($imagetmpname[$i],"uploaded/".$imagename[$i])){
            // echo $imagename[$i]."upload completed<br>";
        }else{
        }
    }
    ?>