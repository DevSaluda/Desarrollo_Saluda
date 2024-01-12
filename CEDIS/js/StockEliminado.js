function CargaProductos(){


    $.post("https://controlfarmacia.com/CEDIS/Consultas/ProductosEliminados.php","",function(data){
      $("#tablaProductos").html(data);
    })

  }
  
  
  
  CargaProductos();