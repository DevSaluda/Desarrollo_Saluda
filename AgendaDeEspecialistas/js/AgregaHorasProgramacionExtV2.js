$('document').ready(function ($) {
   
    $.validator.addMethod("Sololetras", function (value, element) {
      return this.optional(element) || /[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]*$/.test(value);
    }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Solo debes ingresar letras!");
    $.validator.addMethod("Telefonico", function (value, element) {
      return this.optional(element) || /^[+]?([0-9]+(?:[\.][0-9]*)?|\.[0-9]+)$/.test(value);
    }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Solo debes ingresar numeros!");
    $.validator.addMethod("Correos", function (value, element) {
      return this.optional(element) || /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/.test(value);
    }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Ingresa un correo valido!");
    $.validator.addMethod("NEmpresa", function (value, element) {
      return this.optional(element) || /^[\u00F1A-Za-z _]*[\u00F1A-Za-z][\u00F1A-Za-z _]*$/.test(value);
    }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Solo debes ingresar letras!");
    $.validator.addMethod("Problema", function (value, element) {
      return this.optional(element) || /^[\u00F1A-Za-z _]*[\u00F1A-Za-z][\u00F1A-Za-z _]*$/.test(value);
    }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Solo debes ingresar letras!");
  
  
    $("#ProgramaHorasNuevas").validate({
      rules: {
  
  
       codbarras: {
          required: true,
        },
        
      
      },
      messages: {
       codbarras: {
          required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Dato requerido",
        },
     
       
  
  
      },
      submitHandler: submitForm
    });
    // hide messages 
  
  
    function submitForm() {
  
  
  
      $.ajax({
        type: 'POST',
        url: "Consultas/ProgramaHorasNuevasExt.php",
        data: $('#ProgramaHorasNuevas').serialize(),
        cache: false,
        beforeSend: function () {
  
          $("#submit_registro").html("Verificando datos... <span class='fa fa-refresh fa-spin' role='status' aria-hidden='true'></span>");
  
  
        },
        success: function(){
       
 

       
            $("#editModal").removeClass("in");
            $(".modal-backdrop").remove(); 
            $("#editModal").hide();
          
              $('#ExitoEnFecha').modal('toggle'); 
              setTimeout(function(){ 
                  $('#ExitoEnFecha').modal('hide') 
              }, 2000); // abrir
              // $('#ActualizarEstadoFinal').trigger("click");
              CargaProgramaMedicosSucursalesExt();
                     },
                     error: function(){
                        $("#show_error").fadeIn();
                     }
      });
      return false;
    }
  });