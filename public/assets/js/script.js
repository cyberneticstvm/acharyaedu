$(function(){
    "use strict"

    $('form').submit(function(){
        $(".btn-submit").attr("disabled", true);
        $(".btn-submit").html("<span class='spinner-grow spinner-grow-sm' role='status' aria-hidden='true'></span>");
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#datatable-basic').DataTable({
        pagingType: "numbers"
    });

    $(document).ready(function() {
        $('.select2').select2();
    });

    $(".subject").change(function(){
        var sid = $(this).val();
        $.ajax({
            type: 'GET',
            url: '/helper/module/'+sid
        }).then(function (data){
            var options = "<option value=''>Select</option>";
            $.map(data, function(obj){
                options = options + "<option value='"+obj.id+"'>"+obj.name+"</option>";
            });
            $(".module").html(options);
        });
    });

    $('#smartwizard').smartWizard({
        selected: 0,
        toolbar: {
            extraHtml: `<button class="btn btn-success btn-submit" type="submit" onclick="javascript: return confirm('Are you sure want to complete the exam?')">Complete</button><button class="btn btn-secondary" onclick="onCancel($('#smartwizard'))">Cancel</button>`
        },
        anchor: {
            enableNavigation: false,
        },
    });
});

var timeleft = parseInt($("#exam-time-duration").val()); 
var s = 60;
/*var examTimer = setInterval(function(){
    if(timeleft <= 0){
      clearInterval(examTimer);
      alert("Your time has over.");
      $("#frmExam").submit();
    }
    document.getElementById("time-remain").innerHTML = timeleft;
    timeleft -= 1;
}, 60000);*/

var examTimerSecs = setInterval(function(){
    if(s <= 0){
        s = 60;
        timeleft -= 1;
        document.getElementById("time-remain").innerHTML = timeleft;
    }
    if(timeleft <= 0){
        clearInterval(examTimerSecs);
        alert("Your time has over.");
        $("#frmExam").submit();
    }
    document.getElementById("secs").innerHTML = s;
    s -= 1;
}, 1000);

setTimeout(function () {
    $(".alert").hide('slow');
}, 5000);

/*function bindDDL(sid){
    $.ajax({
        type: 'GET',
        url: '/helper/module/'+sid
    }).then(function (data){
        xdata = $.map(data, function(obj){
            obj.text = obj.name || obj.id;  
            return obj;
        });
        console.log(xdata)
        $('.module').val('').trigger('change');        
        $('.module').select2({data:xdata});
    });
}*/



