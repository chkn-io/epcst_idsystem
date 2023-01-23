
var list = []

$('#name').change(function(){
    var select = this.options[this.selectedIndex].innerHTML;
    if($(this).val() !== ''){
        if($(this).val() == 0){
            $(this).attr('disabled','disabled')
            $('#name option').removeAttr('hidden');
            list = []
        }
        this.options[this.selectedIndex].setAttribute("hidden","hidden");
        list.push({"id":$(this).val(),'name':select});
        generateList()
    }
})

$(document).on('click','.remove-selected',function(e){
    e.preventDefault()
    var id = $(this).parent().attr('data-record')
    console.log(list)
    list.splice($(this).parent().attr('data-pocket'),1)
    console.log(list)
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
    if($('#from').val() != '' && $('#to').val() != '' && list.length != 0){
        $('input[name="list"]').val(JSON.stringify(list))
        $.ajax({
            url:'reports/generate/',
            data:$('form').serialize(),
            dataType:'JSON',
            type:'POST',
            success:function(e){

            }
        })
    }else{
        Swal.fire('Oops!','All fields are required!','error')
    }
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

