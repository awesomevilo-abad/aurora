$(document).ready(function(){
	loadData();
	$('#btnUpdate').hide();
	$('#btnCancel').hide();
	$("#Name").val('');
	$("#formData select").val('');
	$("#percentage").val('10');

	$("#formData").on('submit',(function(e) {
		
		e.preventDefault();
		$.ajax({
        	url: "Phase/addPhase.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    processData:false,
			success: function(data)
		    {
					alert(data);
				if(data == "incomplete"){
					alert('Incomplete Phase Data');
				}
				else if( data == "error"){
					alert('Duplicate Values');
				}
				else{
					alert("successfully saved!");
					loadData();
					$("#Name").val('');
					$("#formData select").val('');
					$('#percentage').val('0');
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
				url: 'Phase/bridge.php',
				type: 'POST',
				data: {"id":id, "type":"delete"},
				success:function(response){
					console.log(response);
					loadData();
					$("#Name").val('');
					$("#formData select").val('');
					$('#percentage').val('0');
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
		url: 'Phase/bridge.php',
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
		$('#percentage').val('0');
    
	$.ajax({
		url: 'Phase/bridge.php',
		type: 'POST',
		dataType: 'JSON',
		data: {"id":id,"type":"single"},
		success:function(response){
			console.log(response);
			$('#id').val(response.Pid);
			$('#idcounter').val(response.PidCounter);
			$('#building').val(response.Bid);
			$('#Name').val(response.PName);
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
  $("#Name").val('');
	$("#formData select").val('');
	$('#percentage').val('0');
});


$("#btnUpdate").click(function(){
	$("#btnAdd").show();
	$("#btnUpdate").hide();
	$("#btnCancel").hide();
	$('#percentage').val('0');
	$.ajax({
		url: 'Phase/updatePhase.php',
		type: 'POST',
		data: $("#formData").serialize(),
		success:function(response){
			console.log(response);
			loadData();
			
			$("#Name").val('');
			$("#formData select").val('');
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		  }
	});
});

// SAVING STAFF AND AREA
$("#formassign").on('submit',(function(e) {
		
	e.preventDefault();
	$.ajax({
				url: "phase/assignPhaseStaff.php",
		type: "POST",
		data:  new FormData(this),
		contentType: false,
				processData:false,
		success: function(data)
			{
			// alert('Succefully Added');
			$("#closemodal").click();
			loadData();
			
		
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		}        
	 });
}));

// change STAFF AND AREA
$("#formchange").on('submit',(function(e) {
	
	e.preventDefault();
	$.ajax({
				url: "Phase/modal_update.php",
		type: "POST",
		data:  new FormData(this),
		contentType: false,
				processData:false,
		success: function(data)
			{
			// alert('Succefully Added');
			$("#closemodalchange").click();
			loadData();
			
		
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		}        
	 });
}));





