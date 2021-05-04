$(document).ready(function(){
	viewingloadData();
	getYear();


});

function getYear(){
    var min = new Date().getFullYear(),
    max = min + 9,
    select = document.getElementById('selectYear');

    for (var i = min; i<=max; i++){
    var opt = document.createElement('option');
    opt.value = i;
    opt.innerHTML = i;
    select.appendChild(opt);
}
}
function changeYear(year){
	
	var all= "viewOffenseStructural";
	var year =year;
	var week = $('#week').val();
	var offense = $('#offense').val();

	$.ajax({
		url: 'Offense/bridge.php',
		type: 'POST',
		data: {type : all, year:year, month:month, week:week, offense:offense},
		
		success:function(response){
			$("#viewOffenseStructural").html(response);
		}
	});

}
function changeMonth(month){
	
	var all= "viewOffenseStructural";
	var month =month;
	var week = $('#week').val();
	var offense = $('#offense').val();
	var year = $('#selectYear').val();

	$.ajax({
		url: 'Offense/bridge.php',
		type: 'POST',
		data: {type : all, year:year,month:month, week:week, offense:offense},
		
		success:function(response){
			$("#viewOffenseStructural").html(response);
		}
	});

}function changeWeek(week){
	
	var all= "viewOffenseStructural";
	var month =$('#month').val();
	var week = week;
	var offense = $('#offense').val();
	var year = $('#selectYear').val();

	$.ajax({
		url: 'Offense/bridge.php',
		type: 'POST',
		data: {type : all, year:year,month:month, week:week, offense:offense},
		
		success:function(response){
			$("#viewOffenseStructural").html(response);
		}
	});

}function changeOffense(offense){
	
	var all= "viewOffenseStructural";
	var month =$('#month').val();
	var week = $('#week').val();
	var offense = offense;
	var year = $('#selectYear').val();

	$.ajax({
		url: 'Offense/bridge.php',
		type: 'POST',
		data: {type : all, year:year,month:month, week:week, offense:offense},
		
		success:function(response){
			$("#viewOffenseStructural").html(response);
		}
	});

}

function viewingloadData() {
	var all= "viewOffenseStructural";
	var month =$('#month').val();
	var week = $('#week').val();
	var offense = $('#offense').val();
	var year = $('#selectYear').val();

	$.ajax({
		url: 'Offense/bridge.php',
		type: 'POST',
		data: {type : all, year:year,month:month, week:week, offense:offense},
		
		beforeSend: function(){
			$("#showdata").hide();
			$('#loader').html('<img src="icons/loaderr.gif" style="opacity:.8" width=200 height=200 alt="Hello Image" />');
		},
		complete: function(){
			$("#showdata").show();
			$("#loader").hide();
		},
		success:function(response){
			$("#viewOffenseStructural").html(response);
		}
	});
}



