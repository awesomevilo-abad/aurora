$(document).ready(function () {
	// loadData();
	loadCheck();
	loadCheckvisor();
	// loadResult();
	loadCat();
	loadCat_visor();
	loadphase();
	// loadCheckFilter();
	$("#btnSubmit").hide();
	$("#showtime").hide();
	$("#btnAdd").hide();
	$("#autoBack").hide();
	$("#updateSkipAreaButton").hide();
	$("#buttonCompleteDeclineModalConfirmation").hide();
});



function loadData() {
	var all = "all";
	var cat = $("#cat").val();
	var pageType = $("#pageType").val();
	$.ajax({
		url: 'startChecklist/bridge.php',
		type: 'POST',
		data: {
			id: cat,
			type: all,
			pageType: pageType
		},
		beforeSend: function () {
			$("#container").hide();
			$('#loader').html('<img src="icons/loaderr.gif" style="opacity:.8" width=200 height=200 alt="Hello Image" />');
		},
		complete: function () {
			$("#container").show();
			$("#loader").hide();
		},
		success: function (response) {
			$("#choose").html(response);
		}
	});
}


function loadCat() {
	var all = "cat";
	var cat = $("#cat").val();
	var pageType = $("#pageType").val();
	$.ajax({
		url: 'startChecklist/bridge.php',
		type: 'POST',
		data: {
			id: cat,
			type: all,
			pageType: pageType
		},
		beforeSend: function () {
			$("#container").hide();
			$('#loader').html('<img src="icons/loaderr.gif" style="opacity:.8" width=200 height=200 alt="Hello Image" />');
		},
		complete: function () {
			$("#container").show();
			$("#loader").hide();
		},
		success: function (response) {
			$("#choose").html(response);
		}
	});
}

function loadCat_visor() {
	var all = "cat_visor";
	var cat = $("#cat").val();
	var pageType = $("#pageType").val();

	$.ajax({
		url: 'startChecklist/bridge.php',
		type: 'POST',
		data: {
			id: cat,
			type: all,
			pageType: pageType
		},
		beforeSend: function () {
			$("#container").hide();
			$('#loader').html('<img src="icons/loaderr.gif" style="opacity:.8" width=200 height=200 alt="Hello Image" />');
		},
		complete: function () {
			$("#container").show();
			$("#loader").hide();
		},
		success: function (response) {
			$("#choose_visor").html(response);
		}
	});
}

function loadphase() {
	var phase = "phase";
	var bid = $("#bid").val();
	var pageType = $("#pageType").val();
	$.ajax({
		url: 'startChecklist/bridge.php',
		type: 'POST',
		data: {
			id2: bid,
			type: phase,
			pageType: pageType
		},
		beforeSend: function () {
			$("#container").hide();
			$('#loader').html('<img src="icons/loaderr.gif" style="opacity:.8" width=200 height=200 alt="Hello Image" />');
		},
		complete: function () {
			$("#container").show();
			$("#loader").hide();
		},
		success: function (response) {
			// console.log(cat);
			$("#choose2").html(response);
		}
	});
}

function submitChecklist() {

	alert('click');

}

function loadCheck() {

	var checklist = "checklist";
	var aid = $("#checklistaid").val()
	var id = $("#checklistid").val(); //kinuha ang checklist id galing sa main php
	var pageType = $("#pageType").val(); //kinuha ang checklist id galing sa main php
	var week = $("#week").val(); //kinuha ang checklist id galing sa main php
	var month = $("#month").val(); //kinuha ang checklist id galing sa main php
	var year = $("#year").val(); //kinuha ang checklist id galing sa main php
	var areaselected = $("#areaselected").val(); //kinuha ang checklist id galing sa main php
	var from = $("#from").val(); //kinuha ang checklist id galing sa main php
	var to = $("#to").val(); //kinuha ang checklist id galing sa main php
	$.ajax({
		url: 'startChecklist/bridge.php',
		type: 'POST',
		data: {
			id: id,
			type: checklist,
			pageType: pageType,
			aid: aid,
			month: month,
			year: year,
			week: week,
			areaselected: areaselected,
			from: from,
			to: to
		},
		beforeSend: function () {
			$("#checklist").hide();
			$('#loader').html('<img src="icons/loaderr.gif" style="opacity:.8" width=200 height=200 alt="Hello Image" />');
		},
		complete: function () {
			$("#checklist").show();
			$("#loader").hide();
		},
		success: function (response) {

			$("#checklist").html(response);
		}
	});
}

