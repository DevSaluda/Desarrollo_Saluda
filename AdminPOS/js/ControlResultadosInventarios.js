function CargaProductos(){


    $.post("https://saludapos.com/AdminPOS/Consultas/ResultadosInventarios.php","",function(data){
      $("#tablaProductos").html(data);
    })
  
  }
  
  
  
  CargaProductos();