function  CargaGestionventas(){
    // Verificar que el elemento existe antes de hacer la petición
    if ($("#Tabladeventas").length === 0) {
        console.error("El elemento #Tabladeventas no existe en el DOM");
        return;
    }

    $.post("https://saludapos.com/POS2/VistaVentas.php","",function(data){
      $("#Tabladeventas").html(data);
      
      // Después de cargar el contenido, intentar inicializar el autocomplete si existe la función
      setTimeout(function() {
          if (typeof inicializarAutocomplete === 'function') {
              inicializarAutocomplete();
          }
      }, 200);
    }).fail(function(xhr, status, error) {
        console.error("Error al cargar VistaVentas.php:", status, error);
        $("#Tabladeventas").html('<div class="alert alert-danger">Error al cargar el formulario de ventas. Por favor, recarga la página.</div>');
    });
}

// Ejecutar solo cuando el DOM esté listo
$(document).ready(function(){
    CargaGestionventas();
});