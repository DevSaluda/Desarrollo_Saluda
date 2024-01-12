function CargaProductos(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/ProductosCompras.php","",function(data){
      $("#tablaProductos").html(data);
    })

  }
  
  
  
  CargaProductos();