document.addEventListener('DOMContentLoaded', function () {
    // Actualización de cantidad
    document.querySelectorAll('.input-cantidad').forEach((input) => {
        input.addEventListener('change', function () {
            const idProducto = this.getAttribute('data-id-producto');
            const idCarrito = this.getAttribute('data-id-carrito');
            const nuevaCantidad = this.value;

            if (nuevaCantidad <= 0) {
                alert('La cantidad debe ser mayor a 0.');
                return;
            }

            fetch('ActualizarCantidadProducto.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `id_carrito=${idCarrito}&id_producto=${idProducto}&cantidad=${nuevaCantidad}`
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        alert(data.message);
                    } else {
                        alert(data.message);
                        location.reload(); // Recargar si hay errores
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                    alert('Ocurrió un error al actualizar la cantidad.');
                });
        });
    });

    // Eliminación de producto
    document.querySelectorAll('.btn-eliminar-producto').forEach((btn) => {
        btn.addEventListener('click', function () {
            const idProducto = this.getAttribute('data-id-producto');
            const idCarrito = this.getAttribute('data-id-carrito');

            if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
                fetch('EliminarProductoCarrito.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `id_carrito=${idCarrito}&id_producto=${idProducto}`
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            alert(data.message);
                            location.reload(); // Recargar la página para reflejar cambios
                        } else {
                            alert(data.message);
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
