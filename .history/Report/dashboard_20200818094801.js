$(document).ready(function () {
    getYear();
    getYearQA();
    getYearQAStaff();
    getYearProtechStaff();
    // loadbuildinggradesanitationmonthly($('#selectYear').val());
    loadbuildinggradestructuralmonthly($('#selectYear').val());
    loadbuildinggradeequipmentmonthly($('#selectYear').val());
    // loadprotechmonitoringStructural();  
    loadbuildinggradeequipmentmonitoring();
    loadphaseddeclinedmonitoring();
    // loadprotechmonitoring();
    loadqamonitoring('1201', $('#monthqa').val(), $('#selectYear').val());
    if ($('#QAStaff').val() == undefined) {
        loadqamonitoringperformance(" Melissa Angela Bulos", $('#selectYear').val());
    } else {
        loadqamonitoringperformance($('#QAStaff').val(), $('#selectYear').val());
    }

    // loadqamonitoringperformance($('#QAStaff').val(),$('#selectYear').val());
    loadprotechmonitoringperformance('Sanitation', $('#monthprotech').val(), $('#selectYearProtech').val());
    $('#s2id_month').hide();
    $('#s2id_monthstr').hide();
    $('#s2id_montheq').hide();



});

function getYear() {
    var min = new Date().getFullYear(),
        max = min + 9,
        select = document.getElementById('selectYear');

    for (var i = min; i <= max; i++) {
        var opt = document.createElement('option');
        opt.value = i;
        opt.innerHTML = i;
        select.appendChild(opt);
    }
}

function getYearQA() {
    var min = new Date().getFullYear(),
        max = min + 9,
        select = document.getElementById('selectYearQA');

    for (var i = min; i <= max; i++) {
        var opt = document.createElement('option');
        opt.value = i;
        opt.innerHTML = i;
        select.appendChild(opt);
    }
}

function getYearQAStaff() {
    var min = new Date().getFullYear(),
        max = min + 9,
        select = document.getElementById('selectYearQAStaff');

    for (var i = min; i <= max; i++) {
        var opt = document.createElement('option');
        opt.value = i;
        opt.innerHTML = i;
        select.appendChild(opt);
    }
}

function getYearProtechStaff() {
    var min = new Date().getFullYear(),
        max = min + 9,
        select = document.getElementById('selectYearProtech');

    for (var i = min; i <= max; i++) {
        var opt = document.createElement('option');
        opt.value = i;
        opt.innerHTML = i;
        select.appendChild(opt);
    }
}

function changeYear(val) {
    loadbuildinggradesanitationmonthly(val);
    loadbuildinggradestructuralmonthly(val);
    loadbuildinggradeequipmentmonthly(val);
}

function changeBuilding(val) {
    alert(val);
}


