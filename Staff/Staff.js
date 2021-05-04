$(document).ready(function(){
	loadData();
	$('#btnUpdate').hide();
	$('#btnCancel').hide();
	$("#formData input").val('');
	$("#formData select").val('');


// submit form insert

	$("#formData").on('submit',(function(e) {
		
		e.preventDefault();
		$.ajax({
        	url: "Staff/addStaff.php",
			type: "POST",
			data:  new FormData(this),
			contentType: false,
    	    processData:false,
			success: function(data)
		    {
				// console.log(data);
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

	// end insert

	
// SAVING STAFF AND AREA
$("#formassign").on('submit',(function(e) {
		
	e.preventDefault();
	$.ajax({
				url: "Staff/assignPhaseStaff.php",
		type: "POST",
		data:  new FormData(this),
		contentType: false,
				processData:false,
		success: function(data)
			{
				// alert(data);
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

$(document).on('click' , '.bn-delete' ,function(){
	if(confirm("Are you sure want to delete the record?")) {
		var id = this.id;
		$.ajax({
			url: 'Staff/bridge.php',
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

$(document).on('click' , '.bn-removed' ,function(){
	if(confirm("Are you sure want to remove this phase?")) {
		var id = this.id;
		$.ajax({
			url: 'Staff/bridge.php',
			type: 'POST',
			data: {"id":id, "type":"remove"},
			success:function(response){
				console.log(response);
				// loadData();
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
				alert(thrownError);
				}
		});
	}
});


});


function Modal(userid){
	$.ajax({
			url: 'Staff/modal_content.php',
			type: 'POST',
			data:{},
			success:function(response){
					// alert(Pid);
					$("#openStaff").click();
					$("#userid").val(userid);
					$("#phase").html(response);
			},
			error: function (xhr, ajaxOptions, thrownError) {
					alert(xhr.status);
					alert(thrownError);
			}
	});

}

function ModalAddPhase(userid){
	$.ajax({
			url: 'Staff/modal_addPhaseTable.php',
			type: 'POST',
			data:{userid:userid},
			success:function(response){
					// alert(Pid);
					$("#addphase").click();
					$("#useradd").val(userid);
					$("#phasetable").html(response);
			},
			error: function (xhr, ajaxOptions, thrownError) {
					alert(xhr.status);
					alert(thrownError);
			}
	});

}

function loadData() {
	var all= "all";
	$.ajax({
		url: 'Staff/bridge.php',
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
		url: 'Staff/bridge.php',
		type: 'POST',
		dataType: 'JSON',
		data: {"id":id,"type":"single"},
		success:function(response){
			// console.log(response);
			$('#id').val(response.Acid);
			$('#Name').val(response.AcName);
			$('#pos').val(response.Position);
			$('#department').val(response.Department);
			$('#user').val(response.Username);
			$('#password').val(response.Password);
		
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
		url: 'Staff/updateStaff.php',
		type: 'POST',
		data: $("#formData").serialize(),
		success:function(data) {
			// alert (data);
			if(data == "incomplete"){
				alert('Incomplete Data');
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





