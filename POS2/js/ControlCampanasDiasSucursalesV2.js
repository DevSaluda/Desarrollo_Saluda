function CargaCitasEnSucursal(){


    $.post("https://saludapos.com/POS2/Consultas/CitasEnSucursalDias.php","",function(data){
      $("#CitasEnLaSucursal").html(data);
    }).fail(function(xhr, status, error) {
      // Manejar errores de manera silenciosa
      console.error("Error al cargar citas:", status, error);
      $("#CitasEnLaSucursal").html('<p class="alert alert-warning">Por el momento no hay citas</p>');
    });
  
  }
  
  
  
  CargaCitasEnSucursal();

  
