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