var botonesDescuento = document.querySelectorAll('.btn-descuento');

botonesDescuento.forEach(function (boton) {
  boton.addEventListener('click', function () {
    var idFila = boton.getAttribute('data-fila');
    aplicarDescuento(idFila);
  });
});

function aplicarDescuento(idFila) {
  // Lógica para aplicar el descuento a la fila
  // (Asume que la columna donde aplicar el descuento es la segunda, ajusta según tu estructura)
  var fila = document.getElementById(idFila);
  var precioOriginal = parseFloat(fila.cells[1].textContent);
  var porcentajeDescuento = 10; // Ejemplo: 10%
  var descuento = (precioOriginal * porcentajeDescuento) / 100;
  var precioConDescuento = precioOriginal - descuento;

  // Actualizar el valor en la columna correspondiente
  fila.cells[1].textContent = precioConDescuento.toFixed(2);

  // Actualizar el contenido del modal de detalles de descuento
  document.getElementById('detalleDescuento').textContent = 'Detalles de descuento aplicados a ' + idFila;
}