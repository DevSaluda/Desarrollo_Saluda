function CargaProductos(){


    $.get("https://controlfarmacia.com/AdminPOS/Consultas/ListaTraspasos.php","",function(data){
      $("#tablaProductos").html(data);
    })
  
  }
  
  
  
  CargaProductos();