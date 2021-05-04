$(document).ready(function(){
	loadData();
	$('#btnUpdate').hide();
	$('#btnCancel').hide();
	$("#formData input").val('');
	$("#formData select").val('');
	$("#percentage").val('10');

	$("#formData").on('submit',(function(e) {
		
		e.preventDefault();
		$.ajax({
        	url: "Building/addBuilding.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    processData:false,
			success: function(data)
		    {
				if(data == "incomplete"){
					alert('Incomplete Building Data');
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
				url: 'Building/bridge.php',
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
		url: 'Building/bridge.php',
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


$(document).on('click' , '.bn-edit' ,function(){
	var id = this.id;
	$('#btnAdd').hide();
	$('#btnUpdate').show();
	$('#btnCancel').show();
	$.ajax({
		url: 'Building/bridge.php',
		type: 'POST',
		dataType: 'JSON',
		data: {"id":id,"type":"single"},
		success:function(response){
			console.log(response);
			$('#id').val(response.id);
			$('#buildingname').val(response.Name);
			$('#category').val(response.Category);
			$('#colordiv').val(response.Color);
			$('#percentage').val(response.Percentage);
		
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
  $("#formData input").val('');
  $("#formData select").val('');
});

$( "#reset" ).click(function() {
	$("#btnAdd").show();
  $("#btnUpdate").hide();
  $("#btnCancel").hide();
  $("#formData input").val('');
  $("#formData select").val('');
});
 
function showimport(){
	$('#importbuilding').show();
}	

$("#btnUpdate").click(function(){
	$("#btnAddBuild").show();
	$("#btnUpdate").hide();
	$("#btnCancel").hide();
	$.ajax({
		url: 'Building/updateBuilding.php',
		type: 'POST',
		data: $("#formData").serialize(),
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
});





