function CargaProductos(){


    $.get("https://controlfarmacia.com/AdminPOS/Consultas/ListaTraspasosExcel.php","",function(data){
      $("#tablaProductos").html(data);
    })
  
  }
  
  
  
  CargaProductos();