$(document).ready(function () {
    // Validar el formulario
    $("#DevolucionesAlMomento").validate({
        rules: {
            clienteInput: {
                required: true,
            },
        },
        messages: {
            clienteInput: {
                required: "El nombre del cliente es necesario",
            },
        },
        submitHandler: function (form) {
            // Primera solicitud AJAX para guardar datos
            $.ajax({
                type: 'POST',
                url: "Consultas/RegistraDevoluciones.php",
                data: $(form).serialize(),
                cache: false,
                success: function (data) {
                    var response = JSON.parse(data);

                    if (response.status === 'success') {
                        // Segunda solicitud AJAX para imprimir tickets
                        $.ajax({
                            type: 'POST',
                            url: "Consultas/ImprimirTicket.php",  // Cambia esto al archivo PHP que imprime los tickets
                            data: $(form).serialize(), // Reutilizar datos serializados
                            cache: false,
                            success: function (printData) {
                                // Opcional: Manejo del éxito de la impresión del ticket
                                var printResponse = JSON.parse(printData);
                                if (printResponse.status === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Ticket impreso con éxito!',
                                        showConfirmButton: false,
                                        timer: 2000,
                                        didOpen: () => {
                                            setTimeout(() => {
                                                location.reload();
                                            }, 1500);
                                        },
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error al imprimir el ticket',
                                        text: printResponse.message,
                                    });
                                }
                            },
                            error: function () {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error en la impresión del ticket',
                                    text: 'No se pudo imprimir el ticket. Por favor, inténtalo de nuevo.',
                                });
                            }
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Algo salió mal',
                            text: response.message,
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error en la petición',
                        text: 'No se pudieron guardar los datos. Por favor, inténtalo de nuevo.',
                    });
                }
            });
        },
    });
});
