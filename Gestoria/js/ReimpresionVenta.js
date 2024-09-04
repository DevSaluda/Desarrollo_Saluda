$(document).ready(function(e) { 
    
    $("#GeneraTicket").trigger("hide");
    $("#EnviaTicket").trigger("click");

    setTimeout(function(){ 
        $('#Cancelacionmodal').modal('hide') 
        
    }, 3000); // abrir
    $('#ReimprimeVentas').modal('hide') 
   
    });
