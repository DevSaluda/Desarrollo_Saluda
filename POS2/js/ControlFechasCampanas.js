function CargaFechas(){


    $.get("https://controlfarmacia.com/Controldecitas/Consultas/Fechas.php","",function(data){
      $("#FechasCampanas").html(data);
    })
  
  }
  
  
  
  CargaFechas();

  
