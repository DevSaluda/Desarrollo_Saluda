$('document').ready(function($){
 
    // hide messages 
    $("#error_alta").hide();
    $("#show_message").hide();
 
    // on submit...
    $('#ajax-form').submit(function(e){
 
        e.preventDefault();
 
        //name required
      
 
      
 
        // email required
     
        // ajax
        $.ajax({
            type:"POST",
            url: "Consultas/GuardaHorarios.php",
            data: $(this).serialize(), // get all form field value in serialize form
            success: function(){
               
                 CargaHorarios();
  $("#ajax-form")[0].reset();
                  $("#VerificaHoras").removeClass("in");
                  $(".modal-backdrop").remove();
                  $("#VerificaHoras").hide();
                  $('#Exito').modal('toggle'); 
                  setTimeout(function(){ 
                      $('#Exito').modal('hide') 
                  }, 2000); // abrir
             
                         },
                         error: function(){
                            $("#show_error").fadeIn();
                         }
        });
    });  
 
    return false;
    });