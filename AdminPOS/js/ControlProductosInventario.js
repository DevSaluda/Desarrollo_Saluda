function CargaProductos(){


    $.post("https://controlfarmacia.com/AdminPOS/Consultas/ProductosInventarios.php","",function(data){
      $("#tablaProductosInventarios").html(data);
    })

  }
  
  
  
  CargaProductos();