$(document).ready(function(e) { 
    
    $("#GeneraTicket").trigger("hide");
    $("#EnviaTicket").trigger("click");

    setTimeout(function(){ 
        $('#Reimpresion').modal('hide') 
        
    }, 1000); // abrir
    $('#ReimprimeVentas').modal('hide') 
   
    });
