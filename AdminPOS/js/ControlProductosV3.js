function CargaProductos(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/ProductosV3.php","",function(data){
      $("#tablaProductos").html(data);
    })
  
  }
  
  
  
  CargaProductos();