function loadCheckvisor() {
	var checklist = "checklistvisor";
	var aid = $("#checklistaid").val()
	var id = $("#checklistidvisor").val(); //kinuha ang checklist id galing sa main php
	var AcName = $("#AcName").val(); //kinuha ang checklist id galing sa main php
	$.ajax({
		url: 'startChecklist/bridge.php',
		type: 'POST',
		data: {
			id: id,
			type: checklist,
			aid: aid,
			AcName: AcName
		},
		success: function (response) {
			$("#checklistvisor").html(response);
		}
	});
}


function loadResult() {
	var result = "result";
	var id = $("#resultid").val(); //kinuha ang checklist id galing sa main php
	$.ajax({
		url: 'startChecklist/bridge.php',
		type: 'POST',
		data: {
			id: id,
			type: result
		},
		success: function (response) {
			$("#result").html(response);
		}
	});
}


function loadResult2() {
	var result = "result2";
	var id = $("#resultid").val(); //kinuha ang checklist id galing sa main php
	$.ajax({
		url: 'startChecklist/bridge.php',
		type: 'POST',
		data: {
			id: id,
			type: result
		},
		success: function (response) {
			$("#result").html(response);
		}
	});
}



function ConfirmationModal(id, pageType, from, to) {
	$("#divyear").hide();
	$("#confirmModal").click();

	$("#passID").val(id);
	$("#pageType").val(pageType);
	$("#from").val(from);
	$("#to").val(to);



}

function changeMonth_showYearIfDecember5thWeek(month) {

	var week = $('#week').val();

	// && $("#week").val()=='4' || $("#week").val()=='5'
	if (($("#week").val() == '1' && month == 'January') || ($("#week").val() == '5' && month == 'December') || ($("#week").val() == '4' && month == 'December')) {
		$("#divyear").show();
	} else {
		$("#divyear").hide();
	}

}

function changeWeek_showYearIfDecember5thWeek(week) {
	// alert(week)
	var month = $('#month').val();
	// alert(month)
	// && $("#week").val()=='4' || $("#week").val()=='5'
	if (($("#week").val() == '1' && month == 'January') || ($("#week").val() == '5' && month == 'December') || ($("#week").val() == '4' && month == 'December')) {
		$("#divyear").show();
	} else {
		$("#divyear").hide();
	}

}


function completed(id) {

	$("#completed").click();
	$("#passID").val(id);


}




// SAVING STAFF AND AREA
$("#completeform").on('submit', (function (e) {
	e.preventDefault();
	$.ajax({
		url: "Area/assignAreaStaff.php",
		type: "POST",
		data: new FormData(this),
		contentType: false,
		processData: false,
		success: function (data) {
			// alert('Succefully Added');
			$("#closemodal").click();
			alert('added');


		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		}
	});
}));

function completeModal(pid, bldgcat, bldgid, date, mdate, qastaff, totalsani, totalstru, totalequip) {

	var targetgradestatus_sani = $("#targetgradestatus_sani").val();
	var targetgradestatus_str = $("#targetgradestatus_str").val();
	var targetgradestatus_equip = $("#targetgradestatus_equip").val();

	// alert(targetgradestatus_sani);

	$.ajax({
		url: 'startChecklist/modal_content_submitphase.php',
		type: 'POST',
		data: {
			pid: pid,
			date: date,
			mdate: mdate
		},
		success: function (response) {
			// alert(response);
			$("#completeModal").click();
			$("#phaseid").val(pid);
			$("#phaseid_showtime").val(pid);
			$("#phaseid_showtime_autoshow").val(pid);
			$("#bldgcat").val(bldgcat);
			$("#bldgid").val(bldgid);
			$("#datechecked").val(date);
			$("#datereset").val(mdate);
			$("#totalsani").val(totalsani);
			$("#totalstru").val(totalstru);
			$("#totalequip").val(totalequip);
			$("#targetgradestatus_sani").val(targetgradestatus_sani);
			$("#targetgradestatus_equip").val(targetgradestatus_equip);
			$("#targetgradestatus_str").val(targetgradestatus_str);
			$("#qastaff").val(qastaff)
			$("#qastaff_showtime").val(qastaff);
			$("#qastaff_showtime_autoshow").val(qastaff);
			$("#user").html(response);

			$("#tandem_phaseid").val(pid);
			$("#phaseid_showtime_autoshow").val(pid);
			$("#tandem_bldgcat").val(bldgcat);
			$("#tandem_bldgid").val(bldgid);
			$("#tandem_datechecked").val(date);
			$("#tandem_datereset").val(mdate);
			$("#tandem_totalsani").val(totalsani);
			$("#tandem_totalstru").val(totalstru);
			$("#tandem_totalequip").val(totalequip);
			$("#tandem_targetgradestatus_sani").val(targetgradestatus_sani);
			$("#tandem_targetgradestatus_equip").val(targetgradestatus_equip);
			$("#tandem_targetgradestatus_str").val(targetgradestatus_str);
			$("#tandem_qastaff").val(qastaff)
			$("#tandem_user").html(response);
			$("#tandem_user2").html(response);

		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		}
	});


}

