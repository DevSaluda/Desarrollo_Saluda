$('document').ready(function($){
 
  // hide messages 
  $("#error_alta").hide();
  $("#show_message").hide();

  // on submit...
  $('#ajax-form').submit(function(e){

      e.preventDefault();

      //name required
      var Especialidad = $("select#especialidad").val();
      if(Especialidad == ""){
          $("#error_alta").fadeIn().text("Debes elegir una especialidad");
          $("select#especialidad").focus();
          $("#error_alta").fadeOut(4000);
          return false;
      }
      var Medico = $("select#medico").val();
      if(Medico == ""){
          $("#error_alta").fadeIn().text("Debes elegir un medico");
          $("select#medico").focus();
          $("#error_alta").fadeOut(4000);
          return false;
      }

      var Fecha= $("input#fecha").val();
      if(Fecha == ""){
          $("#error_alta").fadeIn().text("Debes ingresar una fecha");
          $("input#fecha").focus();
          $("#error_alta").fadeOut(4000);
          return false;
      }
     
    

      // email required
   
      // ajax
      $.ajax({
          type:"POST",
          url: "Consultas/GuardaFechas.php",
          data: $(this).serialize(), // get all form field value in serialize form
          success: function(){
            CargaFechas();
                $("#ajax-form")[0].reset();
                $("#AltaFecha").removeClass("in");
                $(".modal-backdrop").remove();
                $("#AltaFecha").hide();
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