$(document).ready(function () {
    // Captura el evento de envío del formulario o el evento que maneje la acción
    $('#BajaInventarioCierre').submit(function (e) {
        e.preventDefault(); // Evita el envío normal del formulario

        // Recolecta los datos del formulario
        var formData = {
            "CodBarra": [],  // Array para los códigos de barra
            "NombreProd": [], // Array para los nombres de productos
            "Folio_Prod_Stock": [], // Array para los folios de productos
            "Sucursal": [], // Array para las sucursales
            "SucursalDestino": [], // Array para las sucursales destino
            "PrecioVenta": [], // Array para precios de venta
            "PrecioCompra": [], // Array para precios de compra
            "Cantidadd": [], // Array para la cantidad
            "AgregadoPor": [], // Array para la persona que agrega
            "ID_H_O_D": [], // Array para el ID de la operación
            "FechaInventario": [], // Array para las fechas de inventario
            "TipoMov": [] // Array para los tipos de movimiento
        };

        // Recoge los datos de cada input dentro del formulario (o tabla si los tienes allí)
        // Ejemplo de cómo podría estar estructurada la recolección de datos:
        $('.producto').each(function (index) {
            formData.CodBarra.push($(this).find('.codBarra').val());
            formData.NombreProd.push($(this).find('.nombreProd').val());
            formData.Folio_Prod_Stock.push($(this).find('.folio').val());
            formData.Sucursal.push($(this).find('.sucursal').val());
            formData.SucursalDestino.push($(this).find('.sucursalDestino').val());
            formData.PrecioVenta.push($(this).find('.precioVenta').val());
            formData.PrecioCompra.push($(this).find('.precioCompra').val());
            formData.Cantidadd.push($(this).find('.cantidad').val());
            formData.AgregadoPor.push($(this).find('.agregadoPor').val());
            formData.ID_H_O_D.push($(this).find('.idHOD').val());
            formData.FechaInventario.push($(this).find('.fechaInventario').val());
            formData.TipoMov.push($(this).find('.tipoMov').val());
        });

        // Muestra los datos que se van a enviar en la consola para verificar
        console.log("Datos del formulario:", formData);

        // Realiza la solicitud AJAX para guardar los datos
        $.ajax({
            url: 'Consultas/GuardarCierreInventarios.php',  // La URL de tu archivo PHP
            type: 'POST',
            data: formData,  // Datos a enviar al servidor
            success: function (data) {
                console.log("Datos recibidos del servidor:", data); // Muestra los datos crudos para depuración
                try {
                    // Intentamos parsear la respuesta JSON
                    var response = JSON.parse(data);
                    if (response.status === "success") {
                        // Si el servidor devuelve éxito
                        alert(response.message); // Muestra el mensaje de éxito
                    } else {
                        // Si hay un error en el servidor
                        alert("Error: " + response.message); // Muestra el mensaje de error
                    }
                } catch (e) {
                    // Si hay un error al intentar parsear el JSON
                    console.error("Error al parsear JSON:", e);
                    console.log("Respuesta del servidor no válida:", data); // Muestra la respuesta cruda
                    alert("Hubo un problema al procesar la respuesta del servidor.");
                }
            },
            error: function (xhr, status, error) {
                // Maneja cualquier error en la solicitud AJAX
                console.error("Error en la solicitud AJAX:", error);
                alert("Hubo un problema al procesar la solicitud. Inténtalo de nuevo.");
            }
        });
    });
});
