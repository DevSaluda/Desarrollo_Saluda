function CargaProductos(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/ProductosEliminados.php","",function(data){
      $("#tablaProductos").html(data);
    })

  }
  
  
  
  CargaProductos();