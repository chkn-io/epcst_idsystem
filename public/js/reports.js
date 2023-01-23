var list = []

$('#name').change(function(){
    var select = this.options[this.selectedIndex].innerHTML;
    this.options[this.selectedIndex].setAttribute("hidden","hidden");
    list.push({"id":$(this).val(),'name':select});

    generateList()
})

$(document).on('click','.remove-selected',function(e){
    e.preventDefault()
    var id = $(this).parent().attr('data-record')
    $('option[value="'+id+'"]').removeAttr('hidden')
    $(this).parent().remove()

    return false

})
function generateList(){
    var html = ''
    list.forEach(function(v){
        html +=' <div class="badge bg-success selected-item" data-value="'+v.name+'" data-record="'+v.id+'">'+
        v.name +
        ' <a class="text-white remove-selected"  href="#">'+
        ' <i class="fas fa-remove"></i>'+
        '  </a>'+
        '  </div>'
    })
    console.log(html)
    $('.selected').html(html)
}