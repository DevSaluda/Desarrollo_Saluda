function CargaProductos(){


    $.post("https://saludapos.com/AdminPOS/Consultas/ProductosCompras.php","",function(data){
      $("#tablaProductos").html(data);
    })

  }
  
  
  
  CargaProductos();