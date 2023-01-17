$('table').DataTable({});

function loadFile(event) {
    var output = document.getElementById('pic-preview');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        URL.revokeObjectURL(output.src) // free memory
    }
};