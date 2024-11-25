$('document').ready(function ($) {
    // Validación del formulario
    $("#RegistroTicketSoporteForm").validate({
        rules: {
            Problematica: {
                required: true,
            },
            DescripcionProblematica: {
                required: true,
            },
            Fecha: {
                required: true,
            },
            Agregado_Por: {
                required: true,
            },
            Sucursal: {
                required: true,
            }
        },
        messages: {
            Problematica: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Seleccione un tipo de problema",
            },
            DescripcionProblematica: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Proporcione una descripción de la problemática",
            },
            Fecha: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Proporcione la fecha del reporte",
            },
            Agregado_Por: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Indique quién reporta el problema",
            },
            Sucursal: {
                required: "<i class='fas fa-exclamation-triangle' style='color:red'></i> Seleccione una sucursal",
            }
        },
        submitHandler: submitForm
    });

    // Manejo del envío del formulario
    function submitForm() {
        $("#RegistroTicketSoporteForm").on('submit', function (e) {
            e.preventDefault(); // Evita el comportamiento predeterminado del formulario

            // Validación de imágenes antes de enviar
            const imagenes = document.getElementById("file").files; // Asegúrate de usar el id correcto
            for (let i = 0; i < imagenes.length; i++) {
                if (imagenes[i].size > 5 * 1024 * 1024) { // 5 MB
                    alert(`El archivo ${imagenes[i].name} excede el tamaño permitido de 5 MB.`);
                    return false;
                }
                if (!['image/jpeg', 'image/png', 'image/gif'].includes(imagenes[i].type)) {
                    alert(`El archivo ${imagenes[i].name} no es un tipo de imagen permitido.`);
                    return false;
                }
            }

            // Realiza la solicitud AJAX
            $.ajax({
                type: 'POST',
                url: 'https://saludapos.com/AdminPOS/Consultas/RegistroSoporte.php', // Verifica la ruta
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $("#submitTicketSoporte").html("Verificando datos... <span class='fa fa-refresh fa-spin' role='status' aria-hidden='true'></span>");
                    $("#submitTicketSoporte").prop("disabled", true); // Deshabilita el botón mientras se procesa
                },
                success: function (dataResult) {
                    const result = JSON.parse(dataResult);

                    if (result.statusCode === 200) {
                        $("#submitTicketSoporte").html("Enviado <i class='fas fa-check'></i>");
                        $("#RegistroTicketSoporteForm")[0].reset();
                        $("#RegistroTicketSoporteModal").modal('hide'); // Cierra el modal
                        $('#Exito').modal('toggle'); // Muestra modal de éxito
                        setTimeout(function () {
                            $('#Exito').modal('hide');
                        }, 2000);
                    } else {
                        $("#submitTicketSoporte").html("Algo no salió bien... <i class='fas fa-exclamation-triangle'></i>");
                        $('#ErrorData').modal('toggle'); // Muestra modal de error
                        setTimeout(function () {
                            $("#submitTicketSoporte").html("Guardar Ticket <i class='fas fa-check'></i>");
                        }, 3000);
                    }
                },
                error: function () {
                    $("#submitTicketSoporte").html("Error en la solicitud <i class='fas fa-exclamation-triangle'></i>");
                },
                complete: function () {
                    $("#submitTicketSoporte").prop("disabled", false); // Habilita el botón después de procesar
                }
            });
        });
        return false; // Detiene el envío predeterminado
    }
});
