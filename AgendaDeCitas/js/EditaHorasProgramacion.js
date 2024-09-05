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
  
    // Validación para el formulario de edición de horas
    $("#ProgramaHoras").validate({
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
  
    // Función para el envío del formulario
    function submitForm() {
      $.ajax({
        type: 'POST',
        url: "Consultas/EditaHorasProgramacion.php",  // Cambia la URL para edición de horas
        data: $('#ProgramaHoras').serialize(),
        cache: false,
        beforeSend: function () {
          $("#submit_registro").html("Verificando datos... <span class='fa fa-refresh fa-spin' role='status' aria-hidden='true'></span>");
        },
        success: function(){
            // Cerrar el modal de edición y mostrar el modal de éxito
            $("#editModal").removeClass("in");
            $(".modal-backdrop").remove(); 
            $("#editModal").hide();
          
            // Mostrar el mensaje de éxito
            $('#ExitoEnFecha').modal('toggle'); 
            setTimeout(function(){ 
                $('#ExitoEnFecha').modal('hide') 
            }, 2000);

            // Recargar la tabla o listado de horarios
            CargaProgramaMedicosSucursalesExt();
        },
        error: function(){
            $("#show_error").fadeIn();
        }
      });
      return false;
    }
  });
