function CargaProductos(){


    $.get("https://controlfarmacia.com/CEDIS/Consultas/ListaTraspasos.php","",function(data){
      $("#tablaProductos").html(data);
    })
  
  }
  
  
  
  CargaProductos();