$('document').ready(function($) {
    // Validación del formulario
    $("#RegistroTicketSoporteForm").validate({
        rules: {
            Problematica: {
                required: true,
            },
            DescripcionProblematica: {
                required: true,
            }
        },
        messages: {
            Problematica: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Seleccione un tipo de problema",
            },
            DescripcionProblematica: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Proporcione una descripción de la problemática",
            }
        },
        submitHandler: function() {
            submitForm(); // Llama a la función de envío
        }
    });

    // Manejo del envío del formulario
    function submitForm() {
        // Concatenar Folio y Nombre antes de enviar
        var folio = $("#folioEmpleado").val().trim();
        var nombre = $("#nombreEmpleado").val().trim();
        if(folio && nombre) {
            $("#agregadoPor").val(folio + ' ' + nombre);
        } else {
            $("#agregadoPor").val("");
        }
        const form = $("#RegistroTicketSoporteForm")[0];
const formData = new FormData(form);
// Asegurar que folioEmpleado y nombreEmpleado estén en el payload si el backend los requiere
formData.set('FolioEmpleado', folio);
formData.set('NombreEmpleado', nombre);
// Agregar fecha y hora local del navegador
const now = new Date();
const fechaHora = now.getFullYear() + '-' +
    String(now.getMonth() + 1).padStart(2, '0') + '-' +
    String(now.getDate()).padStart(2, '0') + ' ' +
    String(now.getHours()).padStart(2, '0') + ':' +
    String(now.getMinutes()).padStart(2, '0') + ':' +
    String(now.getSeconds()).padStart(2, '0');
formData.set('Fecha_Registro', fechaHora);

        $.ajax({
            type: 'POST',
            url: 'https://saludapos.com/Tickets/Consultas/RegistroSoporte.php',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $("#submitTicketSoporte").html("Verificando datos... <span class='fa fa-refresh fa-spin' role='status' aria-hidden='true'></span>");
                $("#submitTicketSoporte").prop("disabled", true); // Deshabilitar el botón mientras se envía
            },
            success: function(dataResult) {
                const result = JSON.parse(dataResult);

                if (result.statusCode === 200) {
                    // Mostrar el número de ticket en un modal
                    const ticketNumber = result.ticketNumber;
                    const successMessage = `
                        <p>¡Registro exitoso!</p>
                        <p>Este es tu número de ticket: <strong>${ticketNumber}</strong></p>
                        <p>Con este número puedes consultar el estado de tu ticket en cualquier momento.</p>
                    `;
                    $("#modalExito .modal-body").html(successMessage);
                    $("#modalExito").modal("show"); // Mostrar el modal de éxito

                    // Reiniciar el formulario y el botón
                    $("#RegistroTicketSoporteForm")[0].reset();
                    $("#submitTicketSoporte").html("Guardar Ticket <i class='fas fa-check'></i>");
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
            },
            complete: function() {
                $("#submitTicketSoporte").prop("disabled", false); // Rehabilitar el botón
            }
        });
    }
});
