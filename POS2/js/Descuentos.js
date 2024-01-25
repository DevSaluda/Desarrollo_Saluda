// Función de descuento genérica
function aplicarDescuento(identificador) {
  const campoDescuento = document.getElementById(`cantidadadescontar${identificador}`);
  const campoCostoVenta = document.getElementById(`costoventa${identificador}`);
  const campoDescuentoReal = document.getElementById(`descuento${identificador}`);

  const cantidadDescuento = campoDescuento.value;
  const r = parseFloat(campoCostoVenta.value);  // Asegúrate de obtener el valor correcto del campoCostoVenta y convertirlo a número
  const totalDescuento = (r * cantidadDescuento) / 100;
  const valorConDescuento = r - totalDescuento;

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
      aplicarDescuento(identificador);
  });
});
