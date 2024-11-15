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
    $("#BajaInventarioCierre").validate({
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
        submitHandler: function () {
            if (validarFormulario()) {
                // Mostrar el SweetAlert de carga real
                const loadingSwal = Swal.fire({
                    title: 'Guardando...',
                    text: 'Por favor espera mientras se guardan los datos.',
                    icon: 'info',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading(); // Mostrar indicador de carga
                    }
                });

                // Enviar la solicitud AJAX
                $.ajax({
                    type: 'POST',
                    url: "Consultas/GuardarCierreInventarios.php",
                    data: $('#BajaInventarioCierre').serialize(),
                    cache: false,
                    success: function (data) {
                        console.log(data); // Verifica qué estás recibiendo
                        try {
                            var response = JSON.parse(data); // Intenta parsear la respuesta

                            // Cerrar el SweetAlert de carga solo cuando la respuesta sea recibida
                            loadingSwal.close();

                            // Si la respuesta es exitosa, mostrar el mensaje de éxito
                            if (response.status === 'success') {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Datos guardados con éxito!',
                                    showConfirmButton: false,
                                    timer: 2000,
                                }).then(() => {
                                    window.location.href = "https://saludapos.com/AdminPOS/HistorialInventarios";
                                });
                            } else {
                                // Si hay un error, mostrar el mensaje de error
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Algo salió mal',
                                    text: response.message,
                                });
                            }
                        } catch (e) {
                            console.error('Error al parsear JSON:', e);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error al procesar los datos',
                                text: 'Hubo un problema al recibir los datos. Por favor, inténtalo de nuevo.',
                            });
                        }
                    },
                    error: function () {
                        // Cerrar el SweetAlert de carga si ocurre un error
                        loadingSwal.close();

                        // Mostrar un mensaje de error en caso de fallo en la solicitud
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
