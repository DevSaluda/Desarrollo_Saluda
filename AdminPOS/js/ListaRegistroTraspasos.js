function CargaProductos(){


    $.get("https://controlfarmacia.com/AdminPOS/Consultas/ListaRegistrosTraspasos.php","",function(data){
      $("#tablaProductos").html(data);
    })
  
  }
  
  
  
  CargaProductos();