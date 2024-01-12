function CargaProductos(){


    $.get("https://controlfarmacia.com/POS2/Consultas/ListaTraspasos.php","",function(data){
      $("#tablaProductos").html(data);
    })
  
  }
  
  
  
  CargaProductos();