<!-- Modal de detalles de descuento -->
<div class="modal fade" id="DescuentoDetalles" tabindex="-1" role="dialog" aria-labelledby="DescuentoDetallesLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="DescuentoDetallesLabel">Detalles de Descuento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Formulario para ingresar el porcentaje de descuento -->
        <form id="formDescuento">
          <div class="form-group">
            <label for="porcentajeDescuento">Porcentaje de Descuento:</label>
            <input type="number" class="form-control" id="porcentajeDescuento" placeholder="Ingrese el porcentaje">
          </div>
        </form>

        <!-- Contenido específico de detalles de descuento -->
        <p id="detalleDescuento">Detalles de descuento para la fila seleccionada.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="aplicarDescuento()">Aplicar Descuento</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<script>
   // JavaScript para manejar los descuentos
 var idFilaActual; // Variable para almacenar el ID de la fila actual

var botonesDescuento = document.querySelectorAll('.btn-descuento');

botonesDescuento.forEach(function (boton) {
  boton.addEventListener('click', function () {
    idFilaActual = boton.getAttribute('data-fila');
    // Limpiar el campo de entrada del porcentaje cada vez que se abre el modal
    document.getElementById('porcentajeDescuento').value = '';
    // Actualizar el contenido del modal de detalles de descuento
    document.getElementById('detalleDescuento').textContent = 'Detalles de descuento para la fila ' + idFilaActual;
  });
});

function aplicarDescuento() {
  // Obtener el porcentaje de descuento ingresado por el usuario
  var porcentajeDescuento = parseFloat(document.getElementById('porcentajeDescuento').value);

  // Validar que el porcentaje sea un número válido
  if (!isNaN(porcentajeDescuento)) {
    // Lógica para aplicar el descuento a la fila
    // (Asume que la columna donde aplicar el descuento es la segunda, ajusta según tu estructura)
    var fila = document.getElementById(idFilaActual);
    var precioOriginal = parseFloat(fila.cells[1].textContent);
    var descuento = (precioOriginal * porcentajeDescuento) / 100;
    var precioConDescuento = precioOriginal - descuento;

    // Actualizar el valor en la columna correspondiente
    fila.cells[1].textContent = precioConDescuento.toFixed(2);
    
    // Cerrar el modal después de aplicar el descuento
    $('#DescuentoDetalles').modal('hide');
  } else {
    // Mostrar un mensaje de error si el porcentaje no es válido
    alert('Ingrese un porcentaje de descuento válido.');
  }
}
</script>