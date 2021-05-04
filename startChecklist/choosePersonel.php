<?PHP
if(isset($_POST['position'])){
   if($_POST['position'] == "QA Staff"){
    echo "QA Staff";
   }else{
    echo "QA Supervisor";
   }
}else{
    echo "Please Login First";
}

?>