function SubmitSkippedArea() {
	alert("Skipped");
	$("#btnAddSkippedArea").click();
}


// submit form phase decline
$("#formSkipAreaResult").on('submit', (function (e) {
	var phaseid = $("#pid").val();
	e.preventDefault();
	$.ajax({
		url: "startChecklist/submitSkippedAreaGrade.php",
		type: "POST",
		data: new FormData(this),
		contentType: false,
		processData: false,
		success: function (data) {
			alert(data);
			window.location.assign('MainChecklist.php?id=' + phaseid);
		}
	});
}));

function completeDeclineModal(pid, bldgid, bldgcat, date, mdate, qastaff, totalsani, totalstru, totalequip) {
	$.ajax({
		url: 'startChecklist/modal_content_submitphase.php',
		type: 'POST',
		data: {
			pid: pid,
			date: date,
			mdate: mdate
		},
		success: function (response) {
			// alert(response);
			$("#completeDeclineModal").click();
			$("#phaseid").val(pid);
			$("#bldgcat").val(bldgcat);
			$("#bldgid").val(bldgid);
			$("#datechecked").val(date);
			$("#datereset").val(mdate);
			$("#totalsani").val(totalsani);
			$("#totalstru").val(totalstru);
			$("#totalequip").val(totalequip);
			$("#qastaff").val(qastaff);
			$("#user").html(response);

		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		}
	});


}

function submitformdeclineConfirmation() {

	$("#btnAdd").click(); //click and modal decline confirmation 

	$("#modalSectionOne").hide()
	$("#modalSectionTwo").show()
}



// submit form phase decline
$("#formResults").on('submit', (function (e) {
	var phaseid = $("#pid").val();
	e.preventDefault();
	$.ajax({
		url: "startChecklist/submitDeclineGrade.php",
		type: "POST",
		data: new FormData(this),
		contentType: false,
		processData: false,
		success: function (data) {

		}
	});
}));

function submitformdeclineCancel() {


	$("#modalSectionOne").show()
	$("#modalSectionTwo").hide()
}

// submit form validation per area

function submitformdecline() {

	var user = $("#user").val();
	var password = $("#password").val();
	var phaseid = $("#phaseid").val();
	var bldgcat = $("#bldgcat").val();
	var bldgid = $("#bldgid").val();
	var totalsani = $("#totalsani").val();
	var totalstru = $("#totalstru").val();
	var totalequip = $("#totalequip").val();
	var datechecked = $("#datechecked").val();
	var datereset = $("#datereset").val();
	var qastaff = $("#qastaff").val();
	var reason = $("#reason").val();
	var week = $("#week").val();
	var month = $("#month").val();
	var year = $("#year").val();

	$.ajax({
		url: 'startChecklist/modal_process.php',
		type: 'POST',
		data: {
			user: user,
			pass: password,
			phseid: phaseid,
			bldgid: bldgid,
			datechecked: datechecked,
			qastaff: qastaff,
			totalsani: totalsani,
			totalstru: totalstru,
			totalequip: totalequip,
			reason: reason,
			month: month,
			year: year,
			week: week
		},
		success: function (responseform2) {

			// alert(responseform2);

			if (responseform2.trim() == "Verified") {

				window.location.assign("userStartChecklist.php?id=" + bldgcat + "&page=Audit");
				// completebuildingModal(phaseid,bldgcat,bldgid);
				// $("#btnAdd").click();
				alert('Account Verified');

			} else if (responseform2.trim() == "Incorrect Password") {
				alert('Incorrect Password');
			} else {
				alert("There Somethings wrong!");

			}

		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		}
	});
}



function completeDeclineModalConfirmation(pid, bldgid, bldgcat, date, mdate, qastaff, totalsani, totalstru, totalequip) {
	$.ajax({
		url: 'startChecklist/modal_content_submitphase.php',
		type: 'POST',
		data: {
			pid: pid,
			date: date,
			mdate: mdate
		},
		success: function (response) {
			// alert(response);
			$("#completeModalConfirmation").click();
			$("#phaseid").val(pid);
			$("#bldgcat").val(bldgcat);
			$("#bldgid").val(bldgid);
			$("#datechecked").val(date);
			$("#datereset").val(mdate);
			$("#totalsani").val(totalsani);
			$("#totalstru").val(totalstru);
			$("#totalequip").val(totalequip);
			$("#qastaff").val(qastaff);
			$("#user").html(response);

		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		}
	});


}

