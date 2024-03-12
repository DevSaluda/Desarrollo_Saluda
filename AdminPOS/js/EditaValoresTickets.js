$(document).ready(function () {
    $("#ActualizameLadatadelTicket").on("submit", function (event) {
       

        // Aquí puedes realizar las acciones que desees antes de enviar el formulario, como validar campos o realizar otras tareas.

        // Luego, puedes enviar el formulario manualmente utilizando AJAX.
        $.ajax({
            type: 'POST',
            url: "Consultas/ActualizaInfoDelTicket.php",
            data: $(this).serialize(), // Serializa los datos del formulario
            cache: false,
            beforeSend: function () {
                // Realiza acciones antes del envío, como mostrar un mensaje de carga
            },
            success: function (dataResult) {
                // Procesa la respuesta del servidor
                try {
                    var response = JSON.parse(dataResult);
                    if (response.status === 'success') {
                        // Acciones en caso de éxito
                    } else if (response.status === 'error') {
                        // Acciones en caso de error
                    }
                } catch (error) {
                    console.error("Error al parsear la respuesta JSON: " + error);
                }
            },
            error: function () {
                // Acciones en caso de error de comunicación
            },
            complete: function () {
                // Acciones después de que la solicitud se haya completado (éxito o error)
            }
        });
    });
});
