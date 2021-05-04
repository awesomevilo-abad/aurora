$(document).ready(function(){
	loadData();



});


	
function loadData() {
	var main= "main";
	$.ajax({
		url: 'startChecklist/bridge.php',
		type: 'POST',
		data: {type : main},
		success:function(response){
			$("#choose").html(response);
		}
	});
}



function ConfirmationModal(id){
	$("#confirmModal").click();
	$("#passID").val(id);
	

}


function getID(){
	var getId= $("#passID").val();
	location.href = "MainChecklist.php?id="+getId;

}


function viewPhase(id){
	$.ajax({
		url: 'startChecklist/choosePhase.php',
		type: 'POST',
		data:{id2:id},
		success:function(response){
			// alert(response);
			// alert(id);
			// $("#arid").val(Aid);
			// $("#user").html(response);
			$("#choose").html(response);
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		  }
	});

}
function BacktoBuild(id){
	$.ajax({
		url: 'startChecklist/chooseBuilding.php',
		type: 'POST',
		success:function(response){
			// alert(response);
			// alert(id);
			// $("#arid").val(Aid);
			// $("#user").html(response);
			$("#choose").html(response);
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		  }
	});

}

