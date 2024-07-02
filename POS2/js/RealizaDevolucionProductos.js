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
            $.ajax({
                type: 'POST',
                url: "Consultas/RegistraDevoluciones.php",
                data: $(form).serialize(),
                cache: false,
                success: function (data) {
                    var response = JSON.parse(data);

                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Datos guardados con éxito!',
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
