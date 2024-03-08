function CargaProductos(){


    $.get("https://saludapos.com/AdminPOS/Consultas/ListaTraspasosExcel.php","",function(data){
      $("#tablaProductos").html(data);
    })
  
  }
  
  
  
  CargaProductos();