$(document).ready(function(){
	

	$(document).on('click' , '.logout' ,function(){
		if(confirm("Are you sure want to Logout?")) {
	        window.location.assign('logout.php');
		}else{
        }
	});


});
