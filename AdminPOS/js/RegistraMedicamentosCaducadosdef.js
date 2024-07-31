$(document).ready(function () {
    // Validar el formulario
    $("#RegistraCaducados").validate({
        rules: {
            clienteInput: {
                required: true,
            },
            // Agrega otras reglas aquí para los otros campos según sea necesario
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
            // Agrega mensajes aquí para otros campos según sea necesario
        },
        submitHandler: function (form) {
            $.ajax({
                type: 'POST',
                url: "Consultas/ActualizaComoCaducadosLosProductos.php", // Asegúrate de que esta ruta sea correcta
                data: $(form).serialize(),
                cache: false,
                success: function (data) {
                    try {
                        var response = JSON.parse(data);

                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Registro almacenado correctamente!',
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                // Recargar la página después de que el mensaje se haya cerrado
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Algo salió mal',
                                text: response.message,
                            });
                        }
                    } catch (e) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error en el servidor',
                            text: 'Ocurrió un error al procesar la respuesta.',
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
