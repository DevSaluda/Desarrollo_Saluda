function CargaProductos(){


    $.get("https://saludapos.com/POS2/Consultas/ListaTraspasosAplicados.php","",function(data){
      $("#tablaProductos").html(data);
    })
  
  }
  
  
  
  CargaProductos();