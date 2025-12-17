function CargaCitasEnSucursal(){


    $.post("https://saludapos.com/POS2/Consultas/CitasEnSucursalDias.php","",function(data){
      $("#CitasEnLaSucursal").html(data);
      
      // Inicializar DataTables después de cargar el contenido dinámicamente
      setTimeout(function() {
        var table = $('#CajasSucursales');
        if (table.length && !$.fn.DataTable.isDataTable('#CajasSucursales')) {
          table.DataTable({
            "order": [[ 0, "desc" ]],
            "info": false,
            "lengthMenu": [[10,50,200, -1], [10,50,200, "Todos"]],   
            "language": {
              "url": "Componentes/Spanish.json"
            }
          });
        }
      }, 100);
    }).fail(function(xhr, status, error) {
      // Manejar errores de manera silenciosa
      console.error("Error al cargar citas:", status, error);
      $("#CitasEnLaSucursal").html('<p class="alert alert-warning">Por el momento no hay citas</p>');
    });
  
  }
  
  
  
  CargaCitasEnSucursal();

  
