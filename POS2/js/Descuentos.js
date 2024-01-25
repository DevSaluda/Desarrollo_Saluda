
    // Función de descuento genérica
    function aplicarDescuento(identificador) {
        const campoDescuento = document.getElementById(`cantidadadescontar${identificador}`);
        const campoCostoVenta = document.getElementById(`costoventa${identificador}`);
        const campoDescuentoReal = document.getElementById(`descuento${identificador}`);

        const cantidadDescuento = campoDescuento.value;
        const totalDescuento = (r * cantidadDescuento) / 100;
        const valorConDescuento = r - totalDescuento;

        campoCostoVenta.value = valorConDescuento;
        campoDescuentoReal.value = cantidadDescuento;
    }

    // Asignar eventos a los botones de aplicar descuento
    for (let i = 1; i <= 10; i++) {
        document.getElementById(`btnAplicarDescuento${i}`).addEventListener('click', () => aplicarDescuento(i));
    }