$("#saveImage").on('submit', (function (e) {

	e.preventDefault();
	alert('save');
}));



function completephaseModal(aid, pid) {
	$.ajax({
		url: 'startChecklist/modal_content_submitphase.php',
		type: 'POST',
		data: {
			id: aid,
			pid: pid
		},
		success: function (response) {
			// alert(response);	
			$("#completeModal").click();
			$("#phaseid").val(pid);
			$("#user").html(response);
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		}
	});


}

function skipAreaButton(Aid) {
	$("#skipModal").click();
	$("#AreaId").val(Aid);
	// alert(Aid);
}

function updateSkipArea() {
	alert('updated');
	// alert(Aid);
}

// submit form validation per area

function submitform() {
	var user = $("#user").val();
	var password = $("#password").val();
	var phaseid = $("#phaseid").val();
	var bldgcat = $("#bldgcat").val();
	var bldgid = $("#bldgid").val();
	var totalsani = $("#totalsani").val();
	var totalstru = $("#totalstru").val();
	var totalequip = $("#totalequip").val();
	var targetgradestatus_sani = $("#targetgradestatus_sani").val();
	var targetgradestatus_str = $("#targetgradestatus_str").val();
	var targetgradestatus_equip = $("#targetgradestatus_equip").val();
	var datechecked = $("#datechecked").val();
	var datereset = $("#datereset").val();
	var qastaff = $("#qastaff").val();
	var week = $("#week").val();
	var month = $("#month").val();
	var year = $("#year").val();

	// alert(phaseid);
	// alert(bldgid);
	// alert(totalsani);
	// alert(totalstru);
	// alert(totalequip);
	// alert(targetgradestatus_sani);
	// alert(targetgradestatus_str);
	// alert(targetgradestatus_equip);
	// alert(datechecked);
	// alert(qastaff);
	$.ajax({
		url: 'startChecklist/modal_process.php',
		type: 'POST',
		data: {
			user: user,
			pass: password,
			phseid: phaseid,
			datechecked: datechecked,
			qastaff: qastaff,
			bldgid: bldgid,
			totalsani: totalsani,
			totalstru: totalstru,
			totalequip: totalequip,
			targetgradestatus_sani: targetgradestatus_sani,
			targetgradestatus_str: targetgradestatus_str,
			week: week,
			month: month,
			year: year,
			targetgradestatus_equip: targetgradestatus_equip
		},
		beforeSend: function () {
			$('#loader').html('<img src="icons/loaderr.gif" style="opacity:.8" width=200 height=200 alt="Hello Image" />');
		},
		complete: function () {
			$("#loader").hide();
		},
		success: function (responseform) {
			alert(responseform);

			if (responseform.trim() == "Verified") {
				$("#showconfirmation").hide();
				$("#tandem_showconfirmation").hide();
				$(".tabs").hide();
				$("#showtime").show();
				$("#nextphaseclick").click();
				$("#nextphaseclick").hide();
				// window.location.assign("userStartChecklist.php?id=" + bldgcat);
			} else if (responseform.trim() == "Incorrect Password") {
				alert('Incorrect Password');
			} else {
				alert("There Somethings wrong!");

			}

		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		}
	});
}


