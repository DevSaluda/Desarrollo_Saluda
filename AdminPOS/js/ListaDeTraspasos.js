function CargaProductos(){


    $.get("https://saludapos.com/AdminPOS/Consultas/ListaTraspasos.php","",function(data){
      $("#tablaProductos").html(data);
    })
  
  }
  
  
  
  CargaProductos();