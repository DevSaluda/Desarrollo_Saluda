function CargaProductos(){


    $.get("https://controlfarmacia.com/CEDISMOVIL/Consultas/ListaTraspasos.php","",function(data){
      $("#tablaProductos").html(data);
    })
  
  }
  
  
  
  CargaProductos(); 