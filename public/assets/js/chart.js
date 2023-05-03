$(function(){
    "use strict"
    var seid = $("#student_exam_id").val();
    $.getJSON('/studentperfchart/'+seid, function(response){
      var cor=[]; var wro=[]; var sub=[];
      for(var i=0; i<response.length; i++){
          cor.push(response[i]['correct']);
          wro.push(response[i]['wrong']);
          sub.push(response[i]['sname']);
      }
      var options = {
          series: [{
          name: 'Wrong',
          data: wro
        }, {
          name: 'Correct',
          data: cor
        }],
          chart: {
          type: 'bar',
          height: 350
        },
        colors: ['#ff0000', '#228B22'],
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded',
          },
        },
        dataLabels: {
          enabled: false
        },
        xaxis: {
          categories: sub,
        },
        yaxis: {
          title: {
            text: 'Score'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val + " Score"
            }
          }
        }
      };
      var chart = new ApexCharts(document.querySelector("#studPerfChart"), options);
      chart.render();
    });

    $.getJSON('/studentperfchartall', function(response){
      var da = []; var sub=[];
      for(var i=0; i<response.length; i++){
        da.push((parseInt(response[i]['correct'])/(parseInt(response[i]['correct'])+parseInt(response[i]['wrong'])))*100);
        sub.push(response[i]['sname']);
      }
      var options = {
          series: da,
          chart: {
          type: 'pie',
          width: '75%'
        },
        labels:sub,
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: '100%'
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
      };
      var chart = new ApexCharts(document.querySelector("#studPerfChartAll"), options);
      chart.render();
    });
});
