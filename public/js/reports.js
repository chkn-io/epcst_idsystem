var list = []

$('#name').change(function(){
    var select = this.options[this.selectedIndex].innerHTML;
    if($(this).val() !== ''){
        if($(this).val() == 0){
            // $('#name option').removeAttr('hidden');
            // list = []

            $('#name option').each(function(){
                if($(this).attr('value') != '' && $(this).attr('value') != 0){
                    if($(this).attr('hidden') != 'hidden'){
                        list.push({"id":$(this).attr('value'),'name':$(this).html()});
                        $(this).attr('hidden','hidden')
                    }
                }
            })
        }else{
            this.options[this.selectedIndex].setAttribute("hidden","hidden");
            list.push({"id":$(this).val(),'name':select});
        }
        generateList()
    }
})


$(document).on('click','.remove-selected',function(e){
    e.preventDefault()
    var id = $(this).parent().attr('data-record')
    list.splice($(this).parent().attr('data-pocket'),1)
    if(id == 0){
        list = []
        $('#name option').removeAttr('hidden');
        $('#name').removeAttr('disabled')
        $('.selected').html('<p class="text-center text-success mt-3">Please select names above</p>')
    }
    $('option[value="'+id+'"]').removeAttr('hidden')
    $(this).parent().remove()
    generateList()
    return false
})

$('.generate').click(function(){
    var dates = [];
    var from = $('#from').val()
    var to = $('#to').val()
    $('.report-generated .row').html('<p class="text-primary text-center mb-5">Generating Report. Please Wait.</p>')
    $('.report-generated .card-header').html('DTR From '+from+' - '+to +'<button class="btn btn-primary float-end btn-sm print"><i class="fas fa-print"></i> Print</button>')
    $('.report-generated').removeAttr('hidden');
    var currDate = moment(from).startOf('day');
    currDate = currDate.subtract(1,'days')
    var lastDate = moment(to).startOf('day');
    lastDate = lastDate.add(1,'days')

    while(currDate.add(1, 'days').diff(lastDate) < 0) {
        dates.push(currDate.clone().format('MM/DD'));
    }



    if(from != '' && to != '' && list.length != 0){
        $('input[name="list"]').val(JSON.stringify(list))
        $.ajax({
            url:'reports/generate',
            data:$('form').serialize(),
            dataType:'JSON',
            type:'POST',
            success:(e)=>{
                var html = ''
                var counter = 0
                $(e).each(function(k,v){
                    counter++
                    if(counter == 5){
                        counter = 0
                        html+='<div class="pagebreak"></div>'
                    }
                    html+='<div class="col-md-3 col-sm-3 col-xs-3 mb-1" style="font-size:70%">'+
                            '<div class="border border-dark rounded py-1 px-2">'+
                                '<p class="text-center m-0"><strong>EASTWOODS Professional College</strong><br> of Science and Technology</p>'+
                                '<p class="text-muted text-center m-0"><strong>DAILY TIME RECORD</strong></p>'+
                                '<p class="text-muted text-center m-0"><strong>From: </strong>'+from +' <strong>To: </strong>'+to +' </p>'+
                                '<p><strong>Name: </strong>'+v.employee+'</p>'+
                                '<table class="table table-bordered table-striped">'+
                                '    <thead>'+
                                '        <tr>'+
                                '            <th>Date</th>'+
                                '            <th>Time In</th>'+
                                '            <th>Time Out</th>'+
                                '            <th>Duration</th>'+
                                '        </tr>'+
                                '    </thead>'
                                
                        html+='<tbody>'
                        dates.forEach(function(dt){
                            html+='<tr>'+
                                    '<td>'+dt+'</td>'
                                html+='<td>'
                                    $(v.in[dt]).each(function(k1,v1){
                                        html+='<span>'+moment(new Date("1970-01-01T" + v1)).format('hh:mm A')+'</span> <br>'
                                    })
                                html+='</td>'
                                html+='<td>'
                                    $(v.out[dt]).each(function(k1,v1){
                                        html+='<span>'+moment(new Date("1970-01-01T" + v1)).format('hh:mm A')+'</span> <br>'
                                    })

                                var f = ''
                                var t = ''
                                try{
                                    f = v.in[dt].length != 0 ? v.in[dt][0]:''
                                    // f = moment(f.split(':'))
                                 }catch(e){
                                    f = ''
                                 }
                                try{
                                    t = v.out[dt].length != 0 ? v.out[dt][v.out[dt].length - 1]:''
                                    // t = moment(t.split(':'))
                                }catch(e){
                                    t = ''
                                }
                                
                                var now  = "04/09/2013 "+t;
                                var then = "04/09/2013 "+f;

                                var out = moment.utc(moment(now,"DD/MM/YYYY HH:mm").diff(moment(then,"DD/MM/YYYY HH:mm"))).format("HH:mm")
                               
                                
                                html+='</td><td class="text-danger">'+( t != '' ? out:'' )+'</td>'+
                                    '</tr>'
                        })
                        html+='</tbody>'

                    html+='</table></div>'+
                        '</div>'
                })

                $('.report-generated .row').html(html)
            }
        })
    }else{
        Swal.fire('Oops!','All fields are required!','error')
    }
})

$(document).on("click",'.print',function(){
    window.print()
})

$('.clear').click(function(){
    list = []
    $('#name option').removeAttr('hidden');
    $('#name').removeAttr('disabled')
    $('.selected').html('<p class="text-center text-success mt-3">Please select names above</p>')
    generateList()
})
function generateList(){
    var html = ''
    list.forEach(function(v,k){
        html +=' <div class="badge bg-success selected-item" data-pocket="'+k+'" data-value="'+v.name+'" data-record="'+v.id+'">'+
        v.name +
        ' <a class="text-white remove-selected"  href="#">'+
        ' <i class="fas fa-remove"></i>'+
        '  </a>'+
        '  </div>'
    })

    $('.selected').html(html)

    if(list.length == 0){
        $('.selected').html('<p class="text-center text-success mt-3">Please select names above</p>')
    }
}

