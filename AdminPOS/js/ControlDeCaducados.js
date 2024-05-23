function CargaProductos(){


    $.post("https://saludapos.com/AdminPOS/Consultas/ListadoDeCaducadosPorDia.php","",function(data){
      $("#tablaProductos").html(data);
    })
  
  }
  
  
  
  CargaProductos();