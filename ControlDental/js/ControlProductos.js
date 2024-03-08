function CargaProductos(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/Productos.php","",function(data){
      $("#tablaProductos").html(data);
    })

  }
  
  
  
  CargaProductos();