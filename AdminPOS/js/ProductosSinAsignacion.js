function CargaProductos(){


    $.post("https://saludapos.com/AdminPOS/Consultas/ProductosSinAsignar.php","",function(data){
      $("#tablaProductos").html(data);
    })
  
  }
  
  
  
  CargaProductos();