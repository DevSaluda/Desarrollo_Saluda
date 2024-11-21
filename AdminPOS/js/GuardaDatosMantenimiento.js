$('document').ready(function($) {
    $("#RegistroMantenimientoForm").validate({
        onfocusout: false,  // Desactiva la validación en vivo cuando se pierde el foco
        onkeyup: false,     // Desactiva la validación en vivo mientras se escribe
        rules: {
            tipoEquipo: {
                required: true,
            },
            Comentario: {
                required: true,
            },
            'imagenes[]': {
                required: true,
                extension: "jpg|jpeg|png|gif",
            }
        },
        messages: {
            tipoEquipo: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Seleccione un tipo de equipo",
            },
            Comentario: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Escriba un comentario",
            },
            'imagenes[]': {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Cargue al menos una imagen",
                extension: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Solo se permiten imágenes en formato jpg, jpeg, png o gif",
            }
        },
        submitHandler: submitForm
    });
    

  // Manejo del envío del formulario
function submitForm() {
    const form = $('#RegistroTicketSoporteForm')[0];
    const formData = new FormData(form);

    $.ajax({
        type: 'POST',
        url: 'https://saludapos.com/AdminPOS/Consultas/RegistroSoporte.php',
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function() {
            $("#submitTicketSoporte").html("Verificando datos... <span class='fa fa-refresh fa-spin' role='status' aria-hidden='true'></span>");
        },
        success: function(dataResult) {
            const result = JSON.parse(dataResult);

            if (result.statusCode === 200) {
                $("#submitTicketSoporte").html("Enviado <i class='fas fa-check'></i>");
                $("#RegistroTicketSoporteForm")[0].reset();
                $("#RegistroTicketSoporteModal").modal('hide'); // Cierra el modal
                $('#Exito').modal('toggle'); // Muestra modal de éxito
                setTimeout(function() {
                    $('#Exito').modal('hide');
                }, 2000);
            } else {
                $("#submitTicketSoporte").html("Algo no salió bien... <i class='fas fa-exclamation-triangle'></i>");
                $('#ErrorData').modal('toggle'); // Muestra modal de error
                setTimeout(function() {
                    $("#submitTicketSoporte").html("Guardar Ticket <i class='fas fa-check'></i>");
                }, 3000);
            }
        },
        error: function() {
            $("#submitTicketSoporte").html("Error en la solicitud <i class='fas fa-exclamation-triangle'></i>");
        }
    });
    return false; // Detiene el envío predeterminado
}

});
