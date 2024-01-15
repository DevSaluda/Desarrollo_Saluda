function CargaProductos(){


    $.get("https://saludapos.com/CEDIS/Consultas/ListaTraspasos.php","",function(data){
      $("#tablaProductos").html(data);
    })
  
  }
  
  
  
  CargaProductos();