function tandem_submitform() {
	var user = $("#tandem_user").val();
	var password = $("#tandem_password").val();
	var user2 = $("#tandem_user2").val();
	var password2 = $("#tandem_password2").val();
	var phaseid = $("#tandem_phaseid").val();
	var bldgcat = $("#tandem_bldgcat").val();
	var bldgid = $("#tandem_bldgid").val();
	var totalsani = $("#tandem_totalsani").val();
	var totalstru = $("#tandem_totalstru").val();
	var totalequip = $("#tandem_totalequip").val();
	var targetgradestatus_sani = $("#tandem_targetgradestatus_sani").val();
	var targetgradestatus_str = $("#tandem_targetgradestatus_str").val();
	var targetgradestatus_equip = $("#tandem_targetgradestatus_equip").val();
	var datechecked = $("#tandem_datechecked").val();
	var datereset = $("#tandem_datereset").val();
	var qastaff = $("#tandem_qastaff").val();
	var week = $("#week").val();
	var month = $("#month").val();
	var year = $("#year").val();

	if (password2 != "" && password != "") {

		$.ajax({
			url: 'startChecklist/modal_process_tandem.php',
			type: 'POST',
			data: {
				user: user,
				pass: password,
				user2: user2,
				pass2: password2,
				phseid: phaseid,
				datechecked: datechecked,
				qastaff: qastaff,
				bldgid: bldgid,
				totalsani: totalsani,
				totalstru: totalstru,
				totalequip: totalequip,
				targetgradestatus_sani: targetgradestatus_sani,
				targetgradestatus_str: targetgradestatus_str,
				week: week,
				month: month,
				year: year,
				targetgradestatus_equip: targetgradestatus_equip
			},
			beforeSend: function () {
				$('#loader').html('<img src="icons/loaderr.gif" style="opacity:.8" width=200 height=200 alt="Hello Image" />');
			},
			complete: function () {
				$("#loader").hide();
			},
			success: function (responseform) {
				alert(responseform);

				if (responseform.trim() == "Verified") {
					$("#showconfirmation").hide();
					$("#tandem_showconfirmation").hide();
					$(".tabs").hide();
					$("#showtime").show();
					$("#nextphaseclick").click();
					$("#nextphaseclick").hide();
					// window.location.assign("userStartChecklist.php?id=" + bldgcat);
				} else if (responseform.trim() == "Incorrect Password") {
					alert('Incorrect Password');
				} else {
					alert("There Somethings wrong!");

				}

			},
			error: function (xhr, ajaxOptions, thrownError) {
				alert(xhr.status);
				alert(thrownError);
			}
		});
	} else {
		alert("Please Enter Password");
	}

}

function nextphase() {
	var phaseid_showtime = $("#phaseid_showtime").val();

	$.ajax({
		url: 'startChecklist/showtime.php',
		type: 'POST',
		data: {
			pid: phaseid_showtime
		},
		success: function (response) {
			$("#showtimediff").val(response);
			// alert(response);

		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		}
	});




	// window.location.assign("userStartChecklist.php?id=" + bldgcat);
}

function addPhaseTime() {
	var phaseid = $("#phaseid_showtime").val();
	var qastafftime = $("#showtimediff").val();
	var datetoday = $("#datechecked").val();
	var qastaff = $("#qastaff_showtime").val();

	$.ajax({
		url: 'startChecklist/addtime.php',
		type: 'POST',
		data: {
			pid: phaseid,
			qastaff: qastaff,
			qastafftime: qastafftime,
			datetoday: datetoday
		},
		success: function (response) {
			// alert(response);
			window.location.assign("userStartChecklistCat.php");

		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		}
	});
}





// Checklist submit grade
$("#formGrade").on('submit', (function (e) {
	var phaseid = $("#pid").val();
	var week = $("#week").val();
	var month = $("#month").val();
	var year = $("#year").val();
	var pageType = $("#pageType").val();
	var from = $("#from").val();
	var to = $("#to").val();
	e.preventDefault();
	$.ajax({
		url: "startChecklist/submitCheckGrade.php",
		type: "POST",
		data: new FormData(this),
		contentType: false,
		processData: false,
		beforeSend: function () {
			$("#container").hide();
			$('#loader').html('<img src="icons/loaderr.gif" style="opacity:.8" width=200 height=200 alt="Hello Image" />');
			$("#btnNextArea").hide();
		},
		complete: function () {
			$("#container").show();
			$("#loader").hide();
			$("#btnNextArea").hide();
		},
		success: function (data) {
			alert(data)
			$("#btnNextArea").hide();
			if (data == "Next Area") {
				$("#btnNextArea").hide();
				window.location.assign('MainChecklist.php?id=' + phaseid + "&pageType=" + pageType + "&week=" + week + "&month=" + month + "&year=" + year + "&from=" + from + "&to=" + to);
			} else if (data == "Next Phase") {
				$("#btnNextArea").hide();
				window.location.assign('viewing_gradephase.php?id=' + phaseid + "&pageType=" + pageType + "&week=" + week + "&month=" + month + "&year=" + year);
			} else {
				alert('Something Error');
			}

		}
	});
}));


// Checklist submit grade
$("#formGrade_visor").on('submit', (function (e) {
	var phaseid = $("#pid").val();
	e.preventDefault();
	$.ajax({
		url: "startChecklist/submitCheckGrade_visor.php",
		type: "POST",
		data: new FormData(this),
		contentType: false,
		processData: false,
		success: function (data) {
			alert(data);
			if (data == "Next Area") {
				window.location.assign('MainChecklist.php?id=' + phaseid);
			} else if (data == "Next Phase") {
				window.location.assign("userStartChecklistCat.php");
			} else {
				alert('Something Error');
			}

		}
	});
}));


