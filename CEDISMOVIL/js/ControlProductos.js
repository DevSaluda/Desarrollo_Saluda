function CargaProductos(){


    $.post("https://saludapos.com/CEDISMOVIL/Consultas/Productos.php","",function(data){
      $("#tablaProductos").html(data);
    })

  }
  
  
  
  CargaProductos();