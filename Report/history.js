$(document).ready(function () {
	loadhistory();
	loadhistory_visor();
	// loadCheckFilter();
	loadCheckDateFilter();
	loadCheckDateFilter_visor();
	loadDataReport();
	loadDataReport_Manager();
	loaddashboard();
	$('#btnAddRecord').hide();
	$('#btnUpdate').hide();
	$('#btnCancel').hide();
	$('#btnUpdateRemarks').hide();
	$('#btnCancelRemarks').hide();
	$('#btnUpdateCorrection').hide();
	$('#btnCancelCorrection').hide();
	loaddashboardphase();
	loaddashboard_viewitemfindings();
	// chartWeeklyPhase();
	// loaddashboard_viewitemfindings_structural();
	loadweekdate();
	viewWeekReport();
	$("#shownav").hide();
	$("#hidenav").hide();
	$("#filterreport_phase").hide();
	$("#dropdownequip").hide();
	$("#average").hide();
	$("#filterreport_ave").hide();
	$("#filterreportave").hide();
	dropdownBuilding();
	
$(".container").pagify(8, ".single-item");
});

function viewWeekReport() {
	var title = $("#getTitle").val();

	$.ajax({
		url: 'Report/bridge.php',
		type: 'POST',
		dataType: "json",
		data: {
			type: "GetWeekReport",
			title: title
		},
		success: function (JSONObject) {

			for (var key in JSONObject) {
				if (JSONObject.hasOwnProperty(key)) {
					var Week = JSONObject[key]["Week"];
					var Pid = JSONObject[key]["Pid"] + "_" + Week;
					// console.log(Pid);
					$("#" + Pid).html("1");


				}
			}

		}
	});
}

function loadhistory() {
	var history = "history";
	$.ajax({
		url: 'Report/bridge.php',
		type: 'POST',
		data: {
			type: history
		},
		beforeSend: function(){
			$("#showdata").hide();
			$('#loader').html('<img src="icons/loaderr.gif" style="opacity:.8" width=200 height=200 alt="Hello Image" />');
		},
		complete: function(){
			$("#showdata").show();
			$("#loader").hide();
		},
		success: function (response) {
			// alert(response);
			$("#historytable").html(response);
		}
	});
}


function loadweekdate() {
	var history = "weekDate";
	var date = $("#Week").val();
	// alert(date);
	$.ajax({
		url: 'Report/bridge.php',
		type: 'POST',
		data: {
			type: history,
			date:date
		},
		success: function (response) {
			// alert(response);
			if(response == 1){
			$("#Week").val("1");
			$("#Week_details").val("First Week");
			}else if(response == 2){
			$("#Week").val("2");
			$("#Week_details").val("Second Week");
			}else if(response == 3){
			$("#Week").val("3");
			$("#Week_details").val("Third Week");
			}else if(response == 4){
			$("#Week").val("4");
			$("#Week_details").val("Fourth Week");
			}else if(response == 5){
			$("#Week").val("5");
			$("#Week_details").val("Fifth Week");
			}
			// $("#historytable").html(response);
		}
	});
}

function loaddashboard() {
	var history = "dashboard";
	$.ajax({
		url: 'Report/bridge.php',
		type: 'POST',
		data: {
			type: history
		},
		success: function (response) {
			// alert(response);
			$("#dashboardtable_max").html(response);
			$("#dashboardtable_min").html(response);
		}
	});
}

function loaddashboard_viewitemfindings() {
	var history = "dashboard_viewitemfindings";
	$.ajax({
		url: 'Report/bridge.php',
		type: 'POST',
		data: {
			type: history
		},
		success: function (response) {
			// alert(response);
			$("#dashboardtable_viewitemfindings").html(response);
		}
	});
}

function loaddashboard_viewitemfindings_structural() {
	var history = "dashboard_viewitemfindings";
	$.ajax({
		url: 'Report/bridge.php',
		type: 'POST',
		data: {
			type: history
		},
		success: function (response) {
			// alert(response);
			$("#dashboardtable_viewitemfindings_structural").html(response);
		}
	});
}

function loadDataRemarksReport(fid) {
	var fid = fid
	var history = "remarksreport";
	var typeCorrective = $('#typeCorrective').val();
	// alert(typeCorrective);
	$.ajax({
		url: 'Report/bridge.php',
		type: 'POST',
		data: {
			type: history,
			fid: fid,
			typeCorrective: typeCorrective
		},
		success: function (response) {
			// alert(fid)
			// alert('Succesfully Deleted');
			$("#remarksresult").html(response);
		}
	});
}


function loadDataCorrectionReport(rid) {
	var history = "remarksreportCorrection";
	var typeCorrection = $('#typeCorrection').val();
	// alert(fid);
	$.ajax({
		url: 'Report/bridge.php',
		type: 'POST',
		data: {
			type: history,
			rid: rid,
			typeCorrection: typeCorrection
		},
		success: function (response) {
			// alert('Succesfully Deleted');
			$("#remarksresultCorrection").html(response);
		}
	});
}

function loadDataCompliance(fid) {
	var history = "remarksresultcompliance";
	// var typeCorrection = $('#typeCorrection').val();
	// alert(fid);
	$.ajax({
		url: 'Report/bridge.php',
		type: 'POST',
		data: {
			type: history,
			fid: fid,
		},
		success: function (response) {
			// alert('Succesfully Deleted');
			$("#remarksresultcompliance").html(response);
			
		}
	});
}
function loadDataComplianceremarks(rid,date,compliance) {
	var complianceid = $("#complianceid").val()
	// alert(compliance);
	var history = "remarksresultcomplianceremarks";
	// var typeCorrection = $('#typeCorrection').val();
	// alert(fid);
	$.ajax({
		url: 'Report/bridge.php',
		type: 'POST',
		data: {
			type: history,
			rid: rid,
			date: date,
			compliance: compliance,
			complianceid: complianceid,

		},
		success: function (response) {
			// alert('Succesfully Deleted');
			$("#remarksresultcomplianceremarks").html(response);
		}
	});
}


function loadDataCorrectionReport_image(rid) {
	var history = "remarksreportCorrection";
	var typeCorrection = $('#typeCorrection').val();
	$.ajax({
		url: 'Report/bridge.php',
		type: 'POST',
		data: {
			type: history,
			rid: rid,
			typeCorrection: typeCorrection
		},
		success: function (response) {
			// alert('Succesfully Deleted');
			$("#remarksresultCorrection").html(response);
		}
	});
}


function loadhistory_visor() {

	var history = "history_visor";
	var DateToday = $("#DateToday").val();
	var AcName = $("#AcName").val();
	// alert(DateToday);	
	$.ajax({
		url: 'Report/bridge.php',
		type: 'POST',
		data: {
			type: history,
			date: DateToday,
			AcName: AcName
		},
		beforeSend: function(){
			$("#showdata").hide();
			$('#loader').html('<img src="icons/loaderr.gif" style="opacity:.8" width=200 height=200 alt="Hello Image" />');
		},
		complete: function(){
			$("#showdata").show();
			$("#loader").hide();
		},
		success: function (response) {
			// alert(response);
			$("#historytable_visor").html(response);
		}
	});
}

