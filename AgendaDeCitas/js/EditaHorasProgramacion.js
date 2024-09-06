$('document').ready(function ($) {
   
  $.validator.addMethod("Sololetras", function (value, element) {
    return this.optional(element) || /[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]*$/.test(value);
  }, "<i class='fas fa-exclamation-triangle' style='color:red'></i> Solo debes ingresar letras!");
  
  // Validación para el formulario de edición de horas
  $("#ProgramaHoras").validate({
    rules: {
     HoraSeleccionada: {
        required: true,
      },
      HoraNueva: {
        required: true,
      },
    },
    messages: {
     HoraSeleccionada: {
        required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Selecciona una hora existente",
      },
      HoraNueva: {
        required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Ingresa la nueva hora",
      },
    },
    submitHandler: submitForm
  });

  // Función para el envío del formulario
  function submitForm() {
    $.ajax({
      type: 'POST',
      url: "Consultas/EditaHorasProgramacion.php",  
      data: $('#ProgramaHoras').serialize(),
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
          }, 2000);

          CargaProgramaMedicosSucursalesExt();
      },
      error: function(){
          $("#show_error").fadeIn();
      }
    });
    return false;
  }
});
