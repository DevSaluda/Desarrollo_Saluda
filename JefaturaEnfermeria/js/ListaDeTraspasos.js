function CargaProductos(){


    $.get("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/ListaTraspasos.php","",function(data){
      $("#tablaProductos").html(data);
    })
  
  }
  
  
  
  CargaProductos();