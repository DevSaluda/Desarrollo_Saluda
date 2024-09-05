$(document).ready(function () {
    // Agregar los métodos de validación personalizados
    function validarFormulario() {
        var clienteInput = $("#clienteInput");

        if (clienteInput.val() === "") {
            Swal.fire({
                icon: 'error',
                title: 'Campo requerido',
                text: 'El nombre del cliente es necesario',
            });
            return false;
        }
        return true;
    }

    // Validar el formulario
    $("#VentasAlmomento").validate({
        rules: {
            clienteInput: {
                required: true,
            },
        },
        messages: {
            clienteInput: {
                required: function () {
                    Swal.fire({
                        icon: 'error',
                        title: 'Campo requerido',
                        text: 'El nombre del cliente es necesario',
                    });
                },
            },
        },
        submitHandler: function (form) {
            if (validarFormulario()) {
                // Primera solicitud AJAX para guardar datos
                $.ajax({
                    type: 'POST',
                    url: "Consultas/RegistraCaducados.php",
                    data: $(form).serialize(),
                    cache: false,
                    success: function (data) {
                        var response = JSON.parse(data);

                        if (response.status === 'success') {
                            // Segunda solicitud AJAX para imprimir tickets
                            $.ajax({
                                type: 'POST',
                                url: "http://localhost:8080/ticket/ImprimirTicketDevolucion.php",
                                data: $(form).serialize(),
                                cache: false,
                                success: function (printData) {
                                    try {
                                        var printResponse = JSON.parse(printData);
                                        if (printResponse.status === 'success') {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Venta realizada con éxito',
                                                text: printResponse.message,
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
                                    } catch (e) {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: 'Error al procesar la respuesta del servidor.',
                                        });
                                    }
                                },
                                error: function () {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'Hubo un problema al realizar la solicitud de impresión.',
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
            }
        },
    });
});
