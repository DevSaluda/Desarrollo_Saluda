function CargaProductos(){


    $.post("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/ProductosEliminados.php","",function(data){
      $("#tablaProductos").html(data);
    })

  }
  
  
  
  CargaProductos();