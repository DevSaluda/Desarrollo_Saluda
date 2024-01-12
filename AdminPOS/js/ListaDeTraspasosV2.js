function CargaProductos(){


    $.get("https://controlfarmacia.com/AdminPOS/Consultas/ListaTraspasosV2.php","",function(data){
      $("#tablaProductos").html(data);
    })
  
  }
  
  
  
  CargaProductos();