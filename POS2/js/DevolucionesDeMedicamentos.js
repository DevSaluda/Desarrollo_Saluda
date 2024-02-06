function CargaProductos(){


    $.post("https://saludapos.com/POS2/Consultas/DevolucionesGeneradasSucursal.php","",function(data){
      $("#tablaProductos").html(data);
    })

  }
  
  
  
  CargaProductos();