function ViewHistory(aid, aname, datechecked, PName) {
	// alert(aid);
	$("#areaname").val(aname);
	$("#datechecked").val(datechecked);
	$("#aid").val(aid);
	$("#phasename").val(PName);
	$("#viewcheckgrade").click();
	loadcheckgradetable(aid, datechecked);

}

function loadcheckgradetable(aid, datechecked) {
	var history = "checklistgradetable";
	// alert(aid);
	$.ajax({
		url: 'Report/bridge.php',
		type: 'POST',
		data: {
			type: history,
			aid: aid,
			date: datechecked
		},
		success: function (response) {
			$("#checklistgradetable").html(response);
		}
	});
}

function loadcheckgradetable_image(cid, cname, datechecked) {
	var history = "checklistgradetable_image";
	// alert(datechecked);
	$.ajax({
		url: 'Report/bridge.php',
		type: 'POST',
		data: {
			type: history,
			cid: cid,
			cname: cname,
			date: datechecked
		},
		success: function (response) {
			$("#loadcheckgradetable_image").html(response);
		}
	});
}

function loadcheckgradetable_image_equipment(eid, ename, datechecked) {
	var history = "checklistgradetable_image_equipment";

	$.ajax({
		url: 'Report/bridge.php',
		type: 'POST',
		data: {
			type: history,
			eid: eid,
			ename: ename,
			date: datechecked
		},
		success: function (response) {
			// alert(response);
			$("#loadcheckgradetable_image_equipment").html(response);
		}
	});
}

function loadcheckgradetable_visor(aid, datechecked) {
	alert(aid);
	alert(datechecked);
	var history = "checklistgradetable_visor";
	$.ajax({
		url: 'Report/bridge.php',
		type: 'POST',
		data: {
			type: history,
			aid: aid,
			date: datechecked
		},
		success: function (response) {
			$("#checklistgradetable").html(response);
		}
	});
}


// history filter js

