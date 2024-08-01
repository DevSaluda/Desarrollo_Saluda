function CargaProductos(){


    $.get("https://saludapos.com/CEDISMOVIL/Consultas/ListaTraspasosV2.php","",function(data){
      $("#tablaProductos").html(data);
    })
  
  }
  
  
  
  CargaProductos();