// submit form phase decline
$("#formResults").on('submit', (function (e) {
	var phaseid = $("#pid").val();
	e.preventDefault();
	$.ajax({
		url: "startChecklist/submitDeclineGrade.php",
		type: "POST",
		data: new FormData(this),
		contentType: false,
		processData: false,
		success: function (data) {
			alert(data);

		}
	});
}));

function validateUserModal(id) {
	$("#confirmModal").click();
	$("#passID").val(id);


}


function getID(position, id) {
	if ($("#week").val() == " ") {
		$("week").focus();
		$('#week').css({
			'border': '2px solid #d2322d'
		});

		alert("Please Choose Week and check month, year ");
	} else {
		if ($("#week").val() == undefined) {
			var getId = $("#passID").val();
			var pageType = $("#pageType").val();
			var from = $("#from").val();
			var to = $("#to").val();
			$.ajax({
				url: "startChecklist/choosePersonel.php",
				type: "POST",
				data: {
					position: position,
					pid: getId
				},
				success: function (data) {
					if (data == "QA Staff" || data == "QA Supervisor" && pageType == "Audit") {
						location.href = "MainChecklist.php?id=" + getId + "&pageType=" + pageType + "&week=" + week + "&month=" + month + "&year=" + year + "&from=" + from + "&to=" + to;

					} else if (data == "QA Staff" || data == "QA Supervisor" && pageType == "Spot Audit") {
						location.href = "MainChecklistVisor.php?id=" + getId + "&pageType=" + pageType;

					} else {
						alert("Go To Main Menu Again");

					}
				}
			});
		} else {
			if (confirm("Do you want to Continue? Week " + $("#week").val() + " is selected, " + $("#month").val() + " is selected and " + $("#year").val() + " is selected")) {


				var getId = $("#passID").val();
				var pageType = $("#pageType").val();
				var week = $("#week").val();
				var month = $("#month").val();
				var year = $("#year").val();
				var from = $("#from").val();
				var to = $("#to").val();


				$.ajax({
					url: "startChecklist/choosePersonel.php",
					type: "POST",
					data: {
						position: position,
						pid: getId
					},
					success: function (data) {
						if (data == "QA Staff" || data == "QA Supervisor" && pageType == "Audit") {
							location.href = "MainChecklist.php?id=" + getId + "&pageType=" + pageType + "&week=" + week + "&month=" + month + "&year=" + year + "&from=" + from + "&to=" + to;

						} else if (data == "QA Staff" || data == "QA Supervisor" && pageType == "Spot Audit") {
							location.href = "MainChecklistVisor.php?id=" + getId + "&pageType=" + pageType;

						} else {
							alert("Error Wrong Position");

						}
					}
				});
			}
		}

	}

}

function goToSkipArea(Aid, Pid) {
	// alert(Aid);
	// alert(Pid);
	location.href = "MainChecklist.php?id=" + Pid + "&" + "aid=" + Aid;

}

function gotovam() {
	location.href = "startChecklist.php?id=VAM";

}

function gotofresh() {
	location.href = "startChecklist.php?id=FRESH";

}

function usergotovam(page) {
	location.href = "userStartChecklist.php?id=VAM&page=" + page;

}


function usergotovehicles(page) {
	location.href = "userStartChecklist.php?id=VEHICLES&page=" + page;

}

function usergotofresh(page) {
	location.href = "userStartChecklist.php?id=FRESH&page=" + page;

}


function usergotofresh_visor(page) {
	location.href = "userStartChecklist_visor.php?id=FRESH&page=" + page;

}

function usergotovam_visor(page) {
	location.href = "userStartChecklist_visor.php?id=VAM&page=" + page;

}

function usergotovehicles_visor(page) {
	location.href = "userStartChecklist_visor.php?id=VEHICLES&page=" + page;

}

function gotovehicles() {
	location.href = "userStartChecklist.php?id=VEHICLES";

}

function declinephase() {
	if ($("#week").val() == " ") {
		$("week").focus();
		$('#week').css({
			'border': '2px solid #d2322d'
		});
		alert("Please Choose Week and check month, year ");
	} else {

		if (confirm("Do you want to Continue? Week " + $("#week").val() + " is selected, " + $("#month").val() + " is selected and " + $("#year").val() + " is selected")) {


			var month = $("#month").val();
			var year = $("#year").val();
			var week = $("#week").val();
			var phaseID = $("#passID").val();
			location.href = "PhaseResult.php?Pid=" + phaseID + "&week=" + week + "&month=" + month + "&year=" + year;
		}
	}

}

