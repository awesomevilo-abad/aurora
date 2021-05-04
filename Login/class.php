<?php
include_once 'Conn.php';
class CrudController
{ 
public function is_loggedin()
	{
		if(isset($_SESSION['AcName']))
		{
			return true;
		}
    }
}
?>