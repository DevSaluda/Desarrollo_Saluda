function CargaProductos(){


    $.get("https://saludapos.com/POS2/Consultas/ListaTraspasos.php","",function(data){
      $("#tablaProductos").html(data);
    })
  
  }
  
  
  
  CargaProductos();