function skipAreaModalButton() {
	var AreaId = $("#AreaId").val();
	location.href = "SkipAreaResult.php?Aid=" + AreaId;

}

function viewPhase(id) {

	error: function (xhr, ajaxOptions, thrownError) {
		alert(xhr.status);
		alert(thrownError);
	}
});


$.ajax({
	url: 'startChecklist/choosePhase.php',
	type: 'POST',
	data: {
		id2: id,
		pageType: pageType
	},
	beforeSend: function () {
		$("#container").hide();
		$('#loader').html('<img src="icons/loaderr.gif" style="opacity:.8" width=200 height=200 alt="Hello Image" />');
	},
	complete: function () {
		$("#container").show();
		$("#loader").hide();
	},
	success: function (response) {
		$("#choose").html(response);


	},
	error: function (xhr, ajaxOptions, thrownError) {
		alert(xhr.status);
		alert(thrownError);
	}
});

}

function viewPhase_visor(id, pageType) {
	$.ajax({
		url: 'startChecklist/choosePhase_visor.php',
		type: 'POST',
		data: {
			id2: id,
			pageType: pageType
		},
		beforeSend: function () {
			$("#container").hide();
			$('#loader').html('<img src="icons/loaderr.gif" style="opacity:.8" width=200 height=200 alt="Hello Image" />');
		},
		complete: function () {
			$("#container").show();
			$("#loader").hide();
		},
		success: function (response) {
			$("#choose_visor").html(response);
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		}
	});

}

function completebuildingModal(category, bid, pageType) {
	var cat = category;
	var id = bid;
	$.ajax({
		url: 'startChecklist/choosePhase.php',
		type: 'POST',
		data: {
			id2: id
		},
		success: function (response) {
			// alert(response);
			// alert(id);
			// $("#arid").val(Aid);
			// $("#user").html(response);
			window.location.assign('choosephaseaftersubmit.php?id=' + bid + '&pageType=' + pageType);
			$("#choose2").html(response);
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		}
	});



}

function completebuildingModal_visor(category, bid, pageType) {
	var cat = category;
	var id = bid;
	$.ajax({
		url: 'startChecklist/choosePhase_visor.php',
		type: 'POST',
		data: {
			id2: id
		},
		success: function (response) {
			// alert(response);
			// alert(id);
			// $("#arid").val(Aid);
			// $("#user").html(response);
			window.location.assign('userStartChecklistCat_Visor.php');
			$("#choose_visor").html(response);
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		}
	});



}

