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

                $.ajax({
                    type: 'POST',
                    url: "Consultas/GuardarCierreInventarios.php",
                    data: $('#BajaInventarioCierre').serialize(),
                    cache: false,
                    success: function (data) {
                        console.log("Respuesta del servidor:", data); // Ver qué datos estamos recibiendo
                
                        try {
                            // Comprobar si la respuesta es un JSON válido antes de intentar parsear
                            if (isValidJson(data)) {
                                var response = JSON.parse(data); // Intentar parsear la respuesta
                
                                // Si el parseo fue exitoso
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
                                    // Si la respuesta no fue exitosa
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Algo salió mal',
                                        text: response.message,
                                    });
                                }
                            } else {
                                throw new Error("La respuesta no es un JSON válido");
                            }
                        } catch (e) {
                            console.error('Error al procesar la respuesta:', e);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error al procesar los datos',
                                text: 'Hubo un problema al recibir los datos. Por favor, inténtalo de nuevo.',
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
                
                // Función para validar si la respuesta es un JSON válido
                function isValidJson(str) {
                    try {
                        JSON.parse(str);
                        return true;
                    } catch (e) {
                        return false;
                    }
                }
                
            }
        },
    });
});
