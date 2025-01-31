document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.input-cantidad').forEach((input) => {
        input.addEventListener('change', function () {
            const idProducto = this.getAttribute('data-id-producto');
            const idProcedimiento = this.getAttribute('data-id-procedimiento');
            const nuevaCantidad = this.value;

            if (nuevaCantidad <= 0) {
                alert('La cantidad debe ser mayor a 0.');
                return;
            }

            fetch('Consultas/ActualizarCantidadProcedimiento.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    idProducto: idProducto,
                    idProcedimiento: idProcedimiento,
                    nuevaCantidad: nuevaCantidad
                })
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        alert('Cantidad actualizada correctamente.');
                    } else {
                        alert('Error: ' + data.message);
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                    alert('Ocurrió un error al actualizar la cantidad.');
                });
        });
    });



    // Eliminación de producto de un procedimiento
    document.querySelectorAll('.btn-eliminar-producto').forEach((btn) => {
        btn.addEventListener('click', function () {
            const idProducto = this.getAttribute('data-id-producto');
            const idProcedimiento = this.getAttribute('data-id-procedimiento');
    
            if (confirm('¿Estás seguro de que deseas eliminar este producto del procedimiento?')) {
                fetch('Consultas/EliminarProductoProcedimiento.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ idProducto, idProcedimiento })
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            alert('Producto eliminado exitosamente.');
                            location.reload();
                        } else {
                            alert('Error: ' + data.message);
                        }
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                        alert('Ocurrió un error al eliminar el producto.');
                    });
            }
        });
    });
});