function loadCheckFilter(val) {
	date=val
	$.ajax({
		url: 'Report/modal_content_checkFilter.php',
		type: 'POST',
		data: {date:date},
		
		beforeSend: function(){
			$("#showdata").hide();
			$('#loader').html('<img src="icons/loaderr.gif" style="opacity:.8" width=200 height=200 alt="Hello Image" />');
		},
		complete: function(){
			$("#showdata").show();
			$("#loader").hide();
		},
		success: function (response) {
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

function loadCheckFilter_visor(val) {
	date=val
	$.ajax({
		url: 'Report/modal_content_checkFilter_visor.php',
		type: 'POST',
		data: {date:date},
		success: function (response) {
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

function loadCheckDateFilter() {
	$.ajax({
		url: 'Report/modal_content_checkDateFilter.php',
		type: 'POST',
		data: {},
		success: function (response) {
			// alert(response);	
			// $("#phaseid").val(pid);
			$("#Date").html(response);
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		}
	});


}


function loaddashboardphase() {
	$.ajax({
		url: 'Report/modal_content_dashboardphase.php',
		type: 'POST',
		data: {},
		success: function (response) {
			// alert(response);	
			// $("#phaseid").val(pid);
			$("#Phasedashboard").html(response);
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		}
	});


}

function loadCheckDateFilter_visor() {
	$.ajax({
		url: 'Report/modal_content_checkDateFilter_visor.php',
		type: 'POST',
		data: {},
		success: function (response) {
			// alert(response);	
			// $("#phaseid").val(pid);
			$("#Date_visor").html(response);
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
		url: "Report/Option.php",
		data: {
			building: val,
			category: category
		},
		success: function (data) {
			// alert(data);
			$("#Phase").html(data);
		}
	});
}


function getBuildingfromPhase(val) {
	var category = "getBuildingfromPhase";
	$.ajax({
		type: "POST",
		url: "Report/Option.php",
		data: {
			phase: val,
			category: category
		},
		success: function (data) {
			// alert(data);
			$("#BuildingRecord").val(data);
			$("#BuildingRecordshow").val(data);
		}
	});
}

function getPhase(val) {

	var category = "getPhase";
	$.ajax({
		type: "POST",
		url: "Report/Option.php",
		data: {
			phase: val,
			category: category
		},
		success: function (data) {
			// alert(data);
			$("#Area").html(data);
		}
	});
}


function changereporttype(val) {

	if(val == "auditreport"){
		$("#average").hide();
		$("#auditreport").show();
		$("#checklist").hide();
		$("#hidenav").hide();
		$("#shownav").hide();
		$("#filterreport_area_checklist").hide();
		$("#filterreport").show();
		$("#filterreportave").hide();
		$("#exportAudit").show();

	}else if(val == "checklist"){
		$("#average").hide();
		$("#auditreport").hide();
		$("#checklist").show();
		$("#filterreport_phase").hide();
		$("#filterreport_area_checklist").hide();
		$("#filterreport").hide();
		$("#hidenav").hide();
		$("#shownav").hide();
		$("#filterreportave").hide();
		$("#exportCheck").show();
		$("#exportAudit").hide();
		// alert('hide');
	}else if(val == "average"){
		$("#auditreport").hide();
		$("#checklist").hide();
		$("#average").show();
		$("#filterreportave").show();
		$("#filterreport_ave").hide();
		$("#filterreport").hide();
		$("#hidenav").hide();
		$("#shownav").hide();
		$("#exportCheck").hide();
		$("#exportAudit").hide();
		// alert('hide');
	}

	// if (val == "viewscores_phase") {

	// 	$("#viewscores_phase").show();
	// 	// $("#changereport").hide();
	// 	$("#viewitemfindings_sanitation").hide();
	// 	$("#viewitemfindings_structural").hide();
	// 	$("#viewitemfindings_equipment").hide();
	// 	$("#viewscores_building").hide();

	// } else if (val == "viewscores_building") {
	// 	$("#viewscores_phase").hide();
	// 	// $("#changereport").hide();
	// 	$("#viewitemfindings_sanitation").hide();
	// 	$("#viewitemfindings_structural").hide();
	// 	$("#viewitemfindings_equipment").hide();
	// 	$("#viewscores_building").show();
	// } else if (val == "viewitemfindings_sanitation") {
	// 	$("#viewscores_phase").hide();
	// 	// $("#changereport").hide();
	// 	$("#viewitemfindings_sanitation").show();
	// 	$("#viewitemfindings_structural").hide();
	// 	$("#viewitemfindings_equipment").hide();
	// 	$("#viewscores_building").hide();
	// } else if (val == "viewitemfindings_structural") {
	// 	$("#viewscores_phase").hide();
	// 	// $("#changereport").hide();
	// 	$("#viewitemfindings_sanitation").hide();
	// 	$("#viewitemfindings_structural").show();
	// 	$("#viewitemfindings_equipment").hide();
	// 	$("#viewscores_building").hide();
	// } else if (val == "viewitemfindings_equipment") {
	// 	$("#viewscores_phase").hide();
	// 	// $("#changereport").hide();
	// 	$("#viewitemfindings_sanitation").hide();
	// 	$("#viewitemfindings_structural").hide();
	// 	$("#viewitemfindings_equipment").show();
	// 	$("#viewscores_building").hide();
	// }

}function changereport(val) {

	if(val == "equipment"){
		$("#dropdownequip").show();
		$("#dropdownchecklist").hide();
	}
	else if(val == "sanitation"){
		$("#dropdownequip").hide();
		$("#dropdownchecklist").show();
	}
	else if(val == "structural"){
		$("#dropdownequip").hide();
		$("#dropdownchecklist").show();
	
	}
	else if(val == "sanitationremarks"){
		$("#dropdownequip").hide();
		$("#dropdownchecklist").show();
	
	}

}

function changedata(val) {

	var type = "changedata";
	$.ajax({
		type: "POST",
		url: "Report/bridge.php",
		data: {
			phase: val,
			type: type
		},
		success: function (data) {
			// alert(data);
			// $("#dashboardtable_max").show();
			// $("#dashboardtable_min").show();
			// $("#dateset").show();
			// $("#dateunset").hide();
			// $("#dashboardtable_max").html(data);
			// $("#dashboardtable_min").html(data);
			// $("#dashboardtable").html(data);
			// $("#datedash").show();
			// $("#dateset_building_viewscores").hide();
			
			$("#hidenav").show();
			$("#filterreport_phase").show();
			$("#filterreport").hide();
			
		}
	});
}




function changedata_viewitemfindings(val) {
	// alert(val);
	var type = "changedata_viewitemfindings";
	$.ajax({
		type: "POST",
		url: "Report/bridge.php",
		data: {
			area: val,
			type: type
		},
		success: function (data) {
			// alert(data);
			$("#dashboardtable_viewitemfindings").show();
			$("#dateset_viewitemfindings").show();
			$("#dateunset_viewitemfindings").hide();
			$("#dashboardtable_viewitemfindings").html(data);
		}
	});
}


function changedata_viewitemfindings_structural(val) {
	// alert(val);
	var type = "changedata_viewitemfindings_structural";
	$.ajax({
		type: "POST",
		url: "Report/bridge.php",
		data: {
			area: val,
			type: type
		},
		success: function (data) {
			// alert(data);
			$("#dashboardtable_viewitemfindings_structural").show();
			$("#dateset_viewitemfindings_structural").show();
			$("#dateunset_viewitemfindings_structural").hide();
			$("#dashboardtable_viewitemfindings_structural").html(data);
		}
	});
}

function changedata_viewitemfindings_equipment(val) {
	// alert(val);
	var type = "changedata_viewitemfindings_equipment";
	$.ajax({
		type: "POST",
		url: "Report/bridge.php",
		data: {
			area: val,
			type: type
		},
		success: function (data) {
			// alert(data);
			$("#dashboardtable_viewitemfindings_equipment").show();
			$("#dateset_viewitemfindings_equipment").show();
			$("#dateunset_viewitemfindings_equipment").hide();
			$("#dashboardtable_viewitemfindings_equipment").html(data);
		}
	});
}


function changedata_building_viewscores(val) {
	$("#filterreport").show();
	$("#filterreport_phase").hide();
	var type = "changedata_building_viewscores";
	$.ajax({
		type: "POST",
		url: "Report/Reports_selectbuilding.php",
		data: {
			building: val,
			type: type
		},
		success: function (data) {
			// alert(data);
			// $("#dashboardtable_viewscores_building").show();
			$("#dateset_building_viewscores").show();
			$("#hidenav").show();
			// alert(data);
			$("#phase").html(data);
			
		}
	});
}


function changedata_checklist(val) {

	var type = "changedata_checklist";
	$.ajax({
		type: "POST",
		url: "Report/Reports_selectphase.php",
		data: {
			phase: val,
			type: type
		},
		success: function (data) {
			// alert(data);
			// $("#dashboardtable_viewscores_building").show();
			$("#dateset_building_viewscores").show();
			// $("#dateunset_building_viewscores").hide();
			// $("#dashboardtable_viewscores_building").html(data);
			// $("#dashboardtable_max").html(data);
			// $("#dashboardtable_min").html(data);
			// $("#dashboardtable_min").show();
			// $("#dateunset_building_viewscores").show();
			// $("#dateset").hide();
			$("#hidenav").show();
			// alert(data);
			$("#Report_area_checklist").html(data);
			
		}
	});
}


function phasedata(val) {

	var type = "changedata_building_viewscores";
	$.ajax({
		type: "POST",
		url: "Report/Reports_selectbuilding.php",
		data: {
			building: val,
			type: type
		},
		success: function (data) {
			// alert(data);
			// $("#dashboardtable_viewscores_building").show();
			$("#dateset_building_viewscores").show();
			// $("#dateunset_building_viewscores").hide();
			// $("#dashboardtable_viewscores_building").html(data);
			// $("#dashboardtable_max").html(data);
			// $("#dashboardtable_min").html(data);
			// $("#dashboardtable_min").show();
			// $("#dateunset_building_viewscores").show();
			// $("#dateset").hide();
			$("#hidenav").show();
			// alert(data);
			$("#phase").html(data);
			
		}
	});
}

function changedate(val) {
	var phase = $("#phase").val();
	var type = "changedate";
	// alert(val);
	$.ajax({
		type: "POST",
		url: "Report/bridge.php",
		data: {
			phase: phase,
			date: val,
			type: type
		},
		success: function (data) {
			// alert(data);
			$("#dashboardtable_max").html(data);
			$("#dashboardtable_min").html(data);
		
		}
	});
}

function hidenavigation() {
	$("#auditreport-nav").hide();
	$("#checklist").hide();
	$("#hidenav").hide();
	$("#shownav").show();
	$("#dashboardtable_min").hide();
	$("#dashboardtable_max").show();
	
}
function shownavigation() {
	$("#auditreport-nav").show();
	$("#hidenav").show();
	$("#checklist").show();
	$("#shownav").hide();
	$("#dashboardtable_min").show();
	$("#dashboardtable_max").hide();
	
}


function changedate_viewitemfindings(val) {
	var area = $("#area_viewitemfindings").val();
	var type = "changedate_viewitemfindings";
	// alert(val);
	// alert(date);
	$.ajax({
		type: "POST",
		url: "Report/bridge.php",
		data: {
			area: area,
			date: val,
			type: type
		},
		success: function (data) {
			// alert(data);
			$("#dashboardtable_viewitemfindings").html(data);
		}
	});
}

function changedate_viewitemfindings_structural(val) {
	var area = $("#area_viewitemfindings").val();
	var type = "changedate_viewitemfindings_structural";
	// alert(val);
	// alert(date);
	$.ajax({
		type: "POST",
		url: "Report/bridge.php",
		data: {
			area: area,
			date: val,
			type: type
		},
		success: function (data) {
			// alert(data);
			$("#dashboardtable_viewitemfindings_structural").html(data);
		}
	});
}


function changedate_viewitemfindings_equipment(val) {
	var area = $("#area_viewitemfindings_equipment").val();
	var type = "changedate_viewitemfindings_equipment";
	// alert(val);
	// alert(date);
	$.ajax({
		type: "POST",
		url: "Report/bridge.php",
		data: {
			area: area,
			date: val,
			type: type
		},
		success: function (data) {
			// alert(data);
			$("#dashboardtable_viewitemfindings_equipment").html(data);
		}
	});
}

function changedate_building_viewscores(val) {
	var building = $("#building_viewscores").val();
	var type = "changedate_building_viewscores";
	// alert(val);
	$.ajax({
		type: "POST",
		url: "Report/bridge.php",
		data: {
			building: building,
			date: val,
			type: type
		},
		success: function (data) {
			// alert(data);
			$("#dashboardtable_viewscores_building").html(data);
		}
	});
}

function getDate(val) {

	var category = "getDate";
	$.ajax({
		type: "POST",
		url: "Report/Option.php",
		data: {
			date: val,
			category: category
		},
		success: function (data) {
			// alert(val);
			$("#Building").html(data);


		}
	});
}

function enableBuilding(val) {
	
	loadCheckFilter(val);

}
function enableBuilding_visor(val) {
	
	loadCheckFilter_visor(val);

}


function filteredloadData() {
	var filtered = "filtered";
	var building = $("#Building").val();
	var phase = $("#Phase").val();
	var area = $("#Area").val();
	var date = $("#Date").val();


	$.ajax({
		url: 'Report/bridge.php',
		type: 'POST',
		data: {
			type: filtered,
			building: building,
			phase: phase,
			area: area,
			date: date
		},
		success: function (response) {
			// alert(response);
			// alert(building);
			// alert(phase);
			// alert(area);
			$("#historytable").html(response);
		}
	});
}

function filterReports() {
	var filtered = "filterreports";
	var building = $("#building_viewscores").val();
	var phase = $("#phase").val();
	// var date = $("#datedash").val();
	var start_auditreport = $("#start_auditreport").val();
	var end_auditreport = $("#end_auditreport").val();
// alert(phase);
	if(start_auditreport == ""){
		alert("Enter Start Date");
	}
	else if(end_auditreport == ""){
		alert("Enter End Date");
	}else{

	$.ajax({
		url: 'Report/bridge.php',
		type: 'POST',
		data: {
			type: filtered,
			building: building,
			phase: phase,
			// date: date,
			start_auditreport: start_auditreport,
			end_auditreport: end_auditreport
		},
		beforeSend: function(){
			$("#dashboardtable_min").hide();
			$('#loaderfilter').html('<img src="icons/loaderr.gif" style="opacity:.8" width=200 height=200 alt="Hello Image" />');
		},
		complete: function(){
			$("#dashboardtable_min").show();
			$("#loaderfilter").hide();
		},
		success: function (response) {
			// alert(response);
			// alert(building);
			// alert(phase);
			// alert(area);
			$("#dashboardtable_max").html(response);
			$("#dashboardtable_min").html(response);
			$("#dashboardtable_max").hide();
			$("#dashboardtable_min").show();
		}
	});
	}
}


function filterreportave() {
	var filtered = "filterreportave";
	var building = $("#buildingave").val();
	var phase = $("#phaseave").val();
	var start_auditreport = $("#start_auditreport_ave").val();
	var end_auditreport = $("#end_auditreport_ave").val();
	
	
	if(start_auditreport == ""){
		alert("Enter Start Date");
	}
	else if(end_auditreport == ""){
		alert("Enter End Date");
	}else{

	$.ajax({
		url: 'Report/bridge.php',
		type: 'POST',
		data: {
			type: filtered,
			building: building,
			phase: phase,
			// date: date,
			start_auditreport: start_auditreport,
			end_auditreport: end_auditreport
		},
		success: function (response) {
			$("#dashboardtable_max").html(response);
			$("#dashboardtable_min").html(response);
			$("#dashboardtable_max").hide();
			$("#dashboardtable_min").show();
		}
	});
	}
}

function filterReports_checklist() {
	alert("Please Wait")
	var phase = $("#Report_phase_checklist").val();
	var area = $("#Report_area_checklist").val();
	var type_report = $("#Report_type").val();
	
	if(type_report == 'equipment' || type_report == 'firstoffense' ){
		phase = $("#Report_phase_equip").val();
	}else{
		phase = $("#Report_phase_checklist").val();
	}

	var start_auditreport = $("#start_auditreport_checklist").val();
	var end_auditreport = $("#end_auditreport_checklist").val();

	if(start_auditreport == ""){
		alert("Enter Start Date");
	}
	else if(end_auditreport == ""){
		alert("Enter End Date");
	}else{
	$.ajax({
		url: 'Report/bridge.php',
		type: 'POST',
		data: {
			type: type_report,
			area: area,
			phase: phase,
			type_report: type_report,
			start_auditreport: start_auditreport,
			end_auditreport: end_auditreport
		},
		beforeSend: function(){
			$("#dashboardtable_min").hide();
			$('#loaderfilter').html('<img src="icons/loaderr.gif" style="opacity:.8" width=200 height=200 alt="Hello Image" />');
		},
		complete: function(){
			$("#dashboardtable_min").show();
			$("#loaderfilter").hide();
		},
		success: function (response) {
			$("#dashboardtable_max").html(response);
			$("#dashboardtable_min").html(response);
			$("#dashboardtable_max").hide();
			$("#dashboardtable_min").show();
		}
	});
	}
}


function filterReports_phase() {
	var filtered = "dashboard";
	var building = $("#building_viewscores").val();
	var phase = $("#phase").val();
	var start_auditreport= $("#start_auditreport").val();
	var end_auditreport= $("#end_auditreport").val();

	if(start_auditreport == ""){
		alert("Enter Start Date");
	}
	else if(end_auditreport == ""){
		alert("Enter End Date");
	}else{
		$.ajax({
			url: 'Report/bridge.php',
			type: 'POST',
			data: {
				type: filtered,
				building: building,
				phase: phase,
				start_auditreport: start_auditreport,
				end_auditreport: end_auditreport
			},
		beforeSend: function(){
			$("#dashboardtable_min").hide();
			$('#loaderfilter').html('<img src="icons/loaderr.gif" style="opacity:.8" width=200 height=200 alt="Hello Image" />');
		},
		complete: function(){
			$("#dashboardtable_min").show();
			$("#loaderfilter").hide();
		},
			success: function (response) {
				// alert(response);
				// alert(building);
				// alert(phase);
				// alert(area);
				$("#dashboardtable_max").html(response);
				$("#dashboardtable_min").html(response);
				$("#dashboardtable_max").hide();
				$("#dashboardtable_min").show();
			}
		});
	}

	
}
$("#managepoints").draggable({
	handle: ".modal-dialog"
});

function tagImage(imagename){
	$("#tagImageValue").val(imagename);
	document.getElementById("imgClickAndChange").src = "uploaded/"+imagename;
}

function loadTagImage(rid,pid,date) {
	var all = "TagImage";
	if(date == undefined){
		var newdate = $("#Date").val()
	}else{
		var newdate = date
	}
	$.ajax({
		url: 'Report/bridge.php',
		type: 'POST',
		data: {
			type: all,
			rid: rid,
			date: newdate,
			pid:pid
		},
		// beforeSend: function(){
		// 	$("#showTagImages").hide();
		// 	$('#loadertd').html('<img src="icons/loaderr.gif" style="opacity:.8" width=200 height=200 alt="Hello Image" />');
		// },
		// complete: function(){
		// 	$("#showTagImages").show();
		// 	$("#loadertd").hide();
		// },
		success: function (response) {
			// alert(response);
			$("#showTagImages_"+rid).html(response);
		}
	});
}

function AddtagImage(type,recordId,pid){
	var imagename = $("#tagImageValue").val();
	if(imagename == "sample.png"){
	alert("No Image Selected")
	}
	else{
		var tagImageDate = $("#tagImageDate").val();
		var type='Non Compliance';
		$.ajax({
			url: 'Report/addTagImage.php',
			type: 'POST',
			data: {
				recordId: recordId,
				imagename: imagename,
				pid: pid,
				type: type,
				tagImageDate: tagImageDate
			},
			success: function (response) {
				alert('Added Succesfully')
				$("#showTagImages_"+recordId).html(response);
			}
		});
	}

}

function tagImageCorrection(imagename){
	$("#tagImageValueCorrection").val(imagename);
	document.getElementById("imgClickAndChangeCorrection").src = "uploaded/"+imagename;
}

function loadTagImageCorrection(crid,rid,date) {
	var all = "TagImageCorrection";
	if(date == undefined){
		var newdate = $("#Date").val()
	}else{
		var newdate = date
	}
	$.ajax({
		url: 'Report/bridge.php',
		type: 'POST',
		data: {
			type: all,
			rid: rid,
			date: newdate,
			crid:crid
		},
		// beforeSend: function(){
		// 	$("#showTagImages").hide();
		// 	$('#loadertd').html('<img src="icons/loaderr.gif" style="opacity:.8" width=200 height=200 alt="Hello Image" />');
		// },
		// complete: function(){
		// 	$("#showTagImages").show();
		// 	$("#loadertd").hide();
		// },
		success: function (response) {
			// alert(response);
			$("#showTagImages_"+crid).html(response);
		}
	});
}

function AddtagImageCorrection(CorrectionrecordId,recordId,correctionDate){
	var imagename = $("#tagImageValueCorrection").val();
	if(imagename == "sample.png"){
	alert("No Image Selected")
	}
	else{
		var tagImageDate = $("#tagImageDateCorrection").val();
		var type='Non Compliance';
		$.ajax({
			url: 'Report/addTagImageCorrection.php',
			type: 'POST',
			data: {
				CorrectionrecordId: CorrectionrecordId,
				recordId: recordId,
				imagename: imagename,
				correctionDate: tagImageDate
			},
			success: function (response) {
				alert('Added Succesfully')
				$("#showTagImages_"+CorrectionrecordId).html(response);
			}
		});
	}

}

(function($) {
	var pagify = {
		items: {},
		container: null,
		totalPages: 1,
		perPage: 3,
		currentPage: 0,
		createNavigation: function() {
			this.totalPages = Math.ceil(this.items.length / this.perPage);

			$('.pagination', this.container.parent()).remove();
			var pagination = $('<div class="pagination"></div>').append('');

			for (var i = 0; i < this.totalPages; i++) {
				var pageElClass = "page";
				if (!i)
					pageElClass = "page current";
				var pageEl = '<a style="background-color:#ada9a9;margin:5px;width:50px;padding:5px;color:#dfdfdf;text-decoration:none;cursor:pointer;border-radius:10px;" class="' + pageElClass + '" data-page="' + (
				i + 1) + '">' + (
				i + 1) + "</a>";
				pagination.append(pageEl);
			}
			pagination.append('');

			this.container.after(pagination);

			var that = this;
			$("body").off("click", ".nav");
			this.navigator = $("body").on("click", ".nav", function() {
				var el = $(this);
				that.navigate(el.data("next"));
			});

			$("body").off("click", ".page");
			this.pageNavigator = $("body").on("click", ".page", function() {
				var el = $(this);
				that.goToPage(el.data("page"));
			});
		},
		navigate: function(next) {
			// default perPage to 5
			if (isNaN(next) || next === undefined) {
				next = true;
			}
			$(".pagination .nav").removeClass("disabled");
			if (next) {
				this.currentPage++;
				if (this.currentPage > (this.totalPages - 1))
					this.currentPage = (this.totalPages - 1);
				if (this.currentPage == (this.totalPages - 1))
					$(".pagination .nav.next").addClass("disabled");
				}
			else {
				this.currentPage--;
				if (this.currentPage < 0)
					this.currentPage = 0;
				if (this.currentPage == 0)
					$(".pagination .nav.prev").addClass("disabled");
				}

			this.showItems();
		},
		updateNavigation: function() {

			var pages = $(".pagination .page");
			pages.removeClass("current");
			$('.pagination .page[data-page="' + (
			this.currentPage + 1) + '"]').addClass("current");
		},
		goToPage: function(page) {

			this.currentPage = page - 1;

			$(".pagination .nav").removeClass("disabled");
			if (this.currentPage == (this.totalPages - 1))
				$(".pagination .nav.next").addClass("disabled");

			if (this.currentPage == 0)
				$(".pagination .nav.prev").addClass("disabled");
			this.showItems();
		},
		showItems: function() {
			this.items.hide();
			var base = this.perPage * this.currentPage;
			this.items.slice(base, base + this.perPage).show();

			this.updateNavigation();
		},
		init: function(container, items, perPage) {
			this.container = container;
			this.currentPage = 0;
			this.totalPages = 1;
			this.perPage = perPage;
			this.items = items;
			this.createNavigation();
			this.showItems();
		}
	};

	// stuff it all into a jQuery method!
	$.fn.pagify = function(perPage, itemSelector) {
		var el = $(this);
		var items = $(itemSelector, el);

		// default perPage to 5
		if (isNaN(perPage) || perPage === undefined) {
			perPage = 3;
		}

		// don't fire if fewer items than perPage
		if (items.length <= perPage) {
			return true;
		}

		pagify.init(el, items, perPage);
	};
})(jQuery);



function loadDataReport() {
	var all = "report";
	var qa = $('#QA').val();
	// alert(qa)
	$.ajax({
		url: 'Report/bridge.php',
		type: 'POST',
		data: {
			type: all,
			qa:qa
		},
		beforeSend: function(){
			$("#container").hide();
			$('#loader').html('<img src="icons/loaderr.gif" style="opacity:.8" width=200 height=200 alt="Hello Image" />');
		},
		complete: function(){
			$("#container").show();
			$("#loader").hide();
		},
		success: function (response) {
			// alert(response);
			$("#container").html(response);
		}
	});
}


function loadDataReport_Manager() {
	var all = "reportManager";
	$.ajax({
		url: 'Report/bridge.php',
		type: 'POST',
		data: {
			type: all
		},
		beforeSend: function(){
			$("#container_manager").hide();
			$('#loader').html('<img src="icons/loaderr.gif" style="opacity:.8" width=200 height=200 alt="Hello Image" />');
		},
		complete: function(){
			$("#container_manager").show();
			$("#loader").hide();
		},
		success: function (response) {
			// alert(response);
			$("#container_manager").html(response);
		}
	});
}
function filteredloadData_visor(pos) {
	var filtered = "filtered_visor";
	var building = $("#Building").val();
	var phase = $("#Phase").val();
	var area = $("#Area").val();


	if (pos == "QA Staff" || pos == "ADMIN") {
		var date = $("#Date").val();
	} else if (pos == "QA Supervisor") {
		var date = $("#Date_visor").val();
	} else {

	}
	$.ajax({
		url: 'Report/bridge.php',
		type: 'POST',
		data: {
			type: filtered,
			building: building,
			phase: phase,
			area: area,
			date: date
		},
		beforeSend: function(){
			$("#showdata").hide();
			$('#loader').html('<img src="icons/loaderr.gif" style="opacity:.8" width=200 height=200 alt="Hello Image" />');
		},
		complete: function(){
			$("#showdata").show();
			$("#loader").hide();
		},
		success: function (response) {
			// alert(response);
			$("#historytable_visor").html(response);
		}
	});
}

function showNonComplianceImages(){
	$("#viewAllImages").click();
	$("#modal_managepoints").click();
	
}

function correctionModal() {

	$("#btnAdd").click(); //click and modal decline confirmation 

	// $("#goodpointsmodal").hide()
	$("#correctionmodal").show()
}


function closecompliancecorrection() {
	var complianceconcern = $("#complianceconcern").val()
	var complianceid = $("#complianceid").val()
	var Date = $("#Date").val()

	loadDataComplianceremarks(complianceid,Date, complianceconcern);
	$("#compliance").show()
	$("#addRemarks").hide()
}


function addRemarks(rid,date,compliance) {
	
	
	$("#complianceconcern").val(compliance);
	$("#complianceid").val(rid); //click and modal decline confirmation 
	$("#btnAdd").click(); //click and modal decline confirmation 

	// $("#goodpointsmodal").hide()
	$("#addRemarks").show();
	$("#compliance").hide();
	loadDataComplianceremarks(rid,date,compliance);
	
}

function correctionMode(type, rid, date, main, specific, corrective) {
	$('#GBPointsCorrection').val(main);
	$('#SpecificCorrection').val(specific);
	$('#RidCorrection').val(rid);
	loadDataCorrectionReport(rid)
	loadDataCorrectionReport_image(rid)
	$('#FidImageCorrection').val(rid);
	$("#goodpointsmodal").hide();
	$("#correctionmodal").show();
}

function compliancemode(){
	var fid = $("#FidCorrective").val();
	$('#goodpointsmodal').hide();
	$('#btnUpdateCompliance').hide();
	$('#btnCancelCompliance').hide();
	$('#compliance').show();

	loadDataCompliance(fid);
}

function noncompliancemode(){
	$('#goodpointsmodal').show();
	$('#compliance').hide();

}

function correctiveMode(type, rid, date, main, specific, corrective) {
	$("#goodpointsmodal").show();
	$("#correctionmodal").hide();
}

function addImg_managepoints(type, rid, date) {

	// nagkamali ako dapat hindi FID - findings ng remarks ako magbabase pag nagsasave 
	//ng picture dapat sa RID o doonsa mismong Good or Bad Points o loob ng remarks
	$('#FidImage').val(rid);
	$('#FidImage2').val(rid);
	showImage(rid, date);

	$("#addImgmodal").show();
	$("#typeimg").val(type);
	$("#correctionmodal").hide();
	$("#goodpointsmodal").hide();

}

function addImg_managepoints_correction(rid, correction, date) {

	$("#CridImage").val(rid);
	$("#CorrectionDetails").val(correction);
	$("#correctionmodalwrap").hide();
	$("#correctionimage").show();
	showCorrectionImage(rid, date);


}

function closemodalCorrective(){

	$("#addImgmodal").hide();
	$("#correctionmodal").hide();
	$("#goodpointsmodal").show();
	
	$("#addRemarks").hide();
	$('#compliance').hide();
}

function closemodalCorrection() {

	$("#correctionmodalwrap").show();
	$("#correctionimage").hide();
	
	$('#compliance').hide();
}
function closemodalCompliance() {

	$("#compliance").show();
	$("#addRemarks").hide();
	
}


function managepoints() {

	$("#btnAddRecord").click();
}

function viewmanagepoints(pid, fid, date, PName) {
	$('#PidCorrective').val(pid);
	$('#FidCorrective').val(fid);

	$('#PidCorrection').val(pid);
	$('#FidCorrection').val(fid);

	$('#Pidnoncompliance').val(pid);
	$('#Fidnoncompliance').val(fid);

	$('#Pidcompliance').val(pid);
	$('#Fidcompliance').val(fid);

	$('#Pidcomplianceremarks').val(pid);
	$('#Fidcomplianceremarks').val(fid);

	$('#PidImage').val(pid);
	// $('#FidImage').val(fid);
	// $('#FidImage2').val(fid);


	$('#PidImage2').val(pid);
	$('#DateImage').val(date);
	$('#DateImage2').val(date);
	$('#PName').val(PName);

	loadDataRemarksReport(fid);
	loadDataCompliance(fid);
	// loadTagImage(pid);
	$("#modal_managepoints").click();
}


$("#formManagePoints").on('submit', (function (e) {
	e.preventDefault();
	$.ajax({
		url: 'Report/addRemarks.php',
		type: "POST",
		data: new FormData(this),
		contentType: false,
		processData: false,
		success: function (response) {
			if (response == " Select Phase ") {
				alert("Select Phase");
			} else if (response == " Enter Header ") {
				alert("Enter Header");
			} else if (response == " Select Week ") {
				alert("Select Week");
			} else {
				loadDataReport();
				alert(response);
				// $("#modal_managepoints").click();
			}

		}
	});

}));

function AddCorrective() {
	$('#AddCorrective').click();
}
$("#formManagePointsCorrective").on('submit', (function (e) {
	e.preventDefault();
	var fid=$('#FidCorrective').val();
	$.ajax({
		url: 'Report/addCorrective.php',
		type: "POST",
		data: new FormData(this),
		contentType: false,
		processData: false,
		success: function (response) {
			if (response == " Enter Remarks ") {
				alert("Enter Remarks");
			} else {
				// loadDataReport();
				loadDataRemarksReport(fid);
				// $('#closemodal').click();

				alert(response);
				// $("#modal_managepoints").click();
			}

		}
	});

}));

$("#formManagePointsCompliance").on('submit', (function (e) {
	e.preventDefault();
	
	var complianceid=$('#complianceid').val();
	
	var Datec=$('#Date').val();
	var compliancefid=$('#compliance').val();
	var fid=$('#Fidcompliance').val();
	$.ajax({
		url: 'Report/addCompliance.php',
		type: "POST",
		data: new FormData(this),
		contentType: false,
		processData: false,
		success: function (response) {
			if (response == " Enter Remarks ") {
				alert("Enter Remarks");
			} else {
				// loadDataReport();
				// $('#closemodal').click();
				loadDataCompliance(fid);
				loadDataComplianceremarks(complianceid,Datec,compliancefid);

				alert(response);
				// $("#modal_managepoints").click();
			}

		}
	});

}));

$("#formManagePointsComplianceRemarks").on('submit', (function (e) {
	e.preventDefault();
	
	var complianceid=$('#complianceid').val();
	var Datec=$('#Date').val();
	var compliancefid=$('#compliance').val();
	alert(compliancefid);
	$.ajax({
		url: 'Report/addComplianceRemarks.php',
		type: "POST",
		data: new FormData(this),
		contentType: false,
		processData: false,
		success: function (response) {
			if (response == " Enter Remarks ") {
				alert("Enter Remarks");
			} else {
				// loadDataReport();
				// $('#closemodal').click();
				loadDataComplianceremarks(complianceid,Datec,compliancefid);

				alert(response);
				// $("#modal_managepoints").click();
			}

		}
	});

}));


function AddCorrection() {
	$('#AddCorrection').click();

}
$("#formManagePointsCorrection").on('submit', (function (e) {
	e.preventDefault();
	var rid=$("#RidCorrection").val();
	$.ajax({
		url: 'Report/addCorrection.php',
		type: "POST",
		data: new FormData(this),
		contentType: false,
		processData: false,
		success: function (response) {
			if (response == " Enter Remarks ") {
				alert("Enter Remarks");
			} else {
				loadDataCorrectionReport(rid);

				// $('#closemodal').click();
				// alert(response);
				// $("#modal_managepoints").click();
			}

		}
	});

}));



function showImage(fid, date) {
	var typeImg = $('#type').val();
	
	$.ajax({
		url: 'Report/showImagePoints.php',
		type: "POST",
		data: {
			fid: fid,
			date: date,
			typeImg: typeImg
		},
		success: function (response) {
			$("#imageresult").html(response);

		}
	});


}

function showCorrectionImage(rid, date) {
	// alert(rid);
	$.ajax({
		url: 'Report/showImageCorrection.php',
		type: "POST",
		data: {
			rid: rid,
			date: date,
		},
		success: function (response) {

			// alert("Succesfully Uploaded");
			// $("#arid").val(Aid);
			// $("#user").html(response);
			// $("#imageresult").html(response);
			$("#imageresultcorrection").html(response);

		}
	});


}


function showRecordRemarks(fid, date) {
	var typeImg = $('#type').val();
	// alert(fid);
	$.ajax({
		url: 'Report/showImagePoints.php',
		type: "POST",
		data: {
			fid: fid,
			date: date,
			typeImg: typeImg
		},
		success: function (response) {
			$("#remarksresult").html(response);

		}
	});


}


function DeleteImagePoints(fid) {


	alert("Deleted Succesfully");
	$.ajax({
		url: 'Report/deleteImg_process_points.php',
		type: "POST",
		data: {
			fid: fid
		},
		success: function (response) {
			// alert(response);
			// alert("Succesfully Uploaded");
			// $("#arid").val(Aid);
			// $("#user").html(response);
			$("#imageresult").html(response);

		}
	});
}

function DeleteImageCorrection(Crid) {


	alert("Deleted Succesfully");
	$.ajax({
		url: 'Report/deleteImg_process_correction.php',
		type: "POST",
		data: {
			Crid: Crid
		},
		success: function (response) {
			// alert(response);
			// alert("Succesfully Uploaded");
			// $("#arid").val(Aid);
			// $("#user").html(response);
			$("#imageresult").html(response);

		}
	});
}


// Checklist submit grade
$("#formImagePoints").on('submit', (function (e) {
	e.preventDefault();

	$.ajax({
		url: 'Report/addMoreImgPoints.php',
		type: "POST",
		data: new FormData(this),
		contentType: false,
		processData: false,
		success: function (response) {
			// alert(response);
			// alert("Succesfully Uploaded");
			// $("#arid").val(Aid);
			// $("#user").html(response);
			$("#imageresult").html(response);

		}
	});
}));


// Checklist submit grade
$("#formImageCorrection").on('submit', (function (e) {
	e.preventDefault();

	$.ajax({
		url: 'Report/addMoreImgCorrection.php',
		type: "POST",
		data: new FormData(this),
		contentType: false,
		processData: false,
		success: function (response) {
			// alert(response);
			alert("Succesfully Uploaded");
			// $("#arid").val(Aid);
			// $("#user").html(response);
			$("#imageresultcorrection").html(response);

		}
	});
}));


$(document).on('click', '.bn-delete', function () {
	if (confirm("Are you sure want to delete the record?")) {
		var id = this.id;
		// alert(id);
		$.ajax({
			url: 'Report/bridge.php',
			type: 'POST',
			data: {
				"id": id,
				"type": "delete"
			},
			success: function (response) {
				loadDataReport();
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

$(document).on('click', '.bn-deleteremarks', function () {
	if (confirm("Are you sure want to delete the record?")) {
		var id = this.id;
		var fid=$('#FidCorrective').val();
		$.ajax({
			url: 'Report/bridge.php',
			type: 'POST',
			data: {
				"id": id,
				"type": "deleteremarks"
			},
			success: function (response) {
				loadDataRemarksReport(fid);
				loadDataCompliance(fid);
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


$(document).on('click', '.bn-deletecomplianceremarks', function () {
	if (confirm("Are you sure want to delete the record?")) {
		var id = this.id;
		var complianceid=$('#complianceid').val();
		var Datec=$('#Date').val();
		var compliancefid=$('#compliance').val();
		// alert(fid);
		$.ajax({
			url: 'Report/bridge.php',
			type: 'POST',
			data: {
				"id": id,
				"type": "deletecomplianceremarks"
			},
			success: function (response) {
	
				

				loadDataComplianceremarks(complianceid,Datec,compliancefid);
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

// createRecord start

$(document).on('click', '.bn-edit', function () {
	var id = this.id;
	$('#Points').hide();
	$('#btnUpdate').show();
	$('#btnCancel').show();

	$.ajax({
		url: 'Report/bridge.php',
		type: 'POST',
		dataType: 'JSON',
		data: {
			"id": id,
			"type": "single"
		},
		success: function (response) {

			console.log(response);
			$('#Fid').val(response.Fid);
			$('#BuildingRecord').val(response.Bid);
			$('#phase').val(response.Pid);
			$('#Title').val(response.Title);
			$('#Week').val(response.Week);
			$('#monthYr').val(response.Month);

		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		}
	});
});


// createRecord start

$(document).on('click', '.bn-editremarks', function () {
	var id = this.id;
	
	$('#btnAddRemarks').hide();
	$('#btnUpdateRemarks').show();
	$('#btnCancelRemarks').show();

	$.ajax({
		url: 'Report/bridge.php',
		type: 'POST',
		dataType: 'JSON',
		data: {
			"id": id,
			"type": "singleremarks"
		},
		success: function (response) {
			
			console.log(response);
			$('#RidCorrective').val(response.Rid);
			$('#FidCorrective').val(response.Fid);
			$('#PidCorrective').val(response.Pid);
			$('#GBPoints').val(response.GBPoints);
			$('#Specific').val(response.Specific);
			$('#Corrective').val(response.Corrective);
			$('#recommendation').val(response.recommendation);

		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		}
	});
});


// createRecord start

$(document).on('click', '.bn-editcorrection', function () {
	var id = this.id;
	$('#btnAddCorrection').hide();
	$('#btnUpdateCorrection').show();
	$('#btnCancelCorrection').show();

	$.ajax({
		url: 'Report/bridge.php',
		type: 'POST',
		dataType: 'JSON',
		data: {
			"id": id,
			"type": "singleCorrection"
		},
		success: function (response) {
			// alert(response);
			// console.log(response);
			$('#CridCorrection').val(response.Crid);
			$('#Correction').val(response.CorrectionDetails);

		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		}
	});
});

$("#btnCancelRemarks").click(function () {
	$("#btnAddRemarks").show();
	$("#btnUpdateRemarks").hide();
	$("#btnCancelRemarks").hide();
	$("#GBPoints").val('');
	$("#Specific").val('');
	$("#Corrective").val('');
});

$("#btnUpdateRemarks").click(function () {
	$("#btnAddRemarks").show();
	var fid=$('#FidCorrective').val();
	$("#btnUpdateRemarks").hide();
	$("#btnCancelRemarks").hide();
	$.ajax({
		
		url: 'Report/updateRemarks.php',
		type: 'POST',
		data: $("#formManagePointsCorrective").serialize(),
		success: function (response) {
			alert('Succefully Updated,Kindly Refresh the Correction Table by clicking close and opening Manage Good or Bad Points Button Again');
			loadDataRemarksReport(fid);

			$("#GBPoints").val('');
			$("#Specific").val('');
			$("#Corrective").val('');
			$("#recommendation").val('');
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		}
	});
});


$("#btnCancel").click(function () {
	$("#Points").show();
	$("#btnUpdate").hide();
	$("#btnCancel").hide();
	$("#formManagePoints input").val('');
	$("#formManagePoints select").val('');
});

$("#btnUpdate").click(function () {
	$("#Points").show();
	$("#btnUpdate").hide();
	$("#btnCancel").hide();
	$.ajax({
		url: 'Report/updateReport.php',
		type: 'POST',
		data: $("#formManagePoints").serialize(),
		success: function (response) {
			alert('Succefully Updated');
			loadDataReport();

			$("#formManagePoints input").val('');
			$("#formManagePoints select").val('');
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		}
	});
});


$("#btnCancelCorrection").click(function () {
	$("#btnAddCorrection").show();
	$("#btnUpdateCorrection").hide();
	$("#btnCancelCorrection").hide();
	$("#Correction").val('');
});

$("#btnUpdateCorrection").click(function () {
	$("#btnAddCorrection").show();
	$("#btnUpdateCorrection").hide();
	$("#btnCancelCorrection").hide();
	var rid=$("#RidCorrection").val();
	
	$.ajax({
		url: 'Report/updateCorrection.php',
		type: 'POST',
		data: $("#formManagePointsCorrection").serialize(),
		success: function (response) {
			alert('Succefully Updated');
			loadDataCorrectionReport(rid);

			$("#GBPointsCorrection").val('');
			$("#SpecificCorrection").val('');
			$("#Correction").val('');
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		}
	});
});


$(document).on('click', '.bn-deletecorrection', function () {
	if (confirm("Are you sure want to delete the record?")) {
		var id = this.id;
		var rid=$("#RidCorrection").val();

		$.ajax({
			url: 'Report/bridge.php',
			type: 'POST',
			data: {
				"id": id,
				"type": "deletecorrection"
			},
			success: function (response) {
				loadDataCorrectionReport(rid);
				$("#Correction").val('');
			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
				alert(thrownError);
			}
		});
	}
});

function viewreport(pid, fid, date, title) {
	async:true;
	window.location.assign('view_Report.php?id=' + fid + '&title=' + title);

}

function switchtomodalviewhistorygrade_image(cid, cname, datechecked) {
	$('#areaname_image').val(cname);
	$('#areaid_image').val(cid);
	$('#modalviewhistorygrade').hide();
	$('#modalviewhistorygrade_image').show();
	$('#modalviewhistorygrade_image_equipment').hide();

	loadcheckgradetable_image(cid, cname, datechecked);
}


function switchtomodalviewhistorygrade_image_equipment(eid, ename, datechecked) {
	// alert(eid);
	// alert(ename);
	// alert(datechecked);
	$('#equipmentname_image').val(ename);
	$('#equipment_id').val(eid);
	$('#modalviewhistorygrade').hide();
	$('#modalviewhistorygrade_image').hide();
	$('#modalviewhistorygrade_image_equipment').show();

	loadcheckgradetable_image_equipment(eid, ename, datechecked);
}

function switchtomodalviewhistorygrade() {
	$('#modalviewhistorygrade').show();
	$('#modalviewhistorygrade_image').hide();
	$('#modalviewhistorygrade_image_equipment').hide();

}


// onchange dropdowns
function dropdownBuilding(){
    
var category = "dropdownBuilding";
$.ajax({
type: "POST",
url: "Report/Option.php",
data: {
	category: category
},
success: function (data) {
	$("#dropdownBuilding").val(data);


}
});
}

// end onchange dropdown