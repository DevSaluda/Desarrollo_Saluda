$(document).ready(function(e) { 

    $("#EnviaTicket").trigger("click");
    setTimeout(function(){ 
        $('#editModal').modal('hide') 
    }, 5000); // abrir
    });
