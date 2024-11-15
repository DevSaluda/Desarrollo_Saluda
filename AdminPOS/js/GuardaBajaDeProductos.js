$(document).ready(function () {
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
                const loadingSwal = Swal.fire({
                    title: 'Guardando...',
                    text: 'Por favor espera mientras se guardan los datos.',
                    icon: 'info',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: "Consultas/GuardarCierreInventarios.php",
                    data: $('#BajaInventarioCierre').serialize(),
                    cache: false,
                    success: function (data) {
                        console.log("Respuesta del servidor:", data); // Para ver la respuesta en la consola
                        try {
                            var response = JSON.parse(data);
                            loadingSwal.close();

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
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Algo salió mal',
                                    text: response.message,
                                });
                            }
                        } catch (e) {
                            loadingSwal.close();
                            console.error("Error al parsear JSON:", data);
                            Swal.fire({
                                icon: 'error',
                                title: 'Respuesta inesperada',
                                text: 'No se pudo procesar la respuesta del servidor.',
                            });
                        }
                    },
                    error: function () {
                        loadingSwal.close();
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
