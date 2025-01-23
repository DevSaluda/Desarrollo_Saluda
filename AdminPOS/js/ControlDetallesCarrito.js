
document.addEventListener('DOMContentLoaded', () => {
    const inputsCantidad = document.querySelectorAll('.input-cantidad');

    inputsCantidad.forEach(input => {
        input.addEventListener('change', function () {
            const idProducto = this.dataset.idProducto;
            const idCarrito = this.dataset.idCarrito;
            const nuevaCantidad = this.value;

            if (nuevaCantidad <= 0) {
                alert('La cantidad debe ser mayor a 0.');
                return;
            }

            // Realizar una solicitud AJAX para actualizar la cantidad
            fetch('Consultas/actualizar_cantidad.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    idProducto: idProducto,
                    idCarrito: idCarrito,
                    nuevaCantidad: nuevaCantidad,
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Cantidad actualizada correctamente.');
                } else {
                    alert('Error al actualizar la cantidad.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Hubo un problema al actualizar la cantidad.');
            });
        });
    });
});

