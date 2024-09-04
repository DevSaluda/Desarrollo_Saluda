function CargaProductos(){


    $.post("https://controlfarmacia.com/POS2/Consultas/Productos.php","",function(data){
      $("#tablaProductos").html(data);
    })

  }
  
  
  
  CargaProductos();