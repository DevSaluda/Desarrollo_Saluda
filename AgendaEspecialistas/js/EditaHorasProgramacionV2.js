$("#ProgramaHorasNuevas").validate({
  rules: {
      HoraSeleccionada: {
          required: true,
      },
      NuevaHora: {
          required: true,
      },
  },
  messages: {
      HoraSeleccionada: {
          required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Selecciona una hora existente",
      },
      NuevaHora: {
          required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Ingresa la nueva hora",
      },
  },
  submitHandler: function(form) {
      $.ajax({
          type: 'POST',
          url: "Consultas/EditaHorasProgramacion.php",
          data: $(form).serialize(),
          cache: false,
          beforeSend: function() {
              $("#EnviarDatosUnico").html("Verificando datos... <span class='fa fa-refresh fa-spin' role='status' aria-hidden='true'></span>");
          },
          success: function(response) {
              $("#editModal").removeClass("in");
              $(".modal-backdrop").remove();
              $("#editModal").hide();
              $('#ExitoEnFecha').modal('toggle');
              setTimeout(function(){
                  $('#ExitoEnFecha').modal('hide');
              }, 2000);

              CargaProgramaMedicosSucursalesExt();
          },
          error: function() {
              $("#show_error").fadeIn();
          }
      });
  }
});
