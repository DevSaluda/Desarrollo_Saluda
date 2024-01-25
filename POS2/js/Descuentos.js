// Función de descuento genérica
function aplicarDescuento(identificador) {
  const campoDescuento = document.getElementById(`cantidadadescontar${identificador}`);
  const campoCostoVenta = document.getElementById(`costoventa${identificador}`);
  const campoDescuentoReal = document.getElementById(`descuento${identificador}`);

  console.log(`Identificador: ${identificador}`);
  console.log(`Campo Descuento: ${campoDescuento.value}`);
  console.log(`Campo Costo Venta: ${campoCostoVenta.value}`);

  const cantidadDescuento = campoDescuento.value;
  const r = parseFloat(campoCostoVenta.value);

  console.log(`Valor de r: ${r}`);

  const totalDescuento = (r * cantidadDescuento) / 100;
  const valorConDescuento = r - totalDescuento;

  console.log(`Total Descuento: ${totalDescuento}`);
  console.log(`Valor con Descuento: ${valorConDescuento}`);

  campoCostoVenta.value = valorConDescuento;
  campoDescuentoReal.value = cantidadDescuento;
}

// Obtener todos los botones que abren el modal
const buttons = document.querySelectorAll('[data-toggle="modal"][data-target="#DescuentoDetalles"]');

// Asignar eventos a los botones de aplicar descuento
buttons.forEach((button) => {
  button.addEventListener('click', () => {
    // Obtener el identificador de la fila desde el botón
    const identificador = button.getAttribute('data-identificador');
    console.log(`Botón clicado - Identificador: ${identificador}`);
    aplicarDescuento(identificador);
  });
});
