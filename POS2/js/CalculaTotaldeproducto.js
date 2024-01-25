document.getElementById("contenedor-dinamico").addEventListener("focusout", function(event) {
  // Verifica si el evento se originó desde un campo con la clase "cantidadventa"
  if (event.target.classList.contains("cantidadventa")) {
    multiplicar(event.target);
  }
});

function multiplicar(inputCantidad) {
  // Obtiene los valores de los campos relacionados al input de cantidad
  var m1 = parseFloat(inputCantidad.closest(".fila").querySelector(".precioprod").value);
  var m2 = parseFloat(inputCantidad.value);

 
  var r = m1 * m2;

  // Actualiza el campo de resultado dentro de la misma fila
  inputCantidad.closest(".fila").querySelector(".costoventa").value = r;

  // Llama a la función sumar para realizar cualquier otra operación necesaria
  sumar();
}