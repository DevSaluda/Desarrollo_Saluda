function CargaProductos(){


    $.get("https://saludapos.com/CEDISMOVIL/Consultas/ListaTraspasos.php","",function(data){
      $("#tablaProductos").html(data);
    })
  
  }
  
  
  
  CargaProductos(); 