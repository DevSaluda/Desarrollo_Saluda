function CargaCitasEnSucursalExt(){


    $.post("https://saludapos.com/POS2/Consultas/CitasEnSucursalExtDias.php","",function(data){
      $("#CitasEnLaSucursalExt").html(data);
      
      // Inicializar DataTables después de cargar el contenido dinámicamente
      setTimeout(function() {
        var table = $('#CitasExteriores');
        if (table.length && !$.fn.DataTable.isDataTable('#CitasExteriores')) {
          table.DataTable({
            "order": [[ 0, "desc" ]],
            bFilter: false,
            "info": false,
            "lengthMenu": [[10,50,200, -1], [10,50,200, "Todos"]],   
            "language": {
              "url": "Componentes/Spanish.json"
            }
          });
        }
      }, 100);
    }).fail(function(xhr, status, error) {
      console.error("Error al cargar citas externas:", status, error);
      $("#CitasEnLaSucursalExt").html('<p class="alert alert-warning">Por el momento no hay citas</p>');
    });
  
  }
  
  
  
  CargaCitasEnSucursalExt();

  
