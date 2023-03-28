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
});

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



