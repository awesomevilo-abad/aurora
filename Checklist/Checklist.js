$(document).ready(function(){
	loadData();
	loadCheckFilter();
	viewingloadData();
	$('#btnUpdate').hide();
	$('#btnCancel').hide();
	$("#Name").val('');
	$("#formData select").val('');
	

	$("#formData").on('submit',(function(e) {
		
		e.preventDefault();
		$.ajax({
        	url: "Checklist/addChecklist.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    processData:false,
			success: function(data)
		    {
				// alert (data);
				if(data == "incomplete"){
					alert('Incomplete  Data');
				}
				else if( data == "error"){
					alert('Duplicate Values');
				}
				else{
					alert("successfully saved!");
					loadData();
					$("#formData input").val('');
					$("#formData select").val('');
				}
			
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
				alert(thrownError);
			}        
	   });
	}));

	$(document).on('click' , '.bn-delete' ,function(){
		if(confirm("Are you sure want to delete the record?")) {
			var id = this.id;
			$.ajax({
				url: 'Checklist/bridge.php',
				type: 'POST',
				data: {"id":id, "type":"delete"},
				success:function(response){
					console.log(response);
					loadData();
					$("#formData input").val('');
					$("#formData select").val('');
				},
				error: function (xhr, ajaxOptions, thrownError) {
					alert(xhr.status);
					alert(thrownError);
				  }
			});
		}
	});


});

	
function loadData() {
	var all= "all";
	$.ajax({
		url: 'Checklist/bridge.php',
		type: 'POST',
		data: {type : all},
		beforeSend: function(){
			$("#showdata").hide();
			$('#loader').html('<img src="icons/loaderr.gif" style="opacity:.8" width=200 height=200 alt="Hello Image" />');
		},
		complete: function(){
			$("#showdata").show();
			$("#loader").hide();
		},
		success:function(response){
			$("#container").html(response);
		}
	});
}


function viewingloadData() {
	var all= "view";
	$.ajax({
		url: 'Checklist/bridge.php',
		type: 'POST',
		data: {type : all},
		
		beforeSend: function(){
			$("#showdata").hide();
			$('#loader').html('<img src="icons/loaderr.gif" style="opacity:.8" width=200 height=200 alt="Hello Image" />');
		},
		complete: function(){
			$("#showdata").show();
			$("#loader").hide();
		},
		success:function(response){
			$("#viewChecklist").html(response);
		}
	});
}

function filteredloadData() {
	var filtered= "filtered";
	var building= $("#Building").val();
	var phase= $("#Phase").val();
	var area= $("#Area").val();
	
	$.ajax({
		url: 'Checklist/bridge.php',
		type: 'POST',
		data: {type : filtered,building:building,phase:phase,area:area},
		
		beforeSend: function(){
			$("#showdata").hide();
			$('#loader').html('<img src="icons/loaderr.gif" style="opacity:.8" width=200 height=200 alt="Hello Image" />');
		},
		complete: function(){
			$("#showdata").show();
			$("#loader").hide();
		},
		success:function(response){
			$("#viewChecklist").html(response);
		}
	});
}


function loadCheckFilter(aid,pid){
	$.ajax({
		url: 'Checklist/modal_content_checkFilter.php',
		type: 'POST',
		data:{},
		success:function(response){
			// alert(response);	
			// $("#phaseid").val(pid);
			$("#Building").html(response);
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		  }
	});
	

}

function getBuilding(val) {
	var category = "getBuilding";
	$.ajax({
	type: "POST",
	url: "Checklist/Option.php",
	data: {building:val,category : category},
	success: function(data){
		// alert(val);
	$("#Phase").html(data);
	}
	});
}

function getPhase(val) {
	
	var category = "getPhase";
	$.ajax({
	type: "POST",
	url: "Checklist/Option.php",
	data: {phase:val,category : category},
	success: function(data){
		// alert(data);
	$("#Area").html(data);
	}
	});
}


function changeArea(aid){
	var type= "changearea";
	$.ajax({
		url: 'Checklist/bridge.php',
		type: 'POST',
		dataType: 'JSON',
		data: {
			type : type,
			aid : aid},
		success:function(response){
			$("#Pid").val(response.Pid);
			$("#Bid").val(response.Bid);
			$("#Pname").val(response.PName);
			$("#Bname").val(response.Name);
			console.log(response)
		}
	});
}


$(document).on('click' , '.bn-edit' ,function(){
	var id = this.id;
	$('#btnAdd').hide();
	$('#btnUpdate').show();
    $('#btnCancel').show();
    
	$.ajax({
		url: 'Checklist/bridge.php',
		type: 'POST',
		dataType: 'JSON',
		data: {"id":id,"type":"single"},
		success:function(response){
			console.log(response);
            $('#id').val(response.Cid);
			$('#area').val(response.Aid);
			$('#Name').val(response.CName);
			$('#SOne').val(response.Sani_One);
			$('#STwo').val(response.Sani_Two);
			$('#SThree').val(response.Sani_Three);
			$('#STOne').val(response.Stru_One);
			$('#STTwo').val(response.Stru_Two);
		
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		  }
	});
});

$( "#btnCancel" ).click(function() {
	$("#btnAdd").show();
  $("#btnUpdate").hide();
  $("#btnCancel").hide();
  $("#formData").val('');
});


// $('[name="phase"]').change(function() {
// 	$('[name="buildingname"]').val($(this).val());
//  });


$("#btnUpdate").click(function(){
	$("#btnAdd").show();
	$("#btnUpdate").hide();
	$("#btnCancel").hide();
	$.ajax({
		url: 'Checklist/updateChecklist.php',
		type: 'POST',
		data: $("#formData").serialize(),
		success:function(data) {
			// alert (data);
			if(data == "incomplete"){
				alert('Incomplete Phase Data');
			}
			else if( data == "error"){
				alert('Duplicate Values');
			}
			else{
				alert("successfully saved!");
				loadData();
				$("#formData input").val('');
				$("#formData select").val('');
			}
		
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		  }
	});
});





