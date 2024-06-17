function CargaProductos(){


    $.get("https://saludapos.com/AdminPOS/Consultas/ListaRegistrosTraspasos.php","",function(data){
      $("#tablaProductos").html(data);
    })
  
  }
  
  
  
  CargaProductos();