function BacktoBuild(id) {
	$.ajax({
		url: 'startChecklist/chooseBuilding.php',
		type: 'POST',
		beforeSend: function () {
			$("#container").hide();
			$('#loader').html('<img src="icons/loaderr.gif" style="opacity:.8" width=200 height=200 alt="Hello Image" />');
		},
		complete: function () {
			$("#container").show();
			$("#loader").hide();
		},
		success: function (response) {
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

function BacktoPhase() {

	location.href = "userStartChecklistCat.php"


}

function BacktoPhaseVisor() {


	var pid = $("#pid").val();
	var qastaff = $("#qastaff").val();

	$.ajax({
		url: 'startChecklist/addtimedatephase_visor.php',
		type: 'POST',
		data: {
			pid: pid,
			qastaff: qastaff
		},
		success: function (response) {
			alert('Succesfully Save, you may now go to Pre-Audit History to view your Record');
			location.href = "userStartChecklistCat.php"
			alert(response)
		},
		error: function (xhr, ajaxOptions, thrownError) {
			alert(xhr.status);
			alert(thrownError);
		}
	});

}

function addmoreImg($cname, $cid, $aid, $date) {

	$('#ChecklistName').val($cname);
	$('#ChecklistId').val($cid);
	$('#Aid').val($aid);
	$('#Date').val($date);
	$("#addmoreImgButton").click();
	showImage($cid, $date);

}

function addmoreImgEquip($ename, $eid, $aid, $date) {

	$('#Ename').val($ename);
	$('#Eid').val($eid);
	$('#Aideq').val($aid);
	$('#Dateeq').val($date);
	$("#addmoreImgButtonEquip").click();
	showImageEquip($eid, $date);

}


function addmoreImgVisor($aid, $date, $aname, $pid, $bid) {
	// alert($pid);
	$('#AName').val($aname);
	$('#Aid').val($aid);
	$('#Date').val($date);
	$('#pidimg').val($pid);
	$('#bidimg').val($bid);
	$("#addmoreImgButtonvisor").click();
	showImageVisor($aid, $date);
}


function addmoreImgVisor_noncompliance($aid, $date, $aname, $pid, $bid) {
	// alert($pid);
	$('#AName2').val($aname);
	$('#Aid2').val($aid);
	$('#Date2').val($date);
	$('#pidimg2').val($pid);
	$('#bidimg2').val($bid);
	$("#addmoreImgButtonvisor_noncompliance").click();
	showImageVisor_noncompliance($aid, $date);
}


// Checklist submit grade
$("#formImage").on('submit', (function (e) {
	e.preventDefault();

	$.ajax({
		url: 'startChecklist/addmoreImg_process.php',
		type: "POST",
		data: new FormData(this),
		contentType: false,
		processData: false,
		success: function (response) {

			alert('Successfully Uploaded');
			// alert(response);
			// alert("Succesfully Uploaded");
			// $("#arid").val(Aid);
			// $("#user").html(response);
			$("#imageresult").html(response);

		}
	});
}));


// Checklist submit grade
$("#formImageEquip").on('submit', (function (e) {
	e.preventDefault();

	$.ajax({
		url: 'startChecklist/addmoreImg_process_equip.php',
		type: "POST",
		data: new FormData(this),
		contentType: false,
		processData: false,
		success: function (response) {

			alert('Successfully Uploaded');
			// alert(response);
			// alert("Succesfully Uploaded");
			// $("#arid").val(Aid);
			// $("#user").html(response);
			$("#imageresult").html(response);

		}
	});
}));

// Checklist submit grade
$("#formImage_visor_compliance").on('submit', (function (e) {
	e.preventDefault();

	$.ajax({
		url: 'startChecklist/addmoreImg_process_visor.php',
		type: "POST",
		data: new FormData(this),
		contentType: false,
		processData: false,
		success: function (response) {
			alert('Successfully Uploaded');
			// alert(response);
			// $("#arid").val(Aid);
			// $("#user").html(response);
			$("#imageresult").html(response);

		}
	});
}));


// Checklist submit grade
$("#formImage_visor_noncompliance").on('submit', (function (e) {
	e.preventDefault();

	$.ajax({
		url: 'startChecklist/addmoreImg_process_visor_noncompliance.php',
		type: "POST",
		data: new FormData(this),
		contentType: false,
		processData: false,
		success: function (response) {
			alert('Successfully Uploaded');
			// alert(response);
			// alert("Succesfully Uploaded");
			// $("#arid").val(Aid);
			// $("#user").html(response);
			$("#imageresult").html(response);

		}
	});
}));


// Checklist submit grade
$("#formImage_visor").on('submit', (function (e) {
	e.preventDefault();
	alert('Succesfully Added');

}));

function DeleteImage(cid) {


	// alert($imagename);
	$.ajax({
		url: 'startChecklist/deleteImg_process.php',
		type: "POST",
		data: {
			cid: cid
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


function DeleteImage_equip(eid) {


	alert("Deleted Succesfully");
	$.ajax({
		url: 'startChecklist/deleteImg_process_equip.php',
		type: "POST",
		data: {
			eid: eid
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

function DeleteImage_visor(aid) {


	// alert($imagename);
	$.ajax({
		url: 'startChecklist/deleteImg_process_visor.php',
		type: "POST",
		data: {
			aid: aid
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

function showImage(cid, date) {

	// alert(cid);
	$.ajax({
		url: 'startChecklist/showImg_process.php',
		type: "POST",
		data: {
			cid: cid,
			date: date
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

function showImageEquip(eid, date) {

	// alert(cid);
	$.ajax({
		url: 'startChecklist/showImg_process_equip.php',
		type: "POST",
		data: {
			eid: eid,
			date: date
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


function showImageVisor(aid, date) {

	// alert(cid);
	$.ajax({
		url: 'startChecklist/showImg_process_visor.php',
		type: "POST",
		data: {
			aid: aid,
			date: date
		},
		success: function (response) {
			// alert(date);
			// alert("Succesfully Uploaded");
			// $("#arid").val(Aid);
			// $("#user").html(response);
			$("#imageresult").html(response);

		}
	});


}

function showImageVisor_noncompliance(aid, date) {

	// alert(cid);
	$.ajax({
		url: 'startChecklist/showImg_process_visor_noncompliance.php',
		type: "POST",
		data: {
			aid: aid,
			date: date
		},
		success: function (response) {
			// alert(date);
			// alert("Succesfully Uploaded");
			// $("#arid").val(Aid);
			// $("#user").html(response);
			$("#imageresult").html(response);

		}
	});


	;

}