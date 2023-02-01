$('#date-picker').change(function(){
    $.ajax({
        url:'home/changeDate',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{
            'date':$('#date-picker').val()
        },
        type:'post',
        dataType:'JSON',
        success:function(){
            location.reload()
        }
    })
})