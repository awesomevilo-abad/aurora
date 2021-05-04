$(document).ready(function(){
	loadData();

	$('#btnUpdate').hide();
	$('#btnCancel').hide();
	$("#formData input").val('');
	$("#formData select").val('');

	$("#formData").on('submit',(function(e) {
		
		e.preventDefault();
		$.ajax({
        	url: "Area/addArea.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
					processData:false,
			
			beforeSend: function(){
				$("#showdata").hide();
				$('#loader').html('<img src="icons/loaderr.gif" style="opacity:.8" width=200 height=200 alt="Hello Image" />');
			},
			complete: function(){
				$("#showdata").show();
				$("#loader").hide();
			},
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
				alert(data)
			
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
				alert(thrownError);
			}        
	   });
	}));


	// SAVING STAFF AND AREA
	$("#formassign").on('submit',(function(e) {
		
		e.preventDefault();
		$.ajax({
        	url: "Area/assignAreaStaff.php",
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

	// SAVING STAFF AND AREA
	$("#formchange").on('submit',(function(e) {
		
		e.preventDefault();
		$.ajax({
        	url: "Area/modal_update.php",
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
	function loadData() {
		var all= "all";
		$.ajax({
			url: 'Area/bridge.php',
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

	$(document).on('click' , '.bn-delete' ,function(){
		if(confirm("Are you sure want to delete the record?")) {
			var id = this.id;
			$.ajax({
				url: 'Area/bridge.php',
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


	


$(document).on('click' , '.bn-edit' ,function(){
	var id = this.id;
	$('#btnAdd').hide();
	$('#btnUpdate').show();
    $('#btnCancel').show();
    
	$.ajax({
		url: 'Area/bridge.php',
		type: 'POST',
		dataType: 'JSON',
		data: {"id":id,"type":"single"},
		success:function(response){

			// console.log(response);
       $('#id').val(response.Aid);
			$('#Name').val(response.AName);
			$('#phase').val(response.Pid);
			$('#percentage').val(response.Percentage);
			$('#percentageequip').val(response.percentageequip);
		
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


// $('[name="phase"]').change(function() {
// 	$('[name="buildingname"]').val($(this).val());
//  });


$("#btnUpdate").click(function(){
	$("#btnAdd").show();
	$("#btnUpdate").hide();
	$("#btnCancel").hide();
	$.ajax({
		url: 'Area/updateArea.php',
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



