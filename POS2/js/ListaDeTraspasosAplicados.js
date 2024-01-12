function CargaProductos(){


    $.get("https://controlfarmacia.com/POS2/Consultas/ListaTraspasosAplicados.php","",function(data){
      $("#tablaProductos").html(data);
    })
  
  }
  
  
  
  CargaProductos();