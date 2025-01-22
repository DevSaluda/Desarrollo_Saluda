function CargaProductos(){


    $.post("https://saludapos.com/CEDIS/Consultas/ResultadosInventariosContabilizados.php","",function(data){
      $("#tablaProductos").html(data);
    })
  
  }
  
  
  
  CargaProductos();