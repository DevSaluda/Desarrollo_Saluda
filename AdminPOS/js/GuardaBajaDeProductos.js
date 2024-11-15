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
                        console.log("Respuesta recibida del servidor:", data);
                
                        // Verificar si la respuesta es un objeto y convertirlo en JSON si es necesario
                        if (typeof data === 'object') {
                            console.log("La respuesta ya es un objeto, no es necesario parsearla.");
                        } else if (typeof data === 'string') {
                            // Si la respuesta es una cadena, entonces intentamos parsearla
                            try {
                                data = JSON.parse(data);
                                console.log("JSON parseado correctamente:", data);
                            } catch (e) {
                                console.error("Error al parsear JSON:", e);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error al procesar los datos',
                                    text: 'Hubo un problema al recibir los datos. Por favor, inténtalo de nuevo.',
                                });
                                return;
                            }
                        }
                
                        // Ahora que sabemos que 'data' es un objeto, podemos trabajar con él
                        if (data.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Datos guardados con éxito!',
                                showConfirmButton: false,
                                timer: 2000,
                            }).then(() => {
                                window.location.href = "https://saludapos.com/AdminPOS/HistorialInventarios";
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Algo salió mal',
                                text: data.message,
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
