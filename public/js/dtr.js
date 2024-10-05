$('.employee_list').select2();

$('.dtr_management').css({'display':'none'})
$('#generate-dtr').click(function(){
    $('.dtr_management').css({'display':'none'})
    var check = 0
    $('form .form-control').each(function(){
        if($(this).val() == ''){
            check++
        }
    })
    if(check == 0){
        $.ajax({
            url:'dtr/employee',
            data:$('form').serialize(),
            type:'POST',
            dataType:'JSON',
            success:function(e){
                $('tbody').html('')
                var data = e.data
                $.each(data, function(date,entries){
                    console.log(entries)
                    var in_snapshot = ''
                    var in_timestamp = ''
                    $.each(entries.in, function(id,logs){
                        in_timestamp += `
                            <div class="form-group mb-2">
                                <input class="form-control timeentries" value="${logs.time}" type="time" data-date="${date}" data-type="in" data-id="${id}">
                            </div>
                        `
                        in_snapshot += `
                        <div>
                            <img src="images/${logs.snapshot}" width="100px">
                        </div>
                    `
                    })        

                    var out_snapshot = ''
                    var out_timestamp = ''
                    $.each(entries.out, function(id,logs){
                        out_timestamp += `
                            <div class="form-group mb-2">
                                <input class="form-control timeentries" value="${logs.time}" type="time" data-date="${date}" data-type="out" data-id="${id}">
                            </div>
                        `
                        out_snapshot += `
                        <div>
                            <img src="images/${logs.snapshot}" width="100px">
                        </div>
                    `
                    })    
                    
                    in_timestamp = in_timestamp != '' ? in_timestamp: `
                        <div class="form-group mb-2">
                            <input class="form-control timeentries" value="" data-date="${date}" data-type="in" type="time" data-id="0">
                        </div>
                    `

                    out_timestamp = out_timestamp != '' ? out_timestamp: `
                        <div class="form-group mb-2">
                            <input class="form-control timeentries" value="" data-date="${date}" data-type="out" type="time" data-id="0">
                        </div>
                    `

                    var entry = `
                    <tr>
                        <td>${date}</td>
                        <td>${in_snapshot}</td>
                        <td>${in_timestamp}</td>
                        <td>${out_snapshot}</td>
                        <td>${out_timestamp}</td>
                    </tr>    
                        `
    
                     $('tbody').append(entry)

                     
                    $('.dtr_management').css({'display':'block'})
                })

            }
        })
    }else{
        Swal.fire({
            title: 'Oops!',
            text: 'All inputs are required',
            icon: 'error'
        });
    }
})


$('#save-dtr').click(function(){
    var new_timeentries = []
    var old_timeentries = []
    var ind = 0
    $('.timeentries').each(function(){
        // New
        if($(this).data('id') == 0 && $(this).val() != ''){
            new_timeentries.push({
                'date':$(this).data('date'),
                'time':$(this).val(),
                'type':$(this).data('type'),
                'teachers_id':$('.employee_list').val(),
                'snapshot':'snapshots/default_snapshot.jpg'
            })
        }

        // Old
        if($(this).data('id') != 0){
            if($(this).val() == ''){
                $(this).addClass('is-invalid')
                ind++
            }else{
                $(this).removeClass('is-invalid')
                old_timeentries.push({
                    'date':$(this).data('date'),
                    'time':$(this).val(),
                    'id':$(this).data('id')
                })
            }
        }
    })

    if(ind == 0){
        Swal.fire({
            title: 'Are you sure?',
            text: "You're about to save this Daily Time Record",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, save it!'
          }).then((result) => {
                $.ajax({
                    url:'dtr/employee/save_dtr',
                    data:{
                        'new_timeentries':new_timeentries,
                        'old_timeentries':old_timeentries
                    },
                    dataType:'JSON',
                    type:'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Adding CSRF token to headers
                    },
                    success:function(){
                        $('#generate-dtr').click()
                        Swal.fire({
                            title: 'Success!',
                            text: 'The Daily Time Record is successfully updated',
                            icon: 'success'
                        });
                    }
                })
          })
    }else{
        Swal.fire({
            title: 'Oops!',
            text: 'Past time-entries must have a valid input value.',
            icon: 'error'
        });
    }
})