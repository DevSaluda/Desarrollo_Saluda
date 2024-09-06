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
                url: "Consultas/RegistraIngresosDirectos.php", // Asegúrate de que esta ruta sea correcta
                data: $(form).serialize(),
                cache: false,
                success: function (data) {
                    try {
                        var response = JSON.parse(data);

                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Registro almacenado correctamente!',
                                text: 'Haz clic en el botón para recargar la página.',
                                showConfirmButton: true,
                                confirmButtonText: 'Ok',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    // Recargar la página si el usuario hace clic en el botón
                                    location.reload();
                                }
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
