function CargaProductos(){


    $.post("https://controlfarmacia.com/POS2/Consultas/DevolucionesGeneradasSucursal.php","",function(data){
      $("#tablaProductos").html(data);
    })

  }
  
  
  
  CargaProductos();