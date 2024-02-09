function CargaProductos(){


    $.post("https://saludapos.com/AdminPOS/Consultas/Productos.php","",function(data){
      $("#tablaProductos").html(data);
    })

  }
  
  
  
  CargaProductos();