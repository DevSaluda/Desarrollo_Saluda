function CargaProductos(){


    $.get("https://controlfarmacia.com/JefaturaEnfermeria/Consultas/ListaTraspasosExcel.php","",function(data){
      $("#tablaProductos").html(data);
    })
  
  }
  
  
  
  CargaProductos();