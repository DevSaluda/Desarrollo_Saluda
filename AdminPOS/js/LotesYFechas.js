function CargaProductos(){


    $.post("https://saludapos.com/AdminPOS/Consultas/ResultadosInventariosContabilizados.php","",function(data){
      $("#tablaProductos").html(data);
    })
  
  }
  
  
  
  CargaProductos();