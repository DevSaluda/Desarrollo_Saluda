$("#ProgramaHorasEliminar").validate({
    rules: {
        HoraSeleccionada: {
            required: true,  // Asegura que se seleccione una hora
        },
    },
    messages: {
        HoraSeleccionada: {
            required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Selecciona una hora para eliminar",  // Mensaje personalizado si no se selecciona una hora
        },
    },
    submitHandler: function(form) {
        $.ajax({
            type: 'POST',
            url: "Consultas/EliminaHorarios.php",  // Archivo PHP que procesa la eliminación
            data: $(form).serialize(),  // Envía todos los datos del formulario
            cache: false,
            beforeSend: function() {
                // Muestra un spinner mientras se procesa la eliminación
                $("#EliminarDatosUnico").html("Eliminando... <span class='fa fa-refresh fa-spin' role='status' aria-hidden='true'></span>");
            },
            success: function(response) {
                // Cerrar modal de edición y eliminar backdrop
                $("#editModal").removeClass("in");
                $(".modal-backdrop").remove();
                $("#editModal").hide();

                // Mostrar mensaje de éxito por 2 segundos
                $('#ExitoEnFecha').modal('toggle');
                setTimeout(function() {
                    $('#ExitoEnFecha').modal('hide');
                }, 2000);

                // Recargar la programación de médicos y sucursales
                CargaProgramaMedicosSucursalesExt();
            },
            error: function() {
                // Mostrar mensaje de error si la solicitud falla
                $("#show_error").fadeIn();
            }
        });
    }
});
