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
            extraHtml: `<button class="btn btn-success btn-submit" type="submit" onclick="javascript: return confirm('Are you sure want to submit the exam?')">Submit</button>&nbsp;<a href='/student/active-exams' class='btn btn-danger' onclick="javascript: return confirm('Are you sure want to cancel the exam?')">Cancel</a>&nbsp;<a title='Clear this answer' class='btn btn-warning' href='javascript:void(0)' onclick="clearAnswer($(this));">Clear</a>`
        },
        anchor: {
            enableNavigation: false,
        },
    });
    $('#smartwizard1').smartWizard({
        toolbar: {
            extraHtml: `<a class="btn btn-danger" href='/student/active-exams'>Cancel</a>`
        }
    });
    $(".sw-btn-next, .sw-btn-prev").click(function(){
        $("#smartwizard1 .answer, #smartwizard1 .answer").collapse('hide');
    });
});

function clearAnswer(dis){
    var chk = dis.parent().parent().find(".radanswer").data('chk');
    alert(chk)
    $("input[name='"+chk+"']").prop('checked', false);
    //var radioValue = $("input[name='"+chk+"']:checked").val();
    //alert(radioValue);
}

var timeleft = parseInt($("#exam-time-duration").val()); 
var s = 60;
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




