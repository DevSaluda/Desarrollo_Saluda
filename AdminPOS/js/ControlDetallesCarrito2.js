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

            fetch('Consultas/actualizar_cantidad.php', {
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
    
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('btn-eliminar-producto')) {
                const idProducto = e.target.getAttribute('data-id-producto');
                const idCarrito = e.target.getAttribute('data-id-carrito');
        
                if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
                    fetch('Consultas/EliminarProductoCarrito.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: `id_carrito=${idCarrito}&id_producto=${idProducto}`
                    })
                        .then((response) => response.json())
                        .then((data) => {
                            if (data.success) {
                                alert(data.message);
                                location.reload();
                            } else {
                                alert(data.message);
                            }
                        })
                        .catch((error) => {
                            console.error('Error:', error);
                            alert('Ocurrió un error al eliminar el producto.');
                        });
                }
            }
        });
    
    
    
});
