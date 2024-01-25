function multiplicar(index) {
  // Obtener los valores de la fila específica
  let precio = document.getElementById("precioprod" + index).value;
  let cantidad = document.getElementById("cantidad" + index).value;

  // Calcular el resultado
  let resultado = precio * cantidad;

  // Establecer el resultado en el campo correspondiente
  document.getElementById("costoventa" + index).value = resultado;

  // Llamar a la función sumar() (asumiendo que es una función válida en tu código)
  sumar();
}
