$('table').DataTable({});
var myModal = new bootstrap.Modal(document.getElementById('new-employee '), {
    keyboard: false
  })

$(document).on('click','.new-employee',function(){
    myModal.show()
})
