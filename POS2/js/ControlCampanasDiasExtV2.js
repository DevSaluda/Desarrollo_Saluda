function CargaCitasEnSucursalExt(){


    $.post("https://saludapos.com/POS2/Consultas/CitasEnSucursalExtDias.php","",function(data){
      $("#CitasEnLaSucursalExt").html(data);
      
      // Inicializar DataTables después de que el contenido se haya cargado
      // Verificar que la tabla exista antes de inicializar
      if ($('#CitasExteriores').length && !$.fn.DataTable.isDataTable('#CitasExteriores')) {
        $('#CitasExteriores').DataTable({
          "order": [[ 0, "desc" ]],
          bFilter: false,
          "info": false,
          "lengthMenu": [[10,50,200, -1], [10,50,200, "Todos"]],   
          "language": {
            "url": "Componentes/Spanish.json"
          }
        });
      }
    }).fail(function(xhr, status, error) {
      console.error("Error al cargar citas externas:", status, error);
    });
  
  }
  
  
  
  CargaCitasEnSucursalExt();

  
