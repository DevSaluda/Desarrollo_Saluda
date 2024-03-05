function CargaVentasDelDia() {
  // Realizar una solicitud AJAX a la URL de la API
  $.ajax({
      url: "https://saludapos.com/AdminPOS/Consultas/VentasDelDia.php",
      type: "POST",
      success: function(data) {
          // Insertar los datos recibidos en el div con id "TableVentasDelDia"
          $("#TableVentasDelDia").html(data);
      },
      error: function(xhr, status, error) {
          // Manejar errores si ocurre alguno durante la solicitud
          console.error("Error al cargar ventas del día:", error);
      }
  });
}

// Llamar a la función para cargar las ventas del día cuando la página se cargue
$(document).ready(function() {
  CargaVentasDelDia();
});
