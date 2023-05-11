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
        var random = $(this).data('random');
        $.ajax({
            type: 'GET',
            url: '/helper/module',
            data:{'sid': sid, 'random': random}
        }).then(function (response){console.log(response)
            var options = "<option value=''>Select</option>";
            $.map(response, function(obj){
                options = options + "<option value='"+obj.id+"'>"+obj.name+"</option>";
            });
            $(".module").html(options);
        });
    });

    $('#smartwizard').smartWizard({
        selected: 0,
        toolbar: {
            extraHtml: `<button class="sw-btn sw-btn-success btn-submit" type="submit" onclick="javascript: return confirm('Are you sure want to submit the exam?')">Submit</button>&nbsp;<a href='/student/active-exams' class='sw-btn sw-btn-danger' onclick="javascript: return confirm('Are you sure want to cancel the exam?')">Cancel</a>&nbsp;<a title='Clear this answer' class='sw-btn sw-btn-warning' href='javascript:void(0)' onclick="clearAnswer($(this));">Clear</a>`
        },
        anchor: {
            enableNavigation: false,
        },
    });
    $('#smartwizard1').smartWizard({
        autoAdjustHeight: false,
        toolbar: {
            extraHtml: `<a class="sw-btn sw-btn-danger" href='/student/active-exams'>Cancel</a>`
        }
    });
    $(".sw-btn-next, .sw-btn-prev").click(function(){
        $("#smartwizard .answer, #smartwizard1 .answer").collapse('hide');
    });
    $(".sw-btn").removeClass("btn").addClass("rts-btn");
});

function clearAnswer(dis){
    var chk = dis.parent().parent().find('.quest:visible').find(".radanswer").data('chk');
    $("input[name='"+chk+"']").prop('checked', false);
}

setTimeout(function () {
    $(".alert").hide('slow');
}, 5000);




