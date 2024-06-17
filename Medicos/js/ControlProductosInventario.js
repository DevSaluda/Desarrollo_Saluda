function CargaProductos(){


    $.post("https://saludapos.com/AdminPOS/Consultas/ProductosInventarios.php","",function(data){
      $("#tablaProductosInventarios").html(data);
    })

  }
  
  
  
  CargaProductos();