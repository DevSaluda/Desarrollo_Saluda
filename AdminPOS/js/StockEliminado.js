function CargaProductos(){


    $.post("https://saludapos.com/AdminPOS/Consultas/ProductosEliminados.php","",function(data){
      $("#tablaProductos").html(data);
    })

  }
  
  
  
  CargaProductos();