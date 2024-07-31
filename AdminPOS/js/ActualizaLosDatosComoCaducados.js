$(document).ready(function () {
    // Validar el formulario
    $("#VentasAlmomento").validate({
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
        submitHandler: function () {
            $.ajax({
                type: 'POST',
                url: "Consultas/InsertarMedicamentoCaducado.php", // Asegúrate de que esta ruta sea correcta
                data: $('#VentasAlmomento').serialize(),
                cache: false,
                success: function (data) {
                    try {
                        var response = JSON.parse(data);

                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Venta realizada con éxito',
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
