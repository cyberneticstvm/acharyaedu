$(function () {
  "use strict";
  var seid = $("#student_exam_id").val();
  var type = $("#student_exam_type").val();
  var ctx1 = document.getElementById("studentPerformanceChart");
  $.getJSON('/studentperfchart/' + seid + '/' + type, function (response) {
    console.log(response);
    var cor = []; var wro = []; var sub = [];
    for (var i = 0; i < response.length; i++) {
      cor.push(response[i]['correct']);
      wro.push(response[i]['wrong']);
      sub.push(response[i]['sname']);
    }
    new Chart(ctx1, {
      type: "bar",
      data: {
        labels: sub,
        datasets: [{
          label: "Correct",
          borderWidth: 1,
          backgroundColor: '#50C878',
          data: cor,
        },
        {
          label: "Wrong",
          borderWidth: 1,
          backgroundColor: '#FF0000',
          data: wro,
        }],
      },
    });
  });

  var ctx5 = document.getElementById("stud-reg-chart").getContext("2d");
  $.getJSON('/studentregchart/', function (response) {
    new Chart(ctx5, {
      type: "bar",
      data: {
        labels: [response[11].mname, response[10].mname, response[9].mname, response[8].mname, response[7].mname, response[6].mname, response[5].mname, response[4].mname, response[3].mname, response[2].mname, response[1].mname, response[0].mname],
        datasets: [{
          label: "Student Registration",
          weight: 5,
          borderWidth: 0,
          borderRadius: 4,
          backgroundColor: '#cb0c9f',
          data: [response[11].ptot, response[10].ptot, response[9].ptot, response[8].ptot, response[7].ptot, response[6].ptot, response[5].ptot, response[4].ptot, response[3].ptot, response[2].ptot, response[1].ptot, response[0].ptot],
          fill: false,
          maxBarThickness: 35
        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#9ca2b7'
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: true,
              drawTicks: true,
            },
            ticks: {
              display: true,
              color: '#9ca2b7',
              padding: 10
            }
          },
        },
      },
    });
  });

  var ctx4 = document.getElementById("stud-fee-chart").getContext("2d");
  $.getJSON('/studentfeechart/', function (response) {
    new Chart(ctx4, {
      type: "pie",
      data: {
        labels: ['Admission Fee', 'Batch Fee', 'Other Income', 'Expenses'],
        datasets: [{
          label: "Income & Expense",
          weight: 9,
          cutout: 0,
          tension: 0.9,
          pointRadius: 2,
          borderWidth: 2,
          backgroundColor: ['#17c1e8', '#cb0c9f', '#82d616', '#ea0606'],
          data: [response['afee'], response['bfee'], response['income'], response['expense']],
          fill: false
        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: true,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
            },
            ticks: {
              display: false
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: false,
              drawTicks: false,
            },
            ticks: {
              display: false,
            }
          },
        },
      },
    });
  });

  var ctx3 = document.getElementById("stud-canc-chart").getContext("2d");
  var gradientStroke1 = ctx3.createLinearGradient(0, 230, 0, 50);

  gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.02)');
  gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
  gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //

  $.getJSON('/studentcancelledchart/', function (response) {
    new Chart(ctx3, {
      type: "line",
      data: {
        labels: [response[11].mname, response[10].mname, response[9].mname, response[8].mname, response[7].mname, response[6].mname, response[5].mname, response[4].mname, response[3].mname, response[2].mname, response[1].mname, response[0].mname],
        datasets: [{
          label: "Students Cancelled",
          tension: 0.5,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#cb0c9f",
          borderWidth: 2,
          backgroundColor: gradientStroke1,
          data: [response[11].ptot, response[10].ptot, response[9].ptot, response[8].ptot, response[7].ptot, response[6].ptot, response[5].ptot, response[4].ptot, response[3].ptot, response[2].ptot, response[1].ptot, response[0].ptot],
          maxBarThickness: 6,
          fill: true
        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#9ca2b7'
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#9ca2b7'
            }
          },
        },
      },
    });
  });
})