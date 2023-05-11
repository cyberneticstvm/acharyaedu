$(function(){
    "use strict";
    var seid = $("#student_exam_id").val();
    var ctx1 = document.getElementById("studentPerformanceChart");
    $.getJSON('/studentperfchart/'+seid, function(response){
        var cor=[]; var wro=[]; var sub=[];
        for(var i=0; i<response.length; i++){
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
})