// Production Sanitation
function loadbuildinggradesanitationmonthly(val) {

    $.ajax({
        url: 'Report/dashboard_data_buildingsanitationmonthly.php',
        type: 'POST',
        dataType: "json",
        data: {
            year: val
        },
        success: function (response) {
            var sanitationbuilding = response['data'];

            SanitationBuildingmonthly(sanitationbuilding, val);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
};

function SanitationBuildingmonthly(sanitationbuilding, year) {

    // Create the chart
    Highcharts.chart('container2', {
        chart: {
            type: 'area'

        },
        title: {
            text: 'Depot Sanitation Monthly Grade (Production)'
        },
        subtitle: {
            text: 'Production ' + year
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {

            buttons: {
                BackButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#fec539',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Production',
                    onclick: function () {
                        loadbuildinggradesanitationmonthly(year)
                    }
                },
                FrontButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#0088cc69',
                        r: 10,
                        states: {
                            hover: {
                                fill: '#7cb5ec'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#0088cc69'
                            }
                        }
                    },
                    text: 'Warehouse',
                    onclick: function () {
                        loadbuildinggradesanitationmonthlyWarehouse(year)
                    }
                },
                SideButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#358835b5',
                        r: 10,
                        states: {
                            hover: {
                                fill: '#35883582'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#358835b5'
                            }
                        }
                    },
                    text: 'All',
                    onclick: function () {
                        loadbuildinggradesanitationmonthlyAll(year)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var month = event.point.name
                        loadbuildinggradesanitationmonthlytoweekly(month, year)
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            },
            area: {
                stacking: 'normal',
                lineColor: '#666666',
                lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Depot Monthly Sanitation Grades (Production)",
            colorByPoint: false,
            fill: '#666666',
            data: sanitationbuilding
        }]
    });
};

function loadbuildinggradesanitationmonthlytoweekly(month, year) {

    $.ajax({
        url: 'Report/dashboard_data_buildingsanitationmonthlyweekly.php',
        type: 'POST',
        dataType: "json",
        data: {
            year: year,
            month: month
        },
        success: function (response) {
            var sanitationbuilding = response['data'];

            SanitationBuildingmonthlytoweekly(sanitationbuilding, year, month);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
};

function SanitationBuildingmonthlytoweekly(sanitationbuilding, year, month) {

    // Create the chart
    Highcharts.chart('container2', {
        chart: {
            type: 'column'

        },
        title: {
            text: 'Depot Sanitation Weekly Grade (Production)'
        },
        subtitle: {
            text: 'Production ' + year
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Monthly Grade (Production)',
                    onclick: function () {
                        loadbuildinggradesanitationmonthly(year)
                        $('#s2id_month').hide()
                    }
                },
                BuildingButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#f26e27',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Building',
                    onclick: function () {
                        loadbuildinggradesanitationBuilding(month, year)
                    }
                },
                WeekButton: {
                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#d53d2a',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Week',
                    onclick: function () {
                        loadbuildinggradesanitationmonthlytoweekly(month, year)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingWeek = event.point.name
                        week = buildingWeek.substring(5, 6);
                        loadbuildinggradesanitation(month, year, week)
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            },
            area: {
                stacking: 'normal',
                lineColor: '#666666',
                lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Depot Monthly Sanitation Grades (Production)",
            colorByPoint: false,
            fill: '#666666',
            data: sanitationbuilding
        }]
    });
};

function loadbuildinggradesanitationBuilding(month, year) {


    $.ajax({
        url: 'Report/dashboard_data_buildingsanitationBuilding.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            year: year
        },
        success: function (response) {
            var sanitationbuilding = response['data'];

            SanitationBuildingBuilding(sanitationbuilding, month, year);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
};

function SanitationBuildingBuilding(sanitationbuilding, month, year) {
    // alert("sanitationbuildingbuilding")
    // Create the chart
    Highcharts.chart('container2', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Depot Sanitation Weekly Grade (Production)'
        },
        subtitle: {
            text: 'Production ' + year
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Monthly Grade (Production)',
                    onclick: function () {
                        loadbuildinggradesanitationmonthly(year)
                        $('#s2id_month').hide()
                    }
                },
                BuildingButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#f26e27',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Building',
                    onclick: function () {
                        loadbuildinggradesanitationBuilding(month, year)
                    }
                },
                WeekButton: {
                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#d53d2a',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Week',
                    onclick: function () {
                        loadbuildinggradesanitationmonthlytoweekly(month, year)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingName = event.point.name
                        var week = $('#sanitationbuildingweektextbox').val('0');
                        $('#sanitationbuildingtextbox').val(buildingName);
                        loadbuildinggradesanitationweekly(month, year, buildingName)
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Production Grades",
            colorByPoint: true,
            data: sanitationbuilding
        }]
    });
};


function loadbuildinggradesanitationweekly(month, year, buildingName) {
    $.ajax({
        url: 'Report/dashboard_data_buildingsanitation_weekly.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            building: buildingName,
            year: year
        },
        success: function (response) {
            var sanitationbuildingweekly = response['data'];
            SanitationBuildingWeekly(sanitationbuildingweekly, month, year, buildingName);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function SanitationBuildingWeekly(sanitationbuildingweekly, month, year, buildingname) {

    Highcharts.chart('container2', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month
        },
        subtitle: {
            text: 'Production > ' + month + ' ' + year + ' > ' + buildingname
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Building Grade',
                    onclick: function () {
                        loadbuildinggradesanitationBuilding(month, year)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingWeek = event.point.name
                        week = buildingWeek.substring(5, 6);
                        buildingName = $('#sanitationbuildingtextbox').val();
                        $('#sanitationbuildingweektextbox').val(week);
                        loadbuildinggradesanitationweekly_phase(month, year, buildingName, week)

                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Weekly Grades",
            colorByPoint: true,
            data: sanitationbuildingweekly
        }]
    });
};

function loadbuildinggradesanitation(month, year, week) {


    $.ajax({
        url: 'Report/dashboard_data_buildingsanitation.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            week: week,
            year: year
        },
        success: function (response) {
            var sanitationbuilding = response['data'];

            SanitationBuilding(sanitationbuilding, month, year, week);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
};

function SanitationBuilding(sanitationbuilding, month, year, week) {

    // Create the chart
    Highcharts.chart('container2', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month + ' ' + year
        },
        subtitle: {
            text: 'Production > ' + month + ' ' + year + ' > Week: ' + week
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Weekly Depot Sanitation Grade (Production)',
                    onclick: function () {
                        loadbuildinggradesanitationmonthlytoweekly(month, year)
                        $('#s2id_month').hide()
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingName = event.point.name
                        loadbuildinggradesanitationweekly_phase(month, year, buildingName, week)
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Production Grades",
            colorByPoint: true,
            data: sanitationbuilding
        }]
    });
};

function loadbuildinggradesanitationweekly_phase(month, year, buildingName, week) {


    $.ajax({
        url: 'Report/dashboard_data_buildingsanitation_weekly_phase.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            year: year,
            building: buildingName,
            week: week
        },
        success: function (response) {
            var sanitationbuildingweekly = response['data'];
            SanitationBuildingWeekly_phase(sanitationbuildingweekly, month, year, buildingName, week);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function SanitationBuildingWeekly_phase(sanitationbuildingweekly, month, year, buildingName, week) {

    Highcharts.chart('container2', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month
        },
        subtitle: {
            text: 'Production > ' + month + ' ' + year + ' > ' + buildingName + ' > ' + 'Week ' + week
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Weekly Building Grade',
                    onclick: function () {
                        loadbuildinggradesanitation(month, year, week)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var phase = event.point.name
                        loadbuildinggradesanitationweekly_area(month, year, buildingName, week, phase)

                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Weekly Grades",
            colorByPoint: true,
            data: sanitationbuildingweekly
        }]
    });
};

function loadbuildinggradesanitationweekly_area(month, year, buildingName, week, phase) {

    $.ajax({
        url: 'Report/dashboard_data_buildingsanitation_weekly_area.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            year: year,
            building: buildingName,
            week: week,
            phase: phase
        },
        success: function (response) {
            var sanitationbuildingweekly = response['data'];
            var sanitationbuildingweeklyareaWeight = response['dataWeight'];
            SanitationBuildingWeekly_area(sanitationbuildingweekly, month, year, sanitationbuildingweeklyareaWeight, buildingName, phase);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function SanitationBuildingWeekly_area(sanitationbuildingweekly, month, year, sanitationbuildingweeklyareaWeight, buildingName, phase) {

    Highcharts.chart('container2', {
        chart: {
            type: 'areaspline'
        },
        title: {
            text: 'Month of ' + month + ' Week ' + week
        },
        subtitle: {
            text: 'Production > ' + month + ' ' + year + ' > ' + buildingName + ' > ' + 'Week ' + week + ' > ' + phase
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Weekly Phase Grade',
                    onclick: function () {
                        loadbuildinggradesanitationweekly_phase(month, year, buildingName, week)
                    }
                }
            }
        },
        legend: {
            enabled: true,
            y: -40,
            bubbleLegend: {
                enabled: true,
                borderWidth: 2,
                ranges: [{
                    borderColor: '#1aadce',
                    connectorColor: '#1aadce'
                }, {
                    borderColor: '#0d233a',
                    connectorColor: '#0d233a'
                }, {
                    borderColor: '#f28f43',
                    connectorColor: '#f28f43'
                }]
            }
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingWeek = event.point.name
                        area = buildingWeek;
                        loadbuildinggradesanitationweekly_checklist(month, year, buildingName, week, area, phase)

                        // $('#SaniAreaGrade').hide()
                        // $('#SaniChecklistGrade').show()
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/> <span style="color:{point.color}"><b>QA Staff:</b>{point.QA}</span><br/> <span style="color:{point.color}"><b>Protech:</b>{point.Protech}</span>',
        },


        series: [{
                name: "Weekly Area Grades",
                colorByPoint: false,
                data: sanitationbuildingweekly
            },
            {
                name: "Area Distribution",
                type: 'spline',
                colorByPoint: false,
                data: sanitationbuildingweeklyareaWeight,
                tooltip: {
                    valueSuffix: '%'
                }
            }
        ]
    });
};

function loadbuildinggradesanitationweekly_checklist(month, year, buildingName, week, area, phase) {

    $.ajax({
        url: 'Report/dashboard_data_buildingsanitation_weekly_checklist.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            year: year,
            building: buildingName,
            week: week,
            phase: phase,
            area: area
        },
        success: function (response) {
            var sanitationbuildingweekly = response['data'];
            SanitationBuildingWeekly_checklist(sanitationbuildingweekly, month, year, buildingName, week, area, phase);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function SanitationBuildingWeekly_checklist(sanitationbuildingweekly, month, year, buildingname, week, area, phase) {

    Highcharts.chart('container2', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month + ' Week ' + week
        },
        subtitle: {
            text: 'Production > ' + month + ' ' + year + ' > ' + buildingname + ' > ' + 'Week ' + week + ' > ' + phase + ' > ' + area
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Weekly Area Grade',
                    onclick: function () {
                        loadbuildinggradesanitationweekly_area(month, year, buildingname, week, phase, area)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/> <span style="color:{point.color}"><b>QA Staff:</b>{point.QA}</span><br/> <span style="color:{point.color}"><b>Protech:</b>{point.Protech}</span>',
        },


        series: [{
            name: "Weekly Checklist Grade",
            colorByPoint: false,
            data: sanitationbuildingweekly
        }]
    });
};



// Warehouse Sanitation
function loadbuildinggradesanitationmonthlyWarehouse(year) {


    $.ajax({
        url: 'Report/dashboard_data_buildingsanitationmonthlyWarehouse.php',
        type: 'POST',
        dataType: "json",
        data: {
            year: year
        },
        success: function (response) {
            var sanitationbuilding = response['data'];

            SanitationBuildingmonthlyWarehouse(sanitationbuilding, year);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function SanitationBuildingmonthlyWarehouse(sanitationbuilding, year) {

    // Create the chart
    Highcharts.chart('container2', {
        chart: {
            type: 'area'
        },
        title: {
            text: 'Depot Sanitation Monthly Grade (Warehouse)'
        },
        subtitle: {
            text: 'Warehouse ' + year
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {

            buttons: {
                BackButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Production',
                    onclick: function () {
                        loadbuildinggradesanitationmonthly(year)
                    }
                },
                FrontButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#0088cc69',
                        r: 10,
                        fill: '#0088cc69',
                        states: {
                            hover: {
                                fill: '#7cb5ec'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#0088cc69'
                            }
                        }
                    },
                    text: 'Warehouse',
                    onclick: function () {
                        loadbuildinggradesanitationmonthlyWarehouse(year)
                    }
                },
                SideButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#358835b5',
                        r: 10,
                        states: {
                            hover: {
                                fill: '#35883582'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#358835b5'
                            }
                        }
                    },
                    text: 'All',
                    onclick: function () {
                        loadbuildinggradesanitationmonthlyAll(year)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var month = event.point.name
                        loadbuildinggradesanitationWarehousemonthlytoweekly(month, year)
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            },
            area: {
                stacking: 'normal',
                lineColor: '#666666',
                lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Depot Monthly Sanitation Grades (Warehouse)",
            colorByPoint: false,
            data: sanitationbuilding,
        }]
    });
};

function loadbuildinggradesanitationWarehousemonthlytoweekly(month, year) {

    $.ajax({
        url: 'Report/dashboard_data_buildingsanitationWarehousemonthlytoweekly.php',
        type: 'POST',
        dataType: "json",
        data: {
            year: year,
            month: month
        },
        success: function (response) {
            var sanitationbuilding = response['data'];

            SanitationBuildingWarehousemonthlytoweekly(sanitationbuilding, year, month);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
};

function SanitationBuildingWarehousemonthlytoweekly(sanitationbuilding, year, month) {

    // Create the chart
    Highcharts.chart('container2', {
        chart: {
            type: 'column'

        },
        title: {
            text: 'Depot Sanitation Weekly Grade (Warehouse)'
        },
        subtitle: {
            text: 'Warehouse ' + year
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Monthly Grade (Warehouse)',
                    onclick: function () {
                        loadbuildinggradesanitationmonthlyWarehouse(year)
                        $('#s2id_month').hide()
                    }
                },
                BuildingButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#f26e27',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Building',
                    onclick: function () {
                        loadbuildinggradesanitationBuildingWarehouse(month, year)
                    }
                },
                WeekButton: {
                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#d53d2a',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Week',
                    onclick: function () {
                        loadbuildinggradesanitationWarehousemonthlytoweekly(month, year)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingWeek = event.point.name
                        week = buildingWeek.substring(5, 6);
                        loadbuildinggradesanitationWarehouse(month, year, week)
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            },
            area: {
                stacking: 'normal',
                lineColor: '#666666',
                lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Depot Monthly Sanitation Grades (Warehouse)",
            colorByPoint: false,
            fill: '#666666',
            data: sanitationbuilding
        }]
    });
};

function loadbuildinggradesanitationBuildingWarehouse(month, year) {


    $.ajax({
        url: 'Report/dashboard_data_buildingsanitationBuildingWarehouse.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            year: year
        },
        success: function (response) {
            var sanitationbuilding = response['data'];

            SanitationBuildingBuildingWarehouse(sanitationbuilding, month, year);
            console.log(response)
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
};

function SanitationBuildingBuildingWarehouse(sanitationbuilding, month, year) {

    // Create the chart
    Highcharts.chart('container2', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Depot Sanitation Weekly Grade (Warehouse)'
        },
        subtitle: {
            text: 'Warehouse ' + year
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Monthly Grade (Warehouse)',
                    onclick: function () {
                        loadbuildinggradesanitationmonthlyWarehouse(year)
                        $('#s2id_month').hide()
                    }
                },
                BuildingButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#f26e27',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Building',
                    onclick: function () {
                        loadbuildinggradesanitationBuildingWarehouse(month, year)
                    }
                },
                WeekButton: {
                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#d53d2a',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Week',
                    onclick: function () {
                        loadbuildinggradesanitationWarehousemonthlytoweekly(month, year)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingName = event.point.name
                        var week = $('#sanitationbuildingweektextbox').val('0');
                        $('#sanitationbuildingtextbox').val(buildingName);
                        loadbuildinggradesanitationweeklyWarehouse(month, year, buildingName)
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Production Grades",
            colorByPoint: true,
            data: sanitationbuilding
        }]
    });
};

function loadbuildinggradesanitationweeklyWarehouse(month, year, buildingName) {
    $.ajax({
        url: 'Report/dashboard_data_buildingsanitation_weeklyWarehouse.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            building: buildingName,
            year: year
        },
        success: function (response) {
            var sanitationbuildingweekly = response['data'];
            SanitationBuildingWeeklyWarehouse(sanitationbuildingweekly, month, year, buildingName);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function SanitationBuildingWeeklyWarehouse(sanitationbuildingweekly, month, year, buildingname) {

    Highcharts.chart('container2', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month
        },
        subtitle: {
            text: 'Warehouse > ' + month + ' ' + year + ' > ' + buildingname
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Building Grade',
                    onclick: function () {
                        loadbuildinggradesanitationBuildingWarehouse(month, year)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingWeek = event.point.name
                        week = buildingWeek.substring(5, 6);
                        buildingName = $('#sanitationbuildingtextbox').val();
                        $('#sanitationbuildingweektextbox').val(week);
                        loadbuildinggradesanitationweeklyWarehouse_phase(month, year, buildingName, week)

                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Weekly Grades",
            colorByPoint: true,
            data: sanitationbuildingweekly
        }]
    });
};

function loadbuildinggradesanitationWarehouse(month, year, week) {

    $.ajax({
        url: 'Report/dashboard_data_buildingsanitationWarehouse.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            week: week,
            year: year
        },
        success: function (response) {
            var sanitationbuilding = response['data'];

            SanitationBuildingWarehouse(sanitationbuilding, month, year, week);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function SanitationBuildingWarehouse(sanitationbuilding, month, year, week) {

    Highcharts.chart('container2', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month + ' ' + year
        },
        subtitle: {
            text: 'Warehouse > ' + month + ' ' + year + ' > Week: ' + week
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Weekly Depot Sanitation Grade (Warehouse)',
                    onclick: function () {
                        loadbuildinggradesanitationWarehousemonthlytoweekly(month, year)
                        $('#s2id_month').hide()
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingName = event.point.name
                        loadbuildinggradesanitationweeklyWarehouse_phase(month, year, buildingName, week)

                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Warehouse Grades",
            colorByPoint: true,
            data: sanitationbuilding
        }]
    });
};

function loadbuildinggradesanitationweeklyWarehouse_phase(month, year, buildingName, week) {

    $.ajax({
        url: 'Report/dashboard_data_buildingsanitationWarehouse_weekly_phase.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            year: year,
            building: buildingName,
            week: week
        },
        success: function (response) {
            var sanitationbuildingweekly = response['data'];
            SanitationBuildingWeeklyWarehouse_phase(sanitationbuildingweekly, month, year, week, buildingName);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function SanitationBuildingWeeklyWarehouse_phase(sanitationbuildingweekly, month, year, week, buildingname) {

    Highcharts.chart('container2', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month
        },
        subtitle: {
            text: 'Warehouse > ' + month + ' ' + year + ' > ' + buildingname + ' > ' + 'Week ' + week
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Weekly Building Grade',
                    onclick: function () {
                        loadbuildinggradesanitationWarehouse(month, year, week)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var phase = event.point.name
                        // alert(phase)
                        $('#sanitationphaseweektextbox').val(phase);
                        loadbuildinggradesanitationweeklyWarehouse_area(month, year, buildingname, week, phase)

                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Weekly Grades",
            colorByPoint: true,
            data: sanitationbuildingweekly
        }]
    });
};

function loadbuildinggradesanitationweeklyWarehouse_area(month, year, buildingName, week, phase) {

    $.ajax({
        url: 'Report/dashboard_data_buildingsanitation_weekly_area.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            year: year,
            building: buildingName,
            week: week,
            phase: phase
        },
        success: function (response) {
            var sanitationbuildingweekly = response['data'];
            var sanitationbuildingweeklyareaWeight = response['dataWeight'];
            SanitationBuildingWeeklyWarehouse_area(sanitationbuildingweekly, month, year, sanitationbuildingweeklyareaWeight, buildingName, phase, week);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function SanitationBuildingWeeklyWarehouse_area(sanitationbuildingweekly, month, year, sanitationbuildingweeklyareaWeight, buildingName, phase, week) {

    Highcharts.chart('container2', {
        chart: {
            type: 'areaspline'
        },
        title: {
            text: 'Month of ' + month + ' Week ' + week
        },
        subtitle: {
            text: 'Warehouse > ' + month + ' ' + year + ' > ' + buildingName + ' > ' + 'Week ' + week + ' > ' + phase
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Weekly Phase Grade',
                    onclick: function () {
                        loadbuildinggradesanitationweeklyWarehouse_phase(month, year, buildingName, week)
                    }
                }
            }
        },
        legend: {
            enabled: true,
            y: -40,
            bubbleLegend: {
                enabled: true,
                borderWidth: 2,
                ranges: [{
                    borderColor: '#1aadce',
                    connectorColor: '#1aadce'
                }, {
                    borderColor: '#0d233a',
                    connectorColor: '#0d233a'
                }, {
                    borderColor: '#f28f43',
                    connectorColor: '#f28f43'
                }]
            }
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingWeek = event.point.name
                        area = buildingWeek;
                        loadbuildinggradesanitationweeklyWarehouse_checklist(month, year, buildingName, week, area, phase)

                        $('#SaniAreaGrade').hide()
                        $('#SaniChecklistGrade').show()
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/> <span style="color:{point.color}"><b>QA Staff:</b>{point.QA}</span><br/> <span style="color:{point.color}"><b>Protech:</b>{point.Protech}</span>',
        },


        series: [{
                name: "Weekly Area Grades",
                colorByPoint: false,
                data: sanitationbuildingweekly
            },
            {
                name: "Area Distribution",
                type: 'spline',
                colorByPoint: false,
                data: sanitationbuildingweeklyareaWeight,
                tooltip: {
                    valueSuffix: '°C'
                }
            }
        ]
    });
};

function loadbuildinggradesanitationweeklyWarehouse_checklist(month, year, buildingName, week, area, phase) {

    $.ajax({
        url: 'Report/dashboard_data_buildingsanitation_weekly_checklist.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            year: year,
            building: buildingName,
            week: week,
            phase: phase,
            area: area
        },
        success: function (response) {
            var sanitationbuildingweekly = response['data'];
            SanitationBuildingWeeklyWarehouse_checklist(sanitationbuildingweekly, month, year, buildingName, week, area, phase);
            // console.log(sanitationbuildingweekly);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function SanitationBuildingWeeklyWarehouse_checklist(sanitationbuildingweekly, month, year, buildingname, week, area, phase) {

    Highcharts.chart('container2', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month + ' Week ' + week
        },
        subtitle: {
            text: 'Warehouse > ' + month + ' ' + year + ' > ' + buildingname + ' > ' + 'Week ' + week + ' > ' + phase + ' > ' + area
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Weekly Area Grade',
                    onclick: function () {
                        loadbuildinggradesanitationweeklyWarehouse_area(month, year, buildingname, week, phase, area)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/> <span style="color:{point.color}"><b>QA Staff:</b>{point.QA}</span><br/> <span style="color:{point.color}"><b>Protech:</b>{point.Protech}</span>',
        },


        series: [{
            name: "Weekly Checklist Grade",
            colorByPoint: false,
            data: sanitationbuildingweekly
        }]
    });
};


// All Sanitation
function loadbuildinggradesanitationmonthlyAll(year) {


    $.ajax({
        url: 'Report/dashboard_data_buildingsanitationmonthlyAll.php',
        type: 'POST',
        dataType: "json",
        data: {
            year: year
        },
        success: function (response) {
            var sanitationbuilding = response['data'];

            SanitationBuildingmonthlyAll(sanitationbuilding, year);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function SanitationBuildingmonthlyAll(sanitationbuilding, year) {

    // Create the chart
    Highcharts.chart('container2', {
        chart: {
            type: 'area'
        },
        title: {
            text: 'Depot Sanitation Monthly Grade (All)'
        },
        subtitle: {
            text: 'Production and Warehouse ' + year
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {

            buttons: {
                BackButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Production',
                    onclick: function () {
                        loadbuildinggradesanitationmonthly(year)
                    }
                },
                FrontButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#0088cc69',
                        r: 10,
                        states: {
                            hover: {
                                fill: '#7cb5ec'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#0088cc69'
                            }
                        }
                    },
                    text: 'Warehouse',
                    onclick: function () {
                        loadbuildinggradesanitationmonthlyWarehouse(year)
                    }
                },
                SideButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#358835b5',
                        r: 10,
                        fill: '#358835b5',
                        states: {
                            hover: {
                                fill: '#35883582'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#358835b5'
                            }
                        }
                    },
                    text: 'All',
                    onclick: function () {
                        loadbuildinggradesanitationmonthlyAll(year)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var month = event.point.name
                        loadbuildinggradesanitationAllmonthlytoweekly(month, year)
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            },
            area: {
                stacking: 'normal',
                lineColor: '#666666',
                lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Depot Monthly Sanitation Grades (Warehouse)",
            colorByPoint: false,
            data: sanitationbuilding,
        }]
    });
};

function loadbuildinggradesanitationAllmonthlytoweekly(month, year) {

    $.ajax({
        url: 'Report/dashboard_data_buildingsanitationAllmonthlytoweekly.php',
        type: 'POST',
        dataType: "json",
        data: {
            year: year,
            month: month
        },
        success: function (response) {
            var sanitationbuilding = response['data'];

            SanitationBuildingAllmonthlytoweekly(sanitationbuilding, year, month);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
};

function SanitationBuildingAllmonthlytoweekly(sanitationbuilding, year, month) {

    // Create the chart
    Highcharts.chart('container2', {
        chart: {
            type: 'column'

        },
        title: {
            text: 'Depot Sanitation Weekly Grade (Production and Warehouse)'
        },
        subtitle: {
            text: 'Production and Warehouse ' + year
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Monthly Grade (Production)',
                    onclick: function () {
                        loadbuildinggradesanitationmonthlyAll(year)
                        $('#s2id_month').hide()
                    }
                },
                BuildingButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#f26e27',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Building',
                    onclick: function () {
                        loadbuildinggradesanitationBuildingAll(month, year)
                    }
                },
                WeekButton: {
                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#d53d2a',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Week',
                    onclick: function () {
                        loadbuildinggradesanitationAllmonthlytoweekly(month, year)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingWeek = event.point.name
                        week = buildingWeek.substring(5, 6);
                        loadbuildinggradesanitationAll(month, year, week)
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            },
            area: {
                stacking: 'normal',
                lineColor: '#666666',
                lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Depot Monthly Sanitation Grades (Production and Warehouse )",
            colorByPoint: false,
            fill: '#666666',
            data: sanitationbuilding
        }]
    });
};

function loadbuildinggradesanitationBuildingAll(month, year) {


    $.ajax({
        url: 'Report/dashboard_data_buildingsanitationBuildingAll.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            year: year
        },
        success: function (response) {
            var sanitationbuilding = response['data'];

            SanitationBuildingBuildingAll(sanitationbuilding, month, year);
            console.log(response)
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
};

function SanitationBuildingBuildingAll(sanitationbuilding, month, year) {

    // Create the chart
    Highcharts.chart('container2', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Depot Sanitation Weekly Grade (Production)'
        },
        subtitle: {
            text: 'Production and Warehouse ' + year
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Monthly Grade (Production and Warehouse)',
                    onclick: function () {
                        loadbuildinggradesanitationmonthlyAll(year)
                        $('#s2id_month').hide()
                    }
                },
                BuildingButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#f26e27',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Building',
                    onclick: function () {
                        loadbuildinggradesanitationBuildingAll(month, year)
                    }
                },
                WeekButton: {
                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#d53d2a',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Week',
                    onclick: function () {
                        loadbuildinggradesanitationAllmonthlytoweekly(month, year)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingName = event.point.name
                        var week = $('#sanitationbuildingweektextbox').val('0');
                        $('#sanitationbuildingtextbox').val(buildingName);
                        loadbuildinggradesanitationweeklyAll(month, year, buildingName)
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Production Grades",
            colorByPoint: true,
            data: sanitationbuilding
        }]
    });
};

function loadbuildinggradesanitationweeklyAll(month, year, buildingName) {
    $.ajax({
        url: 'Report/dashboard_data_buildingsanitation_weeklyAll.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            building: buildingName,
            year: year
        },
        success: function (response) {
            var sanitationbuildingweekly = response['data'];
            SanitationBuildingWeeklyAll(sanitationbuildingweekly, month, year, buildingName);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function SanitationBuildingWeeklyAll(sanitationbuildingweekly, month, year, buildingname) {

    Highcharts.chart('container2', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month
        },
        subtitle: {
            text: 'Production and Warehouse > ' + month + ' ' + year + ' > ' + buildingname
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Building Grade',
                    onclick: function () {
                        loadbuildinggradesanitationBuildingAll(month, year)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingWeek = event.point.name
                        week = buildingWeek.substring(5, 6);
                        buildingName = $('#sanitationbuildingtextbox').val();
                        $('#sanitationbuildingweektextbox').val(week);
                        loadbuildinggradesanitationweeklyAll_phase(month, year, buildingName, week)

                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Weekly Grades",
            colorByPoint: true,
            data: sanitationbuildingweekly
        }]
    });
};

function loadbuildinggradesanitationAll(month, year, week) {

    $.ajax({
        url: 'Report/dashboard_data_buildingsanitationAll.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            week: week,
            year: year
        },
        success: function (response) {
            var sanitationbuilding = response['data'];

            SanitationBuildingAll(sanitationbuilding, month, year, week);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function SanitationBuildingAll(sanitationbuilding, month, year, week) {

    Highcharts.chart('container2', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month + ' ' + year
        },
        subtitle: {
            text: 'Production and Warehouse > ' + month + ' ' + year + ' > Week: ' + week
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Weekly Depot Sanitation Grade (Production and Warehouse)',
                    onclick: function () {
                        loadbuildinggradesanitationAllmonthlytoweekly(month, year)
                        $('#s2id_month').hide()
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingName = event.point.name
                        loadbuildinggradesanitationweeklyAll_phase(month, year, buildingName, week)

                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Production and Warehouse Grades",
            colorByPoint: true,
            data: sanitationbuilding
        }]
    });
};

function loadbuildinggradesanitationweeklyAll_phase(month, year, buildingName, week) {

    $.ajax({
        url: 'Report/dashboard_data_buildingsanitationAll_weekly_phase.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            year: year,
            building: buildingName,
            week: week
        },
        success: function (response) {
            var sanitationbuildingweekly = response['data'];
            SanitationBuildingWeeklyAll_phase(sanitationbuildingweekly, month, year, week, buildingName);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function SanitationBuildingWeeklyAll_phase(sanitationbuildingweekly, month, year, week, buildingname) {

    Highcharts.chart('container2', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month
        },
        subtitle: {
            text: 'Production and Warehouse > ' + month + ' ' + year + ' > ' + buildingname + ' > ' + 'Week ' + week
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Weekly Building Grade',
                    onclick: function () {
                        loadbuildinggradesanitationAll(month, year, week)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var phase = event.point.name
                        // alert(phase)
                        $('#sanitationphaseweektextbox').val(phase);
                        loadbuildinggradesanitationweeklyAll_area(month, year, buildingname, week, phase)

                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Weekly Grades",
            colorByPoint: true,
            data: sanitationbuildingweekly
        }]
    });
};

function loadbuildinggradesanitationweeklyAll_area(month, year, buildingName, week, phase) {

    $.ajax({
        url: 'Report/dashboard_data_buildingsanitation_weekly_area.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            year: year,
            building: buildingName,
            week: week,
            phase: phase
        },
        success: function (response) {
            var sanitationbuildingweekly = response['data'];
            var sanitationbuildingweeklyareaWeight = response['dataWeight'];
            SanitationBuildingWeeklyAll_area(sanitationbuildingweekly, month, year, sanitationbuildingweeklyareaWeight, buildingName, phase, week);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function SanitationBuildingWeeklyAll_area(sanitationbuildingweekly, month, year, sanitationbuildingweeklyareaWeight, buildingName, phase, week) {

    Highcharts.chart('container2', {
        chart: {
            type: 'areaspline'
        },
        title: {
            text: 'Month of ' + month + ' Week ' + week
        },
        subtitle: {
            text: 'Production and Warehouse > ' + month + ' ' + year + ' > ' + buildingName + ' > ' + 'Week ' + week + ' > ' + phase
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Weekly Phase Grade',
                    onclick: function () {
                        loadbuildinggradesanitationweeklyAll_phase(month, year, buildingName, week)
                    }
                }
            }
        },
        legend: {
            enabled: true,
            y: -40,
            bubbleLegend: {
                enabled: true,
                borderWidth: 2,
                ranges: [{
                    borderColor: '#1aadce',
                    connectorColor: '#1aadce'
                }, {
                    borderColor: '#0d233a',
                    connectorColor: '#0d233a'
                }, {
                    borderColor: '#f28f43',
                    connectorColor: '#f28f43'
                }]
            }
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingWeek = event.point.name
                        area = buildingWeek;
                        loadbuildinggradesanitationweeklyAll_checklist(month, year, buildingName, week, area, phase)

                        $('#SaniAreaGrade').hide()
                        $('#SaniChecklistGrade').show()
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/> <span style="color:{point.color}"><b>QA Staff:</b>{point.QA}</span><br/> <span style="color:{point.color}"><b>Protech:</b>{point.Protech}</span>',
        },


        series: [{
                name: "Weekly Area Grades",
                colorByPoint: false,
                data: sanitationbuildingweekly
            },
            {
                name: "Area Distribution",
                type: 'spline',
                colorByPoint: false,
                data: sanitationbuildingweeklyareaWeight,
                tooltip: {
                    valueSuffix: '°C'
                }
            }
        ]
    });
};

function loadbuildinggradesanitationweeklyAll_checklist(month, year, buildingName, week, area, phase) {

    $.ajax({
        url: 'Report/dashboard_data_buildingsanitation_weekly_checklist.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            year: year,
            building: buildingName,
            week: week,
            phase: phase,
            area: area
        },
        success: function (response) {
            var sanitationbuildingweekly = response['data'];
            SanitationBuildingWeeklyAll_checklist(sanitationbuildingweekly, month, year, buildingName, week, area, phase);
            // console.log(sanitationbuildingweekly);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function SanitationBuildingWeeklyAll_checklist(sanitationbuildingweekly, month, year, buildingname, week, area, phase) {

    Highcharts.chart('container2', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month + ' Week ' + week
        },
        subtitle: {
            text: 'Production and Warehouse > ' + month + ' ' + year + ' > ' + buildingname + ' > ' + 'Week ' + week + ' > ' + phase + ' > ' + area
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Weekly Area Grade',
                    onclick: function () {
                        loadbuildinggradesanitationweeklyAll_area(month, year, buildingname, week, phase, area)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/> <span style="color:{point.color}"><b>QA Staff:</b>{point.QA}</span><br/> <span style="color:{point.color}"><b>Protech:</b>{point.Protech}</span>',
        },


        series: [{
            name: "Weekly Checklist Grade",
            colorByPoint: false,
            data: sanitationbuildingweekly
        }]
    });
};



// Production Structural
function loadbuildinggradestructuralmonthly(val) {

    $.ajax({
        url: 'Report/dashboard_data_buildingstructuralmonthly.php',
        type: 'POST',
        dataType: "json",
        data: {
            year: val
        },
        success: function (response) {
            var structuralbuilding = response['data'];

            StructuralBuildingmonthly(structuralbuilding, val);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
};

function StructuralBuildingmonthly(structuralbuilding, year) {

    // Create the chart
    Highcharts.chart('StructuralBuildingGrade', {
        chart: {
            type: 'area'

        },
        title: {
            text: 'Depot Structural Monthly Grade (Production)'
        },
        subtitle: {
            text: 'Production ' + year
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {

            buttons: {
                BackButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#fec539',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Production',
                    onclick: function () {
                        loadbuildinggradestructuralmonthly(year)
                    }
                },
                FrontButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#0088cc69',
                        r: 10,
                        states: {
                            hover: {
                                fill: '#7cb5ec'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#0088cc69'
                            }
                        }
                    },
                    text: 'Warehouse',
                    onclick: function () {
                        loadbuildinggradestructuralmonthlyWarehouse(year)
                    }
                },
                SideButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#358835b5',
                        r: 10,
                        states: {
                            hover: {
                                fill: '#35883582'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#358835b5'
                            }
                        }
                    },
                    text: 'All',
                    onclick: function () {
                        loadbuildinggradestructuralmonthlyAll(year)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var month = event.point.name
                        loadbuildinggradestructuralmonthlytoweekly(month, year)
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            },
            area: {
                stacking: 'normal',
                lineColor: '#666666',
                lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Depot Monthly Structural Grades (Production)",
            colorByPoint: false,
            fill: '#666666',
            data: structuralbuilding
        }]
    });
};

function loadbuildinggradestructuralmonthlytoweekly(month, year) {

    $.ajax({
        url: 'Report/dashboard_data_buildingstructuralmonthlyweekly.php',
        type: 'POST',
        dataType: "json",
        data: {
            year: year,
            month: month
        },
        success: function (response) {
            var structuralbuilding = response['data'];

            StructuralBuildingmonthlytoweekly(structuralbuilding, year, month);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
};

function StructuralBuildingmonthlytoweekly(structuralbuilding, year, month) {

    // Create the chart
    Highcharts.chart('StructuralBuildingGrade', {
        chart: {
            type: 'column'

        },
        title: {
            text: 'Depot Structural Weekly Grade (Production)'
        },
        subtitle: {
            text: 'Production ' + year
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Monthly Depot Grade (Production)',
                    onclick: function () {
                        loadbuildinggradestructuralmonthly(year)
                        $('#s2id_month').hide()
                    }
                },
                BuildingButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#f26e27',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Building',
                    onclick: function () {
                        loadbuildinggradestructuralBuilding(month, year)
                    }
                },
                WeekButton: {
                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#d53d2a',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Week',
                    onclick: function () {
                        loadbuildinggradestructuralmonthlytoweekly(month, year)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingWeek = event.point.name
                        week = buildingWeek.substring(5, 6);
                        loadbuildinggradestructural(month, year, week)
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            },
            area: {
                stacking: 'normal',
                lineColor: '#666666',
                lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Depot Monthly Structural Grades (Production)",
            colorByPoint: false,
            fill: '#666666',
            data: structuralbuilding
        }]
    });
};

function loadbuildinggradestructuralBuilding(month, year) {


    $.ajax({
        url: 'Report/dashboard_data_buildingstructuralBuilding.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            year: year
        },
        success: function (response) {
            var sanitationbuilding = response['data'];

            StructuralBuildingBuilding(sanitationbuilding, month, year);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
};

function StructuralBuildingBuilding(sanitationbuilding, month, year) {

    // Create the chart
    Highcharts.chart('StructuralBuildingGrade', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Depot Structural Weekly Grade (Production)'
        },
        subtitle: {
            text: 'Production ' + year
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Monthly Grade (Production)',
                    onclick: function () {
                        loadbuildinggradestructuralmonthly(year)
                        $('#s2id_month').hide()
                    }
                },
                BuildingButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#f26e27',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Building',
                    onclick: function () {
                        loadbuildinggradestructuralBuilding(month, year)
                    }
                },
                WeekButton: {
                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#d53d2a',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Week',
                    onclick: function () {
                        loadbuildinggradestructuralmonthlytoweekly(month, year)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingName = event.point.name
                        var week = $('#sanitationbuildingweektextbox').val('0');
                        $('#sanitationbuildingtextbox').val(buildingName);
                        loadbuildinggradestructuralweekly(month, year, buildingName)
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Production Grades",
            colorByPoint: true,
            data: sanitationbuilding
        }]
    });
};


function loadbuildinggradestructuralweekly(month, year, buildingName) {
    $.ajax({
        url: 'Report/dashboard_data_buildingstructural_weekly.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            building: buildingName,
            year: year
        },
        success: function (response) {
            var sanitationbuildingweekly = response['data'];
            StructuralBuildingWeekly(sanitationbuildingweekly, month, year, buildingName);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function StructuralBuildingWeekly(sanitationbuildingweekly, month, year, buildingname) {

    Highcharts.chart('StructuralBuildingGrade', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month
        },
        subtitle: {
            text: 'Production > ' + month + ' ' + year + ' > ' + buildingname
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Building Grade',
                    onclick: function () {
                        loadbuildinggradestructuralBuilding(month, year)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingWeek = event.point.name
                        week = buildingWeek.substring(5, 6);
                        buildingName = $('#sanitationbuildingtextbox').val();
                        $('#sanitationbuildingweektextbox').val(week);
                        loadbuildinggradestructuralweekly_phase(month, year, buildingName, week)

                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Weekly Grades",
            colorByPoint: true,
            data: sanitationbuildingweekly
        }]
    });
};

function loadbuildinggradestructural(month, year, week) {


    $.ajax({
        url: 'Report/dashboard_data_buildingstructural.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            week: week,
            year: year
        },
        success: function (response) {
            var structuralbuilding = response['data'];

            StructuralBuilding(structuralbuilding, month, year, week);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
};

function StructuralBuilding(structuralbuilding, month, year, week) {

    // Create the chart
    Highcharts.chart('StructuralBuildingGrade', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month + ' ' + year
        },
        subtitle: {
            text: 'Production > ' + month + ' ' + year + ' > Week: ' + week
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Weekly Depot Grade (Production)',
                    onclick: function () {
                        loadbuildinggradestructuralmonthlytoweekly(month, year)
                        $('#s2id_month').hide()
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingName = event.point.name
                        loadbuildinggradestructuralweekly_phase(month, year, buildingName, week)
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Production Grades",
            colorByPoint: true,
            data: structuralbuilding
        }]
    });
};

function loadbuildinggradestructuralweekly_phase(month, year, buildingName, week) {


    $.ajax({
        url: 'Report/dashboard_data_buildingstructural_weekly_phase.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            year: year,
            building: buildingName,
            week: week
        },
        success: function (response) {
            var structuralbuildingweekly = response['data'];
            StructuralBuildingWeekly_phase(structuralbuildingweekly, month, year, buildingName, week);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function StructuralBuildingWeekly_phase(structuralbuildingweekly, month, year, buildingName, week) {

    Highcharts.chart('StructuralBuildingGrade', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month
        },
        subtitle: {
            text: 'Production > ' + month + ' ' + year + ' > ' + buildingName + ' > ' + 'Week ' + week
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Weekly Building Grade',
                    onclick: function () {
                        loadbuildinggradestructural(month, year, week)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var phase = event.point.name
                        loadbuildinggradestructuralweekly_area(month, year, buildingName, week, phase)

                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Weekly Grades",
            colorByPoint: true,
            data: structuralbuildingweekly
        }]
    });
};

function loadbuildinggradestructuralweekly_area(month, year, buildingName, week, phase) {

    $.ajax({
        url: 'Report/dashboard_data_buildingstructural_weekly_area.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            year: year,
            building: buildingName,
            week: week,
            phase: phase
        },
        success: function (response) {
            var structuralbuildingweekly = response['data'];
            var structuralbuildingweeklyareaWeight = response['dataWeight'];
            StructuralBuildingWeekly_area(structuralbuildingweekly, month, year, structuralbuildingweeklyareaWeight, buildingName, phase);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function StructuralBuildingWeekly_area(structuralbuildingweekly, month, year, structuralbuildingweeklyareaWeight, buildingName, phase) {

    Highcharts.chart('StructuralBuildingGrade', {
        chart: {
            type: 'areaspline'
        },
        title: {
            text: 'Month of ' + month + ' Week ' + week
        },
        subtitle: {
            text: 'Production > ' + month + ' ' + year + ' > ' + buildingName + ' > ' + 'Week ' + week + ' > ' + phase
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Weekly Phase Grade',
                    onclick: function () {
                        loadbuildinggradestructuralweekly_phase(month, year, buildingName, week)
                    }
                }
            }
        },
        legend: {
            enabled: true,
            y: -40,
            bubbleLegend: {
                enabled: true,
                borderWidth: 2,
                ranges: [{
                    borderColor: '#1aadce',
                    connectorColor: '#1aadce'
                }, {
                    borderColor: '#0d233a',
                    connectorColor: '#0d233a'
                }, {
                    borderColor: '#f28f43',
                    connectorColor: '#f28f43'
                }]
            }
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingWeek = event.point.name
                        area = buildingWeek;
                        loadbuildinggradestructuralweekly_checklist(month, year, buildingName, week, area, phase)

                        // $('#SaniAreaGrade').hide()
                        // $('#SaniChecklistGrade').show()
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/> <span style="color:{point.color}"><b>QA Staff:</b>{point.QA}</span><br/> <span style="color:{point.color}"><b>Protech:</b>{point.Protech}</span>',
        },


        series: [{
                name: "Weekly Area Grades",
                colorByPoint: false,
                data: structuralbuildingweekly
            },
            {
                name: "Area Distribution",
                type: 'spline',
                colorByPoint: false,
                data: structuralbuildingweeklyareaWeight,
                tooltip: {
                    valueSuffix: '%'
                }
            }
        ]
    });
};

function loadbuildinggradestructuralweekly_checklist(month, year, buildingName, week, area, phase) {

    $.ajax({
        url: 'Report/dashboard_data_buildingstructural_weekly_checklist.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            year: year,
            building: buildingName,
            week: week,
            phase: phase,
            area: area
        },
        success: function (response) {
            var structuralbuildingweekly = response['data'];
            StructuralBuildingWeekly_checklist(structuralbuildingweekly, month, year, buildingName, week, area, phase);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function StructuralBuildingWeekly_checklist(structuralbuildingweekly, month, year, buildingname, week, area, phase) {

    Highcharts.chart('StructuralBuildingGrade', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month + ' Week ' + week
        },
        subtitle: {
            text: 'Production > ' + month + ' ' + year + ' > ' + buildingname + ' > ' + 'Week ' + week + ' > ' + phase + ' > ' + area
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Weekly Area Grade',
                    onclick: function () {
                        loadbuildinggradestructuralweekly_area(month, year, buildingname, week, phase, area)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/> <span style="color:{point.color}"><b>QA Staff:</b>{point.QA}</span><br/> <span style="color:{point.color}"><b>Protech:</b>{point.Protech}</span>',
        },


        series: [{
            name: "Weekly Checklist Grade",
            colorByPoint: false,
            data: structuralbuildingweekly
        }]
    });
};



// Warehouse Structural
function loadbuildinggradestructuralmonthlyWarehouse(year) {


    $.ajax({
        url: 'Report/dashboard_data_buildingstructuralmonthlyWarehouse.php',
        type: 'POST',
        dataType: "json",
        data: {
            year: year
        },
        success: function (response) {
            var structuralbuilding = response['data'];

            StructuralBuildingmonthlyWarehouse(structuralbuilding, year);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function StructuralBuildingmonthlyWarehouse(structuralbuilding, year) {

    // Create the chart
    Highcharts.chart('StructuralBuildingGrade', {
        chart: {
            type: 'area'
        },
        title: {
            text: 'Depot Structural Monthly Grade (Warehouse)'
        },
        subtitle: {
            text: 'Warehouse ' + year
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {

            buttons: {
                BackButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Production',
                    onclick: function () {
                        loadbuildinggradestructuralmonthly(year)
                    }
                },
                FrontButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#0088cc69',
                        r: 10,
                        fill: '#0088cc69',
                        states: {
                            hover: {
                                fill: '#7cb5ec'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#0088cc69'
                            }
                        }
                    },
                    text: 'Warehouse',
                    onclick: function () {
                        loadbuildinggradestructuralmonthlyWarehouse(year)
                    }
                },
                SideButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#358835b5',
                        r: 10,
                        states: {
                            hover: {
                                fill: '#35883582'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#358835b5'
                            }
                        }
                    },
                    text: 'All',
                    onclick: function () {
                        loadbuildinggradestructuralmonthlyAll(year)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var month = event.point.name
                        loadbuildinggradestructuralWarehousemonthlytoweekly(month, year)
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            },
            area: {
                stacking: 'normal',
                lineColor: '#666666',
                lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Depot Monthly Structural Grades (Warehouse)",
            colorByPoint: false,
            data: structuralbuilding,
        }]
    });
};

function loadbuildinggradestructuralWarehousemonthlytoweekly(month, year) {

    $.ajax({
        url: 'Report/dashboard_data_buildingstructuralWarehousemonthlytoweekly.php',
        type: 'POST',
        dataType: "json",
        data: {
            year: year,
            month: month
        },
        success: function (response) {
            var structuralbuilding = response['data'];

            StructuralBuildingWarehousemonthlytoweekly(structuralbuilding, year, month);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
};

function StructuralBuildingWarehousemonthlytoweekly(structuralbuilding, year, month) {

    // Create the chart
    Highcharts.chart('StructuralBuildingGrade', {
        chart: {
            type: 'column'

        },
        title: {
            text: 'Depot Structural Weekly Grade (Warehouse)'
        },
        subtitle: {
            text: 'Warehouse ' + year
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Monthly Depot Structural Grade (Warehouse)',
                    onclick: function () {
                        loadbuildinggradestructuralmonthlyWarehouse(year)
                        $('#s2id_month').hide()
                    }
                },
                BuildingButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#f26e27',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Building',
                    onclick: function () {
                        loadbuildinggradestructuralBuildingWarehouse(month, year)
                    }
                },
                WeekButton: {
                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#d53d2a',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Week',
                    onclick: function () {
                        loadbuildinggradestructuralWarehousemonthlytoweekly(month, year)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingWeek = event.point.name
                        week = buildingWeek.substring(5, 6);
                        loadbuildinggradestructuralWarehouse(month, year, week)
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            },
            area: {
                stacking: 'normal',
                lineColor: '#666666',
                lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Depot Monthly Structural Grades (Warehouse)",
            colorByPoint: false,
            fill: '#666666',
            data: structuralbuilding
        }]
    });
};


function loadbuildinggradestructuralBuildingWarehouse(month, year) {


    $.ajax({
        url: 'Report/dashboard_data_buildingstructuralBuildingWarehouse.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            year: year
        },
        success: function (response) {
            var sanitationbuilding = response['data'];

            StructuralBuildingBuildingWarehouse(sanitationbuilding, month, year);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
};

function StructuralBuildingBuildingWarehouse(sanitationbuilding, month, year) {

    // Create the chart
    Highcharts.chart('StructuralBuildingGrade', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Depot Structural Weekly Grade (Warehouse)'
        },
        subtitle: {
            text: 'Warehouse ' + year
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Monthly Grade (Warehouse)',
                    onclick: function () {
                        loadbuildinggradestructuralmonthlyWarehouse(year)
                        $('#s2id_month').hide()
                    }
                },
                BuildingButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#f26e27',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Building',
                    onclick: function () {
                        loadbuildinggradestructuralBuildingWarehouse(month, year)
                    }
                },
                WeekButton: {
                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#d53d2a',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Week',
                    onclick: function () {
                        loadbuildinggradestructuralWarehousemonthlytoweekly(month, year)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingName = event.point.name
                        var week = $('#sanitationbuildingweektextbox').val('0');
                        $('#sanitationbuildingtextbox').val(buildingName);
                        loadbuildinggradestructuralweeklyWarehouse(month, year, buildingName)
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Warehouse Grades",
            colorByPoint: true,
            data: sanitationbuilding
        }]
    });
};


function loadbuildinggradestructuralweeklyWarehouse(month, year, buildingName) {

    $.ajax({
        url: 'Report/dashboard_data_buildingstructural_weeklyWarehouse.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            building: buildingName,
            year: year
        },
        success: function (response) {
            var sanitationbuildingweekly = response['data'];
            StructuralBuildingWeeklyWarehouse(sanitationbuildingweekly, month, year, buildingName);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function StructuralBuildingWeeklyWarehouse(sanitationbuildingweekly, month, year, buildingname) {

    Highcharts.chart('StructuralBuildingGrade', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month
        },
        subtitle: {
            text: 'Warehouse > ' + month + ' ' + year + ' > ' + buildingname
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Building Grade',
                    onclick: function () {
                        loadbuildinggradestructuralBuildingWarehouse(month, year)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingWeek = event.point.name
                        week = buildingWeek.substring(5, 6);
                        buildingName = $('#sanitationbuildingtextbox').val();
                        $('#sanitationbuildingweektextbox').val(week);
                        loadbuildinggradestructuralweeklyWarehouse_phase(month, year, buildingName, week)

                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Weekly Grades",
            colorByPoint: true,
            data: sanitationbuildingweekly
        }]
    });
};

function loadbuildinggradestructuralWarehouse(month, year, week) {

    $.ajax({
        url: 'Report/dashboard_data_buildingstructuralWarehouse.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            week: week,
            year: year
        },
        success: function (response) {
            var structuralbuilding = response['data'];

            StructuralBuildingWarehouse(structuralbuilding, month, year, week);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function StructuralBuildingWarehouse(structuralbuilding, month, year, week) {

    Highcharts.chart('StructuralBuildingGrade', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month + ' ' + year
        },
        subtitle: {
            text: 'Warehouse > ' + month + ' ' + year + ' > Week: ' + week
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Weekly Depot Structural Grade (Warehouse)',
                    onclick: function () {
                        loadbuildinggradestructuralWarehousemonthlytoweekly(month, year)
                        $('#s2id_month').hide()
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingName = event.point.name
                        loadbuildinggradestructuralweeklyWarehouse_phase(month, year, buildingName, week)

                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Warehouse Grades",
            colorByPoint: true,
            data: structuralbuilding
        }]
    });
};

function loadbuildinggradestructuralweeklyWarehouse_phase(month, year, buildingName, week) {

    $.ajax({
        url: 'Report/dashboard_data_buildingstructuralWarehouse_weekly_phase.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            year: year,
            building: buildingName,
            week: week
        },
        success: function (response) {
            var structuralbuildingweekly = response['data'];
            StructuralBuildingWeeklyWarehouse_phase(structuralbuildingweekly, month, year, week, buildingName);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function StructuralBuildingWeeklyWarehouse_phase(structuralbuildingweekly, month, year, week, buildingname) {

    Highcharts.chart('StructuralBuildingGrade', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month
        },
        subtitle: {
            text: 'Warehouse > ' + month + ' ' + year + ' > ' + buildingname + ' > ' + 'Week ' + week
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Weekly Building Grade',
                    onclick: function () {
                        loadbuildinggradestructuralWarehouse(month, year, week)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var phase = event.point.name
                        // alert(phase)
                        $('#structuralphaseweektextbox').val(phase);
                        loadbuildinggradestructuralweeklyWarehouse_area(month, year, buildingname, week, phase)

                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Weekly Grades",
            colorByPoint: true,
            data: structuralbuildingweekly
        }]
    });
};

function loadbuildinggradestructuralweeklyWarehouse_area(month, year, buildingName, week, phase) {

    $.ajax({
        url: 'Report/dashboard_data_buildingstructural_weekly_area.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            year: year,
            building: buildingName,
            week: week,
            phase: phase
        },
        success: function (response) {
            var structuralbuildingweekly = response['data'];
            var structuralbuildingweeklyareaWeight = response['dataWeight'];
            StructuralBuildingWeeklyWarehouse_area(structuralbuildingweekly, month, year, structuralbuildingweeklyareaWeight, buildingName, phase, week);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function StructuralBuildingWeeklyWarehouse_area(structuralbuildingweekly, month, year, structuralbuildingweeklyareaWeight, buildingName, phase, week) {

    Highcharts.chart('StructuralBuildingGrade', {
        chart: {
            type: 'areaspline'
        },
        title: {
            text: 'Month of ' + month + ' Week ' + week
        },
        subtitle: {
            text: 'Warehouse > ' + month + ' ' + year + ' > ' + buildingName + ' > ' + 'Week ' + week + ' > ' + phase
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Weekly Phase Grade',
                    onclick: function () {
                        loadbuildinggradestructuralweeklyWarehouse_phase(month, year, buildingName, week)
                    }
                }
            }
        },
        legend: {
            enabled: true,
            y: -40,
            bubbleLegend: {
                enabled: true,
                borderWidth: 2,
                ranges: [{
                    borderColor: '#1aadce',
                    connectorColor: '#1aadce'
                }, {
                    borderColor: '#0d233a',
                    connectorColor: '#0d233a'
                }, {
                    borderColor: '#f28f43',
                    connectorColor: '#f28f43'
                }]
            }
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingWeek = event.point.name
                        area = buildingWeek;
                        loadbuildinggradestructuralweeklyWarehouse_checklist(month, year, buildingName, week, area, phase)

                        $('#SaniAreaGrade').hide()
                        $('#SaniChecklistGrade').show()
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/> <span style="color:{point.color}"><b>QA Staff:</b>{point.QA}</span><br/> <span style="color:{point.color}"><b>Protech:</b>{point.Protech}</span>',
        },


        series: [{
                name: "Weekly Area Grades",
                colorByPoint: false,
                data: structuralbuildingweekly
            },
            {
                name: "Area Distribution",
                type: 'spline',
                colorByPoint: false,
                data: structuralbuildingweeklyareaWeight,
                tooltip: {
                    valueSuffix: '°C'
                }
            }
        ]
    });
};

function loadbuildinggradestructuralweeklyWarehouse_checklist(month, year, buildingName, week, area, phase) {

    $.ajax({
        url: 'Report/dashboard_data_buildingstructural_weekly_checklist.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            year: year,
            building: buildingName,
            week: week,
            phase: phase,
            area: area
        },
        success: function (response) {
            var structuralbuildingweekly = response['data'];
            StructuralBuildingWeeklyWarehouse_checklist(structuralbuildingweekly, month, year, buildingName, week, area, phase);
            // console.log(structuralbuildingweekly);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function StructuralBuildingWeeklyWarehouse_checklist(structuralbuildingweekly, month, year, buildingname, week, area, phase) {

    Highcharts.chart('StructuralBuildingGrade', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month + ' Week ' + week
        },
        subtitle: {
            text: 'Warehouse > ' + month + ' ' + year + ' > ' + buildingname + ' > ' + 'Week ' + week + ' > ' + phase + ' > ' + area
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Weekly Area Grade',
                    onclick: function () {
                        loadbuildinggradestructuralweeklyWarehouse_area(month, year, buildingname, week, phase, area)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/> <span style="color:{point.color}"><b>QA Staff:</b>{point.QA}</span><br/> <span style="color:{point.color}"><b>Protech:</b>{point.Protech}</span>',
        },


        series: [{
            name: "Weekly Checklist Grade",
            colorByPoint: false,
            data: structuralbuildingweekly
        }]
    });
};


// All Structural
function loadbuildinggradestructuralmonthlyAll(year) {


    $.ajax({
        url: 'Report/dashboard_data_buildingstructuralmonthlyAll.php',
        type: 'POST',
        dataType: "json",
        data: {
            year: year
        },
        success: function (response) {
            var structuralbuilding = response['data'];

            StructuralBuildingmonthlyAll(structuralbuilding, year);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function StructuralBuildingmonthlyAll(structuralbuilding, year) {

    // Create the chart
    Highcharts.chart('StructuralBuildingGrade', {
        chart: {
            type: 'area'
        },
        title: {
            text: 'Depot Structural Monthly Grade (All)'
        },
        subtitle: {
            text: 'Production and Warehouse ' + year
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {

            buttons: {
                BackButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Production',
                    onclick: function () {
                        loadbuildinggradestructuralmonthly(year)
                    }
                },
                FrontButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#0088cc69',
                        r: 10,
                        states: {
                            hover: {
                                fill: '#7cb5ec'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#0088cc69'
                            }
                        }
                    },
                    text: 'Warehouse',
                    onclick: function () {
                        loadbuildinggradestructuralmonthlyWarehouse(year)
                    }
                },
                SideButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#358835b5',
                        r: 10,
                        fill: '#358835b5',
                        states: {
                            hover: {
                                fill: '#35883582'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#358835b5'
                            }
                        }
                    },
                    text: 'All',
                    onclick: function () {
                        loadbuildinggradestructuralmonthlyAll(year)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var month = event.point.name
                        loadbuildinggradestructuralAllmonthlytoweekly(month, year)
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            },
            area: {
                stacking: 'normal',
                lineColor: '#666666',
                lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Depot Monthly Structural Grades (Warehouse)",
            colorByPoint: false,
            data: structuralbuilding,
        }]
    });
};

function loadbuildinggradestructuralAllmonthlytoweekly(month, year) {

    $.ajax({
        url: 'Report/dashboard_data_buildingstructuralAllmonthlytoweekly.php',
        type: 'POST',
        dataType: "json",
        data: {
            year: year,
            month: month
        },
        success: function (response) {
            var structuralbuilding = response['data'];

            StructuralBuildingAllmonthlytoweekly(structuralbuilding, year, month);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
};

function StructuralBuildingAllmonthlytoweekly(structuralbuilding, year, month) {

    // Create the chart
    Highcharts.chart('StructuralBuildingGrade', {
        chart: {
            type: 'column'

        },
        title: {
            text: 'Depot Structural Weekly Grade (Production and Warehouse)'
        },
        subtitle: {
            text: 'Production and Warehouse ' + year
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Monthly Depot Structural Grade (Production and Warehouse )',
                    onclick: function () {
                        loadbuildinggradestructuralmonthlyAll(year)
                        $('#s2id_month').hide()
                    }
                },
                BuildingButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#f26e27',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Building',
                    onclick: function () {
                        loadbuildinggradestructuralBuildingAll(month, year)
                    }
                },
                WeekButton: {
                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#d53d2a',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Week',
                    onclick: function () {
                        loadbuildinggradestructuralAllmonthlytoweekly(month, year)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingWeek = event.point.name
                        week = buildingWeek.substring(5, 6);
                        loadbuildinggradestructuralAll(month, year, week)
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            },
            area: {
                stacking: 'normal',
                lineColor: '#666666',
                lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Depot Monthly Grades (Production and Warehouse )",
            colorByPoint: false,
            fill: '#666666',
            data: structuralbuilding
        }]
    });
};


function loadbuildinggradestructuralBuildingAll(month, year) {


    $.ajax({
        url: 'Report/dashboard_data_buildingstructuralBuildingAll.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            year: year
        },
        success: function (response) {
            var sanitationbuilding = response['data'];

            StructuralBuildingBuildingAll(sanitationbuilding, month, year);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
};

function StructuralBuildingBuildingAll(sanitationbuilding, month, year) {

    // Create the chart
    Highcharts.chart('StructuralBuildingGrade', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Depot Structural Weekly Grade (Production and Warehouse)'
        },
        subtitle: {
            text: 'Production and Warehouse ' + year
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Monthly Grade (Production and Warehouse)',
                    onclick: function () {
                        loadbuildinggradestructuralmonthlyAll(year)
                        $('#s2id_month').hide()
                    }
                },
                BuildingButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#f26e27',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Building',
                    onclick: function () {
                        loadbuildinggradestructuralBuildingAll(month, year)
                    }
                },
                WeekButton: {
                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#d53d2a',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Week',
                    onclick: function () {
                        loadbuildinggradestructuralAllmonthlytoweekly(month, year)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingName = event.point.name
                        var week = $('#sanitationbuildingweektextbox').val('0');
                        $('#sanitationbuildingtextbox').val(buildingName);
                        loadbuildinggradestructuralweeklyAll(month, year, buildingName)
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Production and Warehouse Grades",
            colorByPoint: true,
            data: sanitationbuilding
        }]
    });
};


function loadbuildinggradestructuralweeklyAll(month, year, buildingName) {

    $.ajax({
        url: 'Report/dashboard_data_buildingstructural_weeklyAll.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            building: buildingName,
            year: year
        },
        success: function (response) {
            var sanitationbuildingweekly = response['data'];
            StructuralBuildingWeeklyAll(sanitationbuildingweekly, month, year, buildingName);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function StructuralBuildingWeeklyAll(sanitationbuildingweekly, month, year, buildingname) {

    Highcharts.chart('StructuralBuildingGrade', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month
        },
        subtitle: {
            text: 'Production and Warehouse > ' + month + ' ' + year + ' > ' + buildingname
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Building Grade',
                    onclick: function () {
                        loadbuildinggradestructuralBuildingAll(month, year)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingWeek = event.point.name
                        week = buildingWeek.substring(5, 6);
                        buildingName = $('#sanitationbuildingtextbox').val();
                        $('#sanitationbuildingweektextbox').val(week);
                        loadbuildinggradestructuralweeklyAll_phase(month, year, buildingName, week)

                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Weekly Grades",
            colorByPoint: true,
            data: sanitationbuildingweekly
        }]
    });
};


function loadbuildinggradestructuralAll(month, year, week) {

    $.ajax({
        url: 'Report/dashboard_data_buildingstructuralAll.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            week: week,
            year: year
        },
        success: function (response) {
            var structuralbuilding = response['data'];

            StructuralBuildingAll(structuralbuilding, month, year, week);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function StructuralBuildingAll(structuralbuilding, month, year, week) {

    Highcharts.chart('StructuralBuildingGrade', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month + ' ' + year
        },
        subtitle: {
            text: 'Production and Warehouse > ' + month + ' ' + year + ' > Week: ' + week
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Weekly Depot Structural Grade (Production and Warehouse)',
                    onclick: function () {
                        loadbuildinggradestructuralAllmonthlytoweekly(month, year)
                        $('#s2id_month').hide()
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingName = event.point.name
                        loadbuildinggradestructuralweeklyAll_phase(month, year, buildingName, week)

                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Production and Warehouse Grades",
            colorByPoint: true,
            data: structuralbuilding
        }]
    });
};

function loadbuildinggradestructuralweeklyAll_phase(month, year, buildingName, week) {

    $.ajax({
        url: 'Report/dashboard_data_buildingstructuralAll_weekly_phase.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            year: year,
            building: buildingName,
            week: week
        },
        success: function (response) {
            var structuralbuildingweekly = response['data'];
            StructuralBuildingWeeklyAll_phase(structuralbuildingweekly, month, year, week, buildingName);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function StructuralBuildingWeeklyAll_phase(structuralbuildingweekly, month, year, week, buildingname) {

    Highcharts.chart('StructuralBuildingGrade', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month
        },
        subtitle: {
            text: 'Production and Warehouse > ' + month + ' ' + year + ' > ' + buildingname + ' > ' + 'Week ' + week
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Weekly Building Grade',
                    onclick: function () {
                        loadbuildinggradestructuralAll(month, year, week)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var phase = event.point.name
                        // alert(phase)
                        $('#structuralphaseweektextbox').val(phase);
                        loadbuildinggradestructuralweeklyAll_area(month, year, buildingname, week, phase)

                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Weekly Grades",
            colorByPoint: true,
            data: structuralbuildingweekly
        }]
    });
};

function loadbuildinggradestructuralweeklyAll_area(month, year, buildingName, week, phase) {

    $.ajax({
        url: 'Report/dashboard_data_buildingstructural_weekly_area.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            year: year,
            building: buildingName,
            week: week,
            phase: phase
        },
        success: function (response) {
            var structuralbuildingweekly = response['data'];
            var structuralbuildingweeklyareaWeight = response['dataWeight'];
            StructuralBuildingWeeklyAll_area(structuralbuildingweekly, month, year, structuralbuildingweeklyareaWeight, buildingName, phase, week);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function StructuralBuildingWeeklyAll_area(structuralbuildingweekly, month, year, structuralbuildingweeklyareaWeight, buildingName, phase, week) {

    Highcharts.chart('StructuralBuildingGrade', {
        chart: {
            type: 'areaspline'
        },
        title: {
            text: 'Month of ' + month + ' Week ' + week
        },
        subtitle: {
            text: 'Production and Warehouse > ' + month + ' ' + year + ' > ' + buildingName + ' > ' + 'Week ' + week + ' > ' + phase
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Weekly Phase Grade',
                    onclick: function () {
                        loadbuildinggradestructuralweeklyAll_phase(month, year, buildingName, week)
                    }
                }
            }
        },
        legend: {
            enabled: true,
            y: -40,
            bubbleLegend: {
                enabled: true,
                borderWidth: 2,
                ranges: [{
                    borderColor: '#1aadce',
                    connectorColor: '#1aadce'
                }, {
                    borderColor: '#0d233a',
                    connectorColor: '#0d233a'
                }, {
                    borderColor: '#f28f43',
                    connectorColor: '#f28f43'
                }]
            }
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingWeek = event.point.name
                        area = buildingWeek;
                        loadbuildinggradestructuralweeklyAll_checklist(month, year, buildingName, week, area, phase)

                        $('#SaniAreaGrade').hide()
                        $('#SaniChecklistGrade').show()
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/> <span style="color:{point.color}"><b>QA Staff:</b>{point.QA}</span><br/> <span style="color:{point.color}"><b>Protech:</b>{point.Protech}</span>',
        },


        series: [{
                name: "Weekly Area Grades",
                colorByPoint: false,
                data: structuralbuildingweekly
            },
            {
                name: "Area Distribution",
                type: 'spline',
                colorByPoint: false,
                data: structuralbuildingweeklyareaWeight,
                tooltip: {
                    valueSuffix: '°C'
                }
            }
        ]
    });
};

function loadbuildinggradestructuralweeklyAll_checklist(month, year, buildingName, week, area, phase) {

    $.ajax({
        url: 'Report/dashboard_data_buildingstructural_weekly_checklist.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            year: year,
            building: buildingName,
            week: week,
            phase: phase,
            area: area
        },
        success: function (response) {
            var structuralbuildingweekly = response['data'];
            StructuralBuildingWeeklyAll_checklist(structuralbuildingweekly, month, year, buildingName, week, area, phase);
            // console.log(structuralbuildingweekly);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function StructuralBuildingWeeklyAll_checklist(structuralbuildingweekly, month, year, buildingname, week, area, phase) {

    Highcharts.chart('StructuralBuildingGrade', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month + ' Week ' + week
        },
        subtitle: {
            text: 'Production and Warehouse > ' + month + ' ' + year + ' > ' + buildingname + ' > ' + 'Week ' + week + ' > ' + phase + ' > ' + area
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Weekly Area Grade',
                    onclick: function () {
                        loadbuildinggradestructuralweeklyAll_area(month, year, buildingname, week, phase, area)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/> <span style="color:{point.color}"><b>QA Staff:</b>{point.QA}</span><br/> <span style="color:{point.color}"><b>Protech:</b>{point.Protech}</span>',
        },


        series: [{
            name: "Weekly Checklist Grade",
            colorByPoint: false,
            data: structuralbuildingweekly
        }]
    });
};

// Production Equipment 
// Production Equipment
function loadbuildinggradeequipmentmonthly(val) {

    $.ajax({
        url: 'Report/dashboard_data_buildingequipmentmonthly.php',
        type: 'POST',
        dataType: "json",
        data: {
            year: val
        },
        success: function (response) {
            var equipmentbuilding = response['data'];

            EquipmentBuildingmonthly(equipmentbuilding, val);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
};

function EquipmentBuildingmonthly(equipmentbuilding, year) {

    // Create the chart
    Highcharts.chart('EquipmentBuildingGrade', {
        chart: {
            type: 'area'

        },
        title: {
            text: 'Depot Equipment Monthly Grade (Production)'
        },
        subtitle: {
            text: 'Production ' + year
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {

            buttons: {
                BackButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#fec539',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Production',
                    onclick: function () {
                        loadbuildinggradeequipmentmonthly(year)
                    }
                },
                FrontButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#0088cc69',
                        r: 10,
                        states: {
                            hover: {
                                fill: '#7cb5ec'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#0088cc69'
                            }
                        }
                    },
                    text: 'Warehouse',
                    onclick: function () {
                        loadbuildinggradeequipmentmonthlyWarehouse(year)
                    }
                },
                SideButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#358835b5',
                        r: 10,
                        states: {
                            hover: {
                                fill: '#35883582'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#358835b5'
                            }
                        }
                    },
                    text: 'All',
                    onclick: function () {
                        loadbuildinggradeequipmentmonthlyAll(year)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var month = event.point.name
                        loadbuildinggradeequipmentmonthlytoweekly(month, year)
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            },
            area: {
                stacking: 'normal',
                lineColor: '#666666',
                lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Depot Monthly Equipment Grades (Production)",
            colorByPoint: false,
            fill: '#666666',
            data: equipmentbuilding
        }]
    });
};

function loadbuildinggradeequipmentmonthlytoweekly(month, year) {

    $.ajax({
        url: 'Report/dashboard_data_buildingequipmentmonthlyweekly.php',
        type: 'POST',
        dataType: "json",
        data: {
            year: year,
            month: month
        },
        success: function (response) {
            var equipmentbuilding = response['data'];

            EquipmentBuildingmonthlytoweekly(equipmentbuilding, year, month);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
};

function EquipmentBuildingmonthlytoweekly(equipmentbuilding, year, month) {

    // Create the chart
    Highcharts.chart('EquipmentBuildingGrade', {
        chart: {
            type: 'column'

        },
        title: {
            text: 'Depot Equipment Weekly Grade (Production)'
        },
        subtitle: {
            text: 'Production ' + year
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Monthly Depot Grade (Production)',
                    onclick: function () {
                        loadbuildinggradeequipmentmonthly(year)
                        $('#s2id_month').hide()
                    }
                },
                BuildingButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#f26e27',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Building',
                    onclick: function () {
                        loadbuildinggradeequipmentBuilding(month, year)
                    }
                },
                WeekButton: {
                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#d53d2a',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Week',
                    onclick: function () {
                        loadbuildinggradeequipmentmonthlytoweekly(month, year)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingWeek = event.point.name
                        week = buildingWeek.substring(5, 6);
                        loadbuildinggradeequipment(month, year, week)
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            },
            area: {
                stacking: 'normal',
                lineColor: '#666666',
                lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Depot Monthly Equipment Grades (Production)",
            colorByPoint: false,
            fill: '#666666',
            data: equipmentbuilding
        }]
    });
};

function loadbuildinggradeequipmentBuilding(month, year) {


    $.ajax({
        url: 'Report/dashboard_data_buildingequipmentBuilding.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            year: year
        },
        success: function (response) {
            var sanitationbuilding = response['data'];

            EquipmentBuildingBuilding(sanitationbuilding, month, year);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
};

function EquipmentBuildingBuilding(sanitationbuilding, month, year) {

    // Create the chart
    Highcharts.chart('EquipmentBuildingGrade', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Depot Equipment Weekly Grade (Production)'
        },
        subtitle: {
            text: 'Production ' + year
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Monthly Grade (Production)',
                    onclick: function () {
                        loadbuildinggradeequipmentmonthly(year)
                        $('#s2id_month').hide()
                    }
                },
                BuildingButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#f26e27',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Building',
                    onclick: function () {
                        loadbuildinggradeequipmentBuilding(month, year)
                    }
                },
                WeekButton: {
                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#d53d2a',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Week',
                    onclick: function () {
                        loadbuildinggradeequipmentmonthlytoweekly(month, year)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingName = event.point.name
                        var week = $('#sanitationbuildingweektextbox').val('0');
                        $('#sanitationbuildingtextbox').val(buildingName);
                        loadbuildinggradeequipmentweekly(month, year, buildingName)
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Production Grades",
            colorByPoint: true,
            data: sanitationbuilding
        }]
    });
};


function loadbuildinggradeequipmentweekly(month, year, buildingName) {
    $.ajax({
        url: 'Report/dashboard_data_buildingequipment_weekly.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            building: buildingName,
            year: year
        },
        success: function (response) {
            var sanitationbuildingweekly = response['data'];
            EquipmentBuildingWeekly(sanitationbuildingweekly, month, year, buildingName);
            console.log(response)
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function EquipmentBuildingWeekly(sanitationbuildingweekly, month, year, buildingname) {

    Highcharts.chart('EquipmentBuildingGrade', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month
        },
        subtitle: {
            text: 'Production > ' + month + ' ' + year + ' > ' + buildingname
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Building Grade',
                    onclick: function () {
                        loadbuildinggradeequipmentBuilding(month, year)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingWeek = event.point.name
                        week = buildingWeek.substring(5, 6);
                        buildingName = $('#sanitationbuildingtextbox').val();
                        $('#sanitationbuildingweektextbox').val(week);
                        loadbuildinggradeequipmentweekly_phase(month, year, buildingName, week)

                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Weekly Grades",
            colorByPoint: true,
            data: sanitationbuildingweekly
        }]
    });
};

function loadbuildinggradeequipment(month, year, week) {


    $.ajax({
        url: 'Report/dashboard_data_buildingequipment.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            week: week,
            year: year
        },
        success: function (response) {
            var equipmentbuilding = response['data'];

            EquipmentBuilding(equipmentbuilding, month, year, week);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
};

function EquipmentBuilding(equipmentbuilding, month, year, week) {

    // Create the chart
    Highcharts.chart('EquipmentBuildingGrade', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month + ' ' + year
        },
        subtitle: {
            text: 'Production > ' + month + ' ' + year + ' > Week: ' + week
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Weekly Depot Grade (Production)',
                    onclick: function () {
                        loadbuildinggradeequipmentmonthlytoweekly(month, year)
                        $('#s2id_month').hide()
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingName = event.point.name
                        loadbuildinggradeequipmentweekly_phase(month, year, buildingName, week)
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Production Grades",
            colorByPoint: true,
            data: equipmentbuilding
        }]
    });
};

function loadbuildinggradeequipmentweekly_phase(month, year, buildingName, week) {


    $.ajax({
        url: 'Report/dashboard_data_buildingequipment_weekly_phase.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            year: year,
            building: buildingName,
            week: week
        },
        success: function (response) {
            var equipmentbuildingweekly = response['data'];
            EquipmentBuildingWeekly_phase(equipmentbuildingweekly, month, year, buildingName, week);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function EquipmentBuildingWeekly_phase(equipmentbuildingweekly, month, year, buildingName, week) {

    Highcharts.chart('EquipmentBuildingGrade', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month
        },
        subtitle: {
            text: 'Production > ' + month + ' ' + year + ' > ' + buildingName + ' > ' + 'Week ' + week
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Weekly Building Grade',
                    onclick: function () {
                        loadbuildinggradeequipment(month, year, week)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var phase = event.point.name
                        loadbuildinggradeequipmentweekly_area(month, year, buildingName, week, phase)

                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Weekly Grades",
            colorByPoint: true,
            data: equipmentbuildingweekly
        }]
    });
};

function loadbuildinggradeequipmentweekly_area(month, year, buildingName, week, phase) {

    $.ajax({
        url: 'Report/dashboard_data_buildingequipment_weekly_area.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            year: year,
            building: buildingName,
            week: week,
            phase: phase
        },
        success: function (response) {
            var equipmentbuildingweekly = response['data'];
            var equipmentbuildingweeklyareaWeight = response['areaWeight'];
            EquipmentBuildingWeekly_area(equipmentbuildingweekly, month, year, equipmentbuildingweeklyareaWeight, buildingName, phase);
            console.log(response)

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function EquipmentBuildingWeekly_area(equipmentbuildingweekly, month, year, equipmentbuildingweeklyareaWeight, buildingName, phase) {

    Highcharts.chart('EquipmentBuildingGrade', {
        chart: {
            type: 'areaspline'
        },
        title: {
            text: 'Month of ' + month + ' Week ' + week
        },
        subtitle: {
            text: 'Production > ' + month + ' ' + year + ' > ' + buildingName + ' > ' + 'Week ' + week + ' > ' + phase
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Weekly Phase Grade',
                    onclick: function () {
                        loadbuildinggradeequipmentweekly_phase(month, year, buildingName, week)
                    }
                }
            }
        },
        legend: {
            enabled: true,
            y: -40,
            bubbleLegend: {
                enabled: true,
                borderWidth: 2,
                ranges: [{
                    borderColor: '#1aadce',
                    connectorColor: '#1aadce'
                }, {
                    borderColor: '#0d233a',
                    connectorColor: '#0d233a'
                }, {
                    borderColor: '#f28f43',
                    connectorColor: '#f28f43'
                }]
            }
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingWeek = event.point.name
                        area = buildingWeek;
                        loadbuildinggradeequipmentweekly_checklist(month, year, buildingName, week, area, phase)

                        // $('#SaniAreaGrade').hide()
                        // $('#SaniChecklistGrade').show()
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/> <span style="color:{point.color}"><b>QA Staff:</b>{point.QA}</span><br/> <span style="color:{point.color}"><b>Protech:</b>{point.Protech}</span>',
        },


        series: [{
                name: "Weekly Area Grades",
                colorByPoint: false,
                data: equipmentbuildingweekly
            },
            {
                name: "Area Distribution",
                type: 'spline',
                colorByPoint: false,
                data: equipmentbuildingweeklyareaWeight,
                tooltip: {
                    valueSuffix: '%'
                }
            }
        ]
    });
};

function loadbuildinggradeequipmentweekly_checklist(month, year, buildingName, week, area, phase) {

    $.ajax({
        url: 'Report/dashboard_data_buildingequipment_weekly_checklist.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            year: year,
            building: buildingName,
            week: week,
            phase: phase,
            area: area
        },
        success: function (response) {
            var equipmentbuildingweekly = response['data'];
            EquipmentBuildingWeekly_checklist(equipmentbuildingweekly, month, year, buildingName, week, area, phase);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function EquipmentBuildingWeekly_checklist(equipmentbuildingweekly, month, year, buildingname, week, area, phase) {

    Highcharts.chart('EquipmentBuildingGrade', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month + ' Week ' + week
        },
        subtitle: {
            text: 'Production > ' + month + ' ' + year + ' > ' + buildingname + ' > ' + 'Week ' + week + ' > ' + phase + ' > ' + area
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Weekly Area Grade',
                    onclick: function () {
                        loadbuildinggradeequipmentweekly_area(month, year, buildingname, week, phase, area)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/> <span style="color:{point.color}"><b>QA Staff:</b>{point.QA}</span><br/> <span style="color:{point.color}"><b>Protech:</b>{point.Protech}</span>',
        },


        series: [{
            name: "Weekly Checklist Grade",
            colorByPoint: false,
            data: equipmentbuildingweekly
        }]
    });
};



// Warehouse Equipment
function loadbuildinggradeequipmentmonthlyWarehouse(year) {


    $.ajax({
        url: 'Report/dashboard_data_buildingequipmentmonthlyWarehouse.php',
        type: 'POST',
        dataType: "json",
        data: {
            year: year
        },
        success: function (response) {
            var equipmentbuilding = response['data'];

            EquipmentBuildingmonthlyWarehouse(equipmentbuilding, year);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function EquipmentBuildingmonthlyWarehouse(equipmentbuilding, year) {

    // Create the chart
    Highcharts.chart('EquipmentBuildingGrade', {
        chart: {
            type: 'area'
        },
        title: {
            text: 'Depot Equipment Monthly Grade (Warehouse)'
        },
        subtitle: {
            text: 'Warehouse ' + year
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {

            buttons: {
                BackButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Production',
                    onclick: function () {
                        loadbuildinggradeequipmentmonthly(year)
                    }
                },
                FrontButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#0088cc69',
                        r: 10,
                        fill: '#0088cc69',
                        states: {
                            hover: {
                                fill: '#7cb5ec'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#0088cc69'
                            }
                        }
                    },
                    text: 'Warehouse',
                    onclick: function () {
                        loadbuildinggradeequipmentmonthlyWarehouse(year)
                    }
                },
                SideButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#358835b5',
                        r: 10,
                        states: {
                            hover: {
                                fill: '#35883582'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#358835b5'
                            }
                        }
                    },
                    text: 'All',
                    onclick: function () {
                        loadbuildinggradeequipmentmonthlyAll(year)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var month = event.point.name
                        loadbuildinggradeequipmentWarehousemonthlytoweekly(month, year)
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            },
            area: {
                stacking: 'normal',
                lineColor: '#666666',
                lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Depot Monthly Equipment Grades (Warehouse)",
            colorByPoint: false,
            data: equipmentbuilding,
        }]
    });
};

function loadbuildinggradeequipmentWarehousemonthlytoweekly(month, year) {

    $.ajax({
        url: 'Report/dashboard_data_buildingequipmentWarehousemonthlyweekly.php',
        type: 'POST',
        dataType: "json",
        data: {
            year: year,
            month: month
        },
        success: function (response) {
            var equipmentbuilding = response['data'];

            EquipmentBuildingWarehousemonthlytoweekly(equipmentbuilding, year, month);
            console.log(response)
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
};

function EquipmentBuildingWarehousemonthlytoweekly(equipmentbuilding, year, month) {

    // Create the chart
    Highcharts.chart('EquipmentBuildingGrade', {
        chart: {
            type: 'column'

        },
        title: {
            text: 'Depot Equipment Weekly Grade (Warehouse)'
        },
        subtitle: {
            text: 'Warehouse ' + year
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Monthly Depot Equipment Grade (Warehouse)',
                    onclick: function () {
                        loadbuildinggradeequipmentmonthlyWarehouse(year)
                        $('#s2id_month').hide()
                    }
                },
                BuildingButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#f26e27',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Building',
                    onclick: function () {
                        loadbuildinggradeequipmentBuildingWarehouse(month, year)
                    }
                },
                WeekButton: {
                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#d53d2a',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Week',
                    onclick: function () {
                        loadbuildinggradeequipmentWarehousemonthlytoweekly(month, year)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingWeek = event.point.name
                        week = buildingWeek.substring(5, 6);
                        loadbuildinggradeequipmentWarehouse(month, year, week)
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            },
            area: {
                stacking: 'normal',
                lineColor: '#666666',
                lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Depot Monthly Equipment Grades (Warehouse)",
            colorByPoint: false,
            fill: '#666666',
            data: equipmentbuilding
        }]
    });
};


function loadbuildinggradeequipmentBuildingWarehouse(month, year) {


    $.ajax({
        url: 'Report/dashboard_data_buildingequipmentBuildingWarehouse.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            year: year
        },
        success: function (response) {
            var sanitationbuilding = response['data'];

            EquipmentBuildingBuildingWarehouse(sanitationbuilding, month, year);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
};

function EquipmentBuildingBuildingWarehouse(sanitationbuilding, month, year) {

    // Create the chart
    Highcharts.chart('EquipmentBuildingGrade', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Depot Equipment Weekly Grade (Warehouse)'
        },
        subtitle: {
            text: 'Warehouse ' + year
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Monthly Grade (Warehouse)',
                    onclick: function () {
                        loadbuildinggradeequipmentmonthlyWarehouse(year)
                        $('#s2id_month').hide()
                    }
                },
                BuildingButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#f26e27',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Building',
                    onclick: function () {
                        loadbuildinggradeequipmentBuildingWarehouse(month, year)
                    }
                },
                WeekButton: {
                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#d53d2a',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Week',
                    onclick: function () {
                        loadbuildinggradeequipmentWarehousemonthlytoweekly(month, year)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingName = event.point.name
                        var week = $('#sanitationbuildingweektextbox').val('0');
                        $('#sanitationbuildingtextbox').val(buildingName);
                        loadbuildinggradeequipmentweeklyWarehouse(month, year, buildingName)
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Warehouse Grades",
            colorByPoint: true,
            data: sanitationbuilding
        }]
    });
};


function loadbuildinggradeequipmentweeklyWarehouse(month, year, buildingName) {

    $.ajax({
        url: 'Report/dashboard_data_buildingequipment_weeklyWarehouse.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            building: buildingName,
            year: year
        },
        success: function (response) {
            var sanitationbuildingweekly = response['data'];
            EquipmentBuildingWeeklyWarehouse(sanitationbuildingweekly, month, year, buildingName);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function EquipmentBuildingWeeklyWarehouse(sanitationbuildingweekly, month, year, buildingname) {

    Highcharts.chart('EquipmentBuildingGrade', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month
        },
        subtitle: {
            text: 'Warehouse > ' + month + ' ' + year + ' > ' + buildingname
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Building Grade',
                    onclick: function () {
                        loadbuildinggradeequipmentBuildingWarehouse(month, year)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingWeek = event.point.name
                        week = buildingWeek.substring(5, 6);
                        buildingName = $('#sanitationbuildingtextbox').val();
                        $('#sanitationbuildingweektextbox').val(week);
                        loadbuildinggradeequipmentweeklyWarehouse_phase(month, year, buildingName, week)

                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Weekly Grades",
            colorByPoint: true,
            data: sanitationbuildingweekly
        }]
    });
};

function loadbuildinggradeequipmentWarehouse(month, year, week) {

    $.ajax({
        url: 'Report/dashboard_data_buildingequipmentWarehouse.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            week: week,
            year: year
        },
        success: function (response) {
            var equipmentbuilding = response['data'];

            EquipmentBuildingWarehouse(equipmentbuilding, month, year, week);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function EquipmentBuildingWarehouse(equipmentbuilding, month, year, week) {

    Highcharts.chart('EquipmentBuildingGrade', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month + ' ' + year
        },
        subtitle: {
            text: 'Warehouse > ' + month + ' ' + year + ' > Week: ' + week
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Weekly Depot Equipment Grade (Warehouse)',
                    onclick: function () {
                        loadbuildinggradeequipmentWarehousemonthlytoweekly(month, year)
                        $('#s2id_month').hide()
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingName = event.point.name
                        loadbuildinggradeequipmentweeklyWarehouse_phase(month, year, buildingName, week)

                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Warehouse Grades",
            colorByPoint: true,
            data: equipmentbuilding
        }]
    });
};

function loadbuildinggradeequipmentweeklyWarehouse_phase(month, year, buildingName, week) {

    $.ajax({
        url: 'Report/dashboard_data_buildingequipmentWarehouse_weekly_phase.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            year: year,
            building: buildingName,
            week: week
        },
        success: function (response) {
            var equipmentbuildingweekly = response['data'];
            EquipmentBuildingWeeklyWarehouse_phase(equipmentbuildingweekly, month, year, week, buildingName);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function EquipmentBuildingWeeklyWarehouse_phase(equipmentbuildingweekly, month, year, week, buildingname) {

    Highcharts.chart('EquipmentBuildingGrade', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month
        },
        subtitle: {
            text: 'Warehouse > ' + month + ' ' + year + ' > ' + buildingname + ' > ' + 'Week ' + week
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Weekly Building Grade',
                    onclick: function () {
                        loadbuildinggradeequipmentWarehouse(month, year, week)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var phase = event.point.name
                        // alert(phase)
                        $('#equipmentphaseweektextbox').val(phase);
                        loadbuildinggradeequipmentweeklyWarehouse_area(month, year, buildingname, week, phase)

                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Weekly Grades",
            colorByPoint: true,
            data: equipmentbuildingweekly
        }]
    });
};

function loadbuildinggradeequipmentweeklyWarehouse_area(month, year, buildingName, week, phase) {

    $.ajax({
        url: 'Report/dashboard_data_buildingequipment_weekly_area.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            year: year,
            building: buildingName,
            week: week,
            phase: phase
        },
        success: function (response) {
            var equipmentbuildingweekly = response['data'];
            var equipmentbuildingweeklyareaWeight = response['areaWeight'];
            EquipmentBuildingWeeklyWarehouse_area(equipmentbuildingweekly, month, year, equipmentbuildingweeklyareaWeight, buildingName, phase, week);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function EquipmentBuildingWeeklyWarehouse_area(equipmentbuildingweekly, month, year, equipmentbuildingweeklyareaWeight, buildingName, phase, week) {

    Highcharts.chart('EquipmentBuildingGrade', {
        chart: {
            type: 'areaspline'
        },
        title: {
            text: 'Month of ' + month + ' Week ' + week
        },
        subtitle: {
            text: 'Warehouse > ' + month + ' ' + year + ' > ' + buildingName + ' > ' + 'Week ' + week + ' > ' + phase
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Weekly Phase Grade',
                    onclick: function () {
                        loadbuildinggradeequipmentweeklyWarehouse_phase(month, year, buildingName, week)
                    }
                }
            }
        },
        legend: {
            enabled: true,
            y: -40,
            bubbleLegend: {
                enabled: true,
                borderWidth: 2,
                ranges: [{
                    borderColor: '#1aadce',
                    connectorColor: '#1aadce'
                }, {
                    borderColor: '#0d233a',
                    connectorColor: '#0d233a'
                }, {
                    borderColor: '#f28f43',
                    connectorColor: '#f28f43'
                }]
            }
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingWeek = event.point.name
                        area = buildingWeek;
                        loadbuildinggradeequipmentweeklyWarehouse_checklist(month, year, buildingName, week, area, phase)

                        $('#SaniAreaGrade').hide()
                        $('#SaniChecklistGrade').show()
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/> <span style="color:{point.color}"><b>QA Staff:</b>{point.QA}</span><br/> <span style="color:{point.color}"><b>Protech:</b>{point.Protech}</span>',
        },


        series: [{
                name: "Weekly Area Grades",
                colorByPoint: false,
                data: equipmentbuildingweekly
            },
            {
                name: "Area Distribution",
                type: 'spline',
                colorByPoint: false,
                data: equipmentbuildingweeklyareaWeight,
                tooltip: {
                    valueSuffix: '°C'
                }
            }
        ]
    });
};

function loadbuildinggradeequipmentweeklyWarehouse_checklist(month, year, buildingName, week, area, phase) {

    $.ajax({
        url: 'Report/dashboard_data_buildingequipment_weekly_checklist.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            year: year,
            building: buildingName,
            week: week,
            phase: phase,
            area: area
        },
        success: function (response) {
            var equipmentbuildingweekly = response['data'];
            EquipmentBuildingWeeklyWarehouse_checklist(equipmentbuildingweekly, month, year, buildingName, week, area, phase);
            // console.log(equipmentbuildingweekly);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function EquipmentBuildingWeeklyWarehouse_checklist(equipmentbuildingweekly, month, year, buildingname, week, area, phase) {

    Highcharts.chart('EquipmentBuildingGrade', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month + ' Week ' + week
        },
        subtitle: {
            text: 'Warehouse > ' + month + ' ' + year + ' > ' + buildingname + ' > ' + 'Week ' + week + ' > ' + phase + ' > ' + area
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Weekly Area Grade',
                    onclick: function () {
                        loadbuildinggradeequipmentweeklyWarehouse_area(month, year, buildingname, week, phase, area)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/> <span style="color:{point.color}"><b>QA Staff:</b>{point.QA}</span><br/> <span style="color:{point.color}"><b>Protech:</b>{point.Protech}</span>',
        },


        series: [{
            name: "Weekly Checklist Grade",
            colorByPoint: false,
            data: equipmentbuildingweekly
        }]
    });
};


// All Equipment
function loadbuildinggradeequipmentmonthlyAll(year) {


    $.ajax({
        url: 'Report/dashboard_data_buildingequipmentmonthlyAll.php',
        type: 'POST',
        dataType: "json",
        data: {
            year: year
        },
        success: function (response) {
            var equipmentbuilding = response['data'];

            EquipmentBuildingmonthlyAll(equipmentbuilding, year);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function EquipmentBuildingmonthlyAll(equipmentbuilding, year) {

    // Create the chart
    Highcharts.chart('EquipmentBuildingGrade', {
        chart: {
            type: 'area'
        },
        title: {
            text: 'Depot Equipment Monthly Grade (All)'
        },
        subtitle: {
            text: 'Production and Warehouse ' + year
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {

            buttons: {
                BackButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Production',
                    onclick: function () {
                        loadbuildinggradeequipmentmonthly(year)
                    }
                },
                FrontButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#0088cc69',
                        r: 10,
                        states: {
                            hover: {
                                fill: '#7cb5ec'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#0088cc69'
                            }
                        }
                    },
                    text: 'Warehouse',
                    onclick: function () {
                        loadbuildinggradeequipmentmonthlyWarehouse(year)
                    }
                },
                SideButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#358835b5',
                        r: 10,
                        fill: '#358835b5',
                        states: {
                            hover: {
                                fill: '#35883582'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#358835b5'
                            }
                        }
                    },
                    text: 'All',
                    onclick: function () {
                        loadbuildinggradeequipmentmonthlyAll(year)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var month = event.point.name
                        loadbuildinggradeequipmentAllmonthlytoweekly(month, year)
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            },
            area: {
                stacking: 'normal',
                lineColor: '#666666',
                lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Depot Monthly Equipment Grades (Warehouse)",
            colorByPoint: false,
            data: equipmentbuilding,
        }]
    });
};

function loadbuildinggradeequipmentAllmonthlytoweekly(month, year) {

    $.ajax({
        url: 'Report/dashboard_data_buildingequipmentAllmonthlyweekly.php',
        type: 'POST',
        dataType: "json",
        data: {
            year: year,
            month: month
        },
        success: function (response) {
            var equipmentbuilding = response['data'];

            EquipmentBuildingAllmonthlytoweekly(equipmentbuilding, year, month);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
};

function EquipmentBuildingAllmonthlytoweekly(equipmentbuilding, year, month) {

    // Create the chart
    Highcharts.chart('EquipmentBuildingGrade', {
        chart: {
            type: 'column'

        },
        title: {
            text: 'Depot Equipment Weekly Grade (Production and Warehouse)'
        },
        subtitle: {
            text: 'Production and Warehouse ' + year
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Monthly Depot Equipment Grade (Production and Warehouse )',
                    onclick: function () {
                        loadbuildinggradeequipmentmonthlyAll(year)
                        $('#s2id_month').hide()
                    }
                },
                BuildingButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#f26e27',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Building',
                    onclick: function () {
                        loadbuildinggradeequipmentBuildingAll(month, year)
                    }
                },
                WeekButton: {
                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#d53d2a',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Week',
                    onclick: function () {
                        loadbuildinggradeequipmentAllmonthlytoweekly(month, year)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingWeek = event.point.name
                        week = buildingWeek.substring(5, 6);
                        loadbuildinggradeequipmentAll(month, year, week)
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            },
            area: {
                stacking: 'normal',
                lineColor: '#666666',
                lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Depot Monthly Grades (Production and Warehouse )",
            colorByPoint: false,
            fill: '#666666',
            data: equipmentbuilding
        }]
    });
};


function loadbuildinggradeequipmentBuildingAll(month, year) {


    $.ajax({
        url: 'Report/dashboard_data_buildingequipmentBuildingAll.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            year: year
        },
        success: function (response) {
            var sanitationbuilding = response['data'];

            EquipmentBuildingBuildingAll(sanitationbuilding, month, year);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
};

function EquipmentBuildingBuildingAll(sanitationbuilding, month, year) {

    // Create the chart
    Highcharts.chart('EquipmentBuildingGrade', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Depot Equipment Weekly Grade (Production and Warehouse)'
        },
        subtitle: {
            text: 'Production and Warehouse ' + year
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Monthly Grade (Production and Warehouse)',
                    onclick: function () {
                        loadbuildinggradeequipmentmonthlyAll(year)
                        $('#s2id_month').hide()
                    }
                },
                BuildingButton: {

                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#f26e27',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Building',
                    onclick: function () {
                        loadbuildinggradeequipmentBuildingAll(month, year)
                    }
                },
                WeekButton: {
                    theme: {
                        'stroke-width': 0,
                        stroke: '#f26e27',
                        r: 10,
                        fill: '#d53d2a',
                        states: {
                            hover: {
                                fill: '#fec539'
                            },
                            select: {
                                stroke: '#039',
                                fill: '#fec539'
                            }
                        }
                    },
                    text: 'Week',
                    onclick: function () {
                        loadbuildinggradeequipmentAllmonthlytoweekly(month, year)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingName = event.point.name
                        var week = $('#sanitationbuildingweektextbox').val('0');
                        $('#sanitationbuildingtextbox').val(buildingName);
                        loadbuildinggradeequipmentweeklyAll(month, year, buildingName)
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Production and Warehouse Grades",
            colorByPoint: true,
            data: sanitationbuilding
        }]
    });
};


function loadbuildinggradeequipmentweeklyAll(month, year, buildingName) {

    $.ajax({
        url: 'Report/dashboard_data_buildingequipment_weeklyAll.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            building: buildingName,
            year: year
        },
        success: function (response) {
            var sanitationbuildingweekly = response['data'];
            EquipmentBuildingWeeklyAll(sanitationbuildingweekly, month, year, buildingName);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function EquipmentBuildingWeeklyAll(sanitationbuildingweekly, month, year, buildingname) {

    Highcharts.chart('EquipmentBuildingGrade', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month
        },
        subtitle: {
            text: 'Production and Warehouse > ' + month + ' ' + year + ' > ' + buildingname
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Building Grade',
                    onclick: function () {
                        loadbuildinggradeequipmentBuildingAll(month, year)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingWeek = event.point.name
                        week = buildingWeek.substring(5, 6);
                        buildingName = $('#sanitationbuildingtextbox').val();
                        $('#sanitationbuildingweektextbox').val(week);
                        loadbuildinggradeequipmentweeklyAll_phase(month, year, buildingName, week)

                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Weekly Grades",
            colorByPoint: true,
            data: sanitationbuildingweekly
        }]
    });
};


function loadbuildinggradeequipmentAll(month, year, week) {

    $.ajax({
        url: 'Report/dashboard_data_buildingequipmentAll.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            week: week,
            year: year
        },
        success: function (response) {
            var equipmentbuilding = response['data'];

            EquipmentBuildingAll(equipmentbuilding, month, year, week);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function EquipmentBuildingAll(equipmentbuilding, month, year, week) {

    Highcharts.chart('EquipmentBuildingGrade', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month + ' ' + year
        },
        subtitle: {
            text: 'Production and Warehouse > ' + month + ' ' + year + ' > Week: ' + week
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Weekly Depot Equipment Grade (Production and Warehouse)',
                    onclick: function () {
                        loadbuildinggradeequipmentAllmonthlytoweekly(month, year)
                        $('#s2id_month').hide()
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingName = event.point.name
                        loadbuildinggradeequipmentweeklyAll_phase(month, year, buildingName, week)

                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Production and Warehouse Grades",
            colorByPoint: true,
            data: equipmentbuilding
        }]
    });
};

function loadbuildinggradeequipmentweeklyAll_phase(month, year, buildingName, week) {

    $.ajax({
        url: 'Report/dashboard_data_buildingequipmentAll_weekly_phase.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            year: year,
            building: buildingName,
            week: week
        },
        success: function (response) {
            var equipmentbuildingweekly = response['data'];
            EquipmentBuildingWeeklyAll_phase(equipmentbuildingweekly, month, year, week, buildingName);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function EquipmentBuildingWeeklyAll_phase(equipmentbuildingweekly, month, year, week, buildingname) {

    Highcharts.chart('EquipmentBuildingGrade', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month
        },
        subtitle: {
            text: 'Production and Warehouse > ' + month + ' ' + year + ' > ' + buildingname + ' > ' + 'Week ' + week
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Weekly Building Grade',
                    onclick: function () {
                        loadbuildinggradeequipmentAll(month, year, week)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var phase = event.point.name
                        // alert(phase)
                        $('#equipmentphaseweektextbox').val(phase);
                        loadbuildinggradeequipmentweeklyAll_area(month, year, buildingname, week, phase)

                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },


        series: [{
            name: "Weekly Grades",
            colorByPoint: true,
            data: equipmentbuildingweekly
        }]
    });
};

function loadbuildinggradeequipmentweeklyAll_area(month, year, buildingName, week, phase) {

    $.ajax({
        url: 'Report/dashboard_data_buildingequipment_weekly_area.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            year: year,
            building: buildingName,
            week: week,
            phase: phase
        },
        success: function (response) {
            var equipmentbuildingweekly = response['data'];
            var equipmentbuildingweeklyareaWeight = response['areaWeight'];
            EquipmentBuildingWeeklyAll_area(equipmentbuildingweekly, month, year, equipmentbuildingweeklyareaWeight, buildingName, phase, week);

        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function EquipmentBuildingWeeklyAll_area(equipmentbuildingweekly, month, year, equipmentbuildingweeklyareaWeight, buildingName, phase, week) {

    Highcharts.chart('EquipmentBuildingGrade', {
        chart: {
            type: 'areaspline'
        },
        title: {
            text: 'Month of ' + month + ' Week ' + week
        },
        subtitle: {
            text: 'Production and Warehouse > ' + month + ' ' + year + ' > ' + buildingName + ' > ' + 'Week ' + week + ' > ' + phase
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Weekly Phase Grade',
                    onclick: function () {
                        loadbuildinggradeequipmentweeklyAll_phase(month, year, buildingName, week)
                    }
                }
            }
        },
        legend: {
            enabled: true,
            y: -40,
            bubbleLegend: {
                enabled: true,
                borderWidth: 2,
                ranges: [{
                    borderColor: '#1aadce',
                    connectorColor: '#1aadce'
                }, {
                    borderColor: '#0d233a',
                    connectorColor: '#0d233a'
                }, {
                    borderColor: '#f28f43',
                    connectorColor: '#f28f43'
                }]
            }
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var buildingWeek = event.point.name
                        area = buildingWeek;
                        loadbuildinggradeequipmentweeklyAll_checklist(month, year, buildingName, week, area, phase)

                        $('#SaniAreaGrade').hide()
                        $('#SaniChecklistGrade').show()
                    }
                },
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/> <span style="color:{point.color}"><b>QA Staff:</b>{point.QA}</span><br/> <span style="color:{point.color}"><b>Protech:</b>{point.Protech}</span>',
        },


        series: [{
                name: "Weekly Area Grades",
                colorByPoint: false,
                data: equipmentbuildingweekly
            },
            {
                name: "Area Distribution",
                type: 'spline',
                colorByPoint: false,
                data: equipmentbuildingweeklyareaWeight,
                tooltip: {
                    valueSuffix: '°C'
                }
            }
        ]
    });
};

function loadbuildinggradeequipmentweeklyAll_checklist(month, year, buildingName, week, area, phase) {

    $.ajax({
        url: 'Report/dashboard_data_buildingequipment_weekly_checklist.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            year: year,
            building: buildingName,
            week: week,
            phase: phase,
            area: area
        },
        success: function (response) {
            var equipmentbuildingweekly = response['data'];
            EquipmentBuildingWeeklyAll_checklist(equipmentbuildingweekly, month, year, buildingName, week, area, phase);
            // console.log(equipmentbuildingweekly);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function EquipmentBuildingWeeklyAll_checklist(equipmentbuildingweekly, month, year, buildingname, week, area, phase) {

    Highcharts.chart('EquipmentBuildingGrade', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month + ' Week ' + week
        },
        subtitle: {
            text: 'Production and Warehouse > ' + month + ' ' + year + ' > ' + buildingname + ' > ' + 'Week ' + week + ' > ' + phase + ' > ' + area
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 100,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Weekly Area Grade',
                    onclick: function () {
                        loadbuildinggradeequipmentweeklyAll_area(month, year, buildingname, week, phase, area)
                    }
                }
            }
        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 1,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.2f}%'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/> <span style="color:{point.color}"><b>QA Staff:</b>{point.QA}</span><br/> <span style="color:{point.color}"><b>Protech:</b>{point.Protech}</span>',
        },


        series: [{
            name: "Weekly Checklist Grade",
            colorByPoint: false,
            data: equipmentbuildingweekly
        }]
    });
};





// Equipment Monitoring


function changeMontheqMonitoring(val) {

    loadbuildinggradeequipmentmonitoring(val);
}

function loadbuildinggradeequipmentmonitoring(val) {
    var month = $('#montheqmonitoring').val();
    var changemonth = val;
    if (changemonth == "undefined") {
        month = $('#montheqmonitoring').val();
    } else {
        changemonth = val;
    }
    $.ajax({
        url: 'Report/dashboard_data_buildingequipmentmonitoring.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month
        },
        success: function (response) {
            var buildingdata = response['categoriesdata'];
            // var buildingdatafunctional = response['categoriesdatafunctional'];
            // var buildingdata1stOffense = response['categoriesdata1stoffense'];
            // var buildingdataNonFunctional = response['categoriesdatanonfunctional'];
            // var buildingdataNotOnSite = response['categoriesdatanotonsite'];
            // var allbuilding = response['allbuilding'];
            EquipmentBuildingMonitoring(buildingdata, month);
            //  ;
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function EquipmentBuildingMonitoring(buildingdata, month) {
    // Create the chart
    Highcharts.chart('EquipmentBuildingMonitoring', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Month of ' + month
        },
        subtitle: {
            text: 'Equipment Monitoring'
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var EquipmentCategory = event.point.name
                        if (EquipmentCategory == "Not On Site") {
                            EquipmentCategory = "Not Onsight";

                        } else {
                            EquipmentCategory = event.point.name;
                        }

                        loadbuildinggradeequipmentmonitoringBuilding(month, EquipmentCategory)
                    }
                },
                dataLabels: {
                    enabled: true,
                    format: '{point.name}: {point.y:1f}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
        },

        series: [{
            name: "Equipment Distribution",
            colorByPoint: true,
            data: buildingdata
        }]
    });
};
// EquipmentCategory>Building
function loadbuildinggradeequipmentmonitoringBuilding(month, EquipmentCategory) {

    // alert(EquipmentCategory)
    var month = $('#montheqmonitoring').val();
    var changemonth = month;
    if (changemonth == "undefined") {
        month = $('#montheqmonitoring').val();
    } else {
        changemonth = month;
    }
    $.ajax({
        url: 'Report/dashboard_data_buildingequipmentmonitoringBuilding.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            EquipmentCategory: EquipmentCategory
        },
        success: function (response) {
            var buildingdata = response['categoriesdata'];
            EquipmentBuildingMonitoringBuilding(buildingdata, month, EquipmentCategory);
            //  ;
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function EquipmentBuildingMonitoringBuilding(buildingdata, month, Category) {
    // Create the chart
    Highcharts.chart('EquipmentBuildingMonitoring', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 30,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Category',
                    onclick: function () {
                        loadbuildinggradeequipmentmonitoring(month)
                    }
                }
            }
        },
        subtitle: {
            text: 'Category:<b>' + Category + '</b>'
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var Building = event.point.name
                        loadbuildinggradeequipmentmonitoringPhase(month, Category, Building)


                    }
                },
                dataLabels: {
                    enabled: true,
                    format: '{point.y:1f}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:1f}</b> of total<br/><b>{point.description}</b>'
        },

        series: [{
            name: "Equipment Distribution",
            colorByPoint: true,
            data: buildingdata
        }]
    });
};
// EquipmentCategory>Building>phase
function loadbuildinggradeequipmentmonitoringPhase(month, Category, Building) {

    // alert(EquipmentCategory)
    var month = $('#montheqmonitoring').val();
    var changemonth = month;
    if (changemonth == "undefined") {
        month = $('#montheqmonitoring').val();
    } else {
        changemonth = month;
    }
    $.ajax({
        url: 'Report/dashboard_data_buildingequipmentmonitoringPhase.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            Category: Category,
            Building: Building
        },
        success: function (response) {
            var phasedata = response['categoriesdata'];
            // var buildingdatafunctional = response['categoriesdatafunctional'];
            // var buildingdata1stOffense = response['categoriesdata1stoffense'];
            // var buildingdataNonFunctional = response['categoriesdatanonfunctional'];
            // var buildingdataNotOnSite = response['categoriesdatanotonsite'];
            // var allbuilding = response['allbuilding'];
            EquipmentBuildingMonitoringPhase(phasedata, month, Category, Building);
            //  ;
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function EquipmentBuildingMonitoringPhase(phasedata, month, Category, Building) {
    // Create the chart
    // alert(phasedata)
    Highcharts.chart('EquipmentBuildingMonitoring', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 30,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Building',
                    onclick: function () {
                        loadbuildinggradeequipmentmonitoringBuilding(month, Category)
                    }
                }
            }
        },
        subtitle: {
            text: 'Category:<b>' + Category + '</b>'
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var Phase = event.point.name
                        loadbuildinggradeequipmentmonitoringArea(month, Category, Phase, Building)


                    }
                },
                dataLabels: {
                    enabled: true,
                    format: '{point.y:1f}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:1f}</b> of total<br/><b>{point.description}</b>'
        },

        series: [{
            name: "Equipment Distribution",
            colorByPoint: true,
            data: phasedata
        }]
    });
};
// EquipmentCategory>Building>phase>area
function loadbuildinggradeequipmentmonitoringArea(month, Category, Phase, Building) {

    var month = $('#montheqmonitoring').val();
    var changemonth = month;
    if (changemonth == "undefined") {
        month = $('#montheqmonitoring').val();
    } else {
        changemonth = month;
    }
    $.ajax({
        url: 'Report/dashboard_data_buildingequipmentmonitoringArea.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            Category: Category,
            Phase: Phase
        },
        success: function (response) {
            var areadata = response['categoriesdata'];
            EquipmentBuildingMonitoringArea(areadata, month, Category, Building, Phase);
            //  ;
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function EquipmentBuildingMonitoringArea(areadata, month, Category, Building, Phase) {
    // Create the chart
    Highcharts.chart('EquipmentBuildingMonitoring', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 30,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Phase',
                    onclick: function () {
                        loadbuildinggradeequipmentmonitoringPhase(month, Category, Building)
                    }
                }
            }
        },
        subtitle: {
            text: 'Category:<b>' + Category + '</b>'
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var area = event.point.name
                        // alert(area)
                        loadbuildinggradeequipmentmonitoringEquipment(month, Category, Building, Phase, area)


                    }

                },
                dataLabels: {
                    enabled: true,
                    format: '{point.y:1f}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:1f}</b> of total<br/><b>{point.description}</b>'
        },

        series: [{
            name: "Equipment Distribution",
            colorByPoint: true,
            data: areadata
        }]
    });
};
// EquipmentCategory>Building>phase>area>equipment
function loadbuildinggradeequipmentmonitoringEquipment(month, Category, Building, Phase, area) {
    // alert(EquipmentCategory)
    var month = $('#montheqmonitoring').val();
    var changemonth = month;
    if (changemonth == "undefined") {
        month = $('#montheqmonitoring').val();
    } else {
        changemonth = month;
    }
    $.ajax({
        url: 'Report/dashboard_data_buildingequipmentmonitoringEquipment.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            Category: Category,
            Building: Building,
            Phase: Phase,
            area: area
        },
        success: function (response) {
            var equipdata = response['categoriesdata'];
            EquipmentBuildingMonitoringEquipment(equipdata, month, Category, Building, Phase, area);
            //  ;
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function EquipmentBuildingMonitoringEquipment(equipdata, month, Category, Building, Phase, area) {
    Highcharts.chart('EquipmentBuildingMonitoring', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Month of ' + month
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            min: 0,
            max: 30,
            title: {
                text: ''
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to Area',
                    onclick: function () {
                        loadbuildinggradeequipmentmonitoringArea(month, Category, Phase, Building)
                    }
                }
            }
        },
        subtitle: {
            text: 'Category:<b>' + Category + '</b>'
        },
        plotOptions: {
            series: {

                dataLabels: {
                    enabled: true,
                    format: '{point.y:1f}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:1f}</b> of total<br/><b>{point.description}</b><br>'
        },

        series: [{
            name: "Equipment Distribution",
            colorByPoint: true,
            data: equipdata
        }]
    });
};


// Phase Declined Monitoring
function changePhase(val) {

    var month = $("#monthphase").val();
    loadphaseddeclinedmonitoring(month, val)
}


function changeMonthphase(val) {
    var phase = $("#phase").val();
    loadphaseddeclinedmonitoring(val, phase);
}


function loadphaseddeclinedmonitoring(val) {

    var phase = $("#phase").val();

    var month = $('#monthphase').val();
    var changemonth = val;
    if (changemonth == "undefined") {
        month = $('#monthphase').val();
    } else {
        changemonth = val;
    }
    // alert(month)
    // alert(phase)
    $.ajax({
        url: 'Report/dashboard_data_phaseddeclinedmonitoring.php',
        type: 'POST',
        dataType: "json",
        data: {
            month: month,
            phase: phase
        },
        success: function (response) {
            var declineReason = response['data'];
            var phasename = response['phasename'];
            var Phaseweek = response['Phaseweek'];
            PhaseDeclinedMonitoring(declineReason, month, phasename);
            //  ;
        },
        error: function (xhr, ajaxOptions, thrownError) {
            // alert("Not yet Audittsed");
            // PhaseDeclinedMonitoring();
        }
    });
}


function PhaseDeclinedMonitoring(declineReason, month, phase) {
    // Create the chart
    Highcharts.chart('PhaseDeclineMonitoring', {
        chart: {
            type: 'pie'
        },
        title: {
            text: phase
        },
        subtitle: {
            text: 'Month of ' + month
        },
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                    format: '{point.name}: {point.y:1f}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:1f}</b> of total<br/><b>Week </b>{point.week}<br/><br/><b>QA Staff: </b>{point.qastaff}<br/><br/><b>Protech </b>{point.protech}<br/>'
        },

        series: [{
            name: "Phase Remarks",
            colorByPoint: true,
            data: declineReason
        }]

    });
};




// QA Monitoring

function changePhaseQA(phase) {
    var year = $('#selectYearQA').val()
    var month = $('#monthqa').val()
    loadqamonitoring(phase, month, year);
}

function changeMonthqa(month) {
    var year = $('#selectYearQA').val()
    var phase = $('#phaseQa').val()
    loadqamonitoring(phase, month, year);
}

function changeYearQA(year) {
    var month = $('#monthqa').val()
    var phase = $('#phaseQa').val()
    loadqamonitoring(phase, month, year);
}


function loadqamonitoring(phase, month, year) {

    $.ajax({
        url: 'Report/dashboard_data_qamonitoring.php',
        type: 'POST',
        dataType: "json",
        data: {
            phase: phase,
            month: month,
            year: year
        },
        success: function (response) {
            var qadata = response['categoriesdata'];
            QAMonitoring(qadata, month, year);
            console.log(response)
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}




function QAMonitoring(qadata, month, year) {
    // Create the chart
    Highcharts.chart('QAMonitoring2', {
        chart: {
            type: 'column'
        },
        title: {
            text: month
        },
        subtitle: {
            text: year
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'category'
            }

        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var qaname = event.point.name
                        // alert(qaname)
                        // loadqamonitoringPhase(month,qaname)

                    }
                },
                dataLabels: {
                    enabled: true,
                    format: '{point.name}: {point.y:1f}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span><br><b>Total Audit Duration: </b>{point.y:1f} Minutes<br/><b>Phase: </b>{point.Phase}<br/>'
        },

        series: [{
            name: "QA Minutes",
            colorByPoint: false,
            data: qadata
        }]

    });
};

// QA Performance

function changePhaseQAStaff(qa) {
    var year = $('#selectYearQAStaff').val()
    loadqamonitoringperformance(qa, year);
}

function changeYearQAStaff(year) {
    var qa = $('#phaseQastaff').val()
    loadqamonitoringperformance(qa, year);
}


function loadqamonitoringperformance(qa, year) {

    $.ajax({
        url: 'Report/dashboard_data_qamonitoringPerformance.php',
        type: 'POST',
        dataType: "json",
        data: {
            qa: qa,
            year: year
        },
        success: function (response) {
            var qadata = response['categoriesdata'];
            QAMonitoringPerformance(qadata, year, qa);
            console.log(response)
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function QAMonitoringPerformance(qadata, year, qa) {
    // Create the chart
    Highcharts.chart('QAMonitoringPerformance', {
        chart: {
            type: 'line'
        },
        title: {
            text: year
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'category'
            }

        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var month = event.point.name
                        loadqamonitoringperformancephases(year, month, qa)

                    }
                },
                dataLabels: {
                    enabled: true,
                    format: '{point.name}: {point.y:1f}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span><br><b>Total Audit Duration: </b>{point.y:1f} Minutes<br/><b>Phase: </b>{point.Phase}<br/>'
        },

        series: [{
            name: qa,
            colorByPoint: false,
            data: qadata
        }]

    });
};


function loadqamonitoringperformancephases(year, month, qa) {

    $.ajax({
        url: 'Report/dashboard_data_qamonitoringPerformancePhases.php',
        type: 'POST',
        dataType: "json",
        data: {
            qa: qa,
            month: month,
            year: year
        },
        success: function (response) {
            var qadata = response['categoriesdata'];
            QAMonitoringPerformancephases(qadata, year, month, qa);
            console.log(response)
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function QAMonitoringPerformancephases(qadata, year, month, qa) {
    // Create the chart
    Highcharts.chart('QAMonitoringPerformance', {
        chart: {
            type: 'column'
        },
        title: {
            text: month + ' ' + year
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'category'
            }

        },
        exporting: {
            buttons: {
                BackButton: {
                    text: 'Back to QA Monthly Performance',
                    onclick: function () {
                        loadqamonitoringperformance(qa, year)
                    }
                }
            }
        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var qaname = event.point.name
                        // loadqamonitoringPhase(month,qaname)

                    }
                },
                dataLabels: {
                    enabled: true,
                    format: '{point.name}: {point.y:1f}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span><br><b>Total Audit Duration: </b>{point.y:1f} Minutes<br/><b>Phase: </b>{point.Phase}<br/><b>Date: </b>{point.FullDate}<br/>'
        },

        series: [{
            name: qa,
            colorByPoint: true,
            data: qadata
        }]

    });
};


function changeMonthprotech(month) {
    var year = $('#selectYearProtech').val()
    var type = $('#selectTypeProtech').val()
    loadprotechmonitoringperformance(type, month, year);
}

function changeYearProtech(year) {
    var month = $('#monthprotech').val()
    var type = $('#selectTypeProtech').val()
    loadprotechmonitoringperformance(type, month, year);

}

function changeTypeProtech(type) {
    var month = $('#monthprotech').val()
    var year = $('#selectYearProtech').val()
    loadprotechmonitoringperformance(type, month, year);

}

function loadprotechmonitoringperformance(type, month, year) {

    $.ajax({
        url: 'Report/dashboard_data_protechMonitoring.php',
        type: 'POST',
        dataType: "json",
        data: {
            type: type,
            month: month,
            year: year
        },
        success: function (response) {
            var protechdata = response['categoriesdata'];
            ProtechMonitoringPerformance(protechdata, month, year, type);
            console.log(response)
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }
    });
}

function ProtechMonitoringPerformance(protechdata, month, year, type) {
    // Create the chart
    Highcharts.chart('ProtechMonitoring', {
        chart: {
            type: 'line'
        },
        title: {
            text: type
        },
        subtitle: {
            text: month + year
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'category'
            }

        },
        plotOptions: {
            series: {
                events: {
                    click: function (event) {
                        var month = event.point.name
                        // loadqamonitoringperformancephases(year,month,qa)

                    }
                },
                dataLabels: {
                    enabled: true,
                    format: '{point.name}: {point.y:1f}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span><br><b>Total Grade: </b>{point.y:1f} %<br/>'
        },

        series: [{
            name: type,
            colorByPoint: false,
            data: protechdata
        }]

    });
};