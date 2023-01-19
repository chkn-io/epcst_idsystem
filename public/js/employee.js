$('table').DataTable({});

function loadFile(event) {
    var output = document.getElementById('pic-preview');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
    }
};


$('.activate').click(function(e){
    e.preventDefault()
    var id = $(this).attr('data-record')
    var location = $(this).attr('href')
    Swal.fire({
        title: 'Are you sure?',
        text: "This account will be activated",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, activate it!'
      }).then((result) => {
            window.location.href = location+'/active/'+id
      })

    return false;
})


$('.deactivate').click(function(e){
    e.preventDefault()
    var id = $(this).attr('data-record')
    var location = $(this).attr('href')
    Swal.fire({
        title: 'Are you sure?',
        text: "This account will be deactivated",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, deactivate it!'
      }).then((result) => {
            window.location.href = location+'/deactivated/'+id
      })

    return false;
})


