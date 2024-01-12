function CargaProductos(){


    $.get("https://controlfarmacia.com/CEDIS/Consultas/ListaTraspasosPorAceptar.php","",function(data){
      $("#tablaProductos").html(data);
    })
  
  }
  
  
  
